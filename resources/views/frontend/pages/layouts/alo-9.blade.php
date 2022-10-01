<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="col-md-12 col-xs-12 mix1 pps">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
        @if($i == 1)
        <div class="col-md-6 col-xs-12 m-b-1">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 img_310 alobg pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @elseif($i>1 && $i<=2)
        <div class="col-md-6 col-xs-12 m-b-1">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 alobg img_310 pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @else
        <div class="col-md-{{$section_item->colxs}} col-xs-12">
            <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 alobg img_200 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        </div>
        @endif
        <?php $i++; ?>
    @endforeach
    </div>
</div>