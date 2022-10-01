
<style>
.ppss {
    margin-bottom: 0 !important;
}
</style>

<div class="col-md-3 col-xs-12">

    @if($section_item->item_title)
   <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section_item->item_title}}</h1>
   <a class="dnone-m" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
   </div>
   @endif
    <div class="row">
       
        @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)

            @if($index == 0)
                <div class="col-md-12 pps">
                    <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="news-post standard-post2 ppss">
                        <div class="col-md-12 col-xs-12 pps post-gallery">
                            @if($section_news->image)
                            <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                            @else
                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                            @endif
                            @if($section_news->type == 3)
                                <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                            @elseif($section_news->type == 4)
                                <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                            @else @endif
                        </div>

                        <div class="col-md-12 col-xs-12 pps post-title">
                            <h2>{{($section_news->news_title)}}</h2>
                        </div>
                    </a>
                </div>
            @else
                <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="col-md-12 col-xs-12 news-post standard-post24 pps">
                    <div class="col-md-5 col-xs-4 pps news-post pps">
		                @if($section_news->image)
                        <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="">
                        @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                        @endif
                    </div>
		            <div class="col-md-7 col-xs-8 post-title">
		                <h2>{{($section_news->news_title)}}</h2>
		            </div>
                </a>
            @endif
          
        @endforeach
    </div>
    <a class="dnone-d more-news btn" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}}</a>
</div>
