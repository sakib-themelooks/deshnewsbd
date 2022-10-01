@foreach($get_news as $i => $news)
     <div class="col-md-12 col-xs-12">
            <a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="news-post standard-post2">
                <div class="mix5_news_img pps videos">
                    @if($news->image)
                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                    @endif
                    @if($news->type == 3)
                        <a class="play-link" class="play-link" href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                    @elseif($news->type == 4)
                        <a class="play-link" href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                    @else @endif
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title" style="color:#fff;">
                    <p>{{$news->news_title}}</p>
                </div>
            </a>
        </div>
@endforeach