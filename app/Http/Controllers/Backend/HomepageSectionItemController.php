<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\News;
use App\Models\Addvertisement;
use App\Models\HomepageSection;
use App\Models\HomepageSectionItem;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomepageSectionItemController extends Controller
{
    use CreateSlug;


    public function index($slug)
    {
  
        $data['section'] = HomepageSection::where('slug', $slug)->first();

        $sectionItems = HomepageSectionItem::where('section_id', $data['section']->id);
        if($data['section']->section_type == 'news'){
            $sectionItems->with('news');
        }
        if($data['section']->section_type == 'category' || $data['section']->section_type == 'category-tab' || preg_replace("/\d/", "", $data['section']->section_type) == 'special-item'){
            $sectionItems->with('category');

            //get caregories
            $data['categories'] = Category::with('subcategory')->where('type', 'category')->orderBy('position', 'asc')->get();
        }
        if($data['section']->section_type == 'ads'){
            $sectionItems->with('ads_details');
            //get Addvertisement
            $data['allAds'] = Addvertisement::orderBy('id', 'desc')->where('status', 1)->paginate(15);
        }
        $data['sectionItems'] = $sectionItems->orderBy('position', 'asc')->get();

        return view('backend.page.section.sectionItem.'.$data['section']->section_type)->with($data);
    }

    //get all Items by anyone field
    public function getAllItems(Request $request){
        $data['items_id'] = HomepageSectionItem::where('section_id', $request->section_id)->get()->pluck('item_id')->toArray();

        $item = News::where('news.status', 1)->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id');
        if ($request->item) {
            $keyword = $request->item;
            $item->Where('news_title', 'like', '%' . $keyword . '%');
        }


        if ($request->category && $request->category != 'all') {
            $item->where('category_id', $request->category);
        }
        $data['allItems'] = $item->orderBy('news_title', 'asc')->select('news.*','media_galleries.source_path')->paginate(25);

        return view('backend.page.section.sectionItem.getItems')->with($data);
    }

    //get all banner by anyone field
    public function getAllbanners(Request $request){
        $data['items_id'] = HomepageSectionItem::where('section_id', $request->section_id)->get()->pluck('item_id')->toArray();

        $item = Banner::where('status', 1);
        if ($request->item) {
            $keyword = $request->item;
            $item->where('title', 'like', '%' . $keyword . '%');
        }

        $data['allBanners'] = $item->orderBy('title', 'asc')->paginate(25);

        return view('backend.page.section.sectionItem.getBanner')->with($data);
    }

    //added section single news
    public function sectionSingleItemStore(Request $request)
    {
        $section = HomepageSection::where('id', $request->section_id)->first();
        if($section){
            $sectionItem = HomepageSectionItem::where('section_id', $request->section_id)->where('item_id', $request->item_id)->first();
            if(!$sectionItem) {
                $sectionItem = new HomepageSectionItem();
                $sectionItem->section_id = $request->section_id;
                $sectionItem->item_id = $request->item_id;
                $sectionItem->approved = 1;
                $sectionItem->status = 'active';
                $sectionItem->save();
                $output = [
                    'status' => true,
                    'msg' => 'Item added success.'
                ];
            }else{
                $output = [
                    'status' => false,
                    'msg' => 'This Item already added.'
                ];
            }
        }
        return response()->json($output);
    }

    //added section multi news
    public function sectionMultiItemStore(Request $request){

        if($request->item_id){
            foreach ($request->item_id as $item_id => $value) {
                $sectionItem = HomepageSectionItem::where('section_id', $request->section_id)->where('item_id', $item_id)->first();
                if(!$sectionItem){
                    $sectionItem = new HomepageSectionItem();
                    $sectionItem->section_id = $request->section_id;
                    $sectionItem->item_id = $item_id;
                    $sectionItem->approved = 1;
                    $sectionItem->status = 'active';
                    $sectionItem->save();
                }else{
                    Toastr::error('Item already added.');
                }
            }
        }else{
            Toastr::error('Item added failed, Please select any item');
        }
        return back();
    }

    public function store(Request $request)
    {
        if($request->section_type == 'category'){
            $request->validate([
                'category_id' => 'required',
            ]);
        }
        if($request->section_type == 'ads'){
            $request->validate([
                'adsSourch' => 'required',
            ]);
        }

        $section = new HomepageSectionItem();
        $section->item_title = ($request->item_title) ? $request->item_title : null;
        $section->section_id = $request->section_id;
        $section->section_layout = $request->section_layout;
        $section->background_color = $request->background_color;
        $section->item_sub_title = $request->item_sub_title;
        $section->text_color = $request->text_color;
        $section->colmd = $request->colmd;
        $section->colxs = $request->colxs;
        $section->lazyload = $request->lazyload;
        $section->device = ($request->device) ? $request->device : 0;
        $section->codex = $request->codex;
        $section->margin = $request->margin;
        $section->padding = $request->padding;
        $section->bg_text = $request->bg_text;
        $section->bt_text = $request->bt_text;
        $section->borders = $request->borders;
        $section->class_1 = $request->class_1;
        $section->class_2 = $request->class_2;
        $section->icon = $request->icon;
        $section->item_number = $request->item_number;
        $section->item_title_number = $request->item_title_number;
        $section->is_feature = ($request->is_feature ? 1 : 0);
        $section->item_id = ($request->section_type == 'category-tab') ? json_encode($request->category_id)  : $request->category_id;
        
        if ($request->hasFile('title_img')) {
            $image = $request->file('title_img');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'title_img', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->title_img = $new_image_name;
        }

        
       
        if($request->section_type == 'ads'){
            if($request->adsSourch == 'new'){
                //new ads store
                $ads = new Addvertisement();
                $ads->ads_name = $request->item_title;
                $ads->adsType = $request->adsType;
                $ads->page = 'home';
                $ads->add_code = ($request->add_code) ? $request->add_code : null;
                $ads->redirect_url = $request->redirect_url;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $new_image_name = $this->uniqueImagePath('addvertisements', 'image', $image->getClientOriginalName());
                    $image->move(public_path('upload/marketing'), $new_image_name);
                    $ads->image = $new_image_name;
                }
                $ads->save();

                $item_id = $ads->id;
            }else{
                $item_id = $request->ads_id;
            }

            $section->item_id = $item_id;
        }
        
        $section->name1 = $request->name1 ?? null;
        $section->name2 = $request->name2 ?? null;
        $section->name3 = $request->name3 ?? null;
        $section->name4 = $request->name4 ?? null;
        $section->name5 = $request->name5 ?? null;
        $section->name6 = $request->name6 ?? null;
        $section->name7 = $request->name7 ?? null;
        $section->name8 = $request->name8 ?? null;
        
        $section->subname1 = $request->subname1 ?? null;
        $section->subname2 = $request->subname2 ?? null;
        $section->subname3 = $request->subname3 ?? null;
        $section->subname4 = $request->subname4 ?? null;
        $section->subname5 = $request->subname5 ?? null;
        $section->subname6 = $request->subname6 ?? null;
        $section->subname7 = $request->subname7 ?? null;
        $section->subname8 = $request->subname8 ?? null;
        
        $section->link1 = $request->link1 ?? null;
        $section->link2 = $request->link2 ?? null;
        $section->link3 = $request->link3 ?? null;
        $section->link4 = $request->link4 ?? null;
        $section->link5 = $request->link5 ?? null;
        $section->link6 = $request->link6 ?? null;
        $section->link7 = $request->link7 ?? null;
        $section->link8 = $request->link8 ?? null;
        
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

        $section->status = ($request->status ? 1 : 0);
        $store = $section->save();

        if($store){
            Toastr::success('Section '.$request->section_type.' added successfully.');
        }else{
            Toastr::error('Section '.$request->section_type.' can\'t added.');
        }

        return back();
    }


    public function edit($id)
    {
        $data['sectionItem'] = HomepageSectionItem::where('id', $id)->first();
        $data['categories'] = Category::with('subcategory.subcategory')->where('type', 'category')->orderBy('position', 'asc')->get();

        $sectionMain = HomepageSection::find($data['sectionItem']->section_id);
        return view('backend.page.section.sectionItem.edit.'.preg_replace('/[0-9]+/', '', $sectionMain->section_type))->with($data);
    }

    public function update(Request $request)
    {


        $section = HomepageSectionItem::find($request->id);
        $section->item_title = $request->item_title;
        $section->section_layout = $request->section_layout;
        $section->item_id = $request->category_id;
        $section->background_color = $request->background_color;
        $section->item_sub_title = $request->item_sub_title;
        $section->text_color = $request->text_color;
        $section->colmd = $request->colmd;
        $section->colxs = $request->colxs;
        $section->device = $request->device;
        $section->lazyload = $request->lazyload;
        $section->codex = $request->codex;
        $section->margin = $request->margin;
        $section->padding = $request->padding;
        $section->bg_text = $request->bg_text;
        $section->bt_text = $request->bt_text;
        $section->borders = $request->borders;
        $section->class_1 = $request->class_1;
        $section->class_2 = $request->class_2;
        $section->icon = $request->icon;
        $section->item_number = $request->item_number;
        $section->item_title_number = $request->item_title_number;
        $section->status = ($request->status ? 1 : 0);
        
         $section->name1 = $request->name1 ?? null;
        $section->name2 = $request->name2 ?? null;
        $section->name3 = $request->name3 ?? null;
        $section->name4 = $request->name4 ?? null;
        $section->name5 = $request->name5 ?? null;
        $section->name6 = $request->name6 ?? null;
        $section->name7 = $request->name7 ?? null;
        $section->name8 = $request->name8 ?? null;
        
        $section->subname1 = $request->subname1 ?? null;
        $section->subname2 = $request->subname2 ?? null;
        $section->subname3 = $request->subname3 ?? null;
        $section->subname4 = $request->subname4 ?? null;
        $section->subname5 = $request->subname5 ?? null;
        $section->subname6 = $request->subname6 ?? null;
        $section->subname7 = $request->subname7 ?? null;
        $section->subname8 = $request->subname8 ?? null;
        
        $section->link1 = $request->link1 ?? null;
        $section->link2 = $request->link2 ?? null;
        $section->link3 = $request->link3 ?? null;
        $section->link4 = $request->link4 ?? null;
        $section->link5 = $request->link5 ?? null;
        $section->link6 = $request->link6 ?? null;
        $section->link7 = $request->link7 ?? null;
        $section->link8 = $request->link8 ?? null;
       
        if($request->section_type == 'category-tab'){
            $section->item_id = json_encode($request->category_id);
        }
        if ($request->hasFile('thumb_image')) {
            $image_path = public_path('upload/images/homepage/'. $section->thumb_image);
            if(file_exists($image_path) && $section->thumb_image){
                unlink($image_path);
            }
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'thumb_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->thumb_image = $new_image_name;
        }
        if ($request->hasFile('sthumb_image')) {
            $image_path = public_path('upload/images/homepage/'. $section->sthumb_image);
            if(file_exists($image_path) && $section->sthumb_image){
                unlink($image_path);
            }
            $image = $request->file('sthumb_image');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'sthumb_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->sthumb_image = $new_image_name;
        }
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
        
        if ($request->hasFile('title_img')) {
            $image = $request->file('title_img');
            $new_image_name = $this->uniqueImagePath('homepage_section_items', 'title_img', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->title_img = $new_image_name;
        }
        
        $update = $section->save();
        
        if($update){
            Toastr::success('Section update successfully.');
        }else{
            Toastr::error('Section can\'t update.');
        }

        return back();
    }

    public function itemRemove($id)
    {
        $section = HomepageSectionItem::find($id);
        if($section){
            $section->delete();
            $output = [
                'status' => true,
                'msg' => 'Section item remove successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Section item cannot remove.'
            ];
        }
        return response()->json($output);
    }

}
