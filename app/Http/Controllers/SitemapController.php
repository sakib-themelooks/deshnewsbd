<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Page;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{

    public function __construct(){
        $sitemap_active = SiteSetting::where('type', 'sitemap')->where('status', 1)->first();
        //check sitemap active or deactive
        if(!$sitemap_active){
            return redirect()->route('404')->send();
        }
    }

    //xml sitemap setting
    public function sitemapSetting() {
        return view('admin.setting.seo-setting');
    }
	public function index() {
		return response()->view('frontend.sitemap.index')->header('Content-Type', 'text/xml');
	}

	public function articles() {

		$articles = News::leftJoin('media_galleries', 'news.thumb_image', 'media_galleries.id')->orderBy("news.id", "desc")->select(["news.id", "category", "source_path", "publish_date"])->paginate(500);
		
		return response()->view('frontend.sitemap.article', [
		'articles' => $articles,
		])->header('Content-Type', 'text/xml');
	}
	
    //xml pages sitemap
    public function pages() {
        $pages = Page::orderBy("id", "desc")->select(["page_slug","updated_at"])->get();
        return response()->view('frontend.sitemap.pages', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
    
	public function categories() {
		$categories = Category::with('subcategory')->orderBy("id", "desc")->get();
		$pages = Page::orderBy("id", "desc")->select(['updated_at','page_slug'])->get();

		return response()->view('frontend.sitemap.category', [
		'categories' => $categories,
		'pages' => $pages,
		])->header('Content-Type', 'text/xml');
	}
    
	public function news() {
		$news = DB::table('news')->orderBy("id", "desc")->select(['*'])->get();
		return response()->view('frontend.sitemap.news', [
		'news' => $news
		])->header('Content-Type', 'text/xml');
	}
}
