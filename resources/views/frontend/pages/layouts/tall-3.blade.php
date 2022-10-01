<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        <a class="item col-md-{{$section_item->colxs}} col-xs-6 mixsection_news_img" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
            <div class="col-md-12 col-xs-12 grid2_news_imgs pps videos">
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