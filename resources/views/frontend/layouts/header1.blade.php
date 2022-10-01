<?php 
$menuitems = App\Models\Menuitem::with(['subMenus.childMenus'])->whereNull('parent_id')->whereHas('get_menu', function($query){ $query->where('location','main_header');})->orderby('position', 'asc')->get(); 
?>
<?PHP
$lang_date = 'bn'; //switch
$engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

$bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );


// dd(date("l, F j, Y"));


if($lang_date == 'en'){
$convertedDATE = date("D, F j, Y ");
$getYear = 'frontend.en.layouts.banglayear';
}else{
$convertedDATE = str_replace($engDATE, $bangDATE, date("l, F j, Y"));
$getYear = 'frontend.layouts.banglayear';
}

$header_dark_logo = DB::table('general_settings')->first()->dark_logo;
$footer_dark_logo = DB::table('general_settings')->first()->footer_dark_logo;
?>
<style>
.news-title2 {
    border-bottom: 2px solid #007bff;
    margin-bottom: 10px;
    padding: 0 10px;
}
.news-title2 h1 {
    position: relative;
    padding: 5px 50px 5px 30px;
    background: -o-linear-gradient(154deg,transparent 12px,#007bff 0,#007bff 100%);
    background: linear-gradient(-64deg,transparent 12px,#007bff 0,#007bff 100%);
    font-size: 18px;
    font-weight: normal;
    display: inline-block;
    color: white;
    margin: 0;
}
    
.news-title2.v_3 h1 {background: linear-gradient(-64deg,transparent 12px,#17a2b8 0,#17a2b8 100%);}
.news-title2.v_3 {border-bottom: 2px solid #17a2b8;}
.news-title2.v_4 h1 {background: linear-gradient(-64deg,transparent 12px,#ea4335 0,#ea4335 100%);}
.news-title2.v_4 {border-bottom: 2px solid #ea4335;}
.news-title2.v_5 h1 {background: linear-gradient(-64deg,transparent 12px,#630933 0,#630933 100%);}
.news-title2.v_5 {border-bottom: 2px solid #630933;}
.news-title2.v_6 h1 {background: linear-gradient(-64deg,transparent 12px,#a67d51 0,#a67d51 100%);}
.news-title2.v_6 {border-bottom: 2px solid #a67d51;}
.news-title2.v_7 h1 {background: linear-gradient(-64deg,transparent 12px,#4579bd 0,#4579bd 100%);}
.news-title2.v_7 {border-bottom: 2px solid #4579bd;}
.news-title2>h1::after {
    width: 5px;
    height: 110%;
    display: inline-block;
    -webkit-transform: skewX(-26.5deg);
    -ms-transform: skewX(-26.5deg);
    transform: skewX(-26.5deg);
    content: " ";
    border-right: 4px solid #fff;
    border-left: 4px solid #fff;
    position: absolute;
    right: 10px;
    top: 0;
}
.news-title2>h1::before {
    content: "";
    width: 30px;
    height: 110%;
    -webkit-transform: skewX(-26.5deg);
    -ms-transform: skewX(-26.5deg);
    transform: skewX(-26.5deg);
    background: #fff;
    position: absolute;
    left: -20px;
    top: 0px;
    z-index: 9;
}
.border-bottom-cc {
    border-bottom: 1px solid #007bff;
    display: block;
    text-align: right;
    padding: 5px;
    font-weight: 400;
    color: #007bff;
    text-decoration: none;
}
.flexff {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}
.contents {display: contents;}
.navbar {background: #1fb78d;}
ul.sub-menu a {color: black;display: flex;justify-content: space-between;align-items: center;}
.p1 {padding: 1px;}
.img_410 img {height: 410px;object-fit: cover;}
.news-title2 a {
    border-bottom: 3px solid #dd3333;
}
.navbar ul li a:hover, .navbar ul ul li a:hover {
    color: white;
}
.news-title4 {
    border-top: 2px solid black;
    border-bottom: 1px solid black;
    padding: 5px 0 0px;
    margin-bottom: 10px;
}
.box_bg_color-3 {
    background: #a6b1b7;
    display: block;
    overflow: auto;
}
.img_60 img {
    height: 60px;
    object-fit: cover;
}
.h60 {
    height: 60px;
    overflow: hidden;
}
.box_bg_color-4 {
    background: #fafac1;
    display: block;
}
.h80 {
    height: 80px;
    overflow: hidden;
}
.img_330 img {
    height: 330px;
    object-fit: cover;
}
.img_310 img {
    height: 310px;
    object-fit: cover;
}
.img_200 img {
    height: 200px;
    object-fit: cover;
}
.img_270 img {
    height: 270px;
    object-fit: cover;
}
.sidebar.large-sidebar {
    overflow: auto;
}
.z-index-5 {z-index: 5;}
.justify-end {justify-content: flex-end;}
[data-theme="dark"] body,
[data-theme="dark"] .modal.right.fade.in .modal-dialog,
[data-theme="dark"] .modal-header,
[data-theme="dark"] .list-unstyled,
[data-theme="dark"] .modal.left.fade.in .modal-dialog,
[data-theme="dark"] .navbar ul.sub-menu,
[data-theme="dark"] .header.active .navbar,
[data-theme="dark"] .full,
[data-theme="dark"] .panels,
[data-theme="dark"] .header24 {
    background: #18191a !important;
}
[data-theme="dark"] .title_text_color-1,
[data-theme="dark"] .box_text_color-1,
[data-theme="dark"] .title_bg_color-1,
[data-theme="dark"] .t-red::after,
[data-theme="dark"] .author,
[data-theme="dark"] .news-time,
[data-theme="dark"] .description,
[data-theme="dark"] span,
[data-theme="dark"] h1,
[data-theme="dark"] .news-title4 h2,
[data-theme="dark"] .box_bg_color-1 h2,
[data-theme="dark"] .trending-tag a,
[data-theme="dark"] .list-unstyled a,
[data-theme="dark"] .footermin,
[data-theme="dark"] .authorsx,
[data-theme="dark"] .navbar a
{color: #fff;}

[data-theme="dark"] .box_bg_color-3,
[data-theme="dark"] .box_bg_color-3 h1,
[data-theme="dark"] .box_bg_color-3 h2,
[data-theme="dark"] .box_bg_color-4 h1,
[data-theme="dark"] .box_bg_color-4 h2,
[data-theme="dark"] .box_bg_color-4
{color: #242526;}

[data-theme="dark"] .box_bg_color-1
{background: #242526 !important;}

.bg-primary a {
    background: #10a4b5;
    color: white;
    font-size: 20px;
    padding: 5px 0;
    margin-bottom: 0.5em;
}
.panels {
    max-height: 315px;
    overflow-y: scroll;
    background: white;
    padding: 10px;
}
.tabs {
    width: 100%;
}
.tab {
    width: 50%;
    cursor: pointer;
    padding: 10px 20px;
    background: #10a4b5;
    display: inline-block;
    color: #fff;
}
.panel{
  display:none;
  animation: fadein .8s;
}
@keyframes fadein {
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}

.radio{
  display:none;
}
#one:checked ~ .panels #one-panel,
#two:checked ~ .panels #two-panel,
#three:checked ~ .panels #three-panel{
  display:block
}
#one:checked ~ .tabs #one-tab,
#two:checked ~ .tabs #two-tab,
#three:checked ~ .tabs #three-tab{
  background:#fff;
  color:#000;
  border-top: 3px solid #10a4b5;
}

/** slider switch **/
.p-r-1 {padding-right: 10px;}
.justify-content {justify-content: flex-end;}
.theme-switch {
    position: relative;
    width: 50px;
    height: 28px;
}

.theme-switch input {
    display: none;
}

.slider-theme {
    background-color: #ccc;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.4s ease-in-out;
}

input:checked + .slider-theme {
    background-color: #14b866;
}

.slider-theme:before {
    content: "";
    background-color: #fff;
    position: absolute;
    width: 20px;
    height: 20px;
    left: 4px;
    bottom: 4px;
    border-radius: 50%;
    transition: all 0.4s ease-in-out;
}

input:checked + .slider-theme:before {
    transform: translateX(22px);
}

.slider-theme::after {
    content: "";
    display: block;
    color: #fff;
    width: 11px;
    height: 5px;
    position: absolute;
    left: 12px;
    top: 12px;
    border-bottom: 2px solid #fff;
    border-left: 2px solid #fff;
    transform: translate(-50%,-50%) rotate(-45deg);
}
.search-icon {
  font-size: 25px;
  color: #fff;
  background-color: #eee0;
  border: 0;
  outline: none;
  margin-top: 0;
    margin-right: 5px;
}

.search-toggle .search-icon.icon-close {
  display: none;
}
.search-toggle.opened .search-icon.icon-search {
  display: none;
}
.search-toggle.opened .search-icon.icon-close {
  display: block;
}

.search-container {
  position: absolute !important;
  -moz-transition: all 0.3s;
  -o-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  max-height: 0;
  overflow: hidden;
  background-color: #212529;
}
.search-container.opened {
  max-height: 100px;
  right: 45px;
    top: 35px;
    z-index: 999999999;
}
.search-container input[type="text"] {
  outline: none;
  font-size: 1.6rem;
  margin: 10px;
  width: 300px;
  background-color: inherit;
  border: 0;
  color: white;
}
.search-container .search-icon {
  vertical-align: middle;
}


.owl-carousel {
-ms-touch-action: pan-y;
touch-action: pan-y;
}
.owl-carousel {
-ms-touch-action: none;
touch-action: none;
}
.yt-content-slider .owl2-controls {
    opacity: 0;
    -webkit-transition: all 0.2s ease 0s;
    -moz-transition: all 0.2s ease 0s;
    transition: all 0.2s ease 0s;
}
.yt-content-slider:hover .owl2-controls {
    opacity: 1;
}
.yt-content-slider .owl2-controls .owl2-nav .owl2-next,
.yt-content-slider .owl2-controls .owl2-nav .owl2-prev {
    line-height: 36px;
    text-align: center;
    font-size: 22px;
    display: inline-block;
    background: #ffffff;
    position: absolute;
    color: #000;
    top: 40%;
    border: 0;
    padding: 0 15px;
    -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 15%);
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 15%);
    border-radius: 50%;
}
.yt-content-slider .owl2-prev {left:0;}
.yt-content-slider .owl2-next {right:0;}

.owl2-carousel .owl2-animated-in {
    z-index: 0;
}

.owl2-carousel .owl2-animated-out {
    z-index: 1;
}

.owl2-carousel .fadeOut {
    -webkit-animation-name: fadeOut;
    animation-name: fadeOut;
}

@-webkit-keyframes fadeOut {
    0% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}

/* 
 *  Owl Carousel - Auto Height Plugin
 */
.owl2-height {
    -webkit-transition: height 500ms ease-in-out;
    -moz-transition: height 500ms ease-in-out;
    -ms-transition: height 500ms ease-in-out;
    -o-transition: height 500ms ease-in-out;
    transition: height 500ms ease-in-out;
}
.owl2-carousel .animated {
    -webkit-animation-duration: 1000ms;
    animation-duration: 1000ms;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}
/* 
 *  Core Owl Carousel CSS File
 */
.owl2-carousel {
    /*display: none;*/
    width: 100%;
    -webkit-tap-highlight-color: transparent;
    /* position relative and z-index fix webkit rendering fonts issue */
    position: relative;
    z-index: 1;
}

.owl2-carousel .owl2-stage {
    position: relative;
    -ms-touch-action: pan-Y;
}

.owl2-carousel .owl2-stage:after {
    content: ".";
    display: block;
    clear: both;
    visibility: hidden;
    line-height: 0;
    height: 0;
}

.owl2-carousel .owl2-stage-outer {
    position: relative;
    overflow: hidden;
    /* fix for flashing background */
    -webkit-transform: translate3d(0px, 0px, 0px);
    transform: translate3d(0px, 0px, 0px);
    -moz-transform: translate3d(0px, 0px, 0px);
}

.owl2-carousel .owl2-controls .owl2-nav .owl2-prev,
.owl2-carousel .owl2-controls .owl2-nav .owl2-next,
.owl2-carousel .owl2-controls .owl2-dot {
    cursor: pointer;
    cursor: hand;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.owl2-carousel.owl2-loaded {
    display: block;
}

.owl2-carousel.owl2-loading {
    opacity: 0;
    display: block;
}

.owl2-carousel.owl2-hidden {
    opacity: 0;
}

.owl2-carousel .owl2-refresh .owl2-item {
    /*display: none;*/
}

.owl2-carousel .owl2-item {
    position: relative;
    min-height: 1px;
    float: left;
    -webkit-backface-visibility: hidden;
    -webkit-tap-highlight-color: transparent;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.owl2-carousel .owl2-item img {
    display: block;
    max-width: 100%;
    -webkit-transform-style: preserve-3d;
}

.owl2-carousel.owl2-text-select-on .owl2-item {
    -webkit-user-select: auto;
    -moz-user-select: auto;
    -ms-user-select: auto;
    user-select: auto;
}

.owl2-carousel .owl2-grab {
    cursor: move;
    cursor: -webkit-grab;
    cursor: -o-grab;
    cursor: -ms-grab;
    cursor: grab;
}

.owl2-carousel.owl2-rtl {
    direction: rtl;
}

.owl2-carousel.owl2-rtl .owl2-item {
    float: right;
}

/* No Js */
.no-js .owl2-carousel {
    display: block;
}

/* 
 *  Owl Carousel - Lazy Load Plugin
 */
.owl2-carousel .owl2-item .owl2-lazy {
    opacity: 0;
    -webkit-transition: opacity 400ms ease;
    -moz-transition: opacity 400ms ease;
    -ms-transition: opacity 400ms ease;
    -o-transition: opacity 400ms ease;
    transition: opacity 400ms ease;
}

.owl2-carousel .owl2-item img {
    transform-style: preserve-3d;
}

/* 
 *  Owl Carousel - Video Plugin
 */
.owl2-carousel .owl2-video-wrapper {
    position: relative;
    height: 100%;
    background: #000;
}

.owl2-carousel .owl2-video-play-icon {
    position: absolute;
    height: 80px;
    width: 80px;
    left: 50%;
    top: 50%;
    margin-left: -40px;
    margin-top: -40px;
    background: url("owl.video.play.html") no-repeat;
    cursor: pointer;
    z-index: 1;
    -webkit-backface-visibility: hidden;
    -webkit-transition: scale 100ms ease;
    -moz-transition: scale 100ms ease;
    -ms-transition: scale 100ms ease;
    -o-transition: scale 100ms ease;
    transition: scale 100ms ease;
}

.owl2-carousel .owl2-video-play-icon:hover {
    -webkit-transition: scale(1.3, 1.3);
    -moz-transition: scale(1.3, 1.3);
    -ms-transition: scale(1.3, 1.3);
    -o-transition: scale(1.3, 1.3);
    transition: scale(1.3, 1.3);
}

.owl2-carousel .owl2-video-playing .owl2-video-tn,
.owl2-carousel .owl2-video-playing .owl2-video-play-icon {
    /*display: none;*/
}

.owl2-carousel .owl2-video-tn {
    opacity: 0;
    height: 100%;
    background-position: center center;
    background-repeat: no-repeat;
    -webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
    background-size: contain;
    -webkit-transition: opacity 400ms ease;
    -moz-transition: opacity 400ms ease;
    -ms-transition: opacity 400ms ease;
    -o-transition: opacity 400ms ease;
    transition: opacity 400ms ease;
}

.owl2-carousel .owl2-video-frame {
    position: relative;
    z-index: 1;
}
.pt-5 {padding-top: 5px;}
.w-b {background: #212529;overflow: auto;padding: 6px 0;}
.time-now {color: white;}
.herabtt {background: transparent;color: white;font-size: 25px;max-height:0;padding: 0;}
.breaking-news24 {
    border: 2px solid #0a7bc0;
}
.has-menu > a:after {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    line-height: 26px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    content: '\f107';
    margin-left: 6px;
    font-size: 16px;
}
.bg-w {
    background: #fff;
    overflow: auto;
}
.breaking-news24 h2 {
    font-size: 20px;
    margin: 0;
    line-height: 24px;
    position: absolute;
    background: #bf1e2e;
    color: #fff;
    padding: 10px;
    z-index: 9;
}
.breaking-news24 h2:after {
    content: "";
    position: absolute;
    left: 110px;
    border-left: 20px solid #bf1e2e;
    border-top: 44px solid transparent;
    clear: both;
    top: 0;
}
.breaking-news24 a, .inline-block {
    display: inline-block;
}
.m-b-0 {
    margin-bottom: 0;
}
.p-3 {
    padding: 3px;
}
.p-r-5 {
    padding-right: 5px;
}
button.close {max-height: 30px;}
@media only screen and (max-width: 600px) {
.hera {display: block;overflow: auto;}
.img_410 img {height: 160px;}
img.logo {height: 30px;display: flex;padding: 10px 0;}
.contents {display: block;}
}
body {top: 0 !important;}
.goog-te-banner-frame.skiptranslate,
.goog-te-gadget img {display: none !important;}
.translated-rtl {
  direction: rtl;
}
</style>
<div>{!! config('siteSetting.code1') !!}</div>
<header class="clearfix header">
    <div class="header-main-bg">
        <div class="container">
        <div class="header-main">
            <div class="nav-item">
                <ul>
                    <li class="archive"><a href="https://deshnewsbd.com/archive">আর্কাইভ</a></li>
                    <div class="devider-line dn"></div>
                    <li class="converter"><a href="https://deshnewsbd.com/converter">কনভার্টার</a></li>
                    <div class="devider-line dn"></div>
                    <li class="location"><i class="fa-solid fa-location-dot"></i>ঢাকা</li>
                    <div class="devider-line dn"></div>
                    <li><i class="fa-solid fa-calendar-days"></i>{{$convertedDATE}} খ্রিস্টাব্দ</li>
                    <div class="devider-line"></div>
                    <li class="bd-date">@include($getYear) বঙ্গাব্দ</li>
                </ul>
            </div>
            <div class="social-icon">
                <ul>
                    @php
                      if(!Session::has('socialLists')){
                          Session::put('socialLists', App\Models\Social::where('status', 1)->get());
                      }
                    @endphp
                    @foreach(Session::get('socialLists') as $social)
                        <li class="icon"><a href="{{$social->link}}"><i class="fa {{$social->icon}}"></i></a></li>
                    @endforeach
                    
                    <li id="translation"></li>
                    <li class="theme-switch-wrapper flex">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" onclick="changeLogo(this)"/>
                            <div class="slider-theme"></div>
                        </label>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    </div>
    
    
    <div class="container">
    <div class="logo-banner">
        <div class="logo">
            <a class="logom" href="{{route('home')}}">
                <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" height="40" alt="Logo" id="logo">
            </a>
        </div>
        <div class="add-banner">
            <a class="logom" href="{{route('home')}}">
                <img src="{{ asset('frontend/images/mujib-add-banner.png')}}" height="40" alt="Logo" id="logo">
            </a>
        </div>
    </div>
</div>
    
    
    <div class="d-none">
        <div class="flex align-c space-between container px-20 mt-15 pb-15 shadow">
            <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <a href="{{route('home')}}">
                <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" class="logo" alt="Logo">
            </a>
            <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="row navbar m-none"> 
        <div class="container flex space-between align-items-center">
    		<ul>
    		    <li class="home"><a href="{{url('/')}}">{{$siteSetting->lang4}}</a></li>
    			@foreach($menuitems as $menuitem)
    			<li @if(count($menuitem->subMenus)>0) class="has-menu" @endif ><a href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
    				@if(count($menuitem->subMenus)>0)
    				<ul class="sub-menu">
    				    @foreach($menuitem->subMenus as $subMenu)
    					<li @if(count($subMenu->childMenus)>0) class="has-menu" @endif ><a href="{{url($subMenu->url)}}">{{$subMenu->title}}</a>
    						@if(count($subMenu->childMenus)>0)
    						<ul class="sub-menu">
    						    @foreach($subMenu->childMenus as $childMenu)
    							<li><a href="{{$childMenu->url}}">{{$childMenu->title}}</a></li>
    							@endforeach
    						</ul>
    						@endif
    					</li>
    					@endforeach
    				</ul>
    				@endif
    			</li>
    			@endforeach
    		</ul>
    		<div class="flex justify-end">
    		<div class="search inline-block">
                  <div class="search-toggle">
                    <button class="search-icon icon-search"><i class="fa fa-fw fa-search"></i></button>
                    <button class="search-icon icon-close"><i class="fa fa-fw  fa-close"></i></button>
                  </div>
                  <div class="search-container">
                    <form action="{{route('search_result')}}">
                      <input type="text" name="q" id="search-terms" value="{{Request::get('q')}}" placeholder="অনুসন্ধান করুন..." />
                      <button type="button" class="search-icon"><i class="fa fa-fw fa-search"></i></button>
                    </form>
                  </div>
            </div>
    		<button type="button" class="btn btn-demo herabtt" data-toggle="modal" data-target="#myModal"><i class="fa fa-bars" aria-hidden="true"></i></button>
    		</div>
        </div>
    </div>
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content ">
				<div class="modal-header flex space-between p-10">
					<form action="{{route('search_result')}}" method="get" class="jumbotronc subscribe-form" style="width: 100%;margin-right: 30px;">
                        <input type="text" name="q" value="{{Request::get('q')}}" style="width: 100%; padding: 10px;" id="subscribe" placeholder="অনুসন্ধান করুন
">
                    </form>
					<button type="button" class="close search-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					<div class="trending">{!! config('siteSetting.trending') !!}</div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div>
    <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		@include('frontend.layouts.left')
	</div>
</header>
<div>{!! config('siteSetting.code4') !!}</div>
<script type="text/javascript">
    function changeLogo(event) {
        if($(event).val()){
            console.log($(event).val())
            $('#logo').attr(src,'{{ asset('upload/images/logo')}}/{{$header_dark_logo}}')
            $('#footer_logo').attr(src,'{{ asset('upload/images/logo')}}/{{$footer_dark_logo}}')
        }
    }
</script>