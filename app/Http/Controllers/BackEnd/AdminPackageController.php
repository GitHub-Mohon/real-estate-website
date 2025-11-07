<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    public function index(){
        $packages = Package::orderBy('id','asc')->get();

        return view('backend.admin.packages.index',compact('packages'));
    }
    public function package_create(){
        $packages = Package::orderBy('id','asc')->get();

        return view('backend.admin.packages.create',compact('packages'));
    }
    public function package_store(Request $request){

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'allowed_days' => 'required|numeric',
            'allowed_properties' => 'required|numeric',
            'allowed_featured_properties' => 'required|numeric',
            'allowed_photos' => 'required|numeric',
            'allowed_videos' => 'required|numeric',
        ]);

        $packages = new Package();
        $packages->name = $request->name;
        $packages->price = $request->price;
        $packages->allowed_days = $request->allowed_days;
        $packages->allowed_properties = $request->allowed_properties;
        $packages->allowed_featured_properties = $request->allowed_featured_properties;
        $packages->allowed_photos = $request->allowed_photos;
        $packages->allowed_videos = $request->allowed_videos;
        $packages->save();

        return redirect()->route('admin_package_index')->with('success','Package Create Successfully');
    }
    public function package_edit($id){

        $singlePackage = Package::where('id',$id)->first();

        return view('backend.admin.packages.edit',compact('singlePackage'))->with('info','Edit this Package');
    }
    public function package_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'allowed_days' => 'required|numeric',
            'allowed_properties' => 'required|numeric',
            'allowed_featured_properties' => 'required|numeric',
            'allowed_photos' => 'required|numeric',
            'allowed_videos' => 'required|numeric',
        ]);

        $packages = Package::where('id',$id)->first();

        $packages->name = $request->name;
        $packages->price = $request->price;
        $packages->allowed_days = $request->allowed_days;
        $packages->allowed_properties = $request->allowed_properties;
        $packages->allowed_featured_properties = $request->allowed_featured_properties;
        $packages->allowed_photos = $request->allowed_photos;
        $packages->allowed_videos = $request->allowed_videos;
        $packages->update();

        return redirect()->route('admin_package_index')->with('success','Package Updated Successfully');
    }
    public function package_destroy( $id){
        $package = Package::where('id',$id)->first();

        if($package){
            $package->delete();

            return redirect()->route('admin_package_index')->with('warning','Package Deleted Successfully');
        }else{
            return redirect()->route('admin_package_index')->with('info','Package not Found');
        }
    }
}
