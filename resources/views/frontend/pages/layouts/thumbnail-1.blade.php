<div class="{{$section_item->colmd}} col-xs-12">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        <a class="col-md-{{$section_item->colxs}} col-xs-12 pps mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
            <div class="col-md-4 col-xs-4 imix pps videos">
                @include('frontend.pages.layouts.img')
            </div>
            <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                @include('frontend.pages.layouts.ititle')
            </div>
        </a>
        <?php $i++; ?>
        @endforeach
    </div>
</div>