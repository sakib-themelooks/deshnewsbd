<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php 
        $i = 1;
        $length = sizeof($section_item->newsByCategory->take($section_item->item_number));    
    ?>
    <div class="row"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <div class="col-md-{{$section_item->colxs}} col-xs-12 mr-20">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" >
                    <div class="col-md-12 col-xs-12 img_270 pps videos">
                        @include('frontend.pages.layouts.imgb')
                    </div>
                    <div class="col-md-12 col-xs-12 pps">
                        @include('frontend.pages.layouts.ititle')
                        <span class="m-none">{!! Str::limit(strip_tags($section_news->news_dsc), 160) !!}</span>
                    </div>
                </a>
            </div>
            @else
            @if($i == 2)
            <div class="col-md-{{$section_item->colxs}} col-xs-12 m-b-1">
            <div class="row ml-5">
            @endif 
                <div class="col-md-12 col-xs-12 m-b-1 border-bottom">
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                        <div class="col-md-3 col-xs-3 img_60 pps videos">
                            @include('frontend.pages.layouts.img')
                        </div>
                        <div class="col-md-9 col-xs-9">
                            @include('frontend.pages.layouts.ititle')
                        </div>
                    </a>
                </div>
            @if($i == $length)  
            </div>   
            </div>
            @endif
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
</div>