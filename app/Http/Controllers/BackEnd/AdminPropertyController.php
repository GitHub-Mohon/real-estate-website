<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Property;
use App\Mail\WebsiteMail;
use App\Models\PropertyGallery;
use App\Models\PropertyVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminPropertyController extends Controller
{
    public function index(){
        $properties = Property::orderBy('id','desc')->get();

        return view('backend.admin.properties.index',compact('properties'));
    }
    public function property_details($id){
        $property = Property::where('id',$id)->first();

        $amenity = explode(',',$property->amenities);
        $amenities = Amenity::orderBy('id','desc')->whereIn('id',$amenity)->get();

        $photo_galleries = PropertyGallery::where('property_id',$property->id)->get();

        $video_galleries = PropertyVideo::where('property_id',$property->id)->get();

        return view('backend.admin.properties.details',compact('property','amenities','photo_galleries','video_galleries'));
    }

    public function property_change_status($id){

        $property = Property::where('id',$id)->first();

        if($property->status == 0){
            $property->status = 1;

        }else{
            $property->status = 0;
        }

        $property->update();

            // ✅ Sending mail to Agent

            if($property->status == 1){
                $status = "Active";
            }else{
                $status = "Pending";
            }

            $link = route('agent_property_index');
            $subject = 'Property Status Updated Successfully';
            $message = 'Dear '.$property->agent->name.','.'<br><br>';
            $message = 'Your Property Status has been updated to ' . $status. '<br><br>';

            $message .= 'Click on the following link to view your property status and properties.'.'<br>';
            $message .= '<a href="'.$link.'">'.$link.'</a>'.'<br>';
            $message .= 'Thank you for your oder'.'<br>';
            $message .= 'Best Regards'.'<br>';
            $message .= 'Admin'.'<br>';
            $message .= env("APP_NAME").'<br>';

            Mail::to($property->agent->email)->send(new WebsiteMail($subject,$message));

        return redirect()->route('admin_property_index')->with('status','Status Updated Successfully');
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
}
