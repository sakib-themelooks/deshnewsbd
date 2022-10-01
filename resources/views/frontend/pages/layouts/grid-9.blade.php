<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-3 col-xs-12 entertainment pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 " style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>1 && $i<=2)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>2 && $i<=3)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>3 && $i<=4)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>4 && $i<=5)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>5 && $i<=6)
        <div class="col-md-6 col-12 entertainment pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 col-xs-12 grid9xx_news_img pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>6 && $i<=7)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>7 && $i<=8)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>8 && $i<=9)
        <div class="col-md-3 entertainment pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 col-xs-12 grid1_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>9 && $i<=10)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>10 && $i<=11)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>11 && $i<=12)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>12 && $i<=13)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 mms" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-4 col-xs-4 grid9_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid11section_news_title pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
    @endforeach
    </div>
</div>