<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <div class="row"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 m-b-1 border-bottom" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-3 col-xs-3 img_60 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-9 col-xs-9 h60">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
        @endforeach
    </div>
    @if($section_item->item_sub_title)
    <a href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">
        <b class="border-bottom-cc alo-7-btn">
            {{$section_item->item_sub_title}} <i class="fa fa-arrow-circle-o-right"></i>
        </b>
    </a>
    @endif
</div>