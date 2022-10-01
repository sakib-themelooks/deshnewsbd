<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

    define('ADMIN', 1);
    define('REPORTER', 2);
    define('USER', 3);
    define('STAFF', 4);

    Route::get('lang/{locale}', function ($locale){

        if($locale == 'en'){
            Session::put('locale', $locale);
            return redirect($locale);
        }
        Session::forget('locale');
        return redirect('/');
    });
    Route::post('user/registration', 'UserController@registration')->name('registration');
    Auth::routes();
    Route::get('social-login/redirect/{provider}', 'SocialLoginController@redirectToProvider')->name('social.login');
    Route::get('social-login/{provider}/callback', 'SocialLoginController@handleProviderCallback')->name('social.callback');

    $locale = (Request::segment(1) == 'en' ? Request::segment(1) : '');
	App::setLocale(Request::segment(1));
    Config::set('app.locale_prefix', $locale);

Route::group(array('prefix' => Config::get('app.locale_prefix')), function() {

    Route::get('/', 'HomeController@index')->name('home');


    Route::get('404', 'HomeController@error')->name('404');
    Route::get('/feed', 'HomeController@feed')->name('feed');
    Route::get('/feeds.rss', 'HomeController@rss')->name('rss');
    Route::get('sitemap', 'SitemapController@index');
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap');
    Route::get('sitemap.xml/pages', 'SitemapController@pages');
    Route::get('sitemap.xml/articles', 'SitemapController@articles');
    Route::get('sitemap.xml/categories', 'SitemapController@categories');
    Route::get('sitemap.xml/news', 'SitemapController@news');


    Route::get('notifications', 'NotificationController@notifications')->name('notifications');
    Route::get('notifications/read/{id}', 'NotificationController@readNotify')->name('readNotify');


//deshjure search route  // for home page and sitebar
    Route::get('deshjure_district/{id}', 'AjaxController@deshjure_district')->name('deshjure_district');
    Route::get('deshjure_upzilla/{id}', 'AjaxController@deshjure_upzilla')->name('deshjure_upzilla');

    Route::get('news/image/{path}', 'HomeController@watermark')->name('watermark');
   
    Route::get('poll', 'PollingController@pollings')->name('pollings');
    Route::get('poll/{slug}', 'PollingController@poll_details')->name('poll_details');
    Route::get('user/polling', 'PollingController@userPolling')->name('userPolling');
    
    Route::get('get/news/by-category', 'HomeController@getNewsByCategory')->name('getNewsByCategory');
    
    
//this route for news insert pages
    Route::get('news/image-gallery', 'AjaxController@imageGallery')->name('imageGallery');
    Route::get('news/video-gallery', 'AjaxController@videoGallery')->name('videoGallery');


    Route::match(['get', 'post'], 'category/{category}/{subcategory?}/{childCategory?}/{subchildCategory?}', ['uses' => 'HomeController@category', 'as' => 'category']);

    Route::get('news/search', 'HomeController@search_news')->name('search_news');
    Route::get('search', 'HomeController@search_result')->name('search_result');

    Route::get('gallery', 'HomeController@gallery')->name('gallery');
    Route::get('gallery/{category}', 'HomeController@gallery_category')->name('gallery.category');
    Route::get('gallery/{category}/{slug}', 'HomeController@gallery_view')->name('gallery.view');

    Route::get('video', 'HomeController@video')->name('video');
    Route::get('video/watch/{slug}', 'HomeController@video_watch')->name('video.watch');

    Route::get('article/{slug}', 'HomeController@news_details')->name('news_details');
   
    Route::get('get/related/news/{slug}', 'HomeController@related_news')->name('related_news');
    Route::get('comments/{slug}', 'CommentController@comments')->name('comments');
    Route::get('news-print/{id}', 'HomeController@newsPrint')->name('newsPrint');
    
    Route::get('repoter/profile/{username}', 'HomeController@reporterPublicProfile')->name('reporter.publicProfile');
    Route::get('user/profile/{username}', 'HomeController@userPublicProfile')->name('user.publicProfile');
    Route::get('service/{slug}', 'ServiceController@service_details')->name('service_details');
    Route::post('query/service', 'ServiceController@serviceQuery')->name('serviceQuery');

    // news details page
    Route::get('{category}/{slug}', 'HomeController@news_details')->name('newsDetails');
    
    Route::get('all-news', 'HomeController@allnews')->name('allnews');
    Route::get('archive', 'HomeController@archive')->name('archive');
    Route::get('location', 'HomeController@location')->name('location');
    Route::get('{page}', 'HomeController@page')->name('page');
});
