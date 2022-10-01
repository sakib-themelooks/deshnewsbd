    @extends('frontend.layouts.master')
    @section('title'){{$get_news->news_title}} | {{Config::get('siteSetting.title')}}
    @endsection
    @section('MetaTag')
        <meta name="keywords" content="{{ $get_news->keywords }}" />
        <!-- Schema.org for Google -->
        <meta itemprop="name" content="{{$get_news->news_title}} |  {{Config::get('siteSetting.site_name')}}">
        <meta itemprop="description" content="{{Str::limit(strip_tags($get_news->news_dsc), 200)}}">
        <meta itemprop="image" content="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{url('/')}}">
        <meta name="twitter:creator" content="@neyamul">
        <meta name="twitter:title" content="{{$get_news->news_title}} |  {{Config::get('siteSetting.site_name')}}">
        <meta name="twitter:description" content="{{Str::limit($get_news->news_dsc, 200)}}">
        <meta name="twitter:image" content="@if($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@endif">
         <!-- Twitter - Product (e-commerce) -->


        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta property="og:title" content="{{$get_news->news_title}} | {{Config::get('siteSetting.site_name')}}">
        <meta property="og:description" content="{{Str::limit(strip_tags($get_news->news_dsc), 100)}}">
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
.post-content.news_dsc.hera img {
    max-width: 100% !important;
    height: auto !important;
    display: block;
}
.post-content.news_dsc.hera {
    margin-bottom: 20px;
    font-size: 1.3em;
    color: #121212;
    font-family: shurjo;
    line-height: 1.67;
}
.post-content.news_dsc.hera br {
    content: "A" !important;
    display: block !important;
    margin-bottom: 0.8em !important;
}
.single-post-box > .post-content h3,
.single-post-box > .post-content p span {
    font-size: 23px !important;
    font-family: shurjo !important;
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
.appdpp {
    margin: 15px 0!important 20px;
    display: block;
    padding: 0;
    text-align: center;
    overflow: auto;
}
.news_divider .divider_icon::after {
  
    content: "\f078";
}
.news_divider .divider_icon::before {
    content: ' ';
    position: absolute;
    top: 4px;
    bottom: 4px;
    left: 4px;
    right: 4px;
    border-radius: 100%;
    border: 1px dotted #e74d4f;
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
.single-post-box>.post-content {
    font-family: shurjo;
}
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
    font-family: shurjo;
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
    font-family: shurjo;
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
    font-family: shurjo;
    text-decoration: none;
    float: left;
}
.row.socialhera {
    display: flex;
    align-items: center;
}
.author, .news-time, .controlBar span {
    font-family: shurjo;
}
.category-titles {
    display: flex;
    align-items: center;
    margin: 10px 0;
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
.single-post-box>.post-content div,
.single-post-box>.post-content p {
    margin-bottom: 20px;
    font-size: 1.3em;
    color: #121212;
    font-family: shurjo;
    line-height: 1.67;
}
p.author {
    margin: 0;
}
.single-post-box .post-gallery {
    text-align: center;
    margin-top: 10px;
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
.post-gallery.videos i {
    position: absolute;
    top: 50%;
    left: 50%;
    height: 35px;
    width: 35px;
    background: #fff;
    transform: translate(-50%,-50%);
    text-align: center;
    line-height: 27px;
    color: red;
    border-radius: 50%;
    font-size: 20px;
    padding-left: 8px;
    border: 4px solid #fff;
    -webkit-box-shadow: 0 0 30px 2px grey;
    -moz-box-shadow: 0 0 30px 2px gray;
    box-shadow: 0 0 30px 2px grey;
    opacity: .8;
    z-index: 1;
}
.standard-post2 .post-title {
    background: #eee;p
}
.bxslider {
    margin-top: 10px;
    display: block;
}
@media only screen and (max-width: 800px) {
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
.single-post-box .post-gallery {
    margin-top: 10px;
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
.author-image {
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
.standard-post2 .post-title h2 {
    font-size: 15px;
    padding: 5px;
    margin: 0;
    height: 48px;
    overflow: hidden;
    line-height: 20px;
}
.standard-post2 .post-title h2 a{color: black;}
.appdpp img {
    width: auto;
    text-align: center;
    margin: auto;
}
</style>

    @endsection
    <?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'news-details')->inRandomOrder()->where('status', 1)->get();
 
    $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 2){
            $top_head_right = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = ($ads->adsType == 'image') ? '<a class="patrika" href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
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
            <div class="container section-body">
                <div class="category-titles">
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
                    <div class="col-sm-9 article divrigth_border" id="sticky-conent">
                        
                        <!-- block content -->
                        <div class="block-content">
                            <!-- single-post box -->
                            <div class="single-post-box">
                                <div class="title-posts"><h1>{{$get_news->news_title}}</h1></div>
                                @if($get_news->thumb_name)
                                
                                @elseif ($get_news->type == 2)
                                @else
                                <div class="d-flex align-items-center my-2 py-2">
                                    <div style="width: 38px; height: 38px; border-radius: 19px; overflow: hidden;margin-right: 10px;">
                                        @if($get_news->reporter->photo)
                                        <img class="author-image" src="{{asset('upload/images/users/'.$get_news->reporter->photo)}}"  alt="{{$get_news->reporter->name}} {{$get_news->reporter->lname}}">
                                        @else
                                        <img class="author-image" src="{{ asset('upload/images/author.jpg')}}"  alt="">
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-start flex-column ml-2">
                                        <p class="author">{{$get_news->reporter->name}}<br>{{$get_news->reporter->lname}}</p>
                                        <p class="news-time">{{banglaDate(Carbon\Carbon::parse($get_news->publish_date)->format('j F, Y'))}}, {{banglaDate(Carbon\Carbon::parse($get_news->publish_date)->diffForHumans())}}</p>
                                    </div>
                                </div>
                                @endif
                                <div class="row socialhera">
                                    <div class="col-md-6 col-xs-9">
                                        <ul class="share-box">
                                            <li><a class="facebook"  href="http://www.facebook.com/sharer.php?u={{route('newsDetails', [$get_news->getCategory->cat_slug_en, $get_news->id])}}" target="_blank"><i class="fa fa-facebook"></i> Share</a></li>
                                            <li><a class="twitter" href="https://twitter.com/share?url={{route('newsDetails', [$get_news->getCategory->cat_slug_en, $get_news->id])}}&amp;text={!! $get_news->news_title !!}&amp;hashtags=patrika71" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="whatsapp" href="https://web.whatsapp.com/send?text={{route('newsDetails', [$get_news->getCategory->cat_slug_en, $get_news->id])}}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                            <li><a target="_blank" href="https://news.google.com/publications/CAAqBwgKMOfqoQswr_W5Aw" class="rss"><img src="{{ asset('upload/images/google_news.png')}}" alt="google news" style="width: 24px; height: 24px"></a></li>
                                        </ul>
                                    </div>
                                    @if($get_news->thumb_name)
                                    @elseif ($get_news->type == 2)
                                    @else
                                    <div class="col-md-6 col-xs-3">
                                        <div class="controlBar">
                                            <button class="up">A+</button>
                                            <button class="down">A-</button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                               
                              
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
                                        @else
                                        <img title="{{$get_news->title}}" src="@if($get_news->image){{asset('upload/images/news/'.$get_news->image->source_path)}}@else{{asset('upload/images/default.jpg')}}@endif" alt="{{$get_news->news_title}}">
                                        @endif
                                     </div>   
                                    @endif
                                
                                @if($get_news->image)<span class="image-caption">{{$get_news->image->title}}</span>@endif
                                
                                <div class="post-content news_dsc hera">
                                @php 
                                $contentBlock = explode("<br>", $get_news->news_dsc); @endphp
                                @foreach($contentBlock as $index => $content)
                                    
                                    {!! $content  !!}

                                    @if($index == 1)
                                       {!! $topOfNews !!}
                                    @elseif($index == 2)
                                        {!! $middleOfNews !!}
                                    @elseif($index == 5)
                                        {!! $bottomOfNews !!}
                                    @endif
                                       
                                @endforeach
                                </div>
                                @if($get_news->keywords)
                                <div class="homesearch">
                					<?php $tag_array = explode(',', $get_news->keywords); ?>
                					@foreach($tag_array as $tag)
                						<a href="{{ url('search?q='.$tag) }}">{{$tag}}</a>
                					@endforeach
                				</div>
                				@endif
                                <!-- comment area box -->
                                
                                @if($get_news->thumb_name)
                                @elseif ($get_news->type == 2)
                                @else
                                <div class="fb-comments" data-href="{{url('/')}}/#{{$get_news->id}}" data-width="100%" data-numposts="5"></div>@endif
                                <!-- End comment area box -->
                                
                                @if(count($more_news)>0)
                                <!-- more news box -->
                                <div class="carousel-box owl-wrapper">
                                    @if($get_news->thumb_name)
                                    @elseif ($get_news->type == 2)
                                    @else
                                    <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> আরও পড়ুন<h1>
                                        <a></a>
                                    </div>
                                    
                                    <div class="row">
                                        @foreach($more_news as $news)
                                            <div class="col-md-3 col-xs-12">
                                                <div class="news-post standard-post2">
                                                    <div class="col-xs-4 col-md-12 post-gallery pps">
                                                       @if($news->image) 
                                                       <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                                       @else
                                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-8 col-md-12 post-title">
                                                        <h2><a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}">{{($news->news_title)}} </a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                   @endif 
                                </div>
                                
                                <!-- End carousel box -->
                                @endif
                                <div id="moreHolder"></div>
                                

                                
                            </div>
                            <!-- End single-post box -->
                        </div>
                       

                    </div>

                    <div class="col-sm-3" id="sticky-conent">
                        <aside>
                            <div class="sidebar large-sidebar">
                                <div class="advertisement">
                                    <div class="desktop-advert">
                                        {!! $sitebarTop !!}
                                    </div>
                                </div>
                                @if ($get_news->type == 2)
                                <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> আরও ফটো দেখুন<h1>
                                        <a></a>
                                    </div>
                                    
                                    <div class="row">
                                        @foreach($more_news as $news)
                                            <div class="col-md-6 col-xs-12">
                                                <div class="news-post standard-post2">
                                                    <div class="col-xs-4 col-md-12 post-gallery pps">
                                                       @if($news->image) 
                                                       <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                                       @else
                                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-8 col-md-12 post-title">
                                                        <h2><a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}">{{($news->news_title)}} </a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                
                                @elseif($get_news->thumb_name)
                                    <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> আরও ভিডিও<h1>
                                        <a></a>
                                    </div>
                                    <div class="row">
                                        @foreach($more_news as $news)
                                        <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-6 col-xs-12">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery videos pps">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                    @if($news->image)
                                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{($news->news_title)}}">
                                                    @else
                                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                    @endif
                                                </div>
                                                <div class="col-md-12 col-xs-12 post-title pps">
                                                    <h2>{{($news->news_title)}}</h2>
                                                </div>
                                            </div>
                                         </a>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                    @include('frontend.layouts.sitebars')
                                @endif
                              
                                

                                <div class="widget features-slide-widget">
                                    <div class="advertisement">
                                        <div class="desktop-advert">
                                            {!! $sitebarBottom !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('js')
@if($get_news->thumb_name)
@elseif ($get_news->type == 2)
@else
<script type="text/javascript">
  $(document).ready(function(){                
        $(window).bind('scroll',fetchMore);
   });
    var newsNo = 0;
    fetchMore = function (){

       if ( $(window).scrollTop() >= $(document).height()-$(window).height()-500 ){
            $newsNo = 0;
            $(window).unbind('scroll',fetchMore);
            $.get('{{route("related_news", $get_news->id)}}',{'newsNo':newsNo },
            function(data) {
               if(data.length>10){
                    newsNo++;
                    $(data).insertBefore($('#moreHolder'));
                    $(window).bind('scroll',fetchMore);
               }
            });
        }
   }
</script>
@endif
<script type="text/javascript">
$('.up').on('click', function () {
    $('.hera').animate({'font-size': '+=1'});
});

$('.down').on('click', function () {
    $('.hera').animate({'font-size': '-=1'});
});
</script>
<div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs =  d.getElementsByTagName(s)[0];
  if  (d.getElementById(id)) return;
  js =  d.createElement(s); js.id = id;
  js.src =  "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
@endsection