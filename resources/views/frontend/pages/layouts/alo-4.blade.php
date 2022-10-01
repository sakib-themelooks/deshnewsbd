<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <div class="col-md-{{($section_item->colxs)}} col-xs-6">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                    <div class="col-md-12 col-xs-12 img_160 pps videos">
                        @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-12 col-xs-12 pps h60">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
            </div>
            <?php $i++; ?>
        @endforeach
    </div>
    @if($section_item->item_sub_title)
    <a href="{{route('category', $section_item->newsByCategory[0]->getCategory->slug)}}">
        <b class="border-bottom-cc alo-4-btn">
            {{$section_item->item_sub_title}} <i class="fa fa-arrow-circle-o-right"></i>
        </b>
    </a>
    @endif
</div>