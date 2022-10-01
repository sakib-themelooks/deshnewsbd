@php
$footer_menus = DB::table('menuitems')->where('menu_id','=',6)->select([
'title',
'url'
])->get();
@endphp
<footer style="background: #1fb78d;
    color: rgb(248, 248, 248);
    display: inline-block;
    border-top: 2px solid #1fb78d;
    margin: 45px auto 0;
    width: 100%;
    padding-top: 1em;
    margin-bottom: 1em;
    font-family: auto;">
    
	<div class="container">
	    
	    
	    <div class="footer-top">
	        <div>
    	        <a class="logomin" href="{{route('home')}}">
                        <img height="50px" src="{{ asset('upload/images/logo/'.config('siteSetting.footer_logo'))}}" alt="Logo" id="footer_logo">
                </a>
                <p>{!! config('siteSetting.site_owner')!!}</p>
            </div>
	        <div class="site-info">
	            <h3>যোগাযোগ</h3>
	            <p class="m-0" style="font-size: 17px;line-height: 26px;font-family: auto;">{!!
                    config('siteSetting.address') !!}</p>
                <p>Developed by : <a href="#" style="display: inline-block;">DeshNewsbd.com</a></p>
	        </div>
	        <div class="social-icon">
	            <h3>সোশ্যাল মিডিয়ায় আমরা</h3>
	            <ul>
	                <li>
	                    <a href="#"><img src="{{ asset('frontend/images/fb.png')}}"></img></a>
	                </li>
	                <li>
	                    <a href="#"><img src="{{ asset('frontend/images/twitter.png')}}"></img></a>
	                </li>
	                <li>
	                    <a href="#"><img src="{{ asset('frontend/images/instagram.png')}}"></img></a>
	                </li>
	                <li>
	                    <a href="#"><img src="{{ asset('frontend/images/youtube.png')}}"></img></a>
	                </li>
	            </ul>
	        </div>
        </div>
        
	</div>
	<div class="footer-nav">
            <ul style="flex-wrap: wrap; display: flex; justify-content: center;">
              @for($i=0;$i<sizeof($footer_menus);$i++)
              <li>
                <a target="_blank" aria-label="{{$footer_menus[$i]->title}}" href="{{$footer_menus[$i]->url}}">{{$footer_menus[$i]->title}}</a> 
                </li>    
              @endfor
            </ul>
        </div>
        <div class="footer-bottom" >
            <p style="font-size: 16px;">{!! config('siteSetting.copyright_text') !!}</p>
        </div>
</footer>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
