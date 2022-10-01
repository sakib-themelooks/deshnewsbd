@foreach($get_news as $i => $news)
    @if($i == 0)
    <div class="col-md-4 col-xs-12">
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
            <div class="col-md-12 col-xs-12 img_330 pps videos">
                @include('frontend.pages.tab-layouts.img')
            </div>
            <div class="col-md-12 col-xs-12 pps h60">
                @include('frontend.pages.tab-layouts.ititle')
            </div>
        </a>
    </div>
    <div class="col-md-8 col-xs-12 pps mix1">
    @else
    <div class="col-md-4 col-xs-12">
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}">
            <div class="col-md-12 col-xs-12 img_130 pps videos">
                @include('frontend.pages.tab-layouts.img')
            </div>
            <div class="col-md-12 col-xs-12 pps h60">
                @include('frontend.pages.tab-layouts.ititle')
            </div>
        </a>
    </div>
    @endif
@endforeach
</div>