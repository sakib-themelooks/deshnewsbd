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
<section class="{{($section_item->colmd)}} col-xs-12 pps mix1 alo1" style="margin-top:30px">
    <div class="col-md-12 col-xs-12 pps">
    @foreach($feature_section_news as $section_news)
        <div class="col-md-{{$section_item->colxs}} col-xs-12">
            <a class="{{$section_item->bg_text}}" href="{{route('newsDetails', [$section_news->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @if($section_news->news_type)
                    <i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if($section_news->thumb_url)
                        <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
                    @elseif($section_item->lazyload)
                        @if($section_news->source_path)
                            <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/news/'. $section_news->source_path)}}"  alt="{{$section_news->news_title}}">
                        @else
                            <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
                        @endif
                    @elseif($section_news->image)
                    <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
                    @endif
                </div>
                <div class="col-md-12 col-xs-12">
                    <h1 class="{{$section_item->bt_text}} m-t-0">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
                </div>
            </a>
        </div>
    @endforeach
    </div>
</section>
@endif
