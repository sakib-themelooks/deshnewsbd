<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <div class="col-md-12 col-xs-12 border-bottom m-b-1 p-0 p-b-1">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" >
                    <div class="col-md-12 col-xs-4 img_190 videos">
                        @include('frontend.pages.layouts.imgb')
                    </div>
                    <div class="col-md-12 col-xs-8 mpps">
                        @include('frontend.pages.layouts.ititle')
                        <span class="m-none mb-15">{!! Str::limit(strip_tags($section_news->news_dsc), 160) !!}</span>
                    </div>
                </a>
            </div>
            @else
            <div class="col-md-{{$section_item->colxs}} col-xs-12 m-b-1 pps">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                   <div class="col-md-4 col-xs-4 img_90 videos">
                        @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-8 col-xs-8 h90 pps">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
            </div>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
    @if($section_item->item_sub_title)
    <a href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">
        <b class="border-bottom-cc">
            {{$section_item->item_sub_title}} <i class="fa fa-arrow-circle-o-right"></i>
        </b>
    </a>
    @endif
    {!! $section_item->codex !!}
</div>