<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="15" data-speed="1" data-margin="10" data-items_column0="{{$section_item->colxs}}" data-items_column1="{{$section_item->colxs}}" data-items_column2="3.5" data-items_column3="2.5" data-items_column4="1.5" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
       @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        <div class="item">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 ih410 pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 grid1section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        <?php $i++; ?>
        @endforeach
    </div>
</div>
