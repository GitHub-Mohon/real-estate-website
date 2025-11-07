<?php

namespace App\Http\Controllers\Backend;
use App\Mail\WebsiteMail;
use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminSubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::orderBy('id','desc')->get();

        return view('backend.admin.subscribers.index',compact('subscribers'));
    }
    public function subscriber_create(){
        $subscribers = Subscriber::orderBy('id','asc')->get();

        return view('backend.admin.subscribers.create',compact('subscribers'));
    }
    public function subscriber_store(Request $request){

        $request->validate([
            'email' => 'required|unique:subscribers,email',
        ]);


        $subscribers = new Subscriber();
        $subscribers->email = $request->email;
        $subscribers->save();

        //Send email to subscribers

        //status
        if($request->status == 0){
            $status = "Pending";
        }elseif($request->status == 1){
            $status = "Active";
        }else{
            $status = "Suspended";
        }

        $link = route('home');
        $subject = 'Subscription Account';
        $message = 'Subscriber Email: '.$request->email.'<br><br>';
        $message .= 'Click on the following link to visit our website: <br> <a href="' .$link .'">' .$link .'</a> <br> <br>';
        $message .= 'Best Regarding <br>';
        $message .= 'Admin <br>';
        $message .= 'CHB Laravel Real Estate<br>';
        $message .= 'Thank you'.'<br>';
        $message .= 'Best Regards'.'<br>';
        $message .= 'Admin'.'<br>';
        $message .= env("APP_NAME").'<br>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->route('admin_subscriber_index')->with('success','Subscriber Create Successfully');
    }

    public function subscriber_destroy( $id){
        $subscriber = Subscriber::where('id',$id)->first();

        if($subscriber){
            $subscriber->delete();

            return redirect()->route('admin_subscriber_index')->with('warning','Subscriber Deleted Successfully');
        }else{
            return redirect()->route('admin_subscriber_index')->with('info','Subscriber not Found');
        }
    }

    public function subscriber_change_status($id){

        $subscriber = Subscriber::where('id',$id)->first();

        if($subscriber->status == 0){
            $subscriber->status = 1;

        }else{
            $subscriber->status = 0;
        }
        $subscriber->token = '';
        $subscriber->update();


        return redirect()->route('admin_subscriber_index')->with('success','Subscriber Status Updated Successfully');
    }

    public function subscriber_export(){

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=subscribers_'.date('F-j-Y').'.csv');

        $output = fopen('php://output','w');
        fputcsv($output,['SL','Email']);

        $subscribers = Subscriber::where('status',1)->orderBy('id','asc')->get();

        $i = 0;
        foreach($subscribers as $subscriber){
            $i++;
            fputcsv($output,[$i,$subscriber->email]);
        }

        fclose($output);
        exit;
    }
}
