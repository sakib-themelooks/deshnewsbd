<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-8 col-xs-12">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>1 && $i<=2)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>2 && $i<=3)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>3 && $i<=4)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-6 col-xs-6 mmb">
                <div class="col-md-12 col-xs-12 grid10_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i == 5)
        <div class="col-md-4 col-xs-12">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
            @endif
            @if($i>5 && $i<=6)
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
            @endif
            @if($i>6 && $i<=7)
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
            @endif
            @if($i>7 && $i<=8)
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
            @endif
            @if($i>8 && $i<=9)
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
            @endif
            @if($i>9 && $i<=10)
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
            @endif
            @if($i>10 && $i<=11)
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="mix777 mmb" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </a>
        </div>
        @endif
        <?php $i++; ?>
        @endforeach
    </div>
</div>