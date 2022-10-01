<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <a class="col-md-8 col-xs-12" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" >
                <div class="col-md-12 col-xs-12 img_588 pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @elseif($i>1 && $i<=2)
            <a class="col-md-{{$section_item->colxs}} col-xs-6 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 img_190 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 grid77 pps">
                    @include('frontend.pages.layouts.ititle')
                    <span class="pps">{!! Str::limit(strip_tags($section_news->news_dsc), 120) !!}</span>
                </div>
            </a>
            @else
            <a class="col-md-{{$section_item->colxs}} col-xs-6 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 img_190 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 grid77 pps">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
</div>
      