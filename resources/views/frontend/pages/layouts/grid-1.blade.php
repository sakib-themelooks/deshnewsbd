<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <div class="col-md-12 col-xs-12">
                <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="display: flex;background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    <div class="col-md-4 col-xs-12 grid77" style="padding: 20px;">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                    <div class="col-md-8 col-xs-12 mix1_news_img pps videos">
                        @include('frontend.pages.layouts.imgb')
                    </div>
                </a>
            </div>
            @else
            <div class="col-md-{{$section_item->colxs}} col-xs-6">
                <a class="mixsection_news_img mms" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    <div class="col-md-12 col-xs-12 mix1_news_imgs pps videos">
                        @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-12 col-xs-12 grid77">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
            </div>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
</div>