<?php

namespace App\Http\Controllers\Reporter;

use App\Models\Deshjure;
use App\Models\SiteSetting;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\MediaGallery;
use App\Models\NewsAttachment;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Models\Reporter;
use Brian2694\Toastr\Facades\Toastr;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Traits\CreateSlug;

class ReporterNewsController extends Controller
{
    use CreateSlug;

    //get all news
    public function index(Request $request, $status='')
    {
        $user_id = Auth::guard('reporter')->id();
        $get_news = News::orderBy('news.id', 'desc')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->groupBy('news.id');
        if(!in_array('editor', explode(',', Auth::guard('reporter')->user()->permission)) || $status != 'pending'){
            $get_news->where('news.user_id', $user_id);
        }
        if($status){
            if($status == 'image-missing'){
                $get_news->where('thumb_image', null);
            }
            elseif($status == 'breaking'){
                $get_news->where('news.breaking_news', 1);
            }elseif($status == 'bd'){
                $get_news->where('news.lang', 'bd');
            }elseif($status == 'en'){
                $get_news->where('news.lang', 'en');
            }elseif($status == 'schedule'){
                $date = Carbon::parse(now())->format('Y-m-d H:i:s');
                $get_news->where('news.publish_date', '>', $date);
            }else{
                $get_news->where('news.status', $status);
            }


        }

        if(!$status && $request->status && $request->status != 'all'){
            $get_news->where('news.status', $request->status);
        }
        if($request->category && $request->category != 'all'){
            $get_news->where('category', $request->category);
        }
        if($request->reporter && $request->reporter != 'all'){
            $get_news->where('news.user_id', $request->reporter);
        }
        if($request->title){
            $get_news->where('news_title', 'LIKE', '%'. $request->title .'%');
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $data['get_news'] = $get_news->selectRaw('news.*, users.name, users.username,categories.category_bd,categories.category_en,categories.cat_slug_en, media_galleries.source_path')->paginate($perPage);

        $data['all_news'] = News::where('user_id', $user_id)->count();
        $data['active_news'] = News::where('user_id', $user_id)->where('status', 'active')->count();
        $data['deactive_news'] = News::where('user_id', $user_id)->where('status', 'deactive')->count();
        $data['reject_news'] = News::where('user_id', $user_id)->where('status', 'reject')->count();
        $pending_news = News::where('status', 'pending');
        if(!in_array('editor', explode(',', Auth::guard('reporter')->user()->permission))){
            $pending_news->where('user_id', $user_id);
        }
        $data['pending_news'] = $pending_news->count();
        $data['breaking'] = News::where('user_id', $user_id)->where('breaking_news', 1)->count();
        $data['image_missing'] = News::where('user_id', $user_id)->where('thumb_image', null)->count();
        $data['categories'] = Category::where('status', 1)->get();
        $data['news_view_amount'] = SiteSetting::where('type', 'news_view_amount')->first();
        return view('reporter.news.news-list')->with($data);
    }
    //news create page
    public function create()
    {
        $data = [];
       $data['categories'] = Category::where('type', 'category')->where('status', 1)->orderBy('position', 'ASC')->get();
        $data['divisions'] = Deshjure::where('cat_type', 'division')->where('status', 1)->orderBy('position', 'ASC')->get();
        return view('reporter.news.news')->with($data);
    }

    //store news
    public function store(Request $request)
    {
        //news is draft
        if($request->submit == 'draft'){
            $request->validate([
            'news_title' => 'required',
            ]);
        }else{
            $request->validate([
                'news_title' => 'required',
                'category' => 'required',
                'lang' => 'required',
            ]);
        }

        $user_id = Auth::guard('reporter')->id();
            if($request->has('user_id')){ $user_id = $request->user_id; }

            if($request->news_slug){
                $news_slug =  $this->createSlug('news', $request->news_slug, 'news_slug');
            }else{
                $news_slug =  $this->createSlug('news', $request->news_title, 'news_slug');
            }

            $news_data = new News();
            $news_data->news_title = $request->news_title;
            $news_data->news_slug = $news_slug;
            $news_data->news_dsc = $request->news_dsc;
            $news_data->category = $request->category[0];
            $news_data->categories = json_encode($request->category);
            $news_data->subcategory = ($request->subcategory) ? $request->subcategory : null;
            $news_data->location = ($request->location) ? json_encode($request->location) : null;
       
            $news_data->user_id = $user_id;
            $news_data->lang =  $request->lang;
            $news_data->type = $request->type;
            $news_data->breaking_news = ($request->breaking_news) ? '1' : '0';
            $news_data->publish_date = ($request->publish_date) ? $request->publish_date : Carbon::parse(now());
            $news_data->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
            $news_data->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
          
            $news_data->meta_description = $request->meta_description;

            //image path
            if($request->has('image')){
                $news_data->thumb_image = $request->image;
            }
            //save status
            if($request->submit == 'draft'){
                $news_data->status = $request->submit;
            }else{
                $news_activation = SiteSetting::where('type', 'news_activation')->first();
                $news_data->status = (isset($request->status)) ? 'active' : 'pending';
            }

            $success = $news_data->save();

            if($success){

                if($request->hasFile('attach_files')){
                    $attach_files = $request->file('attach_files');
                    foreach ($attach_files as $attach_file) {

                        $new_name = $this->uniquePath('media_galleries', 'source_path', $attach_file->getClientOriginalName());
                        $attach_file->move(public_path('upload/file'), $new_name);
                        //save image media Gallery
                        $mediaGallery = new MediaGallery();
                        $mediaGallery->source_path = $new_name;
                        $mediaGallery->type = $news_data->id;
                        $mediaGallery->user_id = $user_id;
                        $mediaGallery->save();

                        //save attach file
                        $attach[] = ['news_id' => $news_data->id, 'source_path' => $new_name];
                    }
                    //insert multiple data
                    NewsAttachment::insert($attach);
                }

                Toastr::success('News is '.$request->submit.' successful.');
            }else{
                Toastr::error('Sorry news insert failed. ');
            }
        return back();
    }

    // edit news
    public function edit($news_slug)
    {
        $user_id = Auth::guard('reporter')->id();
        $data = [];
       
        $data['get_news'] = News::with(['image', 'attachFiles'])->where('news_slug', $news_slug);
        if (!in_array('editor', explode(',', Auth::guard('reporter')->user()->permission))){
            $data['get_news']->where('user_id', $user_id);
        }
        $data['get_news'] = $data['get_news']->first();

        if($data['get_news']){
           
            $data['categories'] = Category::where('type', 'category')->where('status', 1)->orderBy('position', 'ASC')->get();
        $data['divisions'] = Deshjure::where('cat_type', 'division')->where('status', 1)->orderBy('position', 'ASC')->get();

            return view('reporter.news.news-edit')->with($data);
        }else{
            Toastr::error('Sorry news not found.');
            return back();
        }

    }
    //update news
    public function update(Request $request, $id)
    {
        //news is draft
        if($request->submit == 'draft'){
            $request->validate([
            'news_title' => 'required',
            ]);
        }else{
            $request->validate([
                'news_title' => 'required',
                'news_dsc' => 'required',
                'category' => 'required',
                'lang' => 'required',
            ]);
        }

        $user_id = Auth::guard('reporter')->user()->id;

        $news_data = News::find($id);

        if($request->news_slug){
            $news_data->news_slug = strTolower(preg_replace('/[\s]+/', '-', trim($request->news_slug)));
        }
        $news_data->news_title = $request->news_title;
        $news_data->news_dsc = $request->news_dsc;
        $news_data->category = $request->category[0];
        $news_data->categories = json_encode($request->category);
        $news_data->subcategory = ($request->subcategory) ? $request->subcategory : null;
        $news_data->location = ($request->location) ? json_encode($request->location) : null;
       
        $news_data->lang =  $request->lang;
        $news_data->type = $request->type;
        if($request->breaking_news){
        $news_data->breaking_news = ($request->breaking_news) ? '1' : '0';
        }
        $news_data->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $news_data->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
       
        $news_data->meta_description = $request->meta_description;
        if($request->publish_date){
            $news_data->publish_date = $request->publish_date;
        }
        //image path
        if($request->image){
            $news_data->thumb_image = $request->image;
        }
        if($request->reject_reason){
            $news_data->reject_reason = $request->reject_reason;
        }
        //save status
        $news_data->status = (isset($request->status)) ? 'active' : 'pending';
        $success = $news_data->save();

        if($success){
            if($request->hasFile('attach_files')){
                $attach_files = $request->file('attach_files');
                foreach ($attach_files as $attach_file) {

                    $new_name = $this->uniquePath('media_galleries', 'source_path', $attach_file->getClientOriginalName());
                    $attach_file->move(public_path('upload/file'), $new_name);
                    //save image media Gallery
                    $mediaGallery = new MediaGallery();
                    $mediaGallery->source_path = $new_name;
                    $mediaGallery->type = $news_data->id;
                    $mediaGallery->user_id = $user_id;
                    $mediaGallery->save();

                    //save attach file
                    $attach[] = ['news_id' => $news_data->id, 'source_path' => $new_name];
                }
                //insert multiple data
                NewsAttachment::insert($attach);
            }
            Toastr::success('News is ' .$request->submit. ' successfully.');
        }else{
            Toastr::error('Sorry news updated faield.');
        }
        return redirect()->route('reporter.news.edit', $news_data->news_slug);
    }
    //news delete
    public function delete($id)
    {
        $user_id = Auth::guard('reporter')->user()->id;
        $news =  News::where('id', $id)->where('user_id', $user_id)->delete();
        if($news){

            $output = [
                'status' => true,
                'msg' => 'News delete successfull.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry news can\'t deleted.'
            ];
        }
        return response()->json($output);
    }

    //delete attace file
    public function deleteAttachFile($id){
        $newsFile = NewsAttachment::find($id);
        //delete newsFile from store folder
        $file_path = public_path('upload/file/'. $newsFile->source_path);
        if(file_exists($file_path)){
            unlink($file_path);
        }
        // delete image from database
        $delete = $newsFile->delete();
        if($delete){
            echo "Image deleted successfull.";
        }else{
            echo "Sorry image delete failed.!";
        }
    }

}
