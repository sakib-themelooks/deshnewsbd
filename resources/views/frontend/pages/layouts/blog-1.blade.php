<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 mixsection_news_img" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-3 col-xs-12 blog1_news_imgs pps videos">
                    @if($section_news->news_type)
                    <i class="fa {{$section_news->news_type}}" aria-hidden="true"></i>
                    @endif
                    @if($section_news->thumb_url)
                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
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
                <div class="col-md-9 col-xs-12 gridlist1section_news_title">
                    <h3>@if($section_news->sub_1)<span class="red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h3>
                    <p>{!! Str::limit(strip_tags($section_news->news_dsc), 440) !!}</p>
                    @if($section_item->device == '1')
                    <ul class="post-tags">
                        <li class="post1"><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                        <li class="post2"><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                    </ul>
                    @endif
                </div>
            </a>
            <?php $i++; ?>
        @endforeach
    </div>
</div>