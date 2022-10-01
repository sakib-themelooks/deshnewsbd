<?php  
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);
if($section->section_type == 'category'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,slug', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   

$section_items = $section_items->orderBy('position', 'asc')->get();
?>

@if(count($section_items)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>
  @if($section->layout_width == 'box')
    <div class="containers" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        <div class="row">            
            @foreach($section_items as $section_item)
            <div class="container">
               @if($section_item->item_title)
               <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section_item->item_title}}</h1>
               <a class="dnone-m" href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
               </div>
               @endif
                <?php $i = 1;?>
                    @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-4 col-xs-6">
                        <div class="news-post standard-post2">
                            <div class="post-gallery videos">
                                <i class="fa fa-play" aria-hidden="true"></i>
                                @if($section_news->image)
                                <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                                @else
                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                @endif
                            </div>
                            <div class="col-md-12 col-xs-12 post-title pps">
                                <h2>{{($section_news->news_title)}}</h2>
                            </div>
                        </div>
                     </a>
                    @endforeach
            </div>
            <a class="dnone-d more-news btn" href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">{{$section->sub_title}}</a>
            @endforeach
        </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
