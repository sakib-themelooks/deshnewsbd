<div class="{{$section_item->colmd}} col-xs-12">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="col-md-{{$section_item->colxs}} col-xs-6 mixsection_news_img mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 grid5_news_imgs pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            <?php $i++; ?>
        @endforeach
    </div>
</div>