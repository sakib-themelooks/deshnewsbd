
<style>
.features-today {
    padding-bottom: 8px;
    padding-top: 8px;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    scroll-snap-type: mandatory;
    -webkit-scroll-snap-type: mandatory;
    width: 100%;
    flex-wrap: nowrap;
    display: flex;
    overflow-x: auto;
    overflow-y: hidden;
    align-content: center;
    align-items: center;
    flex-direction: row;
}
.features-today a {
    scroll-snap-stop: always;
    scroll-snap-align: center;
    flex-shrink: 0;
    -webkit-tap-highlight-color: transparent;
    display: inline-block;
    margin-right: 5px;
    width: 20%;
    box-shadow: 0 3px 4px 0 rgb(143 143 143);
}
.news-post.image-post2.ss {
    margin: 0;
}
.news-post.image-post2.ss .post-gallery img {
    height: 320px;
    object-fit: cover;
}
.news-post.image-post2 {
    margin-right: 10px;
}
.owl-theme .owl-controls {
    top: -20px;
}
.image-post2 .hover-box h2 {
    color: #fff;
    font-family: shurjo;
    font-size: 20px;
    line-height: 28px;
    max-height: 62px;
}
.image-post2 .hover-box .inner-hover {padding: 0 5px;
}
.image-post2 .hover-box h2 {
    color: #fff;}
.inner-hover {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding-top: 20px;
    background: linear-gradient(360deg,#000,#00000000);
}
.inner-hover h2 {
    color: #fff;
    font-size: 15px;
    font-family: shurjo;
    height: 47px;
    line-height: initial;
    margin-bottom: 10px;
    font-weight: normal;
    overflow: hidden;
    text-decoration: none;
    padding: 5px;
    text-align: center;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}
@media only screen and (max-width: 600px) {
.features-today a {
    width: 40%;
    margin-right: 5px;
    padding: 0;
}
.news-post.image-post2.ss .post-gallery img {
    height: 225px;
}
}
</style>

<div class="col-md-12">
   @if($section_item->item_title)
    <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section_item->item_title}}</h1>
    <a class="dnone-m" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
   </div>
   @endif
    <?php $i = 1;?>
    <div class="features-today">
        @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)
        <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}">
            <div class="news-post image-post2 ss">
                <div class="post-gallery">
                    @if($section_news->image)
                    <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                    @else
                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                    @endif
                    <div class="hover-boxs">
                        @if($section_news->type == 3)
                            <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                        @elseif($section_news->type == 4)
                            <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                        @else @endif
                        <div class="inner-hover">
                            <h2>{{($section_news->news_title)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
         </a>
        @endforeach
    </div>
    <a class="dnone-d more-news btn" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}}</a>
</div>
    
