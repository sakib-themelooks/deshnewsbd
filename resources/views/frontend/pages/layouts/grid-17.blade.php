<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-4 col-xs-12 pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
                <div class="col-md-4 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>1 && $i<=2)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
                <div class="col-md-4 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            @if($i>2 && $i<=3)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
                <div class="col-md-4 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                    
                </div>
            </a>
        </div>
        @endif
        @if($i>3 && $i<=4)
        <div class="col-md-4 col-xs-12 pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12">
                <div class="col-md-12 col-xs-12 grid4_news_imgss pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                    <span class="pps">{!! Str::limit(strip_tags($section_news->news_dsc), 80) !!}</span>
                </div>
            </a>
        </div>
        @endif
        @if($i>4 && $i<=5)
        <div class="col-md-4 pps">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
                <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
                <div class="col-md-4 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
            </a>
            @endif
            @if($i>5 && $i<=6)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
                <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
                <div class="col-md-4 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
            </a>
            @endif
            @if($i>6 && $i<=7)
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" class="col-md-12 col-xs-12 mmb">
                <div class="col-md-8 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
                <div class="col-md-4 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
    @endforeach
    </div>
</div>