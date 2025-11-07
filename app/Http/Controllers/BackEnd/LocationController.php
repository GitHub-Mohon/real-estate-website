<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::orderBy('id','asc')->get();

        return view('backend.admin.locations.index',compact('locations'));
    }
    public function location_create(){
        $locations = Location::orderBy('id','asc')->get();

        return view('backend.admin.locations.create',compact('locations'));
    }
    public function location_store(Request $request){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:locations,slug',
            'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
        ]);

        $slug = Str::slug($request->slug);


        $fileName = 'location_'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/locations'),$fileName);

        $locations = new Location();
        $locations->name = $request->name;
        $locations->slug = $slug;
        $locations->photo = $fileName;
        $locations->save();

        return redirect()->route('admin_location_index')->with('success','Location Create Successfully');
    }
    public function location_edit($id){

        $singleLocation = Location::where('id',$id)->first();

        return view('backend.admin.locations.edit',compact('singleLocation'))->with('info','Edit this Location');
    }
    public function location_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => [
                        'required',
                        Rule::unique('locations', 'slug')->ignore($id),]
        ]);

        $location = Location::where('id',$id)->first();

        $slug = Str::slug($request->slug);

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'location_'. time(). '.' . $request->photo->extension();

            if($location->photo != ''){
                unlink(public_path('uploads/locations/'. $location->photo.''));
            }
            $request->photo->move(public_path('uploads/locations'),$fileName);

        }else{
            $fileName = $location->photo;
        }

        $location->name = $request->name;
        $location->slug = $slug;
        $location->photo = $fileName;
        $location->update();

        return redirect()->route('admin_location_index')->with('success','Location Updated Successfully');
    }
    public function location_destroy( $id){
        $location = Location::where('id',$id)->first();
        $property = Property::where('location_id',$id)->first();

        //if location id is included property, then cannot delete location

        if($property){
            return redirect()->route('admin_location_index')->with('warning','Location cannot be delete as it associated a property');
        }

        if($location->photo != ''){
                unlink(public_path('uploads/locations/'. $location->photo.''));
            }

        if($location){
            $location->delete();

            return redirect()->route('admin_location_index')->with('warning','Location Deleted Successfully');
        }else{
            return redirect()->route('admin_location_index')->with('info','Location not Found');
        }
    }
}
