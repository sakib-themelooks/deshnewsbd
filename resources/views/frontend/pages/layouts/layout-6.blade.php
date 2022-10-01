<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);

if($section->section_type == 'category' || $section->section_type == 'country-wide'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->where('lang', '=', 'bd')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,slug', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   

$section_items = $section_items->orderBy('position', 'asc')->get();

?>

@if(count($section_items)>0 || $section->is_default == 1)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
            @foreach($section_items as $section_item)
            <div class="row">
            @if($section_item->item_title)
               <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section_item->item_title}}</h1>
               <a class="dnone-m" href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            @endif
            @foreach($section_item->newsByCategory->take($section->item_number) as $section_news)
                <div class="col-md-2 col-xs-6 news-post standard-post2 xxx">
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                        <div class="post-gallery">
                            @if($section_news->image)
                            <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                            @else
                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                            @endif
                        </div>
                        <div class="post-title">
                            <h2>{{($section_news->news_title)}}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
            
            </div>
            <a class="dnone-d more-news btn" href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">{{$section->sub_title}}</a>
            @endforeach
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
