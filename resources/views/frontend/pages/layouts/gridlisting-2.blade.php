<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    <a class="col-md-12 col-xs-12 pps mmb" href="">
        <img src="{{asset('upload/images/homepage/'.$section_item->title_img)}}"  alt="">
    </a>
    <?php $i = 1;?>
    <div class="col-md-12 mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <a class="col-md-6 col-xs-6 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-6 col-xs-12 mix5_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="col-md-6 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};padding-left: 10px !important;">
                    <p>{{$section_news->news_title}}</p>
                    <span>{!! Str::limit(strip_tags($section_news->news_dsc), 120) !!}</span>
                </div>
            </a>
        @else
            <a class="col-md-{{($section_item->colxs)}} col-xs-6 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    <p>{{$section_news->news_title}}</p>
                    <span>{!! Str::limit(strip_tags($section_news->news_dsc), 120) !!}</span>
                </div>
            </a>
        @endif
            <?php $i++; ?>
        @endforeach
    </div>
</div>