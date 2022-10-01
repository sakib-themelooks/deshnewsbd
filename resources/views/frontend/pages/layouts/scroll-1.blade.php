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
<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    <ul class="col-md-12 pps nav nav-tabs" id="myTab">
        <li class="active">
            <a href="#nexup1" data-toggle="tab" style="color:{{$section_item->text_color}};">{{$section_item->item_title}}</a>
        </li>
        <li>
            <a href="#nexup2" data-toggle="tab" style="color:{{$section_item->text_color}};">{{$section_item->item_sub_title}}</a>
        </li>
    </ul>

    <div class="tab-content col-md-12 pps mmb">
        <div class="tab-pane active" id="nexup1">
            @foreach($recent_news as $recent)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 mmb pps" href="{{route('newsDetails', [$recent->slug, $recent->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 imix pps videos">
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
                <div class="col-md-8 col-xs-8 grid77 pps">
                    <p>{{$recent->news_title}}</p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="tab-pane " id="nexup2">
            @foreach($popular_news as $popular)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 mmb pps" href="{{route('newsDetails', [$popular->slug, $popular->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 imix pps videos">
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
                <div class="col-md-8 col-xs-8 grid77 pps">
                    <p>{{$popular->news_title}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 pps mmb">{!! $section_item->codex !!}</div>
</div> 