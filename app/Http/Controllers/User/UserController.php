<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\User;
use App\Models\Agent;
use App\Models\Wishlist;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\ReplyConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function dashboard(){

        $data['total_message'] = Message::where('user_id',Auth::guard('web')->user()->id)->count();
        $data['total_wishlist'] = Wishlist::where('user_id',Auth::guard('web')->user()->id)->count();

        return view('Backend.user.dashboard',$data);
    }
    public function register(){
        return view('backend.user.registration');
    }

    public function registration_submit(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required | same:password',
        ]);

        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token = $token;
        $user->save();

        $link = route('registration_verify',[$token, $request->email]);
        $subject = 'Registration Verify';
        $message = 'Click on the following link to verify your email: <br> <a href="' .$link .'">' .$link .'</a>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->back()->with('success','Registration successful please check your email to verify your account');
    }

    public function registration_verify($token,$email){

        $user = User::where('email',$email)->where('token',$token)->first();

        if(!$user){
            return redirect()->route('login')->with('error','Invalid token or email');
        }

        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success','Email verified successful. You can now login');
    }

    public function login(){
        return view('Backend.user.login');
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $status = User::where('email',$request->email)->first();

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

        if(Auth::guard('web')->attempt($data)){
            return redirect()->route('dashboard')->with('success','Logged Successfully');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('info','Logged out Successfully');
    }
    public function forget_password(){
        return view('Backend.user.forget_password');
    }

    public function forget_password_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){
            return redirect()->back()->with('error','Email not found');
        }

        $token = hash('sha256', time());
        $user->token =$token;
        $user->update();

        $link = route('reset_password',[$token,$request->email]);
        $subject = 'Reset Password';
        $massage = 'Click on the following link to reset your password: <br>';
        $massage .= '<a href="'.$link . '">' .$link .'</a>';


        Mail::to($request->email)->send(new WebsiteMail($subject,$massage));

        return redirect()->back()->with('info', 'Reset password link sent to your email');

    }

    public function reset_password($token,$email){

        $user = User::where('email',$email)->where('token',$token)->first();

        if(!$user){
            return redirect()->route('login')->with('error','Invalid token or email');
        }

        return view('Backend.user.reset_password',compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email){
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email',$email)->where('token',$token)->first();
        $user->password = bcrypt($request->password);
        $user->token = '';
        $user->update();

        return redirect()->route('login')->with('success','Password reset successfully');
    }

    public function profile(){
        return view('backend.user.profile');
    }
    public function profile_submit(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required | same:password',
            ]);
        }

        $user = User::where('id', Auth::guard('web')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'user_'. time(). '.' . $request->photo->extension();

            if($user->photo != ''){
                unlink(public_path('uploads/user/'. $user->photo.''));
            }
            $request->photo->move(public_path('uploads/user'),$fileName);

        }else{
            $fileName = $user->photo;
        }

        $user->name = $request->name;
        $user->photo = $fileName;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->update();


        return redirect()->back()->with('info','Profile Updated successfully');
    }

    public function wishlist(){

        $wishlists = Wishlist::orderBy('id','desc')->where('user_id',Auth::user()->id)->get();

        return view('backend.user.wishlist.index',compact('wishlists'));
    }
    public function add_wishlist($id){

        $wishlists = new Wishlist();
        $wishlists->user_id = Auth::guard('web')->user()->id;
        $wishlists->property_id = $id;
        $wishlists->save();

        return redirect()->back()->with('status','Added Wishlist');
    }
    public function remove_wishlist($id){

        $wishlist = Wishlist::where('id',$id)->where('user_id',Auth::guard('web')->user()->id)->first();

        if(!$wishlist){
            return redirect()->back()->with('info','Wishlist not Fund!');
        }

        $wishlist->delete();

        return redirect()->back()->with('status','Removed Wishlist');
    }

    public function message_index(){
        $messages = Message::orderBy('id','desc')->where('user_id',Auth::guard('web')->user()->id)->get();

        return view('backend.user.messages.index',compact('messages'));
    }
    public function message_create(){

        $agents = Agent::orderBy('id','asc')->where('status',1)->get();

        return view('backend.user.messages.create',compact('agents'));
    }

    public function message_store(Request $request){

        $request->validate([
            'agent_id' => 'required',
            'subject' => 'required',
        ]);


        $user = Auth::user();

        $message = Message::where('user_id',$user->id)->where('agent_id',$request->agent_id)->first();

        if($message){
                return redirect()->route('message')->with('error','You already connected this agent!');
            }

        $fileName = null;

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            ]);

            $file = $request->file('file');
            $fileName = 'message_' . time() . '.' . $file->getClientOriginalExtension(); // or ->extension()
            $file->move(public_path('uploads/users/messages'), $fileName);
        }

        $messages = new Message();
        $messages->user_id = Auth::guard('web')->user()->id;
        $messages->agent_id = $request->agent_id;
        $messages->subject = $request->subject;
        $messages->message_body = $request->message_body;

        if ($fileName) {
            $messages->file = $fileName;
        }

        $messages->save();


        return redirect()->route('message')->with('status','Message Send Successfully');

    }

    public function message_chat($id){

        $message = Message::where('id',$id)->where('user_id',Auth::guard('web')->user()->id)->first();
        $agent = Agent::where('id',$message->agent_id)->where('status',1)->first();
        $user = User::where('id',Auth::guard('web')->user()->id)->first();
        $conversations = Conversation::orderBy('id','asc')->where('message_id',$id)->get();
        $reply_conversations = ReplyConversation::orderBy('id','asc')->where('message_id',$id)->get();

        return view('backend.user.messages.details',compact('message','agent','user','conversations','reply_conversations'));
    }

    public function message_conversation( Request $request ,$id){
        $fileName = null;

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            ]);

            $file = $request->file('file');
            $fileName = 'conversation_' . time() . '.' . $file->getClientOriginalExtension(); // or ->extension()
            $file->move(public_path('uploads/users/messages/conversation'), $fileName);
        }

        $conversations = new Conversation();
        $conversations->user_id = Auth::guard('web')->user()->id;
        $conversations->agent_id = $request->agent_id;
        $conversations->message_id = $id;

        if($request->conversation_body){
            $conversations->conversation_body = $request->conversation_body;
        }

        if ($fileName) {
            $conversations->conversation_file = $fileName;
        }

        $conversations->save();


        return redirect()->back()->with('status','Message Send Successfully');
    }

}
