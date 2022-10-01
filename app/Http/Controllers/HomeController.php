<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\HomepageSection;
use App\Models\HomepageSectionItem;
use App\Models\Page;
use App\Models\ReadLater;
use App\Models\SiteSetting;
use App\Models\Category;
use App\Models\Deshjure;
use App\Models\NewsView;
use App\Models\Banner;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Str;
use Session;
use Response;
use Illuminate\Support\Facades\Request;

use View;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $data = [];
        //get all homepage section
        $data['sections'] = HomepageSection::where('status', 1)->orderBy('position', 'asc')->paginate(3);
        
        
        // dd($data);
        
        
        //check ajax request
        if (request()->ajax()) {
            $data['ajaxLoad'] = true;
            $view = view('frontend.homepage.homesection', $data)->render();
            return response()->json(['html'=>$view]);
        }
        
        Cookie::queue('NewsView', 'view', time() + (86400));
        return view('frontend.index2')->with($data);
    }

    public function category(Request $request, $category, $subcategory=null,$childcategory=null,$subchildcategory=null )
    {
        $data = [];
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
        $data['category'] = Category::with('subcategory')->where('cat_slug_en', $category)->orWhere('slug', $category)->first();
         $category_id = $data['category']->id;
         $data['title'] = $data['category']->category_bd;
        if($data['category']->parent_id){
        $data['category'] = Category::with('subcategory')->where('id', $data['category']->parent_id)->first();
        }
       if($data['category']){
           
            $date = Carbon::parse(now())->format('Y-m-d H:i:s');
           
            $categories = News::with(['getcategory', 'image'])
                ->whereJsonContains('categories', "$category_id")
                ->where('status', '=', 'active')
                ->where('publish_date', '<=', $date);
 
            $data['categories'] =  $categories->where('news.lang', '=', $lang)->orderBy('id', 'DESC')->paginate(22);
            //get all homepage section
            $data['sections'] = HomepageSection::where('page_name', $category)->where('status', 1)->orderBy('position', 'asc')->get();

            return view('frontend.category')->with($data);
        }
        else{
            return view('frontend.404');
        }
    }

    public  function news_details($category='', $id){
        $data = [];
        $get_news = News::with(['image','reporter', 'attachFiles'])->where('id', $id);
            if(!Auth::guard('admin')->check() || !Auth::guard('reporter')->check()){
                $get_news->where('status', 'active');
            }

        $data['get_news'] = $get_news->first();

       
        if($data['get_news']){
            $lang = (Request::segment(1) == 'en' ? Request::segment(1) : 'bd');
            $data['comments'] = Comment::where('news_id', $data['get_news']->id)->where('type', 1)->orderBy('id', 'ASC')->paginate(5);
            $news_id = 'view'.request()->ip();

            $newsView = NewsView::where('news_id', $data['get_news']->id)->where('ip_address', request()->ip())->first();

            $news_view_amount = SiteSetting::where('type', 'news_view_amount')->first();
            $news_count_day = ($news_view_amount->value2) ? $news_view_amount->value2 : 1;
            $max_date = Carbon::parse(now())->addDays($news_count_day)->format('Y-m-d'). ' 23:59:59';
            $min_date = Carbon::parse(now())->subDays($news_count_day)->format('Y-m-d'). ' 00:00:00';

            if($data['get_news']->publish_date <= $max_date && $data['get_news']->publish_date >= $min_date ){
                if(!Auth::guard('reporter')->check() && request()->rs && request()->rs == $data['get_news']->user_id) {
                    if(!$newsView) {
                        if(!Cookie::has('NewsView')) {
                            $data['get_news']->increment('view_counts'); //new news view count
                            $newsView = new newsView();
                            $newsView->news_id = $data['get_news']->id;
                            $newsView->visitor_id = (Auth::check() ? Auth::id() : 'guest');
                            $newsView->ip_address = request()->ip();
                            $newsView->total_view = 10;
                            $newsView->save();
                            $user = User::find($data['get_news']->user_id);
                            $user->wallet_balance = $user->wallet_balance + $news_view_amount->value;
                            $user->save();
                        }
                    }
                }
                Cookie::queue('NewsView', 'view', time() + (86400));
            }

            $data['get_news']->increment('impressions');

            $data['more_news'] = News::with(['categoryList', 'image'])
                ->where('news.id', '!=', $data['get_news']->id)
                ->whereJsonContains('news.categories', $data['get_news']->category)
                ->where('news.lang', '=', $lang)
                ->where('news.status', '=', 'active')
                ->orderBy('publish_date', 'DESC')
                ->take(8)->get();
                Session::put('redirectLink', url()->full());
            return view('frontend.news-details')->with($data);
        }else{
            return view('frontend.404');
        }
    }


    public function related_news(Request $request, $id){

        $lang = (Request::segment(1) == 'en' ? Request::segment(1) : 'bd');
        $newsNo = $_REQUEST['newsNo'];
        $get_news = News::with(['image','attachFiles'])->where('id', $id)->where('status', 'active')->first();
        $more_news = News::with(['categoryList', 'categoryList', 'image'])
                ->where('news.id', '!=', $get_news->id)
                ->where('news.category', $get_news->category)
                ->where('news.lang', '=', $lang)
                ->where('news.status', '=', 'active')
                ->orderBy('publish_date', 'DESC')
                ->take(8)->get();

        return view('frontend.related-news')->with(compact('more_news', 'newsNo'));
    }
    
    public function newsPrint($id){
        
        $data['get_news'] = News::with(['image','reporter', 'attachFiles'])->where('id', $id)->first();
        ($data['get_news']);
        return view('frontend.news-print')->with($data);
    }
    
    public function getNewsByCategory(Request $request){
        $category = request('category');
        
        $section_item = HomepageSectionItem::where('id', request('section_id'))->whereJsonContains('item_id', "$category")->where('status', 1)->first();
        $section = HomepageSection::where('id', $section_item->section_id)->first();
       
        $get_news = News::where('status', 'active')->whereJsonContains('categories', "$category")->orderBy('publish_date', 'desc')->take($section_item->item_number)->get(); 
        
        if(\View::exists('frontend.pages.tab-layouts.'.$section_item->section_layout)){
            return  view('frontend.pages.tab-layouts.'.$section_item->section_layout)->with(compact('get_news', 'section', 'section_item'));
        }else{
            return 'News not found.';
        }
    }

    //use jquery plugin not work proper
    public function watermark($path){

        return view('frontend/watermark')->with(compact('path'));
    }

    // all news 
    public function allnews(Request $request)
    {
        $data['page'] = Page::where('page_slug', 'all-news')->where('status', 1)->first();
       
        if($data['page']){
            $data['get_news'] = News::where('status', 'active')->orderBy('id', 'desc')->paginate(24); 
            
            return view('frontend.pages.all-news')->with($data);
        }
        return view('frontend.404');
    }     
    
    // archive news 
    public function archive(Request $request)
    {
        $get_news = News::where('status', 'active');
        if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day']) ){
            $get_news->whereDate('publish_date', $_GET['year'] .'-'. $_GET['month'] .'-'. $_GET['day']);
        }
        $data['get_news'] =  $get_news->orderBy('publish_date', 'desc')->paginate(24); 
        return view('frontend.pages.archive')->with($data);
        
    }   
    
    
    // location news 
    public function location(Request $request)
        {
            $get_news = News::where('status', 'active');

            $division = $zilla = $upazilla = null;
            if(isset($_GET['division']) && $_GET['division'] > 0){
                $division = $_GET['division'];
                $get_news->whereJsonContains('location', "$division");
            }
            if(isset($_GET['zilla']) && $_GET['zilla'] > 0){
                $zilla = $_GET['zilla'];
                $get_news->orWhereJsonContains('location', "$zilla");
            }
            if(isset($_GET['upazilla']) && $_GET['upazilla'] > 0){
                $upazilla = $_GET['upazilla'];
                $get_news->orWhereJsonContains('location', "$upazilla");
            }
            $data['get_news'] =  $get_news->orderBy('publish_date', 'desc')->paginate(24); 
            
            //get all division 
            $data['divisions'] = Deshjure::where('cat_type', 'division')->where('status', 1)->orderBy('position', 'ASC')->get();

            $data['zillas'] = Deshjure::where('parent_id', $division)->where('status', 1)->orderBy('position', 'ASC')->get();
            $data['upazillas'] = Deshjure::where('parent_id', $zilla)->where('status', 1)->orderBy('position', 'ASC')->get();
            
            return view('frontend.pages.locations')->with($data);
        } 
    
    // all custom page display in
    public function page($slug)
    {
        $data['page'] = Page::where('page_slug', $slug)->where('status', 1)->first();
       
        if($data['page']){
            $slug = ($data['page']->is_default == 1) ? $data['page']->page_slug : 'page';
            //get this site banner
            $data['banners'] = Banner::where('page_name', $data['page']->id)->orderBy('position', 'asc')->where('status', 1)->get(); 
            $data['sections'] = HomepageSection::where('page_name', $data['page']->page_slug)->where('status', 1)->orderBy('position', 'asc')->get();
           
            return view('frontend.pages.'.$slug)->with($data);
        }
        return view('frontend.404');

    }

    public function reporterPublicProfile($username){
        $data = [];

        $data['reporter'] = User::with('userinfo')->where('username', $username)->first();
        $lang = (Request::segment(1) == 'en' ? Request::segment(1) : 'bd');
        if($data['reporter']){
            $date = Carbon::parse(now())->format('Y-m-d H:i:s');
            $data['get_news'] = News::with(['categoryList', 'categoryList', 'image'])->where('user_id', $data['reporter']->id)->where('lang', '=', $lang)
                ->where('publish_date', '<=', $date)
                ->where('status', '=', 'active')
                ->orderBy('publish_date', 'DESC')->paginate(24);
            return view('frontend.reporter.reporter-details')->with($data);
        }else{
            return view('frontend.404');
        }

    }

    public function userPublicProfile($username){
        $data = [];
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.users.'; }
        $data['user_details'] = User::where('username', $username)->first();
        if($data['user_details']){
            $data['total_Bdnews'] = News::where('user_id',  $data['user_details']->id)->where('lang', 'bd')->count();
            $data['total_Engnews'] = News::where('user_id',  $data['user_details']->id)->where('lang', 'en')->count();
            $data['read_laters'] = ReadLater::where('user_id',  $data['user_details']->id)->count();
            return view($folder.'user-profile')->with($data);
        }else{
            return view($folder.'404');
        }
    }

    public function search_news(Request $request){
        $output = '';
        $keyword = request('q');
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
        $search_news = News::with('getcategory')->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->where(function ($query) use ($keyword) {
            $query->orWhere('news_title', 'like', '%' . $keyword . '%');
            $query->orWhere('keywords', 'like', '%' . $keyword . '%');
        })
        ->where('news.status', '=', 'active')
        ->where('news.lang', '=', $lang)
        ->where('publish_date', '<=', $date)
        ->take(7)->orderBy('news.id', 'desc')
        ->select('news.news_title','news.news_slug','news.publish_date', 'news.category', 'media_galleries.source_path')
            ->get();

            if(count($search_news)>0){

            $output = '<ul class="list-posts">';
            foreach ($search_news as $news) {

                $output .= '<li><a href="'.route('newsDetails', [$news->getcategory->slug, $news->news_slug]).'">
                                <img src="'.asset('upload/images/thumb_img/'. $news->source_path).'" alt="" width="50">
                                <span class="post-content">
                                    <ul class="post-tags">
                                        <li><i class="fa fa-clock-o"></i>'.Carbon::parse($news->publish_date)->format('j F, Y').'</li>
                                    </ul>
                                </span>
                            '.Str::limit($news->news_title, 80).'</a></li>';
            }
            $output .= (count($search_news)>7 ) ? '<li><a href="'.route('search_result').'?q='.$keyword.'">See All Results</a></li>': '' .'</ul>';

            echo $output;
       }

       return false;

    }

    public function search_result(Request $request){
        $keyword = request('q');
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');
        $search_results = News::leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where(function ($query) use ($keyword) {
                $query->orWhere('news_title', 'like', '%' . $keyword . '%');
                $query->orWhere('keywords', 'like', '%' . $keyword . '%');
            })
            ->where('news.lang', '=', $lang)
            ->where('news.status', '=', 'active')
            ->where('publish_date', '<=', $date)
        ->take(7)->orderBy('news.id', 'desc')->select('news.*', 'media_galleries.source_path')->paginate(20);

        if($search_results){
            return view( 'frontend.search-result')->with(compact('search_results'));
        }else{
            return view('frontend.404');
        }
    }

    public function video(){
        $data = [];
        $data['categories'] = Category::where('status', 1)->orderBy('position', 'ASC')->paginate(12);
        if($data['categories']){
             return view('frontend.news-videos')->with($data);
        }else{
            return view('frontend.404');
        }
    }

    public function gallery(){
        $data = [];
        $data['categories'] = Category::where('status', 1)->orderBy('serial', 'ASC')->paginate(12);
        return view('frontend.news-gallery')->with($data);
    }

    public function error(){
        return view('frontend.404');
    }

    public function feed(){
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');
        $get_feeds = News::with(['image:id,source_path','reporter:id,name'])->where('publish_date', '<=', $date)->take(1000)->where('status', 'active')->orderBy('id', 'DESC')->get();
        return Response::view('frontend.feed',  ['get_feeds' => $get_feeds])->header('Content-Type', 'text/xml');
    }
    
    public function rss(){
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');
        $get_rsss = News::with(['image:id,source_path','reporter:id,name'])->where('publish_date', '<=', $date)->take(20)->where('status', 'active')->orderBy('id', 'DESC')->get();
        return Response::view('frontend.rss',  ['get_feeds' => $get_rsss])->header('Content-Type', 'text/xml');
    }

}
