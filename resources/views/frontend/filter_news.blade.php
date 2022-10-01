@if(count($categories) > 0)
@foreach($categories as $news)
<div class="col-md-3 col-xs-6 pps">
    <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="news-post standard-post22">
        <div class="post-gallery videos">
            @if($news->thumb_name)
            <i class="fa fa-play" aria-hidden="true"></i>
            @endif
            @if($news->image)
            <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="">
            @else
            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
            @endif
        </div>
        <div class="post-title">
            <h2>{{($news->news_title)}}</h2>
        </div>
    </a>
</div>
@endforeach
@endif