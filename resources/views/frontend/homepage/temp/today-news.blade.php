<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc')->limit(5); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,cat_slug_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])->orderBy('position', 'asc')->take(1)->get();
?>

@if(count($section_items)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>
    <div class="container" style=" border-radius: 3px; padding:5px;">        
        <div class="row" >
         @foreach($section_items[0]->newsByCategory as $index => $section_news)
            @if($index == 0)
            <div class="col-md-4">
                <div class="news-post image-post default-size" style="background: #B90403; border-radius: 3px;padding: 8px;margin-top: -10px;margin-bottom: -5px;">
                    <p style="font-size: 16px; font-weight: 600; color:{{$section->text_color}} "><i class="fa fa-play-circle-o"></i> {{$section->title}}</p>
                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                    <a class="play-link" href="{{route('newsDetails', [$section_news->category->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                    <div class="hover-box">
                        <div class="inner-hover">
                            <h2><a href="{{route('newsDetails', [$section_news->category->cat_slug_en, $section_news->id])}}">{{Str::limit($section_news->news_title, 45)}}</a></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                
                <div class="row">
                @else
                    <div class="col-md-3 col-xs-6">
                        <div class="news-post standard-post2">
                           <a style="color: {{$section->text_color}};font-size: 14px;" href="{{route('newsDetails', [$section_news->category->cat_slug_en, $section_news->id])}}">
                            <div class="post-gallery">
                                <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                            </div>
                            {{Str::limit($section_news->news_title, 40)}}
                            </a>
                        </div>
                    </div>
                @if($index == 4)    
                    <div class="col-md-12">
                        <a style="float: right; color: {{$section->text_color}}" href="{{url('video')}}">সকল দেখুন <i class="fa fa-arrow-right"></i></a>
                    </div>
                   
                </div>
            </div>
            @endif
            @endif
         @endforeach
        </div>
    </div>
</section>
@endif
