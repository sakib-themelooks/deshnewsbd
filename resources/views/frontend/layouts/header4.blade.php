<style>
.nav.navbar-nav a {
    font-size: 20px;
    font-weight: bold;
}
.mmt {
    margin-top: 5px;
}
.title2x {
    border-left: 6px solid #343a40;
    background: #f0f0f3;
    position: relative;
    border-radius: 4px;
    box-shadow: inset 5px 5px 4px #a3a3a5, inset -5px -5px 4px #ffffff;
}
.title2x h1 {
    margin-top: 37px;
    font-size: 33px;
    font-weight: bold;
    writing-mode: tb-rl;
    transform: rotate(-180deg);
    margin-left: 13px;
    color: #dd3432;
    text-align: center;
    position: relative;
    transition: 1s ease;
    display: inline-block;
}
.userxx img {
    border-radius: 50%;
    width: 100px;
    height: 100px;
    border: 15px solid #eee;
    object-fit: cover;
}
.usercc p,
.userxx,
.usercc {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.authorsx b {
    color: black;
    margin: 0.4em 0;
    border-bottom: 5px solid red;
}
.usercc {
    border: 2px solid #eee;
    padding: 0.7em 0.5em;
}
.mix3 {
    display: flex;
    padding: 0px 14px;
    width: 100%;
    align-items: center;
    position: absolute;
    bottom: 85px;
    z-index: 1;
}
.authorss {
    color: white !important;
    font-size: 20px;
    font-weight: 300;
    background: orangered;
    padding: 2px 7px;
    border-radius: 5px;
}
.mix2 {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.post-tags {
    list-style: none;
    margin: 0;
    padding: 3px 0px;
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    font-size: 15px;
}
.post-tags i {
    margin-right: 5px;
    font-size: 11px;
}
.red {
    color: red;
    margin-right: 5px;
}
.red::after {
    content: '/';
    padding-left: 5px;
    color: black;
}
.footerx {
    width: 100%;
    overflow: auto;
    display: block;
    margin: 1em 0;
    border-bottom: 1px solid #666;
}
.clearfix.header.active .navbar.navbar-default {
    display: block;
    position: fixed;
    top: 0;
    z-index: 999;
    left: 0;
    right: 0;
}
.logomin {
    width: 100% !important;
    text-align: center;
}
.logomin img {
    max-height: 100px;
    margin: 0.5em auto;
    text-align: center;
}
.dropdown-menu {
    font-size: 20px;
}
.static-menu a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    font-size: 20px
}
span.time-now i {
    padding: 0 5px;
}
.trending-tag {
    margin-bottom: 1em;
    overflow: auto;
}
.trending-tag a {
    color: #fff;
    line-height: 1.5;
    margin: 0 7px;
    padding: 5px 10px;
    background: #124b65;
    flex-shrink: 0;
    overflow: auto;
    display: inline-flex;
}

.sticky-conent {
    position: sticky;
    position: -webkit-sticky;
    top: 42px;
}
.logo-center {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 8px 13px !important;
}
.navbar {
    position: relative;
    min-height: fit-content;
    margin-bottom:0px;
    border-top: 1px solid {{ config('siteSetting.header_text_color') }}40;
    border-bottom: 1px solid {{ config('siteSetting.header_text_color') }}40;
    border-left: 0;
    border-right: 0;
}

.dropdownIcon::after {
    content: "\f107";
    display: inline-block;
    font-family: FontAwesome;
    padding-left: 5px;
}
.dropdown-menu,
.navbar-default {
    background-color: {{ config('siteSetting.header_bg_nav') }};
    border-radius: 0;
}
.dropdownIcon::after,
.dropdown-menu>li>a,
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover,
.navbar-default .navbar-nav>li>a {
    color: {{ config('siteSetting.header_text_color') }};
}
.navbar-collapse {
    padding-right:0!important;
    padding-left:0!important;
    float: left;
}
.headermin {
    display: flex;
    align-items: center;
}
.btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
    outline: thin dotted;
    outline: 0;
    outline-offset: 0;
}
.modal-backdrop.in {filter: alpha(opacity=0);opacity: 0;z-index: 0;}
.minhera a i {
    margin-right: 10px;
}
.minhera1241 {
    margin-left: 25px;
    margin-bottom: 5px;
}
.trending-tag {
    margin-bottom: 1em;
    overflow: auto;
}
.trending-tag a {
    color: #fff;
    font-size: 15px;
    line-height: 1.5;
    margin: 10px 7px;
    padding: 5px 10px;
    background: #124b65;
    flex-shrink: 0;
    overflow: auto;
    display: block;
}
.d-none {display: none;}
.m-none {display: block;}

@media only screen and (max-width: 600px) {
.logo-advertisement {
    padding: 10px 5px;
}
.d-none {display: block;}
.m-none {display: none;}
.clearfix.header.active .logo-advertisement {
    position: fixed;
    z-index: 999;
    top: 0px;
    left: 0;
    right: 0;
    width: 100%;
}}
</style>
<?php 
$menuitems = App\Models\Menuitem::with(['subMenus.childMenus'])->whereNull('parent_id')->whereHas('get_menu', function($query){ $query->where('location','main_header');})->orderby('position', 'asc')->get(); 
?>
<header class="clearfix header m-none">
    {!! config('siteSetting.code1') !!}
    <div style="background:{{config('siteSetting.header_bg_color')}};">
        <!-- Bootstrap navbar -->
        <div class="row">
            <div style="background: #eee;">
                <div class="container mix2">
                    <div class="col-md-5">
                        <?PHP
        
                        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        
                        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
                        if($lang == 'en'){
                        $convertedDATE = date("D, F j, Y ");
                        $getYear = 'frontend.en.layouts.banglayear';
                        }else{
                        $convertedDATE = str_replace($engDATE, $bangDATE, date("l, F j, Y"));
                        $getYear = 'frontend.layouts.banglayear';
                        }
                        ?>
                        <span class="time-now"><i class="fa fa-map-marker" aria-hidden="true"></i> ঢাকা,  <i class="fa fa-calendar" aria-hidden="true"></i> {{$convertedDATE}} |  @include($getYear)</span>
                    </div>
                    <div class="col-md-2 mix2">
                        <a class="classified" href="{!! config('siteSetting.lang10') !!}"><p>Classified</p></a>
                        <a class="english" href="{!! config('siteSetting.lang9') !!}"><p>English Version</p></a>
                    </div>
                    <div class="col-md-5">
                    <ul class="social-icons" style="float: right;">
                         @php
                          if(!Session::has('socialLists')){
                              Session::put('socialLists', App\Models\Social::where('status', 1)->get());
                          }
                        @endphp
                        @foreach(Session::get('socialLists') as $social)
                        <li><a style="background:{{$social->background}}; color:{{$social->text_color}}" href="{{$social->link}}"><i class="fa {{$social->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                    
                </div>
                </div>
            </div>
            <!-- Logo & advertisement -->
            <div class="container mix2">
                <div class="col-md-2 pps">
                    <a class="logomin" href="{{route('home')}}">
                        <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" alt="Logo">
                    </a>
                </div>
                <div class="col-md-3 mmt">{!! config('siteSetting.code2') !!}</div>
                <div class="col-md-7 mmt pps">{!! config('siteSetting.code3') !!}</div>
            </div>
            <div class="container mix2">
                <div style="font-weight: bold;display: inline-block;width: 117px;position: relative;background: #000;color: #fff;padding: 6px 10px;z-index: 999;">ব্রেকিং নিউজ</div>
                <?php $get_breaking_news = App\Models\News::where('breaking_news', 1)->where('status', '=', 'active')->select('news_title', 'news.category', 'id', 'created_at')->take(10)->orderBy('id', 'DESC')->get(); ?>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="padding: 5px 0;font-size: 19px;background: red;margin: 5px 0;">
                    @foreach($get_breaking_news as $breaking_news)
                        <i style="margin-left: 15px;color: red;" class="fa fa-angle-double-right" aria-hidden="true"></i> <a style="color:#fff;font-weight: 600;" href="{{route('newsDetails', [$breaking_news->getCategory->cat_slug_en, $breaking_news->id])}}">{{$breaking_news->news_title}}</a>
                    @endforeach
                </marquee>
            </div>
        </div>
        <!-- End Logo & advertisement -->
    </div>
 

    <div class="navbar navbar-default"> 
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a style="padding-left:1em!important;" href="{{url('/')}}">{{$siteSetting->lang4}}</a></li>
                    @foreach($menuitems as $menuitem)
                    <li class="dropdown">
                        <a class="home @if(count($menuitem->subMenus)>0) dropdownIcon @endif" href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
                        @if(count($menuitem->subMenus)>0)
                        <div class="row dropdown-menu">
                            @foreach($menuitem->subMenus as $subMenu)
                            <div class="static-menu">
                                <a href="{{url($subMenu->url)}}" class="main-menu @if($subMenu->title_hidden == 1) hidden @endif ">{{$subMenu->title}}</a>
                                    @foreach($subMenu->childMenus as $childMenu)
                                    <a target="{{ $childMenu->target }}" class="@if($childMenu->title_hidden == 1) hidden @endif" href="{{$childMenu->url}}">{{$childMenu->title}}</a>
                                    @endforeach
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
<header class="clearfix header d-none">
<div class="logo-advertisement" style="background:{{config('siteSetting.header_bg_color')}};">
    <div class="logo-center">
        <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <a class="logom" href="{{route('home')}}"><img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" height="40" alt="Logo"></a>
        <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
</div>
<!-- menu-sidebar  -->
    <!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<form action="{{route('search_result')}}" method="get" class="jumbotronc subscribe-form" style="width: 100%;margin-right: 10px;">
                        <input type="text" name="q" value="{{Request::get('q')}}" style="width: 100%; padding: 10px;" id="subscribe" placeholder="search">
                    </form>
				</div>

				<div class="modal-body">
					<div class="trending">{!! config('siteSetting.trending') !!}</div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
    <!-- Modal -->
    <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
					<h4 class="modal-title" id="myModalLabel"><img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" height="30" alt="Logo"></h4>
				</div>
				<div class="modal-body">
					<div id="menu-sidebar" class="modal-body">
        				<ul class="list-unstyled components">
                        @foreach($menuitems as $menuitem)
                            <li class="minhera">
                                <a href="{{ url($menuitem->url) }}" @if(count($menuitem->subMenus)>0) data-toggle="collapse" aria-expanded="false" class="dropdownIcon dropdown-toggle" @endif ><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> {{$menuitem->title}}</a>
                               @if(count($menuitem->subMenus)>0)
                                    <ul class="list-unstyled hera12" class="collapse list-unstyled">
                                         @foreach($menuitem->subMenus as $subMenu)
                                            <li class="minhera1241"><a href="{{ url($subMenu->url) }}">{{$subMenu->title}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        </ul>
    				</div>
				</div>
			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
    <!-- menu-sidebar  -->
</header>