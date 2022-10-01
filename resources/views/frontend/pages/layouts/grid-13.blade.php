<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-3 col-xs-12 entertainment">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>1 && $i<=2)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>2 && $i<=3)
        <div class="col-md-6 col-xs-12 entertainment">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12">
                <div class="col-md-12 col-xs-12 grid10xx_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>3 && $i<=4)
        <div class="col-md-3 entertainment">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>4 && $i<=5)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mms">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                   @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>5 && $i<=6)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mms">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>6 && $i<=7)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mms">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>7 && $i<=8)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mms">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>8 && $i<=9)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-6 mms">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
    @endforeach
    </div>
</div>