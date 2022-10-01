<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="5" data-speed="1" data-margin="5" data-items_column0="{{$section_item->colxs}}" data-items_column1="{{$section_item->colxs}}" data-items_column2="{{$section_item->colxs}}" data-items_column3="2.3" data-items_column4="1.5" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        <a class="item col-md-12 col-xs-12 pps mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
            <div class="col-md-12 col-xs-12 grid163_news_img pps videos">
                @include('frontend.pages.layouts.imgb')
            </div>
            <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                @include('frontend.pages.layouts.ititle')
            </div>
        </a>
        <?php $i++; ?>
        @endforeach
    </div>
</div>