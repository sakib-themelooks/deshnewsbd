@extends('frontend.layouts.master')
@section('title')  {{$title}} | {{Config::get('siteSetting.site_name')}}
@endsection
@php
    
    $meta_title = $category->meta_title; $meta_keywords = $category->keywords; $meta_tags = $category->meta_tags; $meta_desciption = $category->meta_desciption;
    
    @endphp
@section('MetaTag')
    <meta name="title" content="{{ $meta_title }}">
    <meta name="description" content="{{$meta_desciption}}">
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_desciption}}">
    <meta property="og:image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="og:type" content="article">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{$meta_title}}">
    <meta itemprop="description" content="{{$meta_desciption}}">
    <meta itemprop="image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{$meta_title}}">
    <meta name="twitter:title" content="{{$meta_title}}">
    <meta name="twitter:description" content="{{$meta_desciption}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/logo/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - -->
@endsection

@section('content')
<?PHP
        $get_ads = App\Models\Addvertisement::where('page', 'category')->where('status', 1)->get();
        $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
        foreach ($get_ads as $ads){
            if($ads->position == 2){
                $top_head_right = $ads->add_code;
            }elseif($ads->position == 3){
                $topOfNews = $ads->add_code;
            }elseif($ads->position == 4){
                $middleOfNews = $ads->add_code;
            }elseif($ads->position == 5){
                $bottomOfNews = $ads->add_code;
            }elseif($ads->position == 6){
                $sitebarTop = $ads->add_code;
            }elseif($ads->position == 7){
                $sitebarMiddle = $ads->add_code;
            }elseif($ads->position == 8){
                $sitebarBottom = $ads->add_code;
            }else{
                echo '';
            }
        }
?>
<?PHP
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

     $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace( $engDATE, $bangDATE,  $formatBng);
    return $convertedDATE;
    }
?>
    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-md-12">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title">
                                @if($category) <span style="font-size:35px;padding:0;color:#0066ff;padding:15px 15px 0 0"> {{$category->category_bd}} </span > @endif 
                                @if($category->slug != request('category')) <span style="font-size:20px;color:#0066ff;"> {{App\Models\Category::where('cat_slug_en', request('category'))->orWhere('slug', request('category'))->first()->category_bd }} </span> @endif
                            </span>
                        </div>
                        <ul class="desh flex p-0">
                            @foreach($category->subcategory as $index => $subcategory)
                            <li style="margin-right:25px; @if($index==0)    list-style: none;@endif"><a style="@if($subcategory && $subcategory->category_bd == $subcategory->subslug) color:#0066ff; @else color:#000; @endif" href="{{ route('category', [$subcategory->slug]) }}"> {{$subcategory->category_bd}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="inline-block">
                        {!! config('siteSetting.code5') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(config('siteSetting.code6')!='')
    <div class="inline-block 456">{!! config('siteSetting.code6') !!}</div>
    @endif
    <div class="container">
    @foreach($sections as $section)
        @php $page = preg_replace("/\d/", "",$section->section_type).$section->box; @endphp
        @if(View::exists('frontend.pages.'.$page))
        @include('frontend.pages.'.$page)
        @endif  
    @endforeach
    </div>
    @if(config('siteSetting.code7')!='')
    <div class="inline-block 789">{!! config('siteSetting.code7') !!}</div>
    @endif
    <section class="block-wrappers">
        <div class="container section-bodys">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                  
                    <div class="inline-block">{!! config('siteSetting.code8') !!}</div>
                    
                    <?php $i = 1;?>
                    @if(count($categories) > 0)
                    <div class="grid-box mix1">
                        @foreach($categories as $news)
                        <div class="col-md-6 col-xs-12 mmb">
                            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="news-post standard-post22">
                                <div class="col-md-4 col-xs-4 pps img_100 videos">
                                    @if($news->news_type)
                                        <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                    @endif
                                    @if($news->thumb_url)
                                        <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{$news->thumb_url}}"  alt="{{$news->news_title}}">
                                    @elseif(Config::get('siteSetting.lazyload'))
                                        @if($news->image)
                                        <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                        @else
                                        <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="">
                                        @endif
                                    @elseif($news->image)
                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                    @else
                                    <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{$news->news_title}}">
                                    @endif
                                </div>
                                <div class="col-md-8 col-xs-8 mix77">
                                    <h1 class="box_text_color-1">{{$news->news_title}}</h1>
                                    <span><i class="fa fa-clock-o"></i>&nbsp; {{banglaDate($news->publish_date)}}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="ajax-load  text-center" id="data-loader"><img  alt="loader image" src="{{asset('frontend/images/bx_loader.gif')}}"></div>
                @else
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h1 style="text-align: center;">{{$siteSetting->lang3}}</h1>
                    </div>
                </div>
                @endif
                
                <div class="inline-block">{!! config('siteSetting.code9') !!}</div>
            </div>
                <div class="col-md-3 col-xs-12 last-update">
                    @if(config('siteSetting.code10')!='')
                        <div class="inline-block">{!! config('siteSetting.code10') !!}</div>
                    @endif
                    <!-- sidebar -->
                     @include('frontend.layouts.news')

                    <div class="inline-block">{!! config('siteSetting.code11') !!}</div>
                </div>
                <div class="inline-block">{!! config('siteSetting.code12') !!}</div>
            </div>
        </div>
    </section>
    <!-- End block-wrapper-section -->
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){                
        $(window).bind('scroll',fetchMore);
   });
    var page = 2;
    fetchMore = function (){

       if ( $(window).scrollTop() >= $(document).height()-$(window).height()-500 ){
          
            $(window).unbind('scroll',fetchMore);
            var category = "{!! str_replace(' ', '', Request::route('category')) !!}" ;
            var subcategory = "{!! (Request::route('subcategory')) ? '/'. str_replace(' ', '', Request::route('subcategory')) : '' !!}";
            var childcategory = "{!! (Request::route('childCategory')) ? '/'. str_replace(' ', '', Request::route('childCategory')) : '' !!}";
            var subchildCategory = "{!! (Request::route('subchildCategory')) ? '/'. str_replace(' ', '', Request::route('subchildCategory')) : '' !!}";
            var  link = '<?php echo URL::to("category");?>/'+category+subcategory+childcategory+subchildCategory;
            
            $.get(link,{'page':page,filter:'filter',perPage:12 },
            function(data) {
               if(data){
                    page++;
                    $('#loadNews').append(data);
                    $(window).bind('scroll',fetchMore);
               }
               
            });
            document.getElementById('data-loader').style.display ='none';
        
        }
   }
</script>
@endsection