<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-6 col-xs-12 entertainment pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 ">
                <div class="col-md-12 col-xs-12 grid141_news_img pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 news9 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>1 && $i<=2)
        <div class="col-md-6 col-12 entertainment pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mmb">
                <div class="col-md-12 col-xs-12 img_190 pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 news9 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>2 && $i<=3)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 news9 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>3 && $i<=4)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 news9 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
    @endforeach
    </div>
</div>