<?php  
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)
    ->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'DESC')->limit(9); }, 'category:id,cat_slug_en', 'newsByCategory.image','newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en', 
        'getCategories' => function ($query) {
    $query->where('status', '=', 1)->limit(5); },])->orderBy('position', 'asc')->take(1)->get();
 
?>
<style>
.post-titlesssz {
    padding: 7px;
    margin: 0;
    background: #eee;
}
.post-titlesssz h2 {
    color: #333;
    font-size: 19px;
    font-family: shurjo;
    height: 23px;
    line-height: initial;
    margin: 0;
    font-weight: normal;
    overflow: hidden;
    text-decoration: none;
}
.v2333 img {
    max-height: 322px;
}
</style>
@if(count($section_items)>0 && count($section_items[0]->newsByCategory)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>


  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        
        <div class="row">
            <div class="col-md-12 section-body" id="sticky-conent">
            	@if($section->title)
                <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> {{$section->title}}</h1>
                <a class="dnone-m" href="{{route('category', $section_items[0]->category->cat_slug_en)}}">{{$section->sub_title}} <i class="fa fa-arrow-circle-right"></i></a>
            	</div>
            	@endif
            	
                @if(count($section_items)>0)
                <div class="row">
                    <div class="grid-box">
                        @foreach($section_items[0]->newsByCategory as $index => $section_news)
                            @if($index== 0)
                                <div class="col-md-7 col-sm-6 pps">
                                    <a href="{{route('newsDetails', [$section_items[0]->category->cat_slug_en, $section_news->id])}}" class="news-post image-post2">
									    <div class="post-gallery v2333">
									        @if($section_news->image)
                                            <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                                            @else
                                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                            @endif
									        <div class="post-titlesssz">
									        <h2>{{($section_news->news_title)}}</h2>
									        </div>
									    </div>
									</a>
                                </div>
                            @elseif($index >= 0 && $index <= 4)
                                <div class="col-md-5 pps">
								    <ul class="list-posts v22">
								        <li>
                                            <div class="col-md-4 col-xs-4  pps">
								            @if($section_news->image)
                                            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="">
                                            @else
                                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                            @endif
                                            </div>
                                            <div class="col-md-8 col-xs-8">
								            <div class="post-content">
								                <h2><a href="{{route('newsDetails', [$section_items[0]->category->cat_slug_en, $section_news->id])}}">{{($section_news->news_title)}}</a></h2>
								                <ul class="post-tags">
			                                       
			                                      @if($section_news->subcategoryList)
                                    				<li><i class="fa fa-tags"></i>{{$section_news->subcategoryList->subcategory_bd}}</li>@endif
			                                    </ul>
								            </div>
                                            </div>
								        </li>
								    </ul>
								</div>
                            	
                            @else
                                <div class="col-md-3 col-xs-6 col-sm-4 pps">
                                    <div class="news-post standard-post2">
                                        <a href="{{route('newsDetails', [$section_items[0]->category->cat_slug_en, $section_news->id])}}">
                                            <div class="post-gallery">
                                                @if($section_news->image)
                                                <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="">
                                                @else
                                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                @endif
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_items[0]->category->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_items[0]->category->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-title">
                                                <h2><a href="{{route('newsDetails', [$section_items[0]->category->cat_slug_en, $section_news->id])}}">{{($section_news->news_title)}} </a></h2>
                                                
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                           
                        @endforeach
                    </div>
                </div>
                <a class="dnone-d more-news btn" href="{{route('category', $section_items[0]->category->cat_slug_en)}}">{{$section->sub_title}}</a>
                @endif
            </div>
        </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>

@endif
