{!! config('siteSetting.code1') !!}
<style>
a {color: black;}
ol ol, ol ul, ul ol, ul ul {
    margin: 0;
    padding: 0;
}
.navbar_nav li,
.navbar_nav {
    list-style: none;
}
.dropdown-hover-content {
    display: none;
    position: absolute;
    margin-top: 62px;
    background: #0685ea;
    border-top: 3px solid #73a22e;
    border-bottom: 3px solid #73a22e;
    left: 0;
    right: 0;
    padding: 30px;
    z-index: 9999999999 !important;
}
a.main-menu,
.subMenu a {
    color: white;
    font-size: 20px;
}
.static-menu {
    margin-right: 10px;
    border-right: 1px solid #fff;
}
.main-menu {
    font-weight: bold;
    padding: 5px 0;
    border-bottom: 1px solid #eee;
    display: block;
    margin-bottom: 3px;
}
.dropdown-hover:hover .dropdown-hover-content {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.navbar_nav .menuitem {
    float: left;
    padding: 15px 50px 15px 0;
    font-size: 20px;
    color: white;
}
ul.navbar_nav {
    display: flex;
    justify-content: center;
    margin: 0;
}
.navbars {
    background: #3b4047;
}
.subMenu {
    padding: 5px 0!important;
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
.navbar-collapse {
    padding-right:0!important;
    padding-left:0!important;
    float: left;
}
.headermin {
    display: flex;
    align-items: center;
    padding: 20px 0;
}
.btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
    outline: thin dotted;
    outline: 0;
    outline-offset: 0;
}
.modal-backdrop.in {filter: alpha(opacity=0);opacity: 0;z-index: 0;}
/*google translate Dropdown */
#google_translate_element select{background:#124b65;color:#fff;border: none;border-radius:0;padding:6px 8px}
/*google translate link | logo */
.goog-logo-link{display:none!important;}
.goog-te-gadget{color:transparent!important;max-width: 144px;}
/* google translate banner-frame */
.goog-te-combo:focus-visible {outline: none;}
.goog-te-banner-frame{display:none !important;}
#goog-gt-tt, .goog-te-balloon-frame{display: none !important;}
.goog-text-highlight { background: none !important; box-shadow: none !important;}
ul.worldwide {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-end;
    gap: 2em;
    font-size: 20px;
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
</style>

<?php 

$menuitems = App\Models\Menuitem::with(['subMenus.childMenus'])->whereNull('parent_id')->whereHas('get_menu', function($query){ $query->where('location','main_header');})->orderby('position', 'asc')->get(); 

?>
<!-- Header -->
@if((new \Jenssegers\Agent\Agent())->isDesktop())
<header class="clearfix header">
    <div style="background:{{config('siteSetting.header_bg_color')}};">
        <!-- Bootstrap navbar -->
        <div class="container">
            <div class="row headermin">
                <!-- Logo & advertisement -->
                <div class="col-md-4 col-xs-12 logo-advertisement">
                    <div class="logo-center">
                        <a class="logomin" href="{{route('home')}}">
                            <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" height="50" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <ul class="worldwide">
                        <li><a href="https://raiseexim.com/worldwide" target="_self">Worldwide</a></li>
                        <li><a href="https://raiseexim.com/cat/stories" target="_self">Stories</a></li>
                        <li><a href="https://raiseexim.com/contact" target="_self">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Logo & advertisement -->
    </div>
    
    
    <div class="navbars" style="background: {{ config('siteSetting.header_bg_nav') }};border-bottom: 3px solid #73a22e;">
      <div class="container m-none">
        <ul class="navbar_nav" data-transition="slide" data-animationtime="500">
        @if(count($menuitems)>0)
            @foreach($menuitems as $menuitem)
            <li class="nav-item dropdown-hover">
                  <a href="{{ $menuitem->url }}" target="{{ $menuitem->target }}" class="menuitem nav-link dropdown-hover-button">{{$menuitem->title}}</a>
                    @if(count($menuitem->subMenus)>0)
                    <div class="container dropdown-hover-content">
                        @foreach($menuitem->subMenus as $subMenu)
                        <div class="col-md-{{($subMenu->menu_width) ? $subMenu->menu_width : 3}} static-menu">
                          <div class="menu">
                            <ul>
                              <li><a href="{{$subMenu->url}}" class="main-menu @if($subMenu->title_hidden == 1) hidden @endif " target="{{ $subMenu->target }}">{{$subMenu->title}}</a>
                                
                                <!-- //end banner area -->

                                @if(count($subMenu->childMenus)>0)
                                <ul class="row">
                                  @foreach($subMenu->childMenus as $childMenu)
                                  <li class="col-md-{{($childMenu->menu_width) ? $childMenu->menu_width : 12}} subMenu">
                                        <a target="{{ $childMenu->target }}" class="@if($childMenu->title_hidden == 1) hidden @endif" href="{{$childMenu->url}}">{{$childMenu->title}}</a>
                                        
                                    </li>
                                  @endforeach
                                </ul>

                                @endif
                              </li>
                            </ul>
                          </div>
                        </div>
                        @endforeach
                    </div>
                  @endif
            </li>
            @endforeach
        @endif
        </ul>
      </div>
    </div>
</header>
@else
<header class="clearfix header">
<div class="col-md-12 col-xs-12 logo-advertisement" style="background:{{config('siteSetting.header_bg_color')}};">
    <div class="logo-center">
        <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <a class="logomin" href="{{route('home')}}"><img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" height="40" alt="Logo"></a>
        <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
</div>
<!-- menu-sidebar  -->

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
                                <a href="{{ url($menuitem->url) }}" @if(count($menuitem->subMenus)>0) data-toggle="collapse" aria-expanded="false" class="dropdownIcon dropdown-toggle" @endif >{{$menuitem->title}}</a>
                                @if(count($menuitem->subMenus)>0)
                                    <ul class="list-unstyled hera12" class="collapse list-unstyled">
                                        @foreach($menuitem->subMenus as $subMenu)
                                            <li class="minhera1241"><a href="{{ url($subMenu->url) }}">{{$subMenu->title}}</a>
                                                <ul>
                                                @foreach($subMenu->childMenus as $childMenu)
                                                <li class="col-md-12 subMenu">
                                                    <a target="{{ $childMenu->target }}" href="{{$childMenu->url}}">{{$childMenu->title}}</a>
                                                </li>
                                                @endforeach
                                                </ul>
                                            </li>
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
@endif