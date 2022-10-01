@foreach($get_news as $i => $news)
    @if($i == 0)
    <div class="col-md-8 col-xs-12 border-bottom border-right p-0">
        <div class="col-md-12 border-bottom m-b-1 p-l-0">
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                <div class="col-md-12 col-xs-12 grid142_news_img pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 mix777 pps">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>0 && $i<=1)
        <div class="col-md-6 col-xs-6 border-right p-l-0">
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid11section_news_title pps">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>1 && $i<=2)
        <div class="col-md-6 col-xs-6">
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 pps">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
    </div>
    @endif
    @if($i>2 && $i<=3)
    <div class="col-md-4 col-xs-12 p-0">
        <a class="col-md-12 col-xs-12 border-bottom m-b-1 mp-0" href="#">
            <img src="https://tpc.googlesyndication.com/simgad/1891242793205297984" border="0" width="300" height="250" alt="" class="img_123">
        </a>
        <div class="col-md-12 border-bottom m-b-1 mp-0">
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                <div class="col-md-5 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-7 col-xs-8">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>3 && $i<=4)
        <div class="col-md-12 col-xs-12 border-bottom m-b-1 mp-0">
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                <div class="col-md-5 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-7 col-xs-8">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        @if($i>4 && $i<=5)
        <div class="col-md-12 col-xs-12 border-bottom mp-0">
            <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
                <div class="col-md-5 col-xs-4 img_100 pps videos">
                    @include('frontend.pages.tab-layouts.img')
                </div>
                <div class="col-md-7 col-xs-8">
                    @include('frontend.pages.tab-layouts.ititle')
                </div>
            </a>
        </div>
    </div>
    @endif
@endforeach