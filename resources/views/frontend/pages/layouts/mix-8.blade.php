<div class="{{$section_item->colmd}} col-xs-12">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <a class="col-md-12 col-xs-12 pps mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" >
                <div class="col-md-12 col-xs-12 img_190 pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};border-bottom: 1px solid #ddd;">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @else
            <a class="col-md-{{$section_item->colxs}} col-xs-12 grid77 pps mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="border-bottom: 1px solid #ddd;background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <p>@if($section_news->sub_1)<span class="red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</p>
            </a>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
    {!! $section_item->codex !!}
</div>