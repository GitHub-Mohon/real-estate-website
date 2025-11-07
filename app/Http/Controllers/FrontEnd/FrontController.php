<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Mail\WebsiteMail;
use App\Models\Order;
use App\Models\Property;
use App\Models\PropertyGallery;
use App\Models\PropertyVideo;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\User;
use App\Models\Amenity;
use App\Models\Location;
use App\Models\Type;
use App\Models\Wishlist;
use App\Models\Post;
use App\Models\Comment;
use App\Models\ReplyComment;
use App\Models\Message;
use App\Models\Testimonial;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class FrontController extends Controller
{


    public function index(){

        $order = Order::where('status','Completed')->where('currently_active',1)
                ->where('expire_date','<', now())->first();

            //Check package date is expire and property is hide
            if($order){
                $expire_property = Property::where('agent_id',$order->agent_id)->where('status',1)->get();

                $property_ids = $expire_property->pluck('id');

                foreach($property_ids as $property_id){

                    $hide_property = Property::where('id',$property_id)->where('status',1)->first();

                    $hide_property->status = 0;
                    $hide_property->update();
                }
            }

        $featured_property = Property::orderBy('price','desc')->where('status',1)->first();

        $properties = Property::orderBy('id','asc')->where('id',"!=",$featured_property->id)->where('status',1)->take(3)->get();

        $properties_ids = $properties->pluck('id');

        $side_properties = Property::orderBy('id','asc')->whereNotIn('id',$properties_ids)->where('id',"!=",$featured_property->id)->where('status',1)->take(3)->get();


        $best3agent = Agent::orderBy('id','asc')->where('status',1)->take(3)->get();
        $best3location = Location::orderBy('id','asc')->take(3)->get();

        $search_locations = Location::orderBy('name','asc')->get();
        $search_types = Type::orderBy('name','asc')->get();

        //blog
        $posts = Post::orderBy('id','desc')->take(3)->get();

        //Testimonial
        $testimonials = Testimonial::orderBy('id','desc')->get();



        return view('frontEnd.home',compact('properties','best3agent','best3location','featured_property', 'side_properties','search_locations','search_types','posts','testimonials'));
    }
    public function about(){
        return view('frontEnd.about');
    }
    public function contact(){
        return view('frontEnd.contact');
    }

     public function contact_submit(Request $request){
        $request->validate([
            'email' => 'required | email ',
            'name' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $admin = Admin::where('id',1)->first();

        $subject = 'Contact Form Message';
        $message = 'Sender Information: <br> <br>';
        $message .= '<b> Name:</b> '. $request->name.'<br>';
        $message .= '<b> Email:</b> '. $request->email.'<br>';
        $message .= '<b> Subject:</b> '. $request->subject.'<br>';
        $message .= '<b> Message:</b> '. nl2br($request->message).'<br>';

        Mail::to($admin->email)->send(new WebsiteMail($subject,$message));

        return redirect()->back()->with('success','Your message has been sent. Thank you!');
    }

    public function select_user(){
        return view('frontEnd.select_user');
    }
    public function pricing(){

        $packages = Package::orderBy('id','asc')->get();

        return view('frontEnd.pricing',compact('packages'));
    }

    public function property_details($slug){
        $property = Property::where('slug',$slug)->where('status',1)->first();

        if(!$property){

            return redirect()->back()->with('error','Property not fund');
        }

        $galleries = PropertyGallery::where('property_id',$property->id)->get();
        $videos = PropertyVideo::where('property_id',$property->id)->get();

        $existing_amenities = explode(',',$property->amenities);
        $amenities = Amenity::whereIn('id',$existing_amenities)->get();



        return view('frontend.property_details',compact('property','galleries','videos','amenities',));
    }

    public function properties(Request $request){

        $order = Order::where('status','Completed')->where('currently_active',1)
                ->where('expire_date','<', now())->first();

            //Check package date is expire and property is hide
            if($order){
                $expire_property = Property::where('agent_id',$order->agent_id)->where('status',1)->get();

                $property_ids = $expire_property->pluck('id');

                foreach($property_ids as $property_id){

                    $hide_property = Property::where('id',$property_id)->where('status',1)->first();

                    $hide_property->status = 0;
                    $hide_property->update();
                }
            }

        //wishlist by user

        if (Auth::check()) {
            $wishlists = Wishlist::orderBy('id', 'asc')
                ->where('user_id', Auth::id())
                ->get();
                } else {
                 $wishlists = collect(); // return empty collection if not logged in
                }


        $properties_side = Property::orderBy('id','desc')->where('status',1)->take(3)->get();
        //property search filter

        $properties = Property::where('status',1);

        if($request->name !== null){
            $properties = $properties->where('name','LIKE','%'.$request->name.'%');
        }
        if($request->location !== null){
            $properties = $properties->where('location_id',$request->location);
        }
        if($request->type !== null){
            $properties = $properties->where('type_id',$request->type);
        }
        if($request->purpose !== null){
            $properties = $properties->where('purpose',$request->purpose);
        }
        if($request->bedrooms !== null){
            $properties = $properties->where('bedroom',$request->bedrooms);
        }
        if($request->bathrooms !== null){
            $properties = $properties->where('bathroom',$request->bathrooms);
        }
        if($request->min_price !== null){
            $properties = $properties->where('price','>=',$request->min_price);
        }
        if($request->max_price !== null){
            $properties = $properties->where('price','<=',$request->max_price);
        }
        if($request->price_range !== null){
            $properties = $properties->where('price','between',$request->price_range);
        }
        if($request->amenity !== null){
            $properties = $properties->whereRaw('FIND_IN_SET(?, amenities)',[$request->amenity]);
        }


        $properties = $properties->orderBy('id','desc')->paginate(4);


        //existing value send blade

        $form_name = $request->name;
        $form_location = $request->location;
        $form_type = $request->type;
        $form_purpose = $request->purpose;
        $form_min_price = $request->min_price;
        $form_max_price = $request->max_price;
        $form_amenity = $request->amenity;


        $locations = Location::orderBy('name','asc')->get();
        $types = Type::orderBy('name','asc')->get();
        $amenities = Amenity::orderBy('name','asc')->get();

        return view('frontend.properties',compact('properties','properties_side','locations','types','amenities','form_name','form_location','form_type','form_purpose','form_min_price','form_max_price','form_amenity','wishlists'));
    }

    public function locations(){
        $locations = Location::orderBy('total_properties','desc')->paginate(6);

        return view('frontend.locations',compact('locations'));
    }

    public function agents(){
        $first_agent = Agent::where('id',1)->where('status',1)->first();
        $all_agent = Agent::orderBy('id','asc')->where('id',"!=", $first_agent->id)->where('status',1)->paginate(4);

        return view('frontend.all_agents',compact('first_agent','all_agent'));
    }
    public function agent_details($id){
        $agent = Agent::where('id',$id)->where('status',1)->first();
        $active_property = Property::where('agent_id',$id)->where('status',1)->count();

        return view('frontend.agent_details',compact('agent','active_property'));
    }
    public function agent_send_mail(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user = Auth::user();

        if($user){

            $message = Message::where('user_id',$user->id)->where('agent_id',$id)->first();

            if(!$message){

                $new_mgs = new Message();
                $new_mgs->user_id = $user->id;
                $new_mgs->agent_id = $id;
                $new_mgs->subject = $request->subject;
                $new_mgs->message_body = $request->message;
                $new_mgs->save();
            }
        }

        $agent = Agent::where('id',$id)->where('status',1)->first();

        $subject = 'Contact Form Message';
        $message = 'Sender Information: <br> <br>';
        $message .= '<b> Name:</b> '. $request->name.'<br>';
        $message .= '<b> Email:</b> '. $request->email.'<br>';
        $message .= '<b> Subject:</b> '. $request->subject.'<br>';
        $message .= '<b> Message:</b> '. nl2br($request->message).'<br>';

        Mail::to($agent->email)->send(new WebsiteMail($subject,$message));


        if($user){
            return redirect()->back()->with('status','Your message has been sent. And Your live chat is open!');
        }else{
            return redirect()->back()->with('status','Your message has been sent. Thank you!');
        }
    }


    //Subscriber

     public function subscriber_send_email(Request $request){
        $request->validate([
            'email' => 'required | email | unique:subscribers,email',
        ]);

        $token = hash('sha256', time());

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->token = $token;
        $subscriber->save();

        $link = route('subscriber_send_email_verify',[$request->email, $token]);
        $subject = 'Subscription Verify';
        $message = 'Click on the following link to verify your email: <br> <a href="' .$link .'">' .$link .'</a> <br> <br>';
        $message .= 'Best Regarding <br>';
        $message .= 'Admin <br>';
        $message .= 'CHB Laravel Real Estate<br>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->back()->with('success','Please check your email to verify Subscribe Email');
    }

    public function subscriber_send_email_verify($email, $token){

        $subscribe = Subscriber::where('email',$email)->where('token',$token)->first();

        if(!$subscribe){
            return redirect()->route('home')->with('error','Invalid token or email');
        }

        $subscribe->token = '';
        $subscribe->status = 1;
        $subscribe->update();

        return redirect()->route('home')->with('success','Email verified successful. Thank you for subscribing!');
    }


    public function services(){
        $packages = Package::orderBy('id','asc')->where('status',1)->paginate(3);

        return view('frontend.services',compact('packages'));
    }
    public function services_details(){
        return view('frontend.services_details');
    }

    public function services_contact(Request $request){
        $request->validate([
            'email' => 'required | email ',
            'name' => 'required',
            'phone' => 'required',
            'budget' => 'required',
            'message' => 'required',
        ]);

        $admin = Admin::where('id',1)->first();

        $subject = 'Property Investment Service to Client Contact';
        $message = 'Sender Information: <br> <br>';
        $message .= '<b> Full Name:</b> '. $request->name.'<br>';
        $message .= '<b> Email Address:</b> '. $request->email.'<br>';
        $message .= '<b> Phone Number:</b> '. $request->phone.'<br>';
        $message .= '<b> Client Budget:</b> '. $request->budget.'<br>';
        $message .= '<b> Message:</b> '. nl2br($request->message).'<br>';

        Mail::to($admin->email)->send(new WebsiteMail($subject,$message));

        return redirect()->back()->with('success','Your message has been sent. Thank you!');

    }
    public function agent_schedule_tour_form(Request $request){
        $request->validate([
            'email' => 'required | email ',
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $agent = Agent::where('id',$request->agent_id)->first();

        $subject = 'Schedule a Tour to Client Contact';
        $message = 'Sender Information: <br> <br>';
        $message .= '<b> Full Name:</b> '. $request->name.'<br>';
        $message .= '<b> Email Address:</b> '. $request->email.'<br>';
        $message .= '<b> Phone Number:</b> '. $request->phone.'<br>';
        $message .= '<b> Subject:</b> '. $request->subject.'<br>';
        $message .= '<b> Message:</b> '. nl2br($request->message).'<br>';

        Mail::to($agent->email)->send(new WebsiteMail($subject,$message));

        return redirect()->back()->with('success','Your message has been sent. Thank you!');

    }

    public function blog(){
        $admin = Admin::where('id',1)->first();
        $posts = Post::orderBy('id','desc')->paginate(6);

        return view('frontend.blog',compact('posts', 'admin'));
    }
    public function blog_details($slug){
        $admin = Admin::where('id',1)->first();
        $post = Post::where('slug',$slug)->first();
        $tags = Post::select('tags')->get();

        //post view count
        $post->view_count = $post->view_count + 1;
        $post->update();

        //comments
        $comments = Comment::with(['admin', 'agent', 'user','post'])->orderBy('id','asc')->where('post_id',$post->id)->get();

        //total comments
        $total_comments = Comment::with(['admin', 'agent', 'user','post'])->orderBy('id','asc')->where('post_id',$post->id)->count();
        $total_reply_comments = ReplyComment::with(['admin', 'agent', 'user','post'])->orderBy('id','asc')->where('post_id',$post->id)->count();
        $total_comments_count = $total_comments + $total_reply_comments;

        return view('frontend.blog_details',compact('post', 'admin','tags','comments','total_comments_count'));

    }

    //post comments

    public function comment_store(Request $request,$id){

        $request->validate([
            'comment' => 'required',
        ]);


        $user = Auth::user();
        $agent = Auth::guard('agent')->user();
        $admin = Auth::guard('admin')->user();

        $comment = new Comment();
        $comment->post_id = $id;

        // Set who made the comment
        if($user) {
            $comment->user_id = $user->id;
        }elseif ($agent) {
            $comment->agent_id = $agent->id;
        }elseif ($admin) {
            $comment->admin_id = $admin->id;
        }

        // Optional fields from the request
        $comment->name = $request->name ?? null;
        $comment->email = $request->email ?? null;
        $comment->website = $request->website ?? null;

        // Required field
        $comment->comment = $request->comment;

        // Save the comment
        $comment->save();


        return redirect()->back()->with('success','Thank you for your comment!');
    }
    public function comment_destroy($comment_id){

        $comment = Comment::where('id',$comment_id)->first();
        $reply_comment = null;
        $reply_comment = ReplyComment::orderBy('id','asc')->where('comment_id',$comment->id)->get();

        if($comment){
            $comment->delete();
            if($reply_comment){
                foreach($reply_comment as $item){
                    $item->delete();
                }
            }
        }else{
           return redirect()->back()->with('error','Comment not fund!');
        }

        return redirect()->back()->with('success','Comment Deleted!');
    }
    public function comment_edit(Request $request,$comment_id){

        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::where('id',$comment_id)->where('post_id',$request->post_id)->first();

        // Optional fields from the request
        $comment->name = $request->name ?? null;
        $comment->email = $request->email ?? null;
        $comment->website = $request->website ?? null;

        // Required field
        $comment->comment = $request->comment;

        // Update the comment
        $comment->update();


        return redirect()->back()->with('success','Thank you for update your comment!');
    }

    //reply comments
    public function reply_comment_store(Request $request,$id){

        $request->validate([
            'comment' => 'required',
        ]);


        $user = Auth::user();
        $agent = Auth::guard('agent')->user();
        $admin = Auth::guard('admin')->user();

        $reply_comment = new ReplyComment();
        $reply_comment->post_id = $request->post_id;
        $reply_comment->comment_id = $id;

        // Set who made the comment
        if($user) {
            $reply_comment->user_id = $user->id;
        }elseif ($agent) {
            $reply_comment->agent_id = $agent->id;
        }elseif ($admin) {
            $reply_comment->admin_id = $admin->id;
        }

        // Optional fields from the request
        $reply_comment->name = $request->name ?? null;
        $reply_comment->email = $request->email ?? null;
        $reply_comment->website = $request->website ?? null;

        // Required field
        $reply_comment->comment = $request->comment;

        // Save the comment
        $reply_comment->save();


        return redirect()->back()->with('success','Thank you for your comment!');
    }

    public function reply_comment_edit(Request $request,$reply_comment_id){

        $request->validate([
            'comment' => 'required',
        ]);

        $reply_comment = ReplyComment::where('id',$reply_comment_id)->where('post_id',$request->post_id)->first();

        // Optional fields from the request
        $reply_comment->name = $request->name ?? null;
        $reply_comment->email = $request->email ?? null;
        $reply_comment->website = $request->website ?? null;

        // Required field
        $reply_comment->comment = $request->comment;

        // Update the comment
        $reply_comment->update();


        return redirect()->back()->with('success','Thank you for update your comment!');
    }
    public function reply_comment_destroy($reply_comment_id){

       $reply_comment = ReplyComment::where('id',$reply_comment_id)->first();

        if($reply_comment){
            $reply_comment->delete();
        }else{
           return redirect()->back()->with('error','Reply Comment not fund!');
        }

        return redirect()->back()->with('success','Reply Comment Deleted!');
    }

    public function terms(){
        return view('frontend.terms');
    }
    public function privacy(){
        return view('frontend.privacy');
    }


}
