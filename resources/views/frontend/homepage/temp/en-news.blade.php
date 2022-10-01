<?php  
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
$query->where('status', '=', 'active')->orderBy('id', 'desc')->limit(11); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,cat_slug_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])->orderBy('position', 'asc')->take(1)->get();
?>
@if(count($section_items)>0 && count($section_items[0]->newsByCategory)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>
  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        
        <div class="row">
            <div class="col-md-12 pps section-body" id="sticky-conent">
            	@if($section->title)
                <div class="titles-section"><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> <h1>{{$section->title}}</h1></div>
            	@endif
            	
                @if(count($section_items)>0)
                <div class="row">
                    <div class="grid-box">
                        @foreach($section_items[0]->newsByCategory as $index => $section_news)
                            @if($index== 0)
                                <div class="col-md-6 col-xs-12 pps">
                                    <div class="news-post standard-post2 ">
                                        <a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-title">
                                                <h2>{{($section_news->news_title)}}</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @elseif($index >= 0 && $index <= 10)
                            <div class="col-md-3 col-xs-12 pps">
							    <ul class="list-posts">
							        <li>
                                        <div class="col-md-5 col-xs-4 pps">
							            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                        </div>
                                        <div class="col-md-7 col-xs-8">
							            <div class="post-content">
							                <h2><a href="{{route('newsDetails', [$section_news->getCategory->cat_slug_en, $section_news->id])}}">{{($section_news->news_title)}}</a></h2>
							            </div>
                                        </div>
							        </li>
							    </ul>
							</div>
                            
                            @else
                                
                            @endif
                           
                        @endforeach
                    </div>
                </div>
                @endif
                
            </div>
        </div>

        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
