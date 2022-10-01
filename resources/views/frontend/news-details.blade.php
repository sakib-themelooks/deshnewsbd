@extends('frontend.layouts.master')
@section('title')@if($get_news->meta_title){{$get_news->meta_title}} - {{Config::get('siteSetting.site_name')}}@else{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}@endif
@endsection
@section('MetaTag')
    <meta charset="UTF-8">
    <meta name="name" content="@if($get_news->meta_title){{$get_news->meta_title}} - {{Config::get('siteSetting.site_name')}}@else{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}@endif">
    <meta name="description" content="@if($get_news->meta_description){!! Str::limit(strip_tags(preg_replace("/[:,'&\/]+/",'', $get_news->meta_description)), 160) !!}@else{!! Str::limit(strip_tags(preg_replace("/[:,'&\/]+/",'', $get_news->news_dsc)), 160) !!}@endif">
    <meta name="image" content="@if($get_news->thumb_url){{$get_news->thumb_url}}@elseif($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@else{{ asset('upload/images/default.jpg')}}@endif">
    <meta name="keywords" content="{{ $get_news->keywords }}{{ $get_news->meta_tags }}" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@{{Config::get('siteSetting.site_name')}}">
    <meta name="twitter:title" content="@if($get_news->meta_title){{$get_news->meta_title}} - {{Config::get('siteSetting.site_name')}}@else{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}@endif">
    <meta name="twitter:description" content="@if($get_news->meta_description){!! Str::limit(strip_tags(preg_replace("/[:,'&\/]+/",'', $get_news->meta_description)), 160) !!}@else{!! Str::limit(strip_tags(preg_replace("/[:,'&\/]+/",'', $get_news->news_dsc)), 160) !!}@endif">
    <meta name="twitter:image" content="@if($get_news->thumb_url){{$get_news->thumb_url}}@elseif($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@else{{ asset('upload/images/default.jpg')}}@endif">
     <!-- Twitter - Product (e-commerce)  -->

    <!-- Open Graph general (Facebook, Pinterest & Google+)  -->
    <meta property="og:title" content="@if($get_news->meta_title){{$get_news->meta_title}}@else{{$get_news->news_title}}@endif">
    <meta property="og:description" content="@if($get_news->meta_description){!! Str::limit(strip_tags(preg_replace("/[:,'&\/]+/",'', $get_news->meta_description)), 160) !!}@else{!! Str::limit(strip_tags(preg_replace("/[:,'&\/]+/",'', $get_news->news_dsc)), 160) !!}@endif">
    <meta property="og:image" content="@if($get_news->thumb_url){{$get_news->thumb_url}}@elseif($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@else{{ asset('upload/images/default.jpg')}}@endif" />
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="fb:admins" content="776246399165100">
    <meta property="fb:app_id" content="2360129154263728">
    <meta property="og:site_name" content="{{config('siteSetting.site_name')}}">
    <meta property="og:locale" content="bn_BD">
    <meta property="og:video" content="@if($get_news->type == 3 && count($get_news->attachFiles)>0) {{asset('upload/file/'.$get_news->attachFiles[0]->source_path)}}@endif">
    <meta property="og:type" content="article">
    <link rel="image_src" href="@if($get_news->thumb_url){{$get_news->thumb_url}}@elseif($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@else{{ asset('upload/images/default.jpg')}}@endif">
    <link rel="preload" as="image" href="@if($get_news->thumb_url){{$get_news->thumb_url}}@elseif($get_news->image){{asset('upload/images/watermark/'.$get_news->image->source_path) }}@else{{ asset('upload/images/default.jpg')}}@endif">
@endsection
@section('css')

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
        $lang_date = 'bn';
        if($lang_date == 'en'){
            return $date;
        }
        else{
        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'PM', 'AM', 'second', 'minutes', 'ago', 'hours', 'hour',   'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'পিএম', 'এএম', 'সেকেন্ট', 'মিনিট', 'আগে', 'ঘন্টা', 'ঘন্টা', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
        $convertedDATE = str_replace($engDATE, $bangDATE, $date);
        return $convertedDATE;
        }
    }

    ?>
    @section('content')
    
    <section class="article-description">
        <div class="breadcrumbs p-tb-0 m-b-1">
            <div class="container">
                <div class="flex col-md-12 col-xs-12">
                    <a  href="{{url('/')}}">{{$siteSetting->lang4}}</a>&#160; /  &#160;
                    @if($get_news->subcategory)
                        <a href="{{ route('category', [$get_news->categoryList->slug, $get_news->subcategoryList->subslug])}}"> 
                        {{$get_news->subcategoryList->subcategory_bd}}</a> 
                    @else
                        <a href="{{ route('category',$get_news->categoryList->slug)}}"> 
                        {{$get_news->categoryList->category_bd }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="block">{!! config('siteSetting.code13') !!}</div>
        <div class="container">
            <div class="col-md-9 col-xs-12">
                <div class="block">{!! config('siteSetting.code14') !!}</div>
                @if($get_news->sub_1)<h5>{{$get_news->sub_1}}</h5>@endif
                <h1 class="details-title">{{$get_news->news_title}}</h1>
                @if($get_news->sub_2)<h6>{{$get_news->sub_2}}</h6>@endif
                
                
                @if($get_news->thumb_name)
                @else
                <div class="flex" style="justify-content: space-between;flex-wrap: wrap;">
                    <div class="flex align-c m-t-1">
                        <div class="author m-r-1 m-none">
                            @if($get_news->reporter->photo)
                            <img class="border-radius-50" src="{{asset('upload/images/users/'.$get_news->reporter->photo)}}"  alt="{{$get_news->reporter->name}} {{$get_news->reporter->lname}}">
                            @else
                            <img class="border-radius-50" src="{{ asset('upload/images/author.jpg')}}"  alt="">
                            @endif
                        </div>
                        <div class="author-name">
                            @if($get_news->userx)
                            <p class="author m-0">{{$get_news->userx}}</p>
                            @else
                            <p class="author m-0">{{$get_news->reporter->name}} {{$get_news->reporter->lname}}</p>
                            @endif
                            <p class="news-time m-0">প্রকাশিত: {{banglaDate(Carbon\Carbon::parse($get_news->publish_date)->format('d F, Y,  h:i A'))}}</p>
                        </div>
                    </div>
                    <div class="share-box flex align-c">
                            <a target="_blank" href="http://www.facebook.com/sharer.php?u={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}"><i class="fa fa-facebook"></i></a>
                            <a target="_blank" href="https://twitter.com/share?url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;text={!! $get_news->news_title !!}"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="https://api.whatsapp.com/send?text={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;title={!! $get_news->news_title !!}"><i class="fa fa-whatsapp"></i></a>
                            <a target="_blank" href="{{route('newsPrint', $get_news->id)}}"><i class="fa fa-print"></i></a>
                            <a target="_blank" href="#" class="m-none rss"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
                            @if($get_news->thumb_name)
                            @else
                            <button class="up">ফ+</button>
                            <button class="down">ফ-</button>
                            @endif
                        </div>
                </div>
                @endif
                
                <div class="block">{!! config('siteSetting.code15') !!}</div>
                @if($get_news->type == 2)              
                    <div class="row category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="yes" data-delay="30" data-speed="1" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                        @foreach($get_news->attachFiles as $attachFile)
                        <img class="items" src="{{asset('upload/file/'.$attachFile->source_path)}}" alt="Bangla Today News"></li>
                        @endforeach
                    </div>
                @elseif($get_news->type == 3)
                    @foreach($get_news->attachFiles as $attachFile)
                    <video width="100%"  controls>
                        <source src="{{asset('upload/file/'.$attachFile->source_path)}}" type="video/mp4">
                    </video>
                    @endforeach
                @else
                <div class="post-gallery videos">
                    @if($get_news->thumb_name)
                    <div class="videoWrapper"><iframe class="video" src="https://www.youtube.com/embed/{{$get_news->thumb_name}}?feature=oembed&controls=3&enablejsapi=1&rel=0&modestbranding=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                    @elseif($get_news->thumb_url)
                        <img src="{{$get_news->thumb_url}}"  alt="{{$get_news->title}}">
                    @elseif(Config::get('siteSetting.lazyload'))
                        @if($get_news->image)
                        <img title="{{$get_news->title}}" class=" lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{asset('upload/images/news/'.$get_news->image->source_path)}}" alt="{{$get_news->news_title}}">
                        @else
                        <img src="{{ asset('upload/images/default.jpg')}}" alt="{{$get_news->title}}">
                        @endif
                    @elseif($get_news->image)
                    <img class="" title="{{$get_news->title}}" src="{{asset('upload/images/news/'.$get_news->image->source_path)}}" alt="{{$get_news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$get_news->title}}">
                    @endif
                 </div>
                 
                 <div class="story-element-caption-attribution-wrapper"><figcaption class="story-element-image-title">{{$get_news->thumb_image_caption}}</figcaption><figcaption class="story-element-image-attribution">{{$get_news->captured_by}}</figcaption>
                 </div>
                 
                 
                 
                @endif
                
                @if($get_news->image)<span class="image-caption">{{$get_news->image->title}}</span>@endif
                <div class="block">{!! config('siteSetting.code16') !!}</div>
                
                
                <div class="description">
                    @php 
                    $ads = $get_ads->toArray();
                    $adNo = 0; $contentBlock = explode("</p>", $get_news->news_dsc); 
                    @endphp
                    
                    
                    @foreach($contentBlock as $index => $content)
                        {!! $content  !!}
                        
                        @if($index == 0)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 1)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 2)
                            <div class="col-md-12 col-xs-12 p-tb-1 m-b-1 border-bottom z-index-5">
                                <h3 class="box_text_color-1 p-l-1 related-news">
                                    @if($get_news->subcategory){{$get_news->subcategoryList->subcategory_bd}}
                                    @else{{$get_news->categoryList->category_bd }}
                                    @endif
                                    {{$siteSetting->lang5}}
                                </h3>
                                @foreach($more_news->take(4) as $news)
                                    <div class="col-md-6 col-xs-12 p-0">
                                        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                                            <div class="col-xs-4 col-md-3 img_80 videos p-5">
                                                @if($news->news_type)
                                                <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                                @endif
                                                @if($news->thumb_url)
                                                    <img src="{{$news->thumb_url}}"  alt="{{$news->title}}">
                                                @elseif(Config::get('siteSetting.lazyload'))
                                                    @if($news->image)
                                                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                                    @else
                                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                    @endif
                                                @elseif($news->image)
                                                <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                                @else
                                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                @endif
                                            </div>
                                            
                                            <div class="col-xs-8 col-md-9 h80">
                                                <h1 class="box_text_color-1">{{$news->news_title}}</h1>
                                            </div>
                                            
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {!! config('siteSetting.post'.$index) !!} 
                        @elseif($index == 3)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 4)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 5)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 6)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 7)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 8)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 9)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 10)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 11)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 12)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 13)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 14)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 15)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 16)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 17)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 18)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 19)
                            {!! config('siteSetting.post'.$index) !!}
                        @elseif($index == 20)
                            {!! config('siteSetting.post'.$index) !!}
                            
                        @else
                             {!! config('siteSetting.post'.$index) !!}
                        @endif
                    @endforeach
                </div>
                
                
                <div class="block">{!! config('siteSetting.code17') !!}</div>
                <div class="col-md-12 col-xs-12 pps flex align-c share-box share-box-bottom">
                   <a class="m-none"  href="http://www.facebook.com/sharer.php?u={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}" target="_blank"><i class="fa fa-facebook"></i></a>
                   <a class="m-none" href="https://twitter.com/share?url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;text={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-twitter"></i></a>
                   <a class="m-none" href="https://api.whatsapp.com/send?text={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                   <a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                   <a href="https://pinterest.com/pin/create/button/?url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}" target="_blank"><i class="fa fa-pinterest"></i></a>
                   <a href="https://mail.google.com/mail/u/0/?to&su={{$get_news->news_title}}&body={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&bcc&cc&fs=1&tf=cm" target="_blank"><i class="fa fa-envelope"></i></a>
                   <a target="_blank" href="{{route('newsPrint', $get_news->id)}}"><i class="fa fa-print"></i></a>
                   <button class="clipboard flex"><i class="fa fa-clone"></i> <span class="m-none"> &#160; {{$siteSetting->lang7}}</span></button>
                </div>
                
                <!-- comment area box -->
                @if($get_news->keywords)
                <div class="col-md-12 col-xs-12 pps homesearch">
					<?php $tag_array = explode(',', $get_news->keywords); ?>
					@foreach($tag_array as $tag)
						<a href="{{ url('search?q='.$tag) }}">{{$tag}}</a>
					@endforeach
				</div>
				@endif
                
                <div class="block">{!! config('siteSetting.code18') !!}</div>
                @if($get_news->thumb_name)
                @elseif ($get_news->type == 2)
                @else
                <div class="fb-comments" data-href="{{url('/')}}/#{{$get_news->id}}" data-width="100%" data-numposts="5"></div>@endif
                <!-- End comment area box -->
                <div class="block">{!! config('siteSetting.code19') !!}</div>
                
                @if(count($more_news)>0)
                <!-- more news box -->
                <!-- Changed -->
                <div class="col-md-12 col-xs-12 pps" style="display:none">
                    @if($get_news->thumb_name)
                    @elseif ($get_news->type == 2)
                    @else
                    <h1 class="box_text_color-1 p-l-10 mp-0">
                        @if($get_news->subcategory){{$get_news->subcategoryList->subcategory_bd}}
                        @else{{$get_news->categoryList->category_bd }}
                        @endif
                        {{$siteSetting->lang5}}
                    </h1>
                    <div class="col-md-12 col-xs-12 pps mix1">
                        @foreach($more_news as $news)
                            <div class="col-md-3 col-xs-12 mmb mp-0">
                                <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                                    <div class="col-xs-4 col-md-12 img_130 videos pps">
                                        @if($news->news_type)
                                        <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                        @endif
                                        @if($news->thumb_url)
                                            <img src="{{$news->thumb_url}}"  alt="{{$news->title}}">
                                        @elseif(Config::get('siteSetting.lazyload'))
                                            @if($news->image)
                                            <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                            @else
                                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                            @endif
                                        @elseif($news->image)
                                        <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                        @else
                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                        @endif
                                    </div>
                                    <div class="col-xs-8 col-md-12 pps mp-l-1">
                                        <h1 class="box_text_color-1">{{$news->news_title}}</h1>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                   @endif 
                </div>
                <div class="block">{!! config('siteSetting.code20') !!}</div>
                <!-- End carousel box -->
                @endif
                
               <div id="moreHolder"></div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="sidebar large-sidebar last-update">
                    <div class="block">{!! config('siteSetting.code21') !!}</div>
                    @if ($get_news->type == 2)
                    <h1 class="box_text_color-1">
                        @if($get_news->subcategory){{$get_news->subcategoryList->subcategory_bd}}
                        @else{{$get_news->categoryList->category_bd }}
                        @endif
                        {{$siteSetting->lang5}}
                    </h1>
                    <div class="col-md-12 col-xs-12 pps">
                        @foreach($more_news as $news)
                        <div class="col-md-6 col-xs-12 mmb">
                            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                                <div class="col-xs-12 col-md-12 img_130 pps videos pps">
                                    @if($news->news_type)
                                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                    @endif
                                    @if($news->thumb_url)
                                        <img src="{{$news->thumb_url}}"  alt="{{$news->title}}">
                                    @elseif(Config::get('siteSetting.lazyload'))
                                        @if($news->image)
                                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                        @else
                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                                        @endif
                                    @elseif($news->image) 
                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                    @else
                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                                    @endif
                                </div>
                                <div class="col-xs-8 col-md-12 pps" style="background:#fff">
                                    <h1 class="box_text_color-1">{{$news->news_title}}</h1>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    
                    @elseif($get_news->thumb_name)
                    <h1 class="box_text_color-1">
                        {{$siteSetting->lang6}}
                        @if($get_news->subcategory){{$get_news->subcategoryList->subcategory_bd}}
                        @else{{$get_news->categoryList->category_bd }}
                        @endif
                    </h1> 
                    <div class="row">
                        @foreach($more_news as $news)
                        <div class="col-md-12 col-xs-12 pps">
                            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                                <div class="col-md-12 col-xs-12 videos pps">
                                    @if($news->news_type)
                                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                    @endif
                                    @if($news->thumb_url)
                                        <img src="{{$news->thumb_url}}"  alt="{{$news->title}}">
                                    @elseif(Config::get('siteSetting.lazyload'))
                                        @if($news->image)
                                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                        @else
                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                        @endif
                                    @elseif($news->image)
                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                    @else
                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                                    @endif
                                </div>
                                <div class="col-md-12 col-xs-12 pps">
                                    <h1 class="box_text_color-1">{{$news->news_title}}</h1>
                                </div>
                             </a>
                         </div>
                        @endforeach
                    </div>
                    
                </div>
                @else
                    @include('frontend.layouts.news')
                @endif
                <div class="block">{!! config('siteSetting.code22') !!}</div>
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
    $('.description p').animate({'font-size': '+=1'});
});

$('.down').on('click', function () {
    $('.description p').animate({'font-size': '-=1'});
});
var $temp = $("<input>");
var $url = $(location).attr('href');

$('.clipboard').on('click', function() {
  $("body").append($temp);
  $temp.val($url).select();
  document.execCommand("copy");
  $temp.remove();
  //$("p").text("URL copied!");
})
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