<?php
        $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
    $recent_news = DB::table('news')
        ->join('categories', 'news.category', '=', 'categories.id')
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->where('news.status', 'active')
        ->limit($section_item->item_number)
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
        ->select('news.*','categories.category_bd', 'categories.slug', 'media_galleries.source_path')->take($section_item->item_number)->get();
    
    ?>
<div class="{{$section_item->colmd}} col-xs-12">
    <div class="warpper flex flex-direction align-c mt--30">
        <input class="radio" id="one" name="group" type="radio" checked>
        <input class="radio" id="two" name="group" type="radio">
        <div class="tabs flex">
        <label class="tab" id="one-tab" for="one">{{$section_item->item_title}}</label>
        <label class="tab" id="two-tab" for="two">{{$section_item->item_sub_title}}</label>
        </div>
        <div class="panels">
        <div class="panel" id="one-panel">
            @foreach($recent_news as $recent)
                <div class="col-md-{{$section_item->colxs}} col-xs-12 p-l-0 p-r-0 p-b-1 m-b-1  border-bottom">
                    <a href="{{route('newsDetails', [$recent->slug, $recent->id])}}">
                        <div class="col-md-4 col-xs-4 img_90 pps videos">
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
                        <div class="col-md-8 col-xs-8 h90">
                            <h1 class="box_text_color-1">{{$recent->news_title}}</h1>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="panel" id="two-panel">
            @foreach($popular_news as $popular)
                <div class="col-md-{{$section_item->colxs}} col-xs-12 p-l-0 p-r-0 p-b-1 m-b-1 border-bottom">
                    <a href="{{route('newsDetails', [$popular->slug, $popular->id])}}">
                        <div class="col-md-4 col-xs-4 img_90 p-0 videos">
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
                        <div class="col-md-8 col-xs-8 h90">
                            <h1 class="box_text_color-1">{{$popular->news_title}}</h1>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
      </div>
    </div>
    <div class="bg-primary text-center py-2">
    <a href="{{url('/archive')}}">আর্কাইভ</a>
    </div>
    <div class="col-md-12 pps mmb">{!! $section_item->codex !!}</div>
</div> 