<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::orderBy('id','asc')->get();

        return view('backend.admin.testimonials.index',compact('testimonials'));
    }
    public function testimonial_create(){
        $testimonials = Testimonial::orderBy('id','asc')->get();

        return view('backend.admin.testimonials.create',compact('testimonials'));
    }

    public function testimonial_store(Request $request){

        $request->validate([
            'name' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'designation' => 'required',
            'subject' => 'required',
            'comments' => 'required',
        ]);


        $fileName = 'testimonial_'. time(). '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads/testimonials'),$fileName);

        $testimonials = new Testimonial();
        $testimonials->name = $request->name;
        $testimonials->photo = $fileName;
        $testimonials->designation = $request->designation;
        $testimonials->subject = $request->subject;
        $testimonials->comments = $request->comments;
        $testimonials->save();

        return redirect()->route('admin_testimonial_index')->with('success','Testimonial Add Successfully');
    }

    public function testimonial_edit($id){

        $singleTestimonial = Testimonial::where('id',$id)->first();

        return view('backend.admin.testimonials.edit',compact('singleTestimonial'))->with('info','Edit this Testimonial');
    }
    public function testimonial_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'subject' => 'required',
            'comments' => 'required',
        ]);

        $testimonial = Testimonial::where('id',$id)->first();


        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $fileName = 'testimonial_'. time(). '.' . $request->photo->extension();

            if($testimonial->photo != ''){
                unlink(public_path('uploads/testimonials/'. $testimonial->photo.''));
            }
            $request->photo->move(public_path('uploads/testimonials'),$fileName);

        }else{
            $fileName = $testimonial->photo;
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->photo = $fileName;
        $testimonial->subject = $request->subject;
        $testimonial->comments = $request->comments;
        $testimonial->update();

        return redirect()->route('admin_testimonial_index')->with('success','Testimonial Updated Successfully');
    }
    public function testimonial_destroy( $id){
        $testimonial = Testimonial::where('id',$id)->first();

        if($testimonial->photo != ''){
                unlink(public_path('uploads/testimonials/'. $testimonial->photo.''));
            }

        if($testimonial){
            $testimonial->delete();

            return redirect()->route('admin_testimonial_index')->with('info','Testimonial Deleted Successfully');
        }else{
            return redirect()->route('admin_testimonial_index')->with('info','Testimonial not Found');
        }
    }
}
