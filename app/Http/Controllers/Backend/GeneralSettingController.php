<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Social;
use App\Models\Upzilla;
use App\Models\SiteSetting;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class GeneralSettingController extends Controller
{
    use CreateSlug;
    public function __construct()
    {

        Session::forget('siteSetting');
        $setting = GeneralSetting::first();
        if(!$setting){
            GeneralSetting::create([
                'currency' => 'USD',
                'currency_symble' => '$',
                'date_format' => 'M j, Y'
            ]);
        }
    }

    //general Setting edit
    public function generalSetting()
    {
        $setting = GeneralSetting::first();
        return view('backend.setting.general-setting')->with(compact('setting'));
    }

    //general Setting update
    public function generalSettingUpdate(Request $request, $id)
    {
        $setting = GeneralSetting::find($id);

        if($setting){
            $setting->site_name = $request->site_name;
            $setting->site_owner = $request->site_owner;
            $setting->site_owners = $request->site_owners;
            $setting->phone = $request->phone;
            $setting->email = $request->email;
            $setting->currency = $request->currency;
            $setting->currency_symble = $request->currency_symble;
            $setting->date_format = $request->date_format;
            $setting->bg_color = $request->bg_color;
            $setting->text_color = $request->text_color;
            $setting->homepage = $request->homepage;
            $setting->about = $request->about;
            $setting->trending = $request->trending;
            $setting->address = $request->address;
            $setting->lazyload = $request->lazyload;
            $setting->code1 = $request->code1;
            $setting->code2 = $request->code2;
            $setting->code3 = $request->code3;
            $setting->code4 = $request->code4;
            $setting->code5 = $request->code5;
            $setting->code6 = $request->code6;
            $setting->code7 = $request->code7;
            $setting->code8 = $request->code8;
            $setting->code9 = $request->code9;
            $setting->code10 = $request->code10;
            $setting->code11 = $request->code11;
            $setting->code12 = $request->code12;
            $setting->code13 = $request->code13;
            $setting->code14 = $request->code14;
            $setting->code15 = $request->code15;
            $setting->code16 = $request->code16;
            $setting->code17 = $request->code17;
            $setting->code18 = $request->code18;
            $setting->code19 = $request->code19;
            $setting->code20 = $request->code20;
            $setting->code21 = $request->code21;
            $setting->code22 = $request->code22;
            $setting->code23 = $request->code23;
            $setting->code24 = $request->code24;
            $setting->code25 = $request->code25;
            
            $setting->post1 = $request->post1;
            $setting->post2 = $request->post2;
            $setting->post3 = $request->post3;
            $setting->post4 = $request->post4;
            $setting->post5 = $request->post5;
            $setting->post6 = $request->post6;
            $setting->post7 = $request->post7;
            $setting->post8 = $request->post8;
            $setting->post9 = $request->post9;
            $setting->post10 = $request->post10;
            $setting->post11 = $request->post11;
            $setting->post12 = $request->post12;
            $setting->post13 = $request->post13;
            $setting->post14 = $request->post14;
            $setting->post15 = $request->post15;
            $setting->post16 = $request->post16;
            $setting->post17 = $request->post17;
            $setting->post18 = $request->post18;
            $setting->post19 = $request->post19;
            $setting->post20 = $request->post20;            
            $setting->save();
            Toastr::success('Setting update success.');
        }else{
            Toastr::error('Sorry something went wrong try again.');
        }

        return back();
    }

    public function logoSetting()
    {
        $setting = GeneralSetting::selectRaw('id, logo,dark_logo,footer_logo,footer_dark_logo,favicon')->first();
        return view('backend.setting.logo')->with(compact('setting'));
    }

    public function logoSettingUpdate(Request $request, $id)
    {
        $setting = GeneralSetting::find($id);

        //if  logo set
        if ($request->hasFile('logo')) {
            //delete previous logo
            $get_logo = public_path('upload/images/logo/'. $setting->logo);
            if($setting->logo && file_exists($get_logo) ){
                unlink($get_logo);
            }
            $image = $request->file('logo');
            $new_image_name = $this->uniquePath('general_settings', 'logo', $image->getClientOriginalName());
            $image->move(public_path('upload/images/logo'), $new_image_name);
            $setting->logo = $new_image_name;
        }

        //if  dark logo set
        if ($request->hasFile('dark_logo')) {
            //delete previous dark logo
            $get_logo = public_path('upload/images/logo/'. $setting->dark_logo);
            if($setting->dark_logo && file_exists($get_logo) ){
                unlink($get_logo);
            }
            $image = $request->file('dark_logo');
            $new_image_name = $this->uniquePath('general_settings', 'dark_logo', $image->getClientOriginalName());
            $image->move(public_path('upload/images/logo'), $new_image_name);
            $setting->dark_logo = $new_image_name;
        }

        //if invoice logo set
        if ($request->hasFile('footer_logo')) {
            //delete previous logo
            $footer_logo = public_path('upload/images/logo/'. $setting->footer_logo);
            if($setting->footer_logo && file_exists($footer_logo)){
                unlink($footer_logo);
            }
            $image = $request->file('footer_logo');
            $new_image_name = $this->uniquePath('general_settings', 'footer_logo', $image->getClientOriginalName());

            $image->move(public_path('upload/images/logo'), $new_image_name);
          //  $image_resize = Image::make($image);
           // $image_resize->resize(300, 100);
           // $image_resize->save($image_path);
            $setting->footer_logo = $new_image_name;
        }


        //if invoice dark_logo set
        if ($request->hasFile('footer_dark_logo')) {
            //delete previous logo
            $footer_dark_logo = public_path('upload/images/logo/'. $setting->footer_dark_logo);
            if($setting->footer_dark_logo && file_exists($footer_dark_logo)){
                unlink($footer_dark_logo);
            }
            $image = $request->file('footer_dark_logo');
            $new_image_name = $this->uniquePath('general_settings', 'footer_dark_logo', $image->getClientOriginalName());

            $image->move(public_path('upload/images/logo'), $new_image_name);
          //  $image_resize = Image::make($image);
           // $image_resize->resize(300, 100);
           // $image_resize->save($image_path);
            $setting->footer_dark_logo = $new_image_name;
        }


        //if invoice default_logo
        if ($request->hasFile('default_logo')) {
            //delete previous logo
            $default_logo = public_path('upload/images/logo/'. $setting->default_logo);
            if($setting->default_logo && file_exists($default_logo)){
                unlink($default_logo);
            }
            $image = $request->file('default_logo');
            $new_image_name = $this->uniquePath('general_settings', 'default_logo', $image->getClientOriginalName());

            $image_path = public_path('upload/images/logo/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(1280, 667);
            $image_resize->save($image_path);
            $setting->default_logo = $new_image_name;
        }
        //if favicon set
        if ($request->hasFile('favicon')) {
            //delete previous logo
            $get_favicon = public_path('upload/images/logo/'. $setting->favicon);
            if($setting->favicon && file_exists($get_favicon)){
                unlink($get_favicon);
            }
            $image = $request->file('favicon');
            $new_image_name = 'favicon-'.$this->uniquePath('general_settings', 'favicon', $image->getClientOriginalName());

            $image_path = public_path('upload/images/logo/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(62, 62);
            $image_resize->save($image_path);
            $setting->favicon = $new_image_name;
        }
        
        //if watermark logo set
        if ($request->hasFile('watermark')) {
            //delete previous logo
            $watermark = public_path('upload/images/logo/'. $setting->watermark);
            if($setting->watermark && file_exists($watermark)){
                unlink($watermark);
            }
            $image = $request->file('watermark');
            $new_image_name = 'watermark-'.$this->uniquePath('general_settings', 'watermark', $image->getClientOriginalName());

            $image_path = public_path('upload/images/logo/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(1160, 92);
            $image_resize->save($image_path);
            $setting->watermark = $new_image_name;
        }

        $setting->save();
        Toastr::success('Logo update sucess');
        return back();

    }


    public function headerSetting()
    {
        $setting = GeneralSetting::first();
        return view('backend.setting.header-setting')->with(compact('setting'));
    }


    public function headerSettingUpdate(Request $request, $id)
    {
        $setting = GeneralSetting::find($id);

        if(!$setting){
            Toastr::error('Sorry something went wrong try again.');
            return back();
        }
        $setting->header = $request->header;
        $setting->header_no = $request->header_no;
        $setting->header_bg_color = $request->header_bg_color;
        $setting->header_bg_nav = $request->header_bg_nav;
        $setting->header_text_color = $request->header_text_color;
        $setting->save();

        Toastr::success('Header update success.');
        return back();
    }


    public function footerSetting()
    {
        $setting = GeneralSetting::first();
        return view('backend.setting.footer')->with(compact('setting'));
    }
    public function footerSettingUpdate(Request $request, $id)
    {
        $setting = GeneralSetting::find($id);

        if(!$setting){
            Toastr::error('Sorry something went wrong try again.');
            return back();
        }
        $setting->footer = $request->footer;
        $setting->footer_no = $request->footer_no;
        $setting->footer_bg_color = $request->footer_bg_color;
        $setting->footer_text_color = $request->footer_text_color;
        $setting->copyright_text = $request->copyright_text;
        $setting->copyright_bg_color = $request->copyright_bg_color;
        $setting->copyright_text_color = $request->copyright_text_color;
        $setting->save();
        Toastr::success('Footer update success.');
        return back();
    }

    public function googleSetting(Request $request)
    {
        //update google analytics
        if(request()->isMethod('get')){
            return view('backend.setting.google-config');
        }

        if(request()->isMethod('post')){
            Session::put('googleSettingTab', $request->googleSettingTab);
            //update analytics
            if($request->googleSettingTab == 'analytics'){
                $analytics = GeneralSetting::find($request->id);
                $analytics->google_analytics = $request->google_analytics;
                $analytics->google_adsense = $request->google_adsense;
                $analytics->lang1 = $request->lang1;
                $analytics->lang2 = $request->lang2;
                $analytics->lang3 = $request->lang3;
                $analytics->lang4 = $request->lang4;
                $analytics->lang5 = $request->lang5;
                $analytics->lang6 = $request->lang6;
                $analytics->lang7 = $request->lang7;
                $analytics->lang8 = $request->lang8;
                $analytics->lang9 = $request->lang9;
                $analytics->lang10 = $request->lang10;
                $analytics->lang11 = $request->lang11;
                $analytics->lang12 = $request->lang12;
                $analytics->lang13 = $request->lang13;
                $analytics->lang14 = $request->lang14;
                $analytics->lang15 = $request->lang15;
                $analytics->lang16 = $request->lang16;
                $analytics->save();
            }

            Toastr::success($request->googleSettingTab.' update success.');
        }
        return back();
    }


    public function seoSetting(Request $request)
    {
        //update reCaptcha
        if(request()->isMethod('get')){
            $setting = GeneralSetting::selectRaw('id, title,meta_keywords,description,meta_image')->first();;
            return view('backend.setting.seo-setting')->with(compact('setting'));
        }

        if(request()->isMethod('post')){
            $setting = GeneralSetting::find($request->id);
            $setting->title = $request->title;
            $setting->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
            $setting->description = $request->description;
            //if  meta_image set
            if ($request->hasFile('meta_image')) {
                //delete previous meta_image
                $meta_image = public_path('upload/images/'. $setting->meta_image);
                if(file_exists($meta_image) && $setting->meta_image){
                    unlink($meta_image);
                }
                $image = $request->file('meta_image');
                $new_image_name = $this->uniquePath('general_settings', 'meta_image', $image->getClientOriginalName());
                $image->move(public_path('upload/images/'), $new_image_name);
                $setting->meta_image = $new_image_name;
            }
             $setting->save();
            Toastr::success('SEO setting update success.');
        }
        return back();
    }
}
