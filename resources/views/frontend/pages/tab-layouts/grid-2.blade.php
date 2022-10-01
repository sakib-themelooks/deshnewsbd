@foreach($get_news as $i => $news)
    @if($i == 0)
    <div class="col-md-8 col-xs-12 entertainment pps">
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-12">
            <div class="col-md-12 col-xs-12 grid142_news_img pps videos">
                @include('frontend.pages.tab-layouts.img')
            </div>
            <div class="col-md-12 col-xs-12 mix777 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                @include('frontend.pages.tab-layouts.ititle')
            </div>
        </a>
        @endif
        @if($i>0 && $i<=1)
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-6 col-xs-6">
            <div class="col-md-12 col-xs-12 img_160 pps videos">
                @include('frontend.pages.tab-layouts.img')
            </div>
            <div class="col-md-12 col-xs-12 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                @include('frontend.pages.tab-layouts.ititle')
            </div>
        </a>
        @endif
        @if($i>1 && $i<=2)
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-6 col-xs-6">
            <div class="col-md-12 col-xs-12 img_160 pps videos">
                @include('frontend.pages.tab-layouts.img')
            </div>
            <div class="col-md-12 col-xs-12 grid11section_news_title pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                @include('frontend.pages.tab-layouts.ititle')
            </div>
        </a>
    </div>
    @endif
    @if($i>2 && $i<=3)
        <div class="col-md-4 col-xs-12">
            <a class="col-md-12 col-xs-12 pps mmb" href="#">
                <img src="https://tpc.googlesyndication.com/simgad/1891242793205297984" border="0" width="300" height="250" alt="" class="img_123">
            </a>
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-12">
                <div class="col-md-5 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-7 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding-left: 10px !important;">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        @endif
        @if($i>3 && $i<=4)
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-12">
                <div class="col-md-5 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-7 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding-left: 10px !important;">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        @endif
        @if($i>4 && $i<=5)
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-12">
                <div class="col-md-5 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-7 col-xs-8 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding-left: 10px !important;">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
    @endif
@endforeach