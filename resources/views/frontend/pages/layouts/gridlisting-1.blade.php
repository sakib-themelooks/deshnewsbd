<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="col-md-{{($section_item->colxs)}} col-xs-6 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-12 col-xs-12 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};margin: 0.5em 0;">
                    <p>{{$section_news->news_title}}</p>
                    <span class="pps">{!! Str::limit(strip_tags($section_news->news_dsc), 80) !!}</span>
                </div>
            </a>
            <?php $i++; ?>
        @endforeach
    </div>
</div>