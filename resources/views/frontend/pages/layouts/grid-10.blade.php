<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-3 col-xs-12 pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>1 && $i<=2)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>2 && $i<=3)
        <div class="col-md-6 col-xs-12 pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12">
                <div class="col-md-12 col-xs-12 ih410 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>3 && $i<=4)
        <div class="col-md-3 pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>4 && $i<=5)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
    @endforeach
    </div>
</div>