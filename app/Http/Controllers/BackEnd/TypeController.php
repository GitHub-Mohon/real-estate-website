<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    public function index(){
    $types = Type::orderBy('id','asc')->get();

        return view('backend.admin.types.index',compact('types'));
    }
    public function type_create(){
        $types = Type::orderBy('id','asc')->get();

        return view('backend.admin.types.create',compact('types'));
    }
    public function type_store(Request $request){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:types,slug',
        ]);

        $slug = Str::slug($request->slug);

        $types = new Type();
        $types->name = $request->name;
        $types->slug = $slug;
        $types->save();

        return redirect()->route('admin_type_index')->with('success','Type Create Successfully');
    }
    public function type_edit($id){

        $singleType = Type::where('id',$id)->first();

        return view('backend.admin.types.edit',compact('singleType'))->with('info','Edit this Type');
    }
    public function type_update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => [
                        'required',
                        Rule::unique('types', 'slug')->ignore($id),]
        ]);

        $type = Type::where('id',$id)->first();

        $slug = Str::slug($request->slug);

        $type->name = $request->name;
        $type->slug = $slug;
        $type->update();

        return redirect()->route('admin_type_index')->with('success','Type Updated Successfully');
    }
    public function type_destroy( $id){
        $type = Type::where('id',$id)->first();
        $property = Property::where('type_id',$id)->first();

        //if type id is included property, then cannot delete type

        if($property){
            return redirect()->route('admin_type_index')->with('warning','Type cannot be delete as it associated a property');
        }

        if($type){
            $type->delete();

            return redirect()->route('admin_type_index')->with('warning','Type Deleted Successfully');
        }else{
            return redirect()->route('admin_type_index')->with('info','Type not Found');
        }
    }
}
