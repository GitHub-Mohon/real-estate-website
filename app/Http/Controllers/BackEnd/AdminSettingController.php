<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function setting(){
        $setting = Setting::where('id',1)->first();

        return view('backend.admin.setting.index',compact('setting'));
    }

    public function setting_update(Request $request, $id){



        $setting = Setting::where('id',1)->first();

        //logo section
        if($request->logo){
            $request->validate([
                'logo' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $logoName = 'logo_'. time(). '.' . $request->logo->extension();

            // if($setting->logo != ''){
            //     unlink(public_path('uploads/setting/'. $setting->logo.''));
            // }
            $request->logo->move(public_path('uploads/setting'),$logoName);

        }else{
            $logoName = $setting->logo;
        }

        //favicon section
        if($request->favicon){
            $request->validate([
                'favicon' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $faviconName = 'favicon_'. time(). '.' . $request->favicon->extension();

            if($setting->favicon != ''){
                unlink(public_path('uploads/setting/'. $setting->favicon.''));
            }
            $request->favicon->move(public_path('uploads/setting'),$faviconName);

        }else{
            $faviconName = $setting->favicon;
        }

        //banner section
        if($request->banner){
            $request->validate([
                'banner' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
            ]);

            $bannerName = 'banner_'. time(). '.' . $request->banner->extension();

            if($setting->banner != ''){
                unlink(public_path('uploads/setting/'. $setting->banner.''));
            }
            $request->banner->move(public_path('uploads/setting'),$bannerName);

        }else{
            $bannerName = $setting->banner;
        }

        $setting->logo = $logoName;
        $setting->favicon = $faviconName;
        $setting->banner = $bannerName;
        $setting->assistance_number = $request->assistance_number;
        $setting->consultation_number = $request->consultation_number;
        $setting->footer_address = $request->footer_address;
        $setting->footer_email = $request->footer_email;
        $setting->phone_number = $request->phone_number;
        $setting->facebook = $request->facebook;
        $setting->tweeter = $request->tweeter;
        $setting->instagram = $request->instagram;
        $setting->linkedin = $request->linkedin;
        $setting->copyright = $request->copyright;
        $setting->update();

        return redirect()->back()->with('success','Save Changed');
    }

}
