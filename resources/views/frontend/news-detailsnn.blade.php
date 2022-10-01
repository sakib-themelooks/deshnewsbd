@extends('frontend.layouts.master')
@section('title')@if($get_news->meta_title){{$get_news->meta_title}} - {{Config::get('siteSetting.site_name')}}@else{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}@endif
@endsection
@section('MetaTag')
    <meta charset="UTF-8">
    <meta name="name" content="@if($get_news->meta_title){{$get_news->meta_title}} - {{Config::get('siteSetting.site_name')}}@else{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}@endif">
    <meta name="description" content="@if($get_news->meta_description){!! $get_news->meta_description !!}@endif ">
    <meta name="image" content="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif">
    <meta name="keywords" content="{{ $get_news->keywords }}{{ $get_news->meta_tags }}" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@{{Config::get('siteSetting.site_name')}}">
    <meta name="twitter:title" content="@if($get_news->meta_title){{$get_news->meta_title}} - {{Config::get('siteSetting.site_name')}}@else{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}@endif">
    <meta name="twitter:description" content="@if($get_news->meta_description){!! $get_news->meta_description !!}@endif ">
    <meta name="twitter:image" content="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif">
     <!-- Twitter - Product (e-commerce)  -->

    <!-- Open Graph general (Facebook, Pinterest & Google+)  -->
    <meta property="og:title" content="@if($get_news->meta_title){{$get_news->meta_title}}@else{{$get_news->news_title}}@endif">
    <meta property="og:description" content="@if($get_news->meta_description){!! $get_news->meta_description !!}@endif ">
    <meta property="og:image" content="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif" />
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="fb:admins" content="776246399165100">
    <meta property="fb:app_id" content="2360129154263728">
    <meta property="og:site_name" content="{{config('siteSetting.site_name')}}">
    <meta property="og:locale" content="bn_BD">
    <meta property="og:video" content="@if($get_news->type == 3 && count($get_news->attachFiles)>0) {{asset('upload/file/'.$get_news->attachFiles[0]->source_path)}}@endif">
    <meta property="og:type" content="article">
    <link rel="image_src" href="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif">
    <link rel="preload" as="image" href="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif">
    <media:thumbnail url="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif"/>

@endsection
@section('css')
<style type="text/css">
.nexup img {
    margin: auto;
}


figcaption {
    background-color: #e9f5f5;
    font-size: 16px!important;
    line-height: 1.7!important;
    color: #666!important;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 3px 0 0 0;
    margin-bottom: 0;
}
.titles-section h1 {
    display: flex;
    flex-direction: row;
    align-items: center;
    font-size: 20px;
    margin: 5px 0;
    padding: 0;
}
.titles-section h1 img {
    padding-right: 7px;
}
.post-content.news_dsc.hera {
    padding: 3em;
    max-width: 900px;
}
.post-content.news_dsc.hera img {
    max-width: 100% !important;
    height: auto !important;
    display: block;
}
.post-content.news_dsc.hera div,
.post-content.news_dsc.hera {
    margin-bottom: 20px;
    font-size: 1.3em;
    color: #121212;
    line-height: 1.67;
}
.btn-share {
    background: #072a3d;
    border: 0;
    padding: 5px 10px;
    color: white;
    border-radius: 5px;
}
.post-content.news_dsc.hera br {
    content: "A" !important;
    display: block !important;
    margin-bottom: 0.8em !important;
}
.single-post-box > .post-content h3,
.single-post-box > .post-content p span {
    font-size: 23px !important;
    font-weight: bold;
}
.news_divider .divider_icon {
    width: 50px;
    height: 50px;
    position: absolute;
    bottom: 100%;
    margin-bottom: -25px;
    left: 50%;
    margin-left: -25px;
    border-radius: 100%;
    box-shadow: 0 2px 4px #e74d4f;
    background: #fff;
    text-align: center;
    line-height: 50px;
    color: #e74d4f;
}
.pps {padding: 0;margin: 0;}
.appdpp a {
    margin: 15px auto!important;
    display: flex;
    padding: 0;
    text-align: center;
    overflow: auto;
    justify-content: center;
}
.news_divider .divider_icon::after {
  
    content: "\f078";
}
.news_divider .divider_icon::before {
    content: '\f107';
    font-family: 'FontAwesome';
    position: absolute;
    top: 4px;
    bottom: 4px;
    left: 4px;
    right: 4px;
    border-radius: 100%;
    border: 1px dotted #e74d4f;
    font-size: 30px;
}
.news_divider {
    margin: 50px auto 40px;
    max-width: 450px;
    position: relative;
}
.news_divider .divider_line {
    overflow: hidden;
    height: 20px;
}
.news_divider .divider_line::after {
    content: '';
    display: block;
    margin: -25px auto 0;
    width: 100%;
    height: 25px;
    border-radius: 125px/12px;
    box-shadow: 0 0 8px #e74d4f;
}
.single-post-box>.post-content b,
.d-flex.align-items-center.my-2.py-2 {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    margin: 10px 0;
}
.news-time {
    margin: 0;
}
.single-post-box .title-posts h1 {
    font-size: 34px;
    margin: 0 0 10px;
    line-height: 43px;
    font-weight: normal;
}
.controlBar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin: 0;
}
.controlBar button {
    background: #eee;
    border: none;
    padding: 5px 10px;
    margin-left: 11px;
    font-size: 20px;
    font-weight: bold;
    border-radius: 5px;
}
.trending-tag {
    display: none !important;
}
.share-box {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    list-style: none;
    margin: 0;
    padding: 0;
}
.share-box li a {
    background: #eee;
    padding: 5px 10px;
    border-radius: 5px;
    margin-right: 10px;
    font-size: 20px;
}
.share-box li a {
    color: black;
}
.share-box .facebook {
    background: #1877f2;
    color: white !important;
    text-decoration: none;
    font-size: 14px;
}
.homesearch {
    overflow: auto;
}
.homesearch a {
    background: #e1e1e1;
    padding: 5px 10px;
    color: black;
    margin: 0 10px 10px 0;
    border-radius: 5px;
    display: block;
    text-decoration: none;
    float: left;
}
.row.socialhera {
    display: flex;
    align-items: center;
}
.category-titles {
    display: flex;
    align-items: center;
    margin: 0 auto;
}
.category-titles a {
    color: black;
    padding: 0 5px;
    font-family: shurjo;
}
.block-content {
    padding: 0 !important;
}
.image-caption {
    background-color: #e9f5f5;
    font-size: 16px!important;
    line-height: 1.7!important;
    color: #666!important;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 3px 0 0 0;
    margin-bottom: 10px;
}
.single-post-box .post-gallery img {
    width: 100%;
    margin-bottom: 0;
    padding: 0 !important;
}

p.author {
    margin: 0;
}
.single-post-box .post-gallery {
    text-align: center;
}
.videoWrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 ratio */
    padding-top: 0;
    height: 0;
}
.videoWrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.standard-post2 .post-title {
    background: #eee;p
}
.bxslider {
    margin-top: 10px;
    display: block;
}
.carousel-box.owl-wrapper,
.fb-comments,
.post-content.news_dsc.hera,
.herabox,
.category-titles {
    background: white;
}
.mix77 p {
    color: black;
}
.titleposts {
    position: absolute;
    top: 13em;
    left: 1em;
    text-align: left;
    background: #00000085;
    display: block;
    padding: 0.4em;
    color: white;
}
@media only screen and (max-width: 800px) {
.single-post-box .title-posts h1 {
    font-size: 18px;
    line-height: 28px;
}
.post-content.news_dsc.hera {
    padding: 3em 1em;
    max-width: 900px;
}  
    
.standard-post2 .post-title {
    padding: 0!important;
}
.col-xs-4.col-md-12.post-gallery.pps {
    margin-top: 0;
}
.standard-post2 .post-title h2 {
    padding-left: 10px;
}
.standard-post2 .post-title h2 {
    font-size: 20px;
    height: 62px;
    font-weight: 500;
    line-height: 30px;
}
.news-post.standard-post2 {
    display: flex;
    align-items: center;
}
.standard-post2 .post-title {
    background: #eeeeee;
}
.col-xs-4.col-md-12.post-gallery {
    padding-left: 0 !important;
}
.col-md-3.col-xs-12 {
    padding: 0 !important;
}
}
img.author-image {
    width: 100%;
}
.bxsliders {
    padding-bottom: 8px;
    padding-top: 8px;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    scroll-snap-type: mandatory;
    -webkit-scroll-snap-type: mandatory;
    width: 100%;
    flex-wrap: nowrap;
    display: flex;
    overflow-x: scroll;
    overflow-y: hidden;
    align-content: center;
    align-items: center;
    flex-direction: row;
}
.bxsliders img {
    scroll-snap-stop: always;
    scroll-snap-align: center;
    flex-shrink: 0;
    -webkit-tap-highlight-color: transparent;
    display: inline-block;
    margin-right: 11px;
    max-width: 100%;
}
.patrika {
    max-width: 100%;
    display: block;
}


</style>
@endsection
    <?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'news-details')->inRandomOrder()->where('status', 1)->get();
 
    $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 2){
            $top_head_right = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = ($ads->adsType == 'image') ? '<a class="nexup" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }else{
            echo '';
        }
    }

    function banglaDate($date){
        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'minutes', 'ago', 'hours', 'hour',   'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'মিনিট', 'আগে', 'ঘন্টা', 'ঘন্টা', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
        $convertedDATE = str_replace($engDATE, $bangDATE, $date);
        return $convertedDATE;
    }

    ?>

    @section('content')
    <section class="block-wrapper">
        <div class="container category-titles">
            <a  href="{{url('/')}}">Home</a> /  
            @if($get_news->subcategory)
                <a href="{{ route('category', [$get_news->categoryList->cat_slug_en, $get_news->subcategoryList->subcat_slug_en])}}"> 
                {{$get_news->subcategoryList->subcategory_bd}}</a>
            @else
                <a href="{{ route('category',$get_news->categoryList->cat_slug_en)}}"> 
                {{$get_news->categoryList->category_bd }}</a>
            @endif
        </div>
        <div class="row">
            <div class="single-post-box">
                @if($get_news->type == 2)
                    <div class="dnone-m">
                        <div class="bxslider">
                            @foreach($get_news->attachFiles as $attachFile)
                            <img src="{{asset('upload/file/'.$attachFile->source_path)}}" alt="Bangla Today News"></li>
                            @endforeach
                        </div>
                    </div>
                    <div class="dnone-d">
                        <div class="bxsliders">
                            @foreach($get_news->attachFiles as $attachFile)
                            <img src="{{asset('upload/file/'.$attachFile->source_path)}}" alt="Bangla Today News"></li>
                            @endforeach
                        </div>
                    </div>
                    
                @elseif($get_news->type == 3)
                    @foreach($get_news->attachFiles as $attachFile)
                    <video width="100%"  controls>
                        <source src="{{asset('upload/file/'.$attachFile->source_path)}}" type="video/mp4">
                    </video>
                    @endforeach
                @else
                <div class="post-gallery">
                    @if($get_news->thumb_name)
                    <div class="videoWrapper"><iframe class="video" src="https://www.youtube.com/embed/{{$get_news->thumb_name}}?feature=oembed&controls=3&enablejsapi=1&rel=0&modestbranding=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                    @elseif(Config::get('siteSetting.lazyload'))
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $get_news->image->source_path)}}"  alt="{{$get_news->news_title}}">
                    @elseif($get_news->image)
                    <img title="{{$get_news->title}}" src="{{asset('upload/images/news/'.$get_news->image->source_path)}}" alt="{{$get_news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$get_news->title}}">
                    @endif
                    <h1 class="titleposts">{{$get_news->news_title}}</h1>
                 </div>   
                @endif
            </div>
            <div class="col-md-12">
                <div class="container post-content news_dsc hera">
                    @php 
                    $contentBlock = explode("</p>", $get_news->news_dsc); @endphp
                    @foreach($contentBlock as $index => $content)
                        
                        {!! $content  !!}

                        @if($index == 4)
                           {!! $topOfNews !!}
                        @elseif($index == 5)
                            {!! $middleOfNews !!}
                        @elseif($index == 6)
                            {!! $bottomOfNews !!}
                        @endif
                           
                    @endforeach
                </div>
                @if(count($more_news)>0)
                <!-- more news box -->
                <div class="container carousel-box owl-wrapper">
                    @foreach($more_news as $news)
                    <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-4 col-xs-12 mmb">
                        <div class="col-xs-4 col-md-12 grid9xx_news_img videos pps">
                        @if($news->thumb_name)
                        <i class="fa fa-play" aria-hidden="true"></i>
                        @endif
                        @if(Config::get('siteSetting.lazyload'))
                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                        @elseif($news->image)
                        <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                        @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                        @endif
                        </div>
                        <div class="col-xs-8 col-md-12 mix77">
                            <h2>{{$news->news_title}}</h2>
                            <p>{!!Str::limit(strip_tags($news->news_dsc), 400)!!}</p>
                            <button>See More</button>
                        </div>
                    </a>
                    @endforeach 
                </div>
                @endif
            </div>
        </div>
    </section>
    @endsection

@section('js')
@endsection