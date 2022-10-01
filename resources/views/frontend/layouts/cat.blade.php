 <?php
    $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
    $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
$recent_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->limit(12)
    ->orderBy('news.id', 'DESC')
    ->where('news.lang', $lang)->where('publish_date', '<=', $date)
    ->select('news.*','categories.category_bd', 'categories.cat_slug_en', 'media_galleries.source_path', 'media_galleries.title')->get();

    $popular_news_day = App\Models\SiteSetting::where('type', 'popular_news_count_day')->first()->value;

    $popular_news_date = Carbon\Carbon::parse(now())->subDays($popular_news_day)->format('Y-m-d '. '23:59:59');

$popular_news =  DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->where('news.lang', $lang)->where('publish_date', '<=', $date)->where('publish_date', '>=', $popular_news_date)
    ->orderBy('view_counts', 'DESC')
    ->select('news.*','categories.category_bd', 'categories.cat_slug_en', 'media_galleries.source_path')->take(12)->get();

?>

    <div class="widget tab-posts-widget dnone-m">

        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="#option1" data-toggle="tab">সর্বশেষ</a>
            </li>
            <li>
                <a href="#option2" data-toggle="tab">জনপ্রিয়</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="option1">
                <ul class="list-posts">
                    @foreach($recent_news as $recent)
                    <li>
                        @if($recent->source_path)
                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}"  alt="">
                        @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                        @endif
                        <div class="post-content">
                            <h2><a href="{{route('newsDetails', [$recent->cat_slug_en, $recent->id])}}">{{Str::limit($recent->news_title, 60)}}</a></h2>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-pane " id="option2">
                <ul class="list-posts">
                    @foreach($popular_news as $popular)
                        <li>
                            @if($popular->source_path)
                            <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}"  alt="">
                            @else
                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                            @endif
                            <div class="post-content">
                                <h2><a href="{{route('newsDetails', [$popular->cat_slug_en, $popular->id])}}">{{Str::limit($popular->news_title, 60)}}</a></h2>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @if(Route::currentRouteName() == 'category')
        <?php         
        $get_most_views =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
           
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5);
            if(Request::segment(3)){
                $get_most_views =$get_most_views->where('cat_slug_en', Request::segment(3));
                
            }else{
               $get_most_views =$get_most_views->where('categories.cat_slug_en',Request::segment(2));
            }
            
            $get_most_views = $get_most_views->orderBy('news.view_counts', 'DESC')->where('news.status', '=', 1)
            ->select('news.*','media_galleries.source_path', 'categories.cat_slug_en', 'media_galleries.title')->get();
        ?>
    @endif
    @if(!Request::is('/'))
        <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> আপনার এলাকার খবর</h1>
        <a></a>
        </div>
        <div class="map">
            @include('frontend.map')
        </div>
    
        @include('frontend.layouts.deshjure')
    @endif

 