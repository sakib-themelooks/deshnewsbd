@extends('frontend.en.layouts.master')
@section('title')
  {{ ($subcategory) ? $subcategory->subcategory_en. " | " : ''}} {{$category->category_en}} | BdType
@endsection
@section('MetaTag')
    <meta name="description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">

    <meta name="keywords" content="bdtype, bangla news, current News, bangla newspaper, bangladesh newspaper, online paper, bangladeshi newspaper, bangla news paper, bangladesh newspapers, newspaper, all bangla news paper, bd news paper, news paper, bangladesh news paper, daily, bangla newspaper, daily news paper, bangladeshi news paper, bangla paper, all bangla newspaper, bangladesh news, daily newspaper, web design, bangla paper, add post, how to use wordpress, wordpress add post, wordpress tutorials, adding wordpress post, wordpress posts, wordpress, wordpress tutorial, word press basics, wordpress basics, marketing, blogger (website), blog (industry), web design (interest), create wordpress, wordpress blog entry, wordpress blog, word press, wordpress (blogger), daily newspaper, bangladesh news, all bangla newspaper, wordpress user guide, bangladeshi news paper, daily news paper, daily, bangladesh news paper, news paper, bd news paper, all bangla news paper, newspaper, bangladesh newspapers, bangla news paper, bangladeshi newspaper, online paper, bangladesh newspaper, bangla newspaper, current news" />

    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

        <!-- Schema.org for Google -->

    <meta itemprop="description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta itemprop="image" content="{{ asset('frontend')}}/images/logo-black.png">

        <!-- Twitter -->
    <meta name="twitter:card" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, , Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="twitter:title" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, , Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="twitter:description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Bdtype">
    <meta name="twitter:image:src" content="{{ asset('frontend')}}/images/logo-black.png">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="og:image" content="{{ asset('frontend')}}/images/logo-black.png">
     <meta name="og:url" content="{{ url()->full() }}">
    <meta name="og:site_name" content="Bdtype">
    <meta name="og:locale" content="en">
    <meta name="og:type" content="website">
    <meta name="fb:admins" content="1323213265465">
    <meta name="fb:app_id" content="13212465454">
    <meta name="og:type" content="product">

@endsection

@section('content')
<?PHP
        $get_ads = App\Models\Addvertisement::where('page', 'category')->where('status', 1)->get();
        $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
        foreach ($get_ads as $ads){
            if($ads->position == 1){
                $top_head_right = $ads->add_code;
            }elseif($ads->position == 2){
                $topOfNews = $ads->add_code;
            }elseif($ads->position == 3){
                $middleOfNews = $ads->add_code;
            }elseif($ads->position == 4){
                $bottomOfNews = $ads->add_code;
            }elseif($ads->position == 5){
                $sitebarTop = $ads->add_code;
            }elseif($ads->position ==6){
                $sitebarMiddle = $ads->add_code;
            }elseif($ads->position ==7){
                $sitebarBottom = $ads->add_code;
            }else{
                echo '';
            }
        }
function banglaDate($date){
    return Carbon\Carbon::parse($date)->format('d F, Y');
    
    }
?>
    <!-- block-wrapper-section
        ================================================== -->
    <section class="ticker-news category">

        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title">{{ ($subcategory) ? $subcategory->subcategory_en : $category->category_en }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">

                        {!! $top_head_right !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="block-wrapper">
        <div class="container section-body">
            <div class="row">
                <div class="col-sm-9" id="sticky-conent">
                    @if($subcategory)
                        <ul class="category-news">
                            <li><i class="fa fa-home"></i><a href="{{ route('category', [$category->cat_slug_en]) }}"> {{$category->category_en}} </a> / <a href="{{ route('category', [$category->cat_slug_en, $subcategory->subcat_slug_en]) }}">{{$subcategory->subcategory_en}} </a></li>
                        </ul>
                    @endif
                    <div class="advertisement">
                        <div class="desktop-advert">
                           {!! $topOfNews !!}
                        </div>
                        <div class="tablet-advert">
                            {!! $topOfNews !!}
                        </div>
                        <div class="mobile-advert">
                            {!! $topOfNews !!}
                        </div>
                    </div>

                    <?php $i = 1;?>
                    @if(count($categories) > 0)
                        <div class="grid-box">
                            <div class="row">

                                    @foreach($categories as $category)
                                        @if(Request::get('page') <= 1)
                                            @if($i==1)
                                                <div class="col-md-6 col-sm-6" >
                                                    <div class="news-post standard-post2">
                                                        <div class="post-gallery">
                                                            <img src="{{ asset('upload/images/'. $category->image->source_path)}}" alt="">
                                                            @if($category->type == 3)
                                                                <a class="play-link" href="{{route('news_details', $category->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                            @elseif($category->type == 4)
                                                                <a class="play-link" href="{{route('news_details', $category->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                            @else @endif
                                                        </div>
                                                        <div class="post-title box_title">
                                                            <h2><a href="{{route('news_details', $category->news_slug)}}">{{Str::limit($category->news_title, 70)}} </a></h2>
                                                            <span>{!!Str::limit(strip_tags($category->news_dsc), 150)!!}</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-3 col-xs-6 col-sm-3">
                                                    <div class="news-post standard-post2">
                                                        <div class="post-gallery">
                                                            <img src="{{ asset('upload/images/thumb_img/'. $category->image->source_path)}}" alt="">
                                                            @if($category->type == 3)
                                                                <a class="play-link" href="{{route('news_details', $category->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                            @elseif($category->type == 4)
                                                                <a class="play-link" href="{{route('news_details', $category->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                            @else @endif
                                                        </div>
                                                        <div class="post-title">
                                                            <h2><a href="{{route('news_details', $category->news_slug)}}">{{Str::limit($category->news_title, 40)}} </a></h2>
                                                            <ul class="post-tags">

                                                                <li> @if($category->subcategoryList)
                                                                    <i class="fa fa-tags"></i>{{$category->subcategoryList->subcategory_en}}@endif
                                                                </li>

                                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($category->publish_date)}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($i==13)
                                             <div class="col-md-12 col-sm-12">
                                                <div class="advertisement">
                                                    <div class="desktop-advert">
                                                        {!! $middleOfNews !!}
                                                    </div>
                                                    <div class="tablet-advert">
                                                        {!! $middleOfNews !!}
                                                    </div>
                                                    <div class="mobile-advert">
                                                        {!! $middleOfNews !!}
                                                    </div>
                                                </div>
                                             </div>
                                            @endif
                                        @else
                                            <div class="col-md-3 col-xs-6 col-sm-3">
                                                <div class="news-post standard-post2">
                                                    <div class="post-gallery">
                                                        <img src="{{ asset('upload/images/thumb_img/'. $category->image->source_path)}}" alt="">
                                                        @if($category->type == 3)
                                                            <a class="play-link" href="{{route('news_details', $category->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                        @elseif($category->type == 4)
                                                            <a class="play-link" href="{{route('news_details', $category->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                        @else @endif
                                                    </div>
                                                    <div class="post-title">
                                                        <h2><a href="{{route('news_details', $category->news_slug)}}">{{Str::limit($category->news_title, 40)}} </a></h2>
                                                        <ul class="post-tags">
                                                            <li> @if($category->subcategoryList)
                                                                <i class="fa fa-tags"></i>{{$category->subcategoryList->subcategory_en}}@endif</li>
                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($category->publish_date)}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                     <?php $i++;?>
                                 @endforeach
                            </div>
                        </div>
                        <!-- pagination box -->
                        <div class="pagination-box">
                            {{$categories->links()}}
                        </div>
                        <!-- End Pagination box -->
                    @else
                        <h1>{{ __('lang.not_found') }}</h1>
                    @endif
                    @if($i==21)
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="advertisement">
                                    <div class="desktop-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                    <div class="tablet-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                    <div class="mobile-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endif
                </div>

                <div class="col-sm-3 div_border" id="sticky-conent">
                    <div class="sidebar large-sidebar">
                       
                         @include('frontend.en.layouts.sitebar')

                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                                <div class="tablet-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                                <div class="mobile-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End block-wrapper-section -->
@endsection
