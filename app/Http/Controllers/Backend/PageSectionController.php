<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\HomepageSectionItem;
use App\Models\Product;
use App\Models\Page;
use App\Models\ServiceType;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    use CreateSlug;
    public function index($page_slug)
    {  
       
        $data['categories'] = Category::where('parent_id', null)->get();
      
        $data['homepageSections'] = HomepageSection::where('page_name', $page_slug)->orderBy('position', 'asc')->get();
        $data['banners'] = Banner::orderBy('position', 'asc')->where('status', 1)->get();
        $data['serviceTypes'] = ServiceType::orderBy('position', 'asc')->where('status', 1)->get();
        
        return view('backend.page.section.index')->with($data);
    }


    public function store(Request $request)
    {
        
        $section = new HomepageSection();
        $section->title = $request->title;
        $section->slug = $this->createSlug('homepage_sections', $request->title);
        $section->section_type = ($request->special_item) ? $request->special_item : $request->section_type;
        $section->section_manage = ($request->section_type == 'special-item' || $request->section_type == 'category' || $request->section_type == 'category-tab') ? 1 : 0;
        $section->page_name = $request->page_name;
        $section->layout_width = ($request->layout_width == 'full') ? 1 : null;
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->display = $request->display;
        $section->columns = $request->columns;
        $section->box = $request->box;
       
        $section->text_bg = $request->text_bg;
        $section->section_number = ($request->section_number) ? $request->section_number : 1;
        
        $section->item_number = ($request->item_number) ? $request->item_number : 7;
        $section->product_id =  ($request->section_type == 'section') ?  implode(',', $request->product_id) : $request->product_id;
        $section->status = ($request->status ? 1 : 0);
        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('homepage_sections', 'thumb_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->thumb_image = $new_image_name;
        }
        $section->image_position = $request->image_position;
       
    
        if ($request->hasFile('banner1')) {
            $image = $request->file('banner1');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner1', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner1 = $new_image_name;
        }
        
        if ($request->hasFile('banner2')) {
            $image = $request->file('banner2');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner2', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner2 = $new_image_name;
        }
        
        if ($request->hasFile('banner3')) {
            $image = $request->file('banner3');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner3', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner3 = $new_image_name;
        }
        
        if ($request->hasFile('banner4')) {
            $image = $request->file('banner4');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner4', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner4 = $new_image_name;
        }
        
        if ($request->hasFile('banner5')) {
            $image = $request->file('banner5');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner5', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner5 = $new_image_name;
        }
        
        if ($request->hasFile('banner6')) {
            $image = $request->file('banner6');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner6', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner6 = $new_image_name;
        }
        
        if ($request->hasFile('banner7')) {
            $image = $request->file('banner7');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner7', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner7 = $new_image_name;
        }
        
        if ($request->hasFile('banner8')) {
            $image = $request->file('banner8');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner8', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner8 = $new_image_name;
        }
        
        if ($request->hasFile('banner9')) {
            $image = $request->file('banner9');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'banner9', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->banner9 = $new_image_name;
        }
        $store = $section->save();
        if($store){
            Toastr::success('Homepage section added successfully.');
        }else{
            Toastr::error('Homepage section cann\'t added.');
        }
        return back();
    }

    public function edit($id)
    {

        $data['categories'] = Category::with('subcategory')->where('parent_id', null)->get();
        $data['banners'] = Banner::orderBy('position', 'asc')->where('status', 1)->get();
        $data['section'] = HomepageSection::where('id', $id)->first();
        $data['serviceTypes'] = ServiceType::orderBy('position', 'asc')->where('status', 1)->get();
        
        return view('backend.page.section.edit')->with($data);

    }


    public function update(Request $request)
    {

        $section = HomepageSection::find($request->id);
        $section->title = $request->title;
        $section->layout_width = ($request->layout_width == 'full') ? 1 : null;
        $section->background_color = $request->background_color;
        $section->section_number = ($request->section_number) ? $request->section_number : 1;
        $section->item_number = ($request->item_number) ? $request->item_number : 7;
        $section->text_color = $request->text_color;
        $section->display = $request->display;
        $section->columns = $request->columns;
        $section->box = $request->box;
       
        $section->text_bg = $request->text_bg;
        if($request->section_type) {
            $section->section_type = ($request->special_item) ? $request->special_item : $request->section_type;
            $section->section_manage = ($request->section_type == 'special-item' || $request->section_type == 'category' || $request->section_type == 'category-tab') ? 1 : 0;
        
            $section->product_id =  ($request->section_type == 'section') ?  implode(',', $request->product_id) : $request->product_id;
        
        }
        $section->status = ($request->status ? 1 : 0);
        if ($request->hasFile('thumb_image')) {
            //delete image from folder
            $image_path = public_path('upload/images/homepage/'. $section->thumb_image);
            if(file_exists($image_path) && $section->thumb_image){
                unlink($image_path);
            }
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('homepage_sections', 'thumb_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->thumb_image = $new_image_name;
        }
        $section->image_position = $request->image_position;
        $store = $section->save();
        if($store){
            Toastr::success('Homepage section update successfully.');
        }else{
            Toastr::error('Homepage section update failed.');
        }

        return back();
    }


    public function delete($id)
    {
        $section = HomepageSection::find($id);

        if($section){
            $section->delete();
            $sectionItems = HomepageSectionItem::where('section_id', $section->id)->delete();
       
            $output = [
                'status' => true,
                'msg' => 'Section deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Section cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function sectionImageDelete($id)
    {
        $section = HomepageSection::find($id);

        if($section){
            $image_path = public_path('upload/images/homepage/'. $section->thumb_image);
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $section->thumb_image = null;
            $section->save();
            $output = [
                'status' => true,
                'msg' => 'Thumb image deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Thumb image delete failed.'
            ];
        }
        return response()->json($output);
    }
//
//    public function getAllProducts (Request $request){
//        $output = '';
//        $products = Product::where('category_id', $request->id)->where('status', 'active')->get();
//        if(count($products)>0){
//            foreach ($products as $source) {
//                $output .= ' <option value="'.$source->id.'">'.$source->title.'</option>';
//            }
//        }
//        echo $output;
//    }

    public function getSingleProduct (Request $request){
        $output = '';
        $products = Product::where('id', $request->id)->where('status', 'active')->get();
        if(count($products)>0){
            foreach ($products as $source) {
                $output .= ' <option selected value="'.$source->id.'">'.$source->title.'</option>';
            }
        }
        echo $output;
    } 

    public function HomepageSectionSorting (Request $request){
        for($i=0; $i<count($request->sectionIds); $i++)
        {
            HomepageSection::where('id', str_replace('item', '', $request->sectionIds[$i]))->update(['position' => $i]);
        }
        echo 'Section Order has been updated';
    }
}
