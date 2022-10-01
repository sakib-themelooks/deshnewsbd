<?php $i = 1;?>
@foreach($categories as $news)
    @if($i == 1)
        <div class="col-md-3 col-xs-12 pps">
            <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @if($news->news_type)
                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if(Config::get('siteSetting.lazyload'))
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @elseif($news->image)
                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                </div>
                <div class="col-md-12 col-xs-12 mix77 pps">
                    <p>{{($news->news_title)}}</p>
                </div>
            </a>
            @endif
            @if($i>1 && $i<=2)
            <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @if($news->news_type)
                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if(Config::get('siteSetting.lazyload'))
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @elseif($news->image)
                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                </div>
                <div class="col-md-12 col-xs-12 mix77 pps">
                    <p>{{($news->news_title)}}</p>
                </div>
            </a>
        </div>
        @endif
        @if($i>2 && $i<=3)
        <div class="col-md-6 col-xs-12 pps">
            <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-12 pps">
                <div class="col-md-12 col-xs-12 ih410 pps videos">
                    @if($news->news_type)
                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if(Config::get('siteSetting.lazyload'))
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @elseif($news->image)
                    <img src="{{ asset('upload/images/news/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                </div>
                <div class="col-md-12 col-xs-12 mix77 pps">
                    <p>{{($news->news_title)}}</p>
                </div>
            </a>
        </div>
        @endif
        @if($i>3 && $i<=4)
        <div class="col-md-3 pps">
            <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @if($news->news_type)
                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if(Config::get('siteSetting.lazyload'))
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @elseif($news->image)
                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                </div>
                <div class="col-md-12 col-xs-12 mix77 pps">
                    <p>{{($news->news_title)}}</p>
                </div>
            </a>
            @endif
            @if($i>4 && $i<=5)
            <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @if($news->news_type)
                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if(Config::get('siteSetting.lazyload'))
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @elseif($news->image)
                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                </div>
                <div class="col-md-12 col-xs-12 mix77 pps">
                    <p>{{($news->news_title)}}</p>
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
@endforeach