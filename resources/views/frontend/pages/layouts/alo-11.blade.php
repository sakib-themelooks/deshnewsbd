<div class="{{$section_item->colmd}} col-xs-12 pps">
    @if(sizeof($section_item->newsByCategory)>0)
    @include(('frontend.pages.layouts.title').$section_item->item_title_number){{$section_item->item_title_number}}
    <?php $i = 1;?>
    <div class="col-xs-12 col-md-12 category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="15" data-speed="1" data-margin="5" data-items_column0="{{$section_item->colxs}}" data-items_column1="{{$section_item->colxs}}" data-items_column2="{{$section_item->colxs}}" data-items_column3="{{$section_item->colxs}}" data-items_column4="1.2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="{{$section_item->bg_text}} inline-block" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 pps img_310 videos">
                    
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 h90">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        @endforeach
    </div>
    @endif
</div>