<div class="{{$section_item->colmd}} col-xs-12 pps">
    <div class="col-md-12 col-xs-12">{!! $section_item->codex !!}</div>
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="col-md-12 col-xs-12 pps"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <div class="col-md-8 col-xs-12 pps">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                    <div class="col-md-12 col-xs-12 img_400 videos">
                        @include('frontend.pages.layouts.imgb')
                    </div>
                    <div class="col-md-12 col-xs-12">
                        @include('frontend.pages.layouts.ititle')
                        <span class="m-none">{!! Str::limit(strip_tags($section_news->news_dsc), 160) !!}</span>
                    </div>
                </a>
            </div>
            @else
            <div class="col-md-{{$section_item->colxs}} col-xs-12 pps">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                    <div class="col-md-12 col-xs-12 img_160 pps mmb videos">
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