<?php  
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);
if($section->section_type == 'category' || $section->section_type == 'country-wide'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'DESC')->limit(9); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,cat_slug_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   
$section_items = $section_items->orderBy('position', 'asc')->get();

?>
<style>
ul.list-posts>li img {
    width: 120px;
    margin-right: 10px;
    float: left;
}
</style>
@if(count($section_items)>0 || $section->is_default == 1)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
            <div class="row">
                <div class="col-md-9 divrigth_border" id="sticky-conent">
                    @if($section->title)
                    <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section->title}}</h1>
                    <a class="dnone-m" href="{{route('category', $section_items[0]->category->cat_slug_en)}}">আরও খবর <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                	@endif

                    <div class="row">
                        <?php $i = 1;?>
                        @foreach($section_items[0]->newsByCategory as $section_news)
                            @if($i==1)
                                <div class="col-md-6">
                                    <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}" class="news-post standard-post2">
                                        <div class="post-gallery">
                                            @if($section_news->image)
                                            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="">
                                            @else
                                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                            @endif
                                        </div>
                                        <div class="post-title"><h2>{{($section_news->news_title)}}</h2></div>
                                    </a>
                                </div>
                            @elseif($i>1 && $i<=5)
                                <div class="col-md-6 col-xs-12 pps">
                                    <ul class="list-posts">
                                        <li>
                                            <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt=""></a>
                                            <div class="post-content">
                                                <h2><a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}">{{($section_news->news_title)}}</a></h2>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                    <a class="dnone-d more-news btn" href="{{route('category', $section_items[0]->category->cat_slug_en)}}"> আরও পড়ুন </a>
                    {!! config('siteSetting.code4') !!}
                </div>
                <div class="col-md-3 sidebar">
                    <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section->sub_title}}</h1>
                    <a></a>
                    </div>
                    <div class="map">
                        @include('frontend.map')
                    </div>
                    @include('frontend.layouts.deshjure')
                </div>
            </div>
        @if($section->layout_width == 'box')
    </div>
    @endif
</section>
@endif
