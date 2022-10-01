@if((new \Jenssegers\Agent\Agent())->isDesktop())
<footer style="background: {{config('siteSetting.footer_bg_color')}} ; color:{{config('siteSetting.footer_text_color')}}">
	<div class="container">
		<div class="footer-widgets-part">
			<div class="row" style="padding: 2em 0;display: flex;align-items: center;">
				<div class="col-md-3 flink">
					
					<a href="https://raiseexim.com/contact">Contact</a>
					<a href="https://raiseexim.com/worldwide ">Worldwide</a>
				</div>
				<div class="col-md-3 flink">
					<a href="https://raiseexim.com/contact">Privacy Notices</a>
					<a href="https://raiseexim.com/worldwide ">Fraud Notice</a>
				</div>
				
				<div class="col-md-3 dnone-m flink">
					<a href="https://raiseexim.com/contact">Website Terms of Use</a>
					<a href="https://raiseexim.com/worldwide">Purchase Order Terms</a>
				</div>
				<div class="col-md-3 dnone-m">
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
				</div>
				
			</div>
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
    <p style="color:{{config('siteSetting.copyright_text_color')}}">{!! config('siteSetting.copyright_text') !!}</p>
</div>
</footer>
@endif
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
<!-- End footer -->
