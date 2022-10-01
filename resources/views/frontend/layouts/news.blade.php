@if((new \Jenssegers\Agent\Agent())->isDesktop())
    <?php
        $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
    $recent_news = DB::table('news')
        ->join('categories', 'news.category', '=', 'categories.id')
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->where('news.status', 'active')
        ->limit(5)
        ->orderBy('news.id', 'DESC')
        ->where('news.lang', $lang)->where('publish_date', '<=', $date)
        ->select('news.*','categories.category_bd', 'categories.slug', 'media_galleries.source_path', 'media_galleries.title')->get();
    
        $popular_news_day = App\Models\SiteSetting::where('type', 'popular_news_count_day')->first()->value;
    
        $popular_news_date = Carbon\Carbon::parse(now())->subDays($popular_news_day)->format('Y-m-d '. '23:59:59');
    
    $popular_news =  DB::table('news')
        ->join('categories', 'news.category', '=', 'categories.id')
        
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->where('news.status', 'active')
        ->where('news.lang', $lang)->where('publish_date', '<=', $date)->where('publish_date', '>=', $popular_news_date)
        ->orderBy('view_counts', 'DESC')
        ->select('news.*','categories.category_bd', 'categories.slug', 'media_galleries.source_path')->take(5)->get();
    
    ?>
    <h1 class="box_text_color-1 last-update-header">{{$siteSetting->lang1}}</h1>
    @foreach($recent_news as $recent)
    <div class="col-md-12 col-xs-12 pps border-bottom m-b-1 mb-7">
        <a href="{{route('newsDetails', [$recent->slug, $recent->id])}}">
            <div class="col-md-8 col-xs-8 pps">
                <h1 class="box_text_color-1">{{$recent->news_title}}</h1>
            </div>
            <div class="col-md-4 col-xs-4 img_80 pps videos">
                @if($recent->news_type)
                <i class="fa {{$recent->news_type}}" aria-hidden="true"></i>
                @endif
                @if($recent->thumb_url)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{$recent->thumb_url}}"  alt="{{$recent->news_title}}">
                @elseif(Config::get('siteSetting.lazyload'))
                    @if($recent->source_path)
                        <img src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}"  alt="{{($recent->news_title)}}">
                    @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$recent->news_title}}">
                    @endif
                @elseif($recent->source_path)
                <img src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}"  alt="{{($recent->news_title)}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}" alt="{{($recent->news_title)}}">
                @endif
            </div>
        </a>
    </div>
    @endforeach
    <h1 class="box_text_color-1">{{$siteSetting->lang2}}</h1>
    @foreach($popular_news as $popular)
    <div class="col-md-12 col-xs-12 pps border-bottom m-b-1 mb-7">
        <a href="{{route('newsDetails', [$popular->slug, $popular->id])}}">
            <div class="col-md-8 col-xs-8 pps">
                <h1 class="box_text_color-1">{{ $popular->news_title }}</h1>
            </div>
            <div class="col-md-4 col-xs-4 img_80 pps videos">
                @if($popular->news_type)
                <i class="fa {{$popular->news_type}}" aria-hidden="true"></i>
                @endif
                @if($popular->thumb_url)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{$popular->thumb_url}}"  alt="{{$popular->news_title}}">
                @elseif(Config::get('siteSetting.lazyload'))
                    @if($popular->source_path)
                <img src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}"  alt="{{$popular->news_title}}">
                @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$popular->news_title}}">
                    @endif
                @elseif($popular->source_path)
                <img src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}"  alt="{{$popular->news_title}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$popular->news_title}}">
                @endif
            </div>
        </a>
    </div>
    @endforeach
@endif