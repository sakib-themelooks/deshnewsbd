 <?php
    $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
    $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
$recent_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
   
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->limit(10)
    ->orderBy('news.publish_date', 'DESC')
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
    ->select('news.*','categories.category_bd', 'categories.cat_slug_en', 'media_galleries.source_path')->take(10)->get();

?>
<style>
.sidebar.large-sidebar .tab-posts-widget .tab-pane ul.list-posts li {
    background: #eee;
}
.news-post.standard-post24 h2, ul.list-posts>li .post-content h2 {
    color: #333;
    font-family: shurjo;
    line-height: 25px;
    margin: 0;
    font-size: 20px;
    max-height: 50px;
    overflow: hidden;
    margin-bottom: 0;
    padding-left: 10px;
}
ul.list-posts>li .post-content h2 a {
    font-family: shurjo;
}
</style>
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
                        @if(Config::get('siteSetting.lazyload'))
                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}"  alt="{{$recent->news_title}}">
                        @elseif($recent->source_path)
                        <img src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}"  alt="{{($recent->news_title)}}">
                        @else
                        <img src="{{ asset('upload/images/default.jpg')}}" alt="{{($recent->news_title)}}">
                        @endif
                        <div class="post-content">
                            <h2><a href="{{route('newsDetails', [$recent->cat_slug_en, $recent->id])}}">{{($recent->news_title)}}</a></h2>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-pane " id="option2">
                <ul class="list-posts">
                    @foreach($popular_news as $popular)
                        <li>
                            @if(Config::get('siteSetting.lazyload'))
                            <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}"  alt="{{$popular->news_title}}">
                            @elseif($popular->source_path)
                            <img src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}"  alt="{{$popular->news_title}}">
                            @else
                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$popular->news_title}}">
                            @endif
                            <div class="post-content">
                                <h2><a href="{{route('newsDetails', [$popular->cat_slug_en, $popular->id])}}">{{$popular->news_title}}</a></h2>
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
            ->limit(10);
            if(Request::segment(3)){
                $get_most_views =$get_most_views->where('cat_slug_en', Request::segment(3));
                
            }else{
               $get_most_views =$get_most_views->where('categories.cat_slug_en',Request::segment(2));
            }
            
            $get_most_views = $get_most_views->orderBy('news.view_counts', 'DESC')->where('news.status', '=', 1)
            ->select('news.*','media_galleries.source_path', 'categories.cat_slug_en', 'media_galleries.title')->get();
        ?>
        <div class="widget features-slide-widget dnone-m">
            <div class="title-section">
                <h1><span>এই বিভাগের সর্বোচ্চ পঠিত</span></h1>
            </div>
            <ul class="list-posts">
                @foreach($get_most_views as $most_views)
                    <li>
                        <img src="{{ asset('upload/images/thumb_img/'. $most_views->source_path)}}" alt="">
                         @if($most_views->type == 3)
                                <a class="play-link" href="{{route('newsDetails', [$most_views->cat_slug_en, $most_views->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                @elseif($most_views->type == 4)
                                    <a class="play-link" href="{{route('newsDetails', [$most_views->cat_slug_en, $most_views->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                @else @endif
                        <div class="post-content">
                            <h2><a href="{{route('newsDetails', [$most_views->cat_slug_en, $most_views->id])}}">{{Str::limit($most_views->news_title, 60)}}</a></h2>
                            <ul class="post-tags">
                                 <li><i class="fa fa-eye"></i>{{$most_views->view_counts}}</li>
                                <li><i class="fa fa-clock-o"></i>{{banglaDate($most_views->publish_date)}}</li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
 