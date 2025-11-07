<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WebsiteMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AdminCustomerController extends Controller
{
    public function index(){
        $customers = User::orderBy('id','desc')->get();

        return view('backend.admin.customers.index',compact('customers'));
    }
    public function customer_create(){
        $customers = User::orderBy('id','asc')->get();

        return view('backend.admin.customers.create',compact('customers'));
    }
    public function customer_store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);


        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'user_'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/user'),$fileName);
        }

        $customers = new User();
        $customers->name = $request->name;
        $customers->email = $request->email;
        $customers->password = bcrypt($request->password);
        if(!empty($fileName)){
            $customers->photo = $fileName;
        }
        $customers->save();

        //Send email to Customer

        //status
        if($request->status == 0){
            $status = "Pending";
        }elseif($request->status == 1){
            $status = "Active";
        }else{
            $status = "Suspended";
        }

        $link = route('login');
        $subject = 'Your account is created';
        $message = 'Account Information: <br> <br>';
        $message .= 'Name: '.$request->name.'<br>';
        $message .= 'Email: '.$request->email.'<br>';
        $message .= 'Password: '.$request->password.'<br>';
        $message .= 'Status: '.$status.'<br>';
        $message .= 'Please go to login page: <br> <a href="'.$link. '">'. $link. '</a> <br> <br>';
        $message .= 'Please update your password & all information.  <br><br>';
        $message .= 'Thank you for your oder'.'<br>';
        $message .= 'Best Regards'.'<br>';
        $message .= 'Admin'.'<br>';
        $message .= env("APP_NAME").'<br>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->route('admin_customer_index')->with('success','Customer Account Create Successfully');
    }
    public function customer_edit($id){

        $singleCustomer = User::where('id',$id)->first();

        return view('backend.admin.customers.edit',compact('singleCustomer'))->with('info','Edit this Customer');
    }
    public function customer_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => [
                        'required',
                        Rule::unique('users', 'email')->ignore($id),]
        ]);

        $customer = User::where('id',$id)->first();


        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'user_'. time(). '.' . $request->photo->extension();

            if($customer->photo != ''){
                unlink(public_path('uploads/user/'. $customer->photo.''));
            }
            $request->photo->move(public_path('uploads/user'),$fileName);

        }else{
            $fileName = $customer->photo;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->photo = $fileName;
        if($request->password){
            $customer->password = $request->password;
        }
        $customer->status = $request->status;
        $customer->update();

        return redirect()->route('admin_customer_index')->with('success','Customer Account Updated Successfully');
    }
    public function customer_destroy( $id){
        $customer = User::where('id',$id)->first();

        if($customer){
            $customer->delete();

            return redirect()->route('admin_customer_index')->with('warning','Customer Account Deleted Successfully');
        }else{
            return redirect()->route('admin_customer_index')->with('info','Customer not Found');
        }
    }
}
