<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Exception;
use App\Mail\WebsiteMail;
use App\Models\Agent;
use App\Models\User;
use App\Models\Admin;
use App\Models\Package;
use App\Models\Property;
use App\Models\PropertyGallery;
use App\Models\PropertyVideo;
use App\Models\Order;
use App\Models\Location;
use App\Models\Type;
use App\Models\Amenity;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\ReplyConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Stripe\StripeClient;


class AgentController extends Controller
{

    public function dashboard(){

        $data['active_property'] = Property::where('agent_id',Auth::guard('agent')->user()->id)->where('status',1)->count();

        $data['pending_property'] = Property::where('agent_id',Auth::guard('agent')->user()->id)->where('status',0)->count();

        $data['featured_property'] = Property::where('agent_id',Auth::guard('agent')->user()->id)->where('status',1)->where('is_featured',1)->count();

        $data['properties'] = Property::orderBy('id','desc')->where('agent_id',Auth::guard('agent')->user()->id)->where('status',1)->take(2)->get();

        return view('Backend.agent.dashboard.index',$data);
    }
    public function register(){
        return view('backend.agent.auth.registration');
    }

    public function registration_submit(Request $request){
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'designation' => 'required',
            'email' => 'required | email | unique:agents,email',
            'password' => 'required',
            'confirm_password' => 'required | same:password',
        ]);

        $token = hash('sha256', time());

        $agent = new Agent();
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->password = bcrypt($request->password);
        $agent->token = $token;
        $agent->save();

        $link = route('agent_registration_verify',[$token, $request->email]);
        $subject = 'Agent Registration Verify';
        $message = 'Click on the following link to verify your email: <br> <a href="' .$link .'">' .$link .'</a>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->back()->with('success','Registration successful please check your email to verify your account');
    }

    public function registration_verify($token,$email){

        $agent = Agent::where('email',$email)->where('token',$token)->first();

        if(!$agent){
            return redirect()->route('login')->with('error','Invalid token or email');
        }

        $agent->token = '';
        $agent->status = 1;
        $agent->update();

        return redirect()->route('login')->with('success','Email verified successful. You can now login');
    }

    public function login(){
        return view('Backend.agent.auth.login');
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $status = Agent::where('email',$request->email)->first();

        if($status == null){
            return redirect()->back()->with('error','Account not found.');
        }

        if($status->status == 0){
            return redirect()->back()->with('error','Account is pending.');

        }elseif($status->status == 2){
            return redirect()->back()->with('error','Account is suspended.');

        }

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];

        if(Auth::guard('agent')->attempt($data)){
            return redirect()->route('agent_dashboard')->with('success','Logged Successfully');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function logout(){
        Auth::guard('agent')->logout();
        return redirect()->route('agent_login')->with('info','Logged out Successfully');
    }
    public function forget_password(){
        return view('Backend.agent.auth.forget_password');
    }

    public function forget_password_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $agent = Agent::where('email',$request->email)->first();

        if(!$agent){
            return redirect()->back()->with('error','Email not found');
        }

        $token = hash('sha256', time());
        $agent->token =$token;
        $agent->update();

        $link = route('agent_reset_password',[$token,$request->email]);
        $subject = 'Agent Reset Password';
        $massage = 'Click on the following link to reset your password: <br>';
        $massage .= '<a href="'.$link . '">' .$link .'</a>';


        Mail::to($request->email)->send(new WebsiteMail($subject,$massage));

        return redirect()->back()->with('info', 'Reset password link sent to your email');

    }

    public function reset_password($token,$email){

        $agent = Agent::where('email',$email)->where('token',$token)->first();

        if(!$agent){
            return redirect()->route('agent_login')->with('error','Invalid token or email');
        }

        return view('Backend.agent.auth.reset_password',compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email){
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $agent = Agent::where('email',$email)->where('token',$token)->first();
        $agent->password = bcrypt($request->password);
        $agent->token = '';
        $agent->update();

        return redirect()->route('agent_login')->with('success','Password reset successfully');
    }

    public function profile(){
        return view('backend.agent.profile.index');
    }
    public function profile_submit(Request $request){

        $request->validate([
            'name' => 'required',
            'company' => 'required|max:255',
            'designation' => 'required|max:255',
        ]);
        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required | same:password',
            ]);
        }

        $agent = Agent::where('id', Auth::guard('agent')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'agent_'. time(). '.' . $request->photo->extension();

            if($agent->photo != ''){
                unlink(public_path('uploads/agent/'. $agent->photo.''));
            }
            $request->photo->move(public_path('uploads/agent'),$fileName);

        }else{
            $fileName = $agent->photo;
        }

        $agent->name = $request->name;
        $agent->photo = $fileName;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->biography = $request->biography;
        $agent->short_biography = $request->short_biography;
        $agent->phone = $request->phone;
        $agent->address = $request->address;
        $agent->country = $request->country;
        $agent->state = $request->state;
        $agent->city = $request->city;
        $agent->zip = $request->zip;
        $agent->website = $request->website;
        $agent->facebook = $request->facebook;
        $agent->twitter = $request->twitter;
        $agent->linkedin = $request->linkedin;
        $agent->instagram = $request->instagram;
        $agent->whatsapp = $request->whatsapp;
        if($request->password){
            $agent->password = bcrypt($request->password);
        }
        $agent->update();


        return redirect()->back()->with('info','Profile Updated successfully');
    }

    public function payment(){

        $total_current_order = Order::where('agent_id',Auth::guard('agent')->user()->id)->count();
        $packages = Package::orderBy('id','asc')->get();
        $current_order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        //How many days left for the current order

        if($current_order){
            $days_left = (strtotime($current_order->expire_date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
        }else{
            $days_left = 0;
        }

        return view('backend.agent.payment.index',compact('packages','total_current_order','current_order','days_left'));
    }
    public function order(){
        $orders = Order::where('agent_id',Auth::guard('agent')->user()->id)->orderBy('id','desc')->get();
        return view('backend.agent.dashboard.orders',compact('orders'));
    }

    public function invoice($id){

        $order = Order::where('id',$id)->first();
        $admin_data = Admin::where('id',1)->first();

        return view('backend.agent.dashboard.invoice',compact('order','admin_data'));
    }

    public function stripe(Request $request)
    {
        $package_data = Package::findOrFail($request->package_id);

        // ✅ Initialize Stripe
        $stripe = new StripeClient(config('stripe.stripe_sk'));

        // ✅ Create checkout session
        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $package_data->name,
                    ],
                    'unit_amount' => $package_data->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('agent_stripe_success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('agent_stripe_cancel'),
        ]);

        // ✅ Store package ID and redirect to Stripe Checkout
        if (!empty($session->id)) {
            session()->put('package_id', $request->package_id);
            return redirect($session->url);
        } else {
            return redirect()->route('agent_payment')->with('error', 'Payment failed. Please try again.');
        }
    }

    public function stripe_success(Request $request){

        if(isset($request->session_id)){

            $stripe = new StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $package_data = Package::where('id',session()->get('package_id'))->first();

            $admin_data = Admin::where('id',1)->first();

            // ✅ Make invoice

            $invoice_no = 'INV-'.Auth::guard('agent')->user()->id.'-'.time();

            Order::where('agent_id',Auth::guard('agent')->user()->id)->update([ 'currently_active' => 0 ]);

            $order = new Order();
            $order->agent_id = Auth::guard('agent')->user()->id;
            $order->package_id = session()->get('package_id');
            $order->invoice_no = $invoice_no;
            $order->transaction_id = $response->id;
            $order->payment_method = 'Stripe';
            $order->paid_amount = $package_data->price;
            $order->purchase_date = date('Y-m-d');
            $order->expire_date = date('Y-m-d', strtotime('+' .$package_data->allowed_days. 'days'));
            $order->status = 'Completed';
            $order->currently_active = 1;
            $order->save();

            // ✅ Sending mail to Agent

            $link = route('agent_order');
            $subject = 'Payment Successfully';
            $message = 'Dear '.Auth::guard('agent')->user()->name.','.'<br><br>';
            $message = 'New order has been received. Payment information is given below! <b><b>';
            $message .= 'Invoice No: '.$invoice_no.'<br>';
            $message .= 'Transaction ID: '.$response->id.'<br>';
            $message .= 'Package Name: '.$package_data->name.'<br>';
            $message .= 'Payment Method: '.'Stripe'.'<br>';
            $message .= 'Paid Amount: '.'$'.$package_data->price.'<br>';
            $message .= 'Purchase Date: '.date('Y-m-d').'<br>';
            $message .= 'Expire Date: '.date('Y-m-d', strtotime('+'.$package_data->allowed_days.'days')).'<br><br>';
            $message .= 'Click on the following link to view your order.'.'<br>';
            $message .= '<a href="'.$link.'">'.$link.'</a>'.'<br>';
            $message .= 'Thank you for your oder'.'<br>';
            $message .= 'Best Regards'.'<br>';
            $message .= env("APP_NAME").'<br>';

            Mail::to(Auth::guard('agent')->user()->email)->send(new WebsiteMail($subject,$message));

            // ✅ Sending mail to Admin

            $link = route('admin_order_index');
            $subject = 'New Order Received';
            $message = 'Dear Admin, <b><b>';
            $message = 'New order has been received. Payment information is given below! <b><b>';
            $message .= 'Invoice No: '.$invoice_no.'<br>';
            $message .= 'Agent Name: '.Auth::guard('agent')->user()->name.'<br>';
            $message .= 'Agent Email: '.Auth::guard('agent')->user()->email.'<br>';
            $message .= 'Transaction ID: '.$response->id.'<br>';
            $message .= 'Package Name: '.$package_data->name.'<br>';
            $message .= 'Payment Method: '.'Stripe'.'<br>';
            $message .= 'Paid Amount: '.'$'.$package_data->price.'<br>';
            $message .= 'Purchase Date: '.date('Y-m-d').'<br>';
            $message .= 'Expire Date: '.date('Y-m-d', strtotime('+'.$package_data->allowed_days.'days')).'<br><br>';
            $message .= 'Click on the following link to view your order.'.'<br>';
            $message .= '<a href="'.$link.'">'.$link.'</a>'.'<br>';
            $message .= 'Thank you for your oder'.'<br>';
            $message .= 'Best Regards'.'<br>';
            $message .= env("APP_NAME").'<br>';

            Mail::to($admin_data->email)->send(new WebsiteMail($subject,$message));

            session()->forget('package_id');

            return redirect()->route('agent_order')->with('success', 'Payment is successful. Your order has been placed');
        }else{
            return redirect()->route('agent_payment')->with('error', 'Payment is failed. Please try again.');
        }
    }

    //Property Section

    public function property_index(){

        //check the agent purchase any package
        $order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        if(!$order){
            return redirect()->route('agent_payment')->with('error', 'You cannot purchase any package yet. Please purchase package to insert property.');
        }

        //properties count, package over can't insert property
        if($order->package->allowed_properties <= Property::where('agent_id',Auth::guard('agent')->user()->id)->count()){
            return redirect()->route('agent_payment')->with('error', 'You have reached the maximum number of the property allowed in your package. Please purchase a new package to insert more properties');
        }

        $properties = Property::orderBy('id','desc')->where('agent_id', Auth::guard('agent')->user()->id)->get();

        return view('backend.agent.properties.index',compact('properties'));
    }
    public function property_create(){

        //check the agent purchase any package
        $order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        if(!$order){
            return redirect()->route('agent_payment')->with('error', 'You cannot purchase any package yet. Please purchase package to insert property.');
        }

        //properties count, package over can't insert property
        if($order->package->allowed_properties <= Property::where('agent_id',Auth::guard('agent')->user()->id)->count()){
            return redirect()->route('agent_payment')->with('error', 'You have reached the maximum number of the property allowed in your package. Please purchase a new package to insert more properties');
        }

        //check the package is expired
        if($order->expire_date < date('Y-m-d')){

            return redirect()->back()->with('error','Your package date is Expire, Please purchase a new package.');
        }

        $locations = Location::orderBy('id','asc')->get();
        $types = Type::orderBy('id','asc')->get();
        $amenities = Amenity::orderBy('id','asc')->get();

        return view('backend.agent.properties.create',compact('locations','types','amenities'));
    }

    public function property_store(Request $request){

        //check the agent purchase any package
        $order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        if(!$order){
            return redirect()->route('agent_payment')->with('error', 'You cannot purchase any package yet. Please purchase package to insert property.');
        }

        //featured properties count, package over can't insert property
        if($request->is_featured == 1){
            if($order->package->allowed_featured_properties <= Property::where('agent_id',Auth::guard('agent')->user()->id)->where('is_featured',1)->count()){
            return redirect()->back()->with('error', 'You have reached the maximum number of the featured properties allowed in your package. Please purchase a new package to insert more featured properties');
        }
        }

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:properties,slug',
            'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'location_id' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'purpose' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'size' => 'required',
            'floor' => 'required',
            'balcony' => 'required',
            'garage' => 'required',
            'built_year' => 'required',
            'is_featured' => 'required',
        ]);

        $slug = Str::slug($request->slug);


        $fileName = 'property_'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/properties'),$fileName);

        try{
            $properties = new Property();
        $properties->name = $request->name;
        $properties->slug = $slug;
        $properties->featured_photo = $fileName;
        $properties->agent_id = Auth::guard('agent')->user()->id;
        $properties->location_id = $request->location_id;
        $properties->type_id = $request->type_id;
        $properties->amenities = implode(',',$request->amenity);
        $properties->description = $request->description;
        $properties->price = $request->price;
        $properties->purpose = $request->purpose;
        $properties->bedroom = $request->bedroom;
        $properties->bathroom = $request->bathroom;
        $properties->size = $request->size;
        $properties->floor = $request->floor;
        $properties->balcony = $request->balcony;
        $properties->garage = $request->garage;
        $properties->address = $request->address;
        $properties->built_year = $request->built_year;
        $properties->map = $request->map;
        $properties->is_featured = $request->is_featured;
        $properties->status = 0;
        $properties->save();


        //update total properties on location table
        $location = Location::where('id',$request->location_id)->first();
        $location->total_properties = $location->total_properties + 1 ;
        $location->update();

        //Send email to Admin

        $admin_data = Admin::where('id',1)->first();
        $admin_email = $admin_data->email;

        $link = route('admin_property_index');
        $subject = "A new property has been added.";
        $message = "Here some information about Property: <br><br>";
        $message .= "Property Title: " .$request->name. "<br>";
        $message .= "Property Price: " .$request->price. "<br>";
        $message .= "Property Purpose: " .$request->purpose. "<br>";
        $message .= "Property Added Agent: " .Auth::guard('agent')->user()->name. "<br>";
        $message .= "Agent Email: " .Auth::guard('agent')->user()->email. "<br>";
        $message .= "Please check the following link to see the pending property that is currently added to the system.<br>";
        $message .= "<a href='".$link."'>".$link."</a>";

        Mail::to($admin_email)->send(new WebsiteMail($subject,$message));

        return redirect()->route('agent_property_index')->with('success','Property Added Successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }


    public function property_edit($id){


        $singleProperty = Property::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();

        if(!$singleProperty){
            return redirect()->back()->with('error','Property not found!');
        }

        $existing_amenities = explode(',',$singleProperty->amenities);
        $locations = Location::orderBy('id','asc')->get();
        $types = Type::orderBy('id','asc')->get();
        $amenities = Amenity::orderBy('id','asc')->get();


        return view('backend.agent.properties.edit',compact('singleProperty','amenities','types','locations','existing_amenities'));
    }

    public function property_update(Request $request,$id){


        $request->validate([
            'name' => 'required',
            'slug' => [
                        'required',
                        Rule::unique('properties', 'slug')->ignore($id),],
            'location_id' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'purpose' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'size' => 'required',
            'floor' => 'required',
            'balcony' => 'required',
            'garage' => 'required',
            'built_year' => 'required',
            'is_featured' => 'required',
        ]);


        $property = Property::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();


        $slug = Str::slug($request->slug);

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'property_'. time(). '.' . $request->photo->extension();

            if($property->featured_photo != ''){
                unlink(public_path('uploads/properties/'. $property->featured_photo.''));
            }
            $request->photo->move(public_path('uploads/properties'),$fileName);

        }else{
            $fileName = $property->featured_photo;
        }

        //update minus total properties on location table
        $minus_location = Location::where('id',$property->location_id)->first();
        $minus_location->total_properties = $minus_location->total_properties - 1 ;
        $minus_location->update();

        try{

        $property->name = $request->name;
        $property->slug = $slug;
        $property->featured_photo = $fileName;
        $property->location_id = $request->location_id;
        $property->type_id = $request->type_id;
        $property->amenities = implode(',',$request->amenity);
        $property->description = $request->description;
        $property->price = $request->price;
        $property->purpose = $request->purpose;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->size = $request->size;
        $property->floor = $request->floor;
        $property->balcony = $request->balcony;
        $property->garage = $request->garage;
        $property->address = $request->address;
        $property->built_year = $request->built_year;
        $property->map = $request->map;
        $property->is_featured = $request->is_featured;
        $property->status = 0;
        $property->update();

        //update plus total properties on location table
        $location = Location::where('id',$request->location_id)->first();
        $location->total_properties = $location->total_properties + 1 ;
        $location->update();

        return redirect()->route('agent_property_index')->with('success','Property Updated Successfully');

        }catch(Exception $e){

        //update minus replace total properties on location table
        $minus_location = Location::where('id',$property->location_id)->first();
        $minus_location->total_properties = $minus_location->total_properties + 1 ;
        $minus_location->update();

            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function property_destroy( $id){
        $property = Property::where('id',$id)->first();

        if(!$property){
            return redirect()->route('agent_property_index')->with('info','Property not Found');
        }

        if($property->featured_photo != ''){
                unlink(public_path('uploads/properties/'. $property->featured_photo.''));
            }

        if($property){
            $property->delete();

            //update minus total properties on location table
            $minus_location = Location::where('id',$property->location_id)->first();
            $minus_location->total_properties = $minus_location->total_properties - 1 ;
            $minus_location->update();

            //property_photo delete

            $property_photos = PropertyGallery::where('property_id',$property->id)->get();

            if(!empty($property_photo)){

                foreach($property_photos as $item){
                unlink(public_path('uploads/properties/galleries/'. $item->photo.''));
                $item->delete();
                }
            }

            //property Videos delete

            $videos = PropertyVideo::where('property_id',$property->id)->get();

            if($videos){

                foreach($videos as $video){
                    $video->delete();
                }
            }


            return redirect()->route('agent_property_index')->with('warning','Property Deleted Successfully');
        }else{
            return redirect()->route('agent_property_index')->with('info','Property not Found');
        }
    }

    // Property Photo

    public function property_photo_gallery( $id){

        $property = Property::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();

        if(!$property){
            return redirect()->route('agent_property_index')->with('info','Property not Found');
        }

        $galleries = PropertyGallery::where('property_id',$property->id)->get();

        return view('backend.agent.properties.photo_gallery',compact('property','galleries'));
    }


    public function property_photo_gallery_store(Request $request, $id){

        //check the agent purchase any package
        $order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        if(!$order){
            return redirect()->route('agent_payment')->with('error', 'You cannot purchase any package yet. Please purchase package to insert property.');
        }

        //check the photos count, package over can't insert property photos
        if($order->package->allowed_photos <= PropertyGallery::where('property_id',$id)->count()){
            return redirect()->back()->with('error', 'You have reached the maximum number of the photos allowed in your package. Please purchase a new package to insert more photos');
        }

        $property = Property::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();

        if(!$property){
            return redirect()->route('agent_property_index')->with('info','Property not Found');
        }

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'gallery'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/properties/galleries'),$fileName);

            try{

            $gallery = new PropertyGallery();
            $gallery->property_id = $property->id;
            $gallery->photo = $fileName;
            $gallery->save();

            return redirect()->route('agent_property_photo_gallery',$gallery->property_id)->with('status','Property Gallery Added Successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

        }
    }


    public function property_photo_gallery_delete($id){

        $gallery = PropertyGallery::where('id',$id)->first();

        if(!$gallery){
            return redirect()->route('agent_property_photo_gallery',$gallery->property_id)->with('info','Property Gallery Photo not Found');
        }

        if($gallery->photo != ''){
                unlink(public_path('uploads/properties/galleries/'. $gallery->photo.''));
            }

        if($gallery){
            $gallery->delete();

            return redirect()->route('agent_property_photo_gallery',$gallery->property_id)->with('warning','Property Gallery Photo Deleted Successfully');
        }else{
            return redirect()->route('agent_property_photo_gallery',$gallery->property_id)->with('info','Property Gallery Photo not Found');
        }
    }

    // Property Video

    public function property_video_gallery( $id){

        $property = Property::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();

        if(!$property){
            return redirect()->route('agent_property_index')->with('info','Property not Found');
        }

        $videos = PropertyVideo::where('property_id',$property->id)->get();


        return view('backend.agent.properties.video_gallery',compact('property','videos'));
    }


    public function property_video_gallery_store(Request $request, $id){

        //check the agent purchase any package
        $order = Order::where('agent_id',Auth::guard('agent')->user()->id)->where('currently_active',1)->first();

        if(!$order){
            return redirect()->route('agent_payment')->with('error', 'You cannot purchase any package yet. Please purchase package to insert property.');
        }

        //check the videos count, package over can't insert property videos
        if($order->package->allowed_videos <= PropertyVideo::where('property_id',$id)->count()){
            return redirect()->back()->with('error', 'You have reached the maximum number of the videos allowed in your package. Please purchase a new package to insert more videos');
        }

        $property = Property::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();

        if(!$property){
            return redirect()->route('agent_property_index')->with('info','Property not Found');
        }

        if($request->video){
            $request->validate([
                'video' => 'required',
            ]);

            try{

            $video = new PropertyVideo();
            $video->property_id = $property->id;
            $video->video = $request->video;
            $video->save();

            return redirect()->route('agent_property_video_gallery',$video->property_id)->with('status','Property Video Added Successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

        }
    }


    public function property_video_gallery_delete($id){

        $video = PropertyVideo::where('id',$id)->first();

        if(!$video){
            return redirect()->route('agent_property_video_gallery',$video->property_id)->with('info','Property Gallery video not Found');
        }

        if($video){
            $video->delete();

            return redirect()->route('agent_property_video_gallery',$video->property_id)->with('warning','Property Gallery Photo Deleted Successfully');
        }else{
            return redirect()->route('agent_property_video_gallery',$video->property_id)->with('info','Property Gallery video not Found');
        }
    }

    public function message_index(){
        $messages = Message::orderBy('id','desc')->where('agent_id',Auth::guard('agent')->user()->id)->get();

        return view('backend.agent.dashboard.messages.index',compact('messages'));
    }
    public function message_chat($id){
        $message = Message::where('id',$id)->where('agent_id',Auth::guard('agent')->user()->id)->first();
        $user = User::where('id',$message->user_id)->where('status',1)->first();
        $agent = Agent::where('id',Auth::guard('agent')->user()->id)->first();
        $conversations = Conversation::orderBy('id','asc')->where('message_id',$id)->get();
        $reply_conversations = ReplyConversation::orderBy('id','asc')->where('message_id',$id)->get();

        return view('backend.agent.dashboard.messages.details',compact('message','agent','user','conversations','reply_conversations'));
    }

    public function message_conversation( Request $request ,$id){
        $fileName = null;

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            ]);

            $file = $request->file('file');
            $fileName = 'rep_conversation_' . time() . '.' . $file->getClientOriginalExtension(); // or ->extension()
            $file->move(public_path('uploads/users/messages/conversation'), $fileName);
        }

        $reply_conversations = new ReplyConversation();
        $reply_conversations->user_id = $request->user_id;
        $reply_conversations->agent_id = Auth::guard('agent')->user()->id;
        $reply_conversations->message_id = $id;

        if($request->reply_conversation_body){
            $reply_conversations->reply_conversation_body = $request->reply_conversation_body;
        }

        if ($fileName) {
            $reply_conversations->reply_conversation_file = $fileName;
        }

        $reply_conversations->save();


        return redirect()->back()->with('status','Message Send Successfully');
    }
}
