@foreach($get_news as $i => $news)
    @if($i == 0)
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-6 col-xs-12" style="background: #fff;display: inline-block;color: black;">
            <div class="col-md-12 col-xs-12 mix777">
                <p>{{$news->news_title}}</p>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="col-md-4 col-xs-12 grid2_news_imgs videos">
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
                </div>
                
                <p>{!! Str::limit(strip_tags($news->news_dsc), 440) !!}</p>
            </div>
        </a>
    @else
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-6 col-xs-12 newsdot" style="display: flex;align-items: center;padding: 5px 0 10px;border-bottom: 1px solid #ddd;margin-bottom: 5px;background: #fff;color: black;">
            <i class="fa fa-circle" aria-hidden="true"></i> <p>{{$news->news_title}}</p>
            
        </a>
    @endif
@endforeach