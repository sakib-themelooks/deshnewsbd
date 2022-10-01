@if($section_news->news_type)
<i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
@endif
@if($section_news->thumb_url)
    <img class="lazyload" width="100" height="100" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
@elseif($section_item->lazyload)
    @if($section_news->image)
        <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
    @else
        <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
    @endif
@elseif($section_news->image)
<img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
@else
<img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
@endif