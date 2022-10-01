@php
    $feature_section_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
   
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.breaking_news', 1)
    ->limit($section_item->item_number)
    ->orderBy('news.id', 'DESC')
    ->where('news.status', '=', 'active')->select('news.*', 'categories.category_bd', 'categories.slug',  'categories.category_en', 'media_galleries.source_path', 'media_galleries.title')->get();
@endphp
@if(count($feature_section_news)>0)
<section class="{{($section_item->colmd)}} col-xs-12 pps mix1" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    <?php $i = 1;?>
    @foreach($feature_section_news as $section_news)
    @if($i == 1)
        <a href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
            <div class="col-md-12 col-xs-12 feature pps videos">
                @if($section_news->news_type)
                <i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
                @endif
                @if($section_news->thumb_url)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
                @elseif($section_news->source_path)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $section_news->source_path)}}"  alt="{{$section_news->news_title}}">
                @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$section_news->news_title}}">
                @endif
            </div>
            <div class="col-md-12 col-xs-12 mix77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding: 8px;">
                <p>@if($section_news->sub_1)<span class="red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</p>
            </div>
        </a>
        @else
        <a href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}" class="col-md-{{$section_item->colxs}} col-xs-12 mmb">
            <div class="col-md-4 col-xs-4 mix5_news_img pps videos">
                @if($section_news->news_type)
                <i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
                @endif
                @if($section_news->thumb_url)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
                @elseif($section_news->source_path)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}"  alt="">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$section_news->news_title}}">
                @endif
            </div>
            <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding: 8px;">
                 @include('frontend.pages.layouts.ititle')
            </div>
        </a>
        @endif
    <?php $i++;?>
    @endforeach
</section>
@endif
