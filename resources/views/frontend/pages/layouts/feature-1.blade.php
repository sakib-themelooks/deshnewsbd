@php
    $feature_section_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
   
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.breaking_news', 1)
    ->limit($section_item->item_number)
    ->orderBy('news.id', 'DESC')
    ->where('news.status', '=', 'active')->select('news.*', 'categories.category_bd', 'categories.slug', 'categories.category_en', 'media_galleries.source_path', 'media_galleries.title')->get();
@endphp
@if(count($feature_section_news)>0)
<section class="{{($section_item->colmd)}} pps mix1" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    <?php $i = 1;?>
    @foreach($feature_section_news as $section_news)
        @if($i == 1)
        <a href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}" class="col-md-8 col-xs-12 mmb">
            <div class="col-md-6 col-xs-12 feature">
                <h1 class="f-1em m-t-0">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
                <p>{!!Str::limit(strip_tags($section_news->news_dsc), 150)!!}</p>
                @if($section_item->device == '1')
                <ul class="post-tags">
                    <li class="post1"><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                    <li class="post2"><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                </ul>
                @endif
            </div>
            <div class="col-md-6 col-xs-12 img_200 pps videos">
                @if($section_news->news_type)
                <i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
                @endif
                @if($section_news->thumb_url)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}?fit=cover&width=100&height=100&format=auto" data-src="{{$section_news->thumb_url}}?fit=cover&width=100&height=100&format=auto"  alt="{{$section_news->news_title}}">
                @elseif($section_item->lazyload)
                    @if($section_news->source_path)
                        <img class="lazyload" src="{{ asset('upload/images/default.jpg?fit=cover&width=100&height=100&format=auto')}}" data-src="{{ asset('upload/images/news/'. $section_news->source_path)}}?fit=cover&width=100&height=100&format=auto"  alt="{{$section_news->news_title}}">
                    @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$section_news->news_title}}">
                    @endif
                @elseif($section_news->image)
                <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$section_news->news_title}}">
                @endif
            </div>
        </a>
        @elseif($i>1 && $i<=2)
        <a href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}" class="col-md-4 col-xs-6 mmb">
            <div class="col-md-12 col-xs-12 feature" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding:0 8px;">
                <h1 class="f-1em m-t-0">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
                <p>{!!Str::limit(strip_tags($section_news->news_dsc), 150)!!}</p>
                @if($section_item->device == '1')
                <ul class="post-tags">
                    <li class="post1"><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                    <li class="post2"><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                </ul>
                @endif
            </div>
        </a>
        @elseif($i>2 && $i<=5)
        <a href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}" class="col-md-4 col-xs-6 mmb">
            <div class="col-md-12 col-xs-12 feature" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding: 8px;">
                <h1 class="f-1em">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
                <p>{!!Str::limit(strip_tags($section_news->news_dsc), 150)!!}</p>
                @if($section_item->device == '1')
                <ul class="post-tags">
                    <li class="post1"><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                    <li class="post2"><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                </ul>
                @endif
            </div>
        </a>
        @else
        <a href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}" class="col-md-4 col-xs-6 mmb">
            <div class="col-md-8 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding: 8px;">
                <h1 class="f-1em">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
                @if($section_item->device == '1')
                <ul class="post-tags">
                    <li class="post1"><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                    <li class="post2"><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                </ul>
                @endif
            </div>
            <div class="col-md-4 pps videos">
                @if($section_news->news_type)
                <i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
                @endif
                @if($section_news->thumb_url)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}?fit=cover&width=100&height=100&format=auto" data-src="{{$section_news->thumb_url}}?fit=cover&width=90&height=90&format=auto"  alt="{{$section_news->news_title}}">
                @elseif($section_item->lazyload)
                    @if($section_news->source_path)
                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $section_news->source_path)}}"  alt="{{$section_news->news_title}}">
                    @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$section_news->news_title}}">
                    @endif
                @elseif($section_news->image)
                <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$section_news->news_title}}">
                @endif
            </div>
        </a>
        @endif
        <?php $i++;?>
    @endforeach
</section>
@endif
