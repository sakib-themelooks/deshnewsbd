<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" href="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}" type="image/x-icon">
    <title>@yield('title')</title>
	@yield('MetaTag')
	<!--rss -->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="{{ route('feed') }}" />
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "url": "{{url('/')}}",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "{{route('search_result')}}?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
    </script>

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic' rel='stylesheet' type='text/css'>
	<link href="{{ asset('frontend/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/jquery.bxslider.css') }}" media="screen">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/magnific-popup.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.carousel.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.theme.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/ticker-style.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/leftsidebar-mobile.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/node_modules/typeahead.js-master/dist/typehead-min.css') }}" media="screen">
	<link href="{{asset('frontend/css/search/main.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('frontend')}}/css/toastr.css">
	@yield('css')
	<style type="text/css">
		.map img{ width: 100%; height: 100%; object-fit: contain; }	
	</style>
  {!! config('siteSetting.google_adsense') !!}
  {!! config('siteSetting.header') !!}
</head>
<body>
@php $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd'); @endphp
	<!-- Container -->
	<div id="container">
		@includeFirst(['frontend.layouts.header'.config('siteSetting.header_no'), "frontend.layouts.header1"])
		@yield('content')
		@includeFirst(['frontend.layouts.footer'.config('siteSetting.footer_no'), "frontend.layouts.footer1"])		
	</div>
	<!-- End Container -->
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.migrate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.bxslider.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.ticker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.imagesloaded.min.js') }}"></script>
  	<script type="text/javascript" src="{{ asset('frontend/js/jquery.isotope.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/plugins-scroll.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
	<script src="{{ asset('frontend/js/toastr.js') }}"></script>
    
    {!! config('siteSetting.google_analytics') !!}
  	{!! Toastr::message() !!}
	<script type="text/javascript">
		@if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

	</script>

	<script>
	 function search_bar(src_key){

		if(src_key != ''){
			$.ajax({
				method:'get',
				url:'{{ route("search_news") }}',
				data:{q:src_key},
				datatype: "text",
				success:function(data){
					if(data){
						document.getElementById('search_bar').style.display = 'block';
						document.getElementById('show_suggest_key').innerHTML = data;
					}else{
						document.getElementById('show_suggest_key').innerHTML = '<p>News not found.</p>';
					}
				}
			});
		}else{
			document.getElementById('search_bar').style.display = 'none';
		}
	}


    $(document).on('click', function (e) {
        if ($(e.target).closest("#search_bar").length === 0) {
            $("#search_bar").hide();
        }
    });
     $('#searchKey').on('click', function(){
        $("#search_bar").show();
    });
	</script>
	<script>
		//Get the button
		var mybutton = document.getElementById("myBtn");
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};
		function scrollFunction() {
		  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		    mybutton.style.display = "block";
		  } else {
		    mybutton.style.display = "none";
		  }
		}
		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
		  document.body.scrollTop = 0;
		  document.documentElement.scrollTop = 0;
		}
	</script>

	<!-- leftsidebar-mobile -->
	<script type="text/javascript">
	    $(document).ready(function () {
	        $('#mobile-menu').on('click', function () {
	            $('#menu-sidebar').toggleClass('active');
	        });
	    });
	</script>
	@yield('js')

	@if(Auth::check()) 
	<script>
	  	function readNotify(id){
			
			var url = "{{route('readNotify', ':id')}}";
			url = url.replace(":id", id);
			$.ajax({
	            url:url,
	            method:"get",
		    });
		}
	</script>
	@endif
</body>
</html>
