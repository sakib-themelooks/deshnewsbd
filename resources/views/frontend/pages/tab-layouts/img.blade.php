@if($news->news_type)
<i class="fa {{$news->news_type}}" aria-hidden="true"></i>
@endif
@if($news->thumb_url)
    <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{$news->thumb_url}}"  alt="{{$news->news_title}}">
@elseif($section_item->lazyload)
    @if($news->image)
        <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
    @else
        <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$news->news_title}}">
    @endif
@elseif($news->image)
<img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
@else
<img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$news->news_title}}">
@endif