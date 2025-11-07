<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AmenityController extends Controller
{
    public function index(){
    $amenities = Amenity::orderBy('id','asc')->get();

        return view('backend.admin.amenities.index',compact('amenities'));
    }
    public function amenity_create(){
        $amenities = Amenity::orderBy('id','asc')->get();

        return view('backend.admin.amenities.create',compact('amenities'));
    }
    public function amenity_store(Request $request){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:amenities,slug',
        ]);

        $slug = Str::slug($request->slug);


        $amenities = new Amenity();
        $amenities->name = $request->name;
        $amenities->slug = $slug;
        $amenities->save();

        return redirect()->route('admin_amenity_index')->with('success','Amenity Create Successfully');
    }
    public function amenity_edit($id){

        $singleAmenity = Amenity::where('id',$id)->first();

        return view('backend.admin.amenities.edit',compact('singleAmenity'))->with('info','Edit this Amenity');
    }
    public function amenity_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => [
                        'required',
                        Rule::unique('amenities', 'slug')->ignore($id),]
        ]);

        $amenity = Amenity::where('id',$id)->first();

        $slug = Str::slug($request->slug);

        $amenity->name = $request->name;
        $amenity->$slug;
        $amenity->update();

        return redirect()->route('admin_amenity_index')->with('success','Amenity Updated Successfully');
    }
    public function amenity_destroy( $id){
        $amenity = Amenity::where('id',$id)->first();
        $properties = Property::all();

        //if amenities id is included property, then cannot delete amenities
        foreach($properties as $item){
            $ids = explode(",",$item->amenities);

            if(in_array($id,$ids)){

            return redirect()->route('admin_amenity_index')->with('warning','Amenity cannot be delete as it associated a property');
            }

        }



        if($amenity){
            $amenity->delete();

            return redirect()->route('admin_amenity_index')->with('warning','Amenity Deleted Successfully');
        }else{
            return redirect()->route('admin_amenity_index')->with('info','Amenity not Found');
        }
    }
}
