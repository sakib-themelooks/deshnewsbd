@extends('frontend.layouts.master')
@section('title', Config::get('siteSetting.title'))

@section('MetaTag')
    <meta name="title" content="{{Config::get('siteSetting.title')}}">
    <meta name="description" content="{{Config::get('siteSetting.description')}}">
    <meta name="image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="keywords" content="{{Config::get('siteSetting.meta_keywords')}}" />
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{Config::get('siteSetting.title')}}">
    <meta property="og:description" content="{{Config::get('siteSetting.description')}}">
    <meta property="og:image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="og:type" content="article">
    <meta property="fb:pages" content="102823257916864" />

    <!-- Twitter -->
    <meta name="twitter:card" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:title" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:description" content="{{Config::get('siteSetting.description')}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@patrika71">
    <meta name="twitter:image:src" content="{{asset('upload/images/logo/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - -->
@endsection

@section('content')
    <?PHP

    function banglaDate($date){
        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
        $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
        $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
        return $convertedDATE;
    }
    ?>

    <div id="loadSection">
    @include('frontend.homepage.homesection')
    </div>
   <div class="ajax-load text-center" id="data-loader"><img src="{{asset('backend/assets/images/process.gif')}}" alt="Today Bangla Breaking News"></div>
@endsection

@section('js')
<script type="text/javascript">

    $(document).ready(function(){
        var page = 2;
        loadMoreProducts(page);
           
        function loadMoreProducts(pageNo){
           
            $.ajax(
                {
                    url: '?page=' + pageNo,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $("#loadSection").append(data.html);
                //check section last page
                if(page <= '{{$sections->lastPage()}}'){
                    page++;
                    loadMoreProducts(page);
                };
               
                $('.yt-content-slider').each(function () {
                    var $slider = $(this),
                        $panels = $slider.children('div'),
                        data = $slider.data();
                    // Remove unwanted br's
                    //$slider.children(':not(.yt-content-slide)').remove();
                    // Apply Owl Carousel
                    
                    $slider.owlCarousel2({
                        responsiveClass: true,
                        mouseDrag: true,
                        video:true,
                    lazyLoad: (data.lazyload == 'yes') ? true : false,
                        autoplay: (data.autoplay == 'yes') ? true : false,
                        autoHeight: (data.autoheight == 'yes') ? true : false,
                        autoplayTimeout: data.delay * 1000,
                        smartSpeed: data.speed * 1000,
                        autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
                        center: (data.center == 'yes') ? true : false,
                        loop: (data.loop == 'yes') ? true : false,
                  dots: (data.pagination == 'yes') ? true : false,
                  nav: (data.arrows == 'yes') ? true : false,
                        dotClass: "owl2-dot",
                        dotsClass: "owl2-dots",
                  margin: data.margin,
                    navText:  ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                        
                        responsive: {
                            0: {
                                items: data.items_column4 
                                },
                            480: {
                                items: data.items_column3
                                },
                            768: {
                                items: data.items_column2
                                },
                            992: { 
                                items: data.items_column1
                                },
                            1200: {
                                items: data.items_column0 
                                }
                        }
                    });
                    
                });
               
               
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            });
        }
    });
    $('#polling').on('submit',function(e){
     e.preventDefault();
     $.ajax({
            type:'get',
            url: '{{ route("userPolling") }}',
            data: $('#polling').serialize(),
            success: function (data) {
                if(data.status){
                    toastr.success(data.msg);
                    $("[name=pollOption]").removeAttr("checked");
                }else{
                    toastr.error(data.msg);
                }
            }
        })
    });
</script>
@endsection
