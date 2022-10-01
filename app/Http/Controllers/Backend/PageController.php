<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Reporter;
use Brian2694\Toastr\Facades\Toastr;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function list()
    {
        $pages = Page::all();
        return view('backend.page.page-lists')->with(compact('pages'));
    }

    public function create()
    {
        return view('backend.page.pages');
    }


    public function store(Request $request)
    {
        $request->validate([
            'page_name_bd' => ['required'],
            'page_name_en' => ['required'],
            'template' => ['required'],

        ]);

        $user_id = Auth::guard('admin')->user()->id;
        $data = new Page();
        $data->page_name_bd = $request->page_name_bd;
        $data->page_name_en = $request->page_name_en;
        $data->page_slug = Str::slug($request->page_name_en);
        $data->page_dsc = $request->page_dsc;
        $data->template = $request->template;
        $data->menu =$request->menu;
        if($request->hasFile('images')){
            $image = $request->file('images');
            $new_name = time().rand('123456', '999999').".".$image->getClientOriginalExtension();
            $image->move(public_path('upload/images/pages/'), $new_name);
            $data->images = $new_name;
        }
        $data->created_by = $user_id;
        $data->status =($request->status) ? '1' : '0';
        $data->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $data->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
      
        $data->meta_description = $request->meta_description;
        $insert = $data->save();
        if($insert){
            Toastr::success('Page Created Successful.');
        }else{
            Toastr::success('Page Cann\'t Created.');
        }
        return back();
    }


    public function edit($slug)
    {
       
        $data = Page::where('page_slug', $slug)->first();
        return view('backend.page.page-edit')->with(compact('data'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'page_name_bd' => ['required'],
            'page_name_en' => ['required'],
            'template' => ['required'],
        ]);
        $user_id = Auth::guard('admin')->user()->id;

        $data = Page::find($request->id);
        $data->page_name_bd = $request->page_name_bd;
        $data->page_name_en = $request->page_name_en;
        $data->page_slug = Str::slug($request->page_name_en);
        $data->page_dsc = $request->page_dsc;
        $data->template = $request->template;
        $data->menu =$request->menu;
        if($request->hasFile('images')){
            $image = $request->file('images');
            $new_name = time().rand('123456', '999999').".".$image->getClientOriginalExtension();
            $image->move(public_path('upload/images/pages/'), $new_name);
            $data->images = $new_name;
        }
        $data->created_by = $user_id;
        $data->status =($request->status) ? '1' : '0';
        $data->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $data->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $data->meta_description = $request->meta_description;

        $update = $data->save();
        if($update){
            Toastr::success('Page update Successful.');

        }else{
            Toastr::success('Page Can\'t update.');
        }
        return back();

    }

    public function delete($id)
    {
        $get_pages = Page::find($id);
        if($get_pages){
            //delete Page from store folder
            if ($get_pages->images){
                $images = explode(',', $get_pages->images);
                // delete image from database
                foreach ($images as $image) {
                    $file_path = public_path('upload/images/pages/' . $image);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }

            $delete = $get_pages->delete();
            $output = [
                    'status' => true,
                    'msg' => 'Page deleted successful.'
                ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry Page can\'t deleted.'
            ];
        }
        return response()->json($output);
    }

}
