<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Property;
use App\Mail\WebsiteMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AdminAgentController extends Controller
{
    public function index(){
        $agents = Agent::orderBy('id','desc')->get();

        return view('backend.admin.agents.index',compact('agents'));
    }
    public function agent_create(){
        $agents = Agent::orderBy('id','asc')->get();

        return view('backend.admin.agents.create',compact('agents'));
    }
    public function agent_store(Request $request){

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

            $fileName = 'agent_'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/agent'),$fileName);
        }

        $agents = new Agent();
        $agents->name = $request->name;
        $agents->email = $request->email;
        $agents->phone = $request->phone;
        $agents->company = $request->company;
        $agents->designation = $request->designation;
        $agents->password = bcrypt($request->password);
        if(!empty($fileName)){
            $agents->photo = $fileName;
        }
        $agents->save();

        //Send email to Agent

        //status
        if($request->status == 0){
            $status = "Pending";
        }elseif($request->status == 1){
            $status = "Active";
        }else{
            $status = "Suspended";
        }

        $link = route('login');
        $subject = 'Your agent account is created';
        $message = 'Account Information: <br> <br>';
        $message .= 'Name: '.$request->name.'<br>';
        $message .= 'Email: '.$request->email.'<br>';
        $message .= 'Phone: '.$request->phone.'<br>';
        $message .= 'Company: '.$request->company.'<br>';
        $message .= 'Designation: '.$request->designation.'<br>';
        $message .= 'Password: '.$request->password.'<br>';
        $message .= 'Status: '.$status.'<br>';
        $message .= 'Please go to login page: <br> <a href="'.$link. '">'. $link. '</a> <br> <br>';
        $message .= 'Please update your password & all information.  <br><br>';
        $message .= 'Thank you for your oder'.'<br>';
        $message .= 'Best Regards'.'<br>';
        $message .= 'Admin'.'<br>';
        $message .= env("APP_NAME").'<br>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->route('admin_agent_index')->with('success','Agent Account Create Successfully');
    }
    public function agent_edit($id){

        $singleAgent = Agent::where('id',$id)->first();

        return view('backend.admin.agents.edit',compact('singleAgent'))->with('info','Edit this Agent');
    }
    public function agent_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => [
                        'required',
                        Rule::unique('agents', 'email')->ignore($id),]
        ]);

        $agent = Agent::where('id',$id)->first();


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

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
        }

        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->company = $request->company;
        $agent->designation = $request->designation;
        $agent->photo = $fileName;
        if($request->password){
            $agent->password = $request->password;
        }
        $agent->status = $request->status;
        $agent->update();

        return redirect()->route('admin_agent_index')->with('success','Agent Account Updated Successfully');
    }
    public function agent_destroy( $id){
        $agent = Agent::where('id',$id)->first();
        $property = Property::where('agent_id',$id)->first();

        //if agent id is included property, then cannot delete agent

        if($property){
            return redirect()->route('admin_agent_index')->with('warning','Agent cannot be delete as it associated a property');
        }

        if($agent){
            $agent->delete();

            return redirect()->route('admin_agent_index')->with('warning','Agent Account Deleted Successfully');
        }else{
            return redirect()->route('admin_agent_index')->with('info','Agent not Found');
        }
    }
}
