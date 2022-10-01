<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);

if($section->section_type == 'category'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,cat_slug_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   

$section_items = $section_items->orderBy('position', 'asc')->get();

?>
<style>
.entertainment h2 {
    color: #333;
    font-size: 19px;
    font-family: shurjo;
    height: 70px;
    line-height: initial;
    margin: 0 0 5px;
    font-weight: normal;
    overflow: hidden;
    text-decoration: none;
    background: #eeeeee;
    padding: 5px;
}
</style>
@if(count($section_items)>0 || $section->is_default == 1)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        
            <div class="row">
            @foreach($section_items as $section_item)

                <div class="col-md-12 col-xs-12">

                    @if($section_item->item_title)
                   <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section_item->item_title}}</h1>
                   <a class="dnone-m" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                   @endif
                    <div class="row">
                       
                        @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)

                            @if($index == 0)
                                <div class="col-md-6 pps">
                                    <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="news-post standard-post2 ">
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
                            @elseif($index >= 0 && $index <= 6)
                                <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="col-md-2 col-xs-6 news-post">
                                    <div class="col-md-12 col-xs-12 pps news-post pps entertainment">
    					                @if($section_news->image)
                                        <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="">
                                        @else
                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                        @endif
    					                <h2>{{($section_news->news_title)}}</h2>
    					            </div>
                                </a>
                            @endif
                          
                        @endforeach
                    </div>
                    <a class="dnone-d more-news btn" href="{{route('category', $section_item->newsByCategory[0]->getCategory->cat_slug_en)}}"> {{$section->sub_title}} </a>
                </div>

            @endforeach
            </div>

        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
