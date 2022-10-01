@if((new \Jenssegers\Agent\Agent())->isDesktop())
<footer style="background: {{config('siteSetting.footer_bg_color')}} ; color:{{config('siteSetting.footer_text_color')}}">
	<div class="container">
	    <div class="footerx">
    	    <?php $menuitems = App\Models\Menuitem::with(['subMenus.childMenus'])->whereNull('parent_id')->whereHas('get_menu', function($query){ $query->where('location','footer');})->orderby('position', 'asc')->get(); ?>
    	    @foreach($menuitems as $menuitem)
    	    <div class="col-md-2 col-xs-6">
                <a class="@if($menuitem->title_hidden == 1) hidden @endif " href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
                @if(count($menuitem->subMenus)>0)
                    @foreach($menuitem->subMenus as $subMenu)
                        <a style="color:{{config('siteSetting.footer_text_color')}};display: block;margin-bottom: 0.5em;" href="{{url($subMenu->url)}}" class="ss-menu @if($subMenu->title_hidden == 1) hidden @endif ">{{$subMenu->title}}</a>
                    @endforeach
                @endif
            </div>
            @endforeach
        </div>
		<div class="footern" style="color:{{config('siteSetting.footer_text_color')}};display: block;">
			@if(config('siteSetting.site_owner'))
			<strong style="font-size: 17px;    display: block;">{!! config('siteSetting.site_owner') !!}</strong>
			@endif
			@if(config('siteSetting.site_owners'))
			<p><i class="fa fa-user"></i> {{ config('siteSetting.site_owners') }}</p>
			@endif
			@if(config('siteSetting.address'))
			<p><i class="fa fa-map-marker"></i> {!! config('siteSetting.address') !!}</p>
			@endif
			@if(config('siteSetting.phone'))
			<p><i class="fa fa-phone"></i> {{ config('siteSetting.phone') }}</p>
			@endif
			@if(config('siteSetting.email'))
			<p><i class="fa fa-envelope"></i>  {{ config('siteSetting.email') }}</p>
			@endif
		</div>
	</div>
	<div class="footer-last-line" style="background: {{config('siteSetting.copyright_bg_color')}} ; color:{{config('siteSetting.copyright_text_color')}}">
		<div class="container">
			<div class="row" style="display:flex;align-items: center;padding: 1em 0;">
				<div class="col-md-4 col-xs-12">
					<p style="color:{{config('siteSetting.copyright_text_color')}}">{!! config('siteSetting.copyright_text') !!}</p>
				</div>
				<div class="col-md-8">
					<nav class="footer-nav">
						<ul style="display: flex;justify-content: flex-end;gap: 1em;list-style: none;margin-bottom: 0;">
							<?php $pages = App\Models\Page::where('menu', 3)->where('status', 1)->get(); ?>
							@foreach($pages as $page)
							<li class="{{$page->page_name_bd}}"><a style="color:{{config('siteSetting.copyright_text_color')}}" href="{{route('page', [$page->page_slug])}}">{{$page->page_name_bd}}</a></li>
							@endforeach
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</footer>
@else
<footer style="background: {{config('siteSetting.footer_bg_color')}} ; color:{{config('siteSetting.footer_text_color')}}">
<div style="display: flex;flex-direction: column;align-items: center;padding: 1em 0;gap: 0.5em;">
    <ul class="social-icons">
         @php
          if(!Session::has('socialLists')){
              Session::put('socialLists', App\Models\Social::where('status', 1)->get());
          }
        @endphp
        @foreach(Session::get('socialLists') as $social)
        <li><a style="background:{{$social->background}}; color:{{$social->text_color}}" href="{{$social->link}}"><i class="fa {{$social->icon}}"></i></a></li>
        @endforeach
    </ul>
    @if(config('siteSetting.site_owner'))<strong style="font-size: 17px;">{!! config('siteSetting.site_owner') !!}</strong>@endif
    <p style="color:{{config('siteSetting.copyright_text_color')}}">{!! config('siteSetting.copyright_text') !!}</p>
</div>
</footer>
@endif
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
<!-- End footer -->
