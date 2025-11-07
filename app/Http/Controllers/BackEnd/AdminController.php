<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use App\Models\User;
use App\Models\Package;
use App\Models\Order;
use App\Models\Property;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function dashboard(){
        $data['total_package'] = Package::where('status',1)->count();
        $data['total_order'] = Order::where('status','Completed')->count();
        $data['total_customer'] = User::where('status',1)->count();
        $data['total_property'] = Property::where('status',1)->count();
        $data['inactive_property'] = Property::where('status',0)->count();
        $data['total_agent'] = Agent::where('status',1)->count();


        return view('Backend.admin.dashboard',$data);
    }
    public function login(){
        return view('Backend.admin.login');
    }
    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if(Auth::guard('admin')->attempt($data)){
            return redirect()->route('admin_dashboard')->with('success','Logged Successfully');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('info','Logged out Successfully');
    }
    public function forget_password(){
        return view('Backend.admin.forget_password');
    }
    public function forget_password_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email',$request->email)->first();

        if(!$admin){
            return redirect()->back()->with('error','Email not found');
        }

        $token = hash('sha256', time());
        $admin->token =$token;
        $admin->update();

        $link = route('admin_reset_password',[$token,$request->email]);
        $subject = 'Reset Password';
        $massage = 'Click on the following link to reset your password: <br>';
        $massage .= '<a href="'.$link . '">' .$link .'</a>';


        Mail::to($request->email)->send(new WebsiteMail($subject,$massage));

        return redirect()->back()->with('info', 'Reset password link sent to your email');

    }

    public function reset_password($token,$email){

        $admin = Admin::where('email',$email)->where('token',$token)->first();

        if(!$admin){
            return redirect()->route('admin_login')->with('error','Invalid token or email');
        }

        return view('Backend.admin.reset_password',compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email){
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $admin = Admin::where('email',$email)->where('token',$token)->first();
        $admin->password = bcrypt($request->password);
        $admin->token = '';
        $admin->update();

        return redirect()->route('admin_login')->with('success','Password reset successfully');
    }

    public function profile(){
        return view('backend.admin.profile');
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

        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'admin_'. time(). '.' . $request->photo->extension();

            if($admin->photo != ''){
                unlink(public_path('uploads/admin/'. $admin->photo.''));
            }
            $request->photo->move(public_path('uploads/admin'),$fileName);

        }else{
            $fileName = $admin->photo;
        }

        $admin->name = $request->name;
        $admin->photo = $fileName;
        if($request->password){
            $admin->password = bcrypt($request->password);
        }
        $admin->update();


        return redirect()->back()->with('success','Profile Updated successfully');
    }
}
