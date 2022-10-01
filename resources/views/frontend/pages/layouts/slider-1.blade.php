<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="yes" data-delay="30" data-speed="1" data-margin="0" data-items_column0="{{$section_item->colxs}}" data-items_column1="{{$section_item->colxs}}" data-items_column2="{{$section_item->colxs}}" data-items_column3="{{$section_item->colxs}}" data-items_column4="{{$section_item->colxs}}" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="slidersection_news_img" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 slider2_news_imgs pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 grid1section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            <?php $i++; ?>
        @endforeach
    </div>
</div>