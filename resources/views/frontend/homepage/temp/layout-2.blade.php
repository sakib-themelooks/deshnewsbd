
<?php  
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);

if($section->section_type == 'category'){
    $section_items->with('newsByCategory', function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,cat_slug_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en');
}   

$section_items = $section_items->orderBy('position', 'asc')->take(1)->get();

?>
<style>
.news-post.standard-post244 div {
    background: #eeeeee;
    display: flex;
    align-items: center;
    margin-top: 0;
    flex-direction: column;
}
.news-post.standard-post244 h2 {
    color: #333;
    font-size: 19px;
    font-family: shurjo;
    height: 46px;
    line-height: initial;
    margin: 0 0 5px;
    font-weight: normal;
    overflow: hidden;
    text-decoration: none;
}
.standard-post2 .post-title {
    padding: 5px!important;
}
.news-post.standard-post2 {
    margin-bottom: 5px;
    overflow: auto;
    display: block;
}
.image-post2 .hover-box .inner-hover {
    background: rgb(7 42 61 / 33%);
}
@media only screen and (max-width: 600px) {
.sidebar .tab-posts-widget ul.nav-tabs {
    margin-top: 10px;
}
.news-post.standard-post244 {
    background: #eeeeee;
    display: flex;
    align-items: center;
    margin: 0 0 5px 0;
    flex-direction: row;
}
.c13212 i {
    margin-right: 5px;
}
</style>
@if(count($section_items)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        
        <div class="row">
            @foreach($section_items as $section_item)
            <div class="col-md-6 pps">
                @if($section_item->item_title)
                   <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section_item->item_title}}</h1>
                   <a class="dnone-m c13212" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                   @endif
                <?php $i = 1; ?>
                <div class="row"> 
                @foreach($section_item->newsByCategory->take($section->item_number) as $section_news)
                    @if($i == 1)
                        <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="col-md-6 col-xs-12 news-post standard-post244">
                            <div class="col-md-12 col-xs-12 post-content"><h2>{{($section_news->news_title)}}</h2></div>
                            <div class="col-md-12 col-xs-12 post-gallery pps">
                                @if($section_news->image)
                                <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                                @else
                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                @endif
                            </div>
                        </a>
                    @elseif($i == 2)
                        <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="col-md-6 col-xs-12 news-post standard-post244">
                            <div class="col-md-12 col-xs-12 post-content"><h2>{{($section_news->news_title)}}</h2></div>
                            <div class="col-md-12 col-xs-12 post-gallery pps"><img src="{{ asset('upload/images/news/'.$section_news->image->source_path)}}" alt=""></div>
                        </a>
                    @else
                        <div class="col-md-3 col-xs-6">
                            <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="news-post standard-post2">
                                <div class="post-gallery">
                                    @if($section_news->image)
                                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="">
                                    @else
                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                    @endif
                                    @if($section_news->type == 3)
                                        <a class="play-link" class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                    @elseif($section_news->type == 4)
                                        <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                    @else @endif
                                </div>
                                <div class="post-title">
                                    <h2>{{$section_news->news_title}}</h2>
                                </div>
                            </a>
                        </div>
                    @endif
                    <?php $i++; ?>
                @endforeach
                </div>
                <a class="dnone-d more-news btn" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}}</a>
            </div>
            @endforeach
        </div>

        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
