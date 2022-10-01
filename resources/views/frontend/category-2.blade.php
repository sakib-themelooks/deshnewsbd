<?php $i = 1;?>
@foreach($categories->take(6) as $news)
    @if($i == 1)
        <a class="col-md-8 col-xs-12" href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" >
            <div class="col-md-12 col-xs-12 mix2_news_img pps videos">
                @if($news->thumb_name)
                <i class="fa fa-play" aria-hidden="true"></i>
                @endif
                @if(Config::get('siteSetting.lazyload'))
                    @if($news->image)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                @elseif($news->image)
                <img src="{{ asset('upload/images/news/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                @endif
            </div>
            <div class="col-md-12 col-xs-12 grid1section_news_title">
                <p>{{($news->news_title)}}</p>
            </div>
        </a>
        @else
        <a class="col-md-4 col-xs-6 mix2section_news_img mmb" href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}">
            <div class="col-md-12 col-xs-12 mix6_news_img pps videos">
                @if($news->thumb_name)
                <i class="fa fa-play" aria-hidden="true"></i>
                @endif
                @if(Config::get('siteSetting.lazyload'))
                    @if($news->image)
                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                    @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                    @endif
                @elseif($news->image)
                <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$news->news_title}}">
                @endif
            </div>
            <div class="col-md-12 col-xs-12 grid1section_news_title pps">
                <p>{{$news->news_title}}</p>
            </div>
        </a>
        @endif
    <?php $i++; ?>
@endforeach
      