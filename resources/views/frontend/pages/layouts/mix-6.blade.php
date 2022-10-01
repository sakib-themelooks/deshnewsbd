<div class="{{$section_item->colmd}} col-xs-12" style="margin:0;padding:{{$section_item->padding}};">
    <div class="col-sm-12">{!! $section_item->codex !!}</div>
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="col-sm-12 mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            @if($i == 1)
            <a class="col-md-12 col-xs-12 pps mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-12 col-xs-12 img_160 pps videos">
                    @include('frontend.pages.layouts.imgb')
                </div>
                <div class="col-md-12 col-xs-12">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            @else
            <a class="col-md-{{$section_item->colxs}} col-xs-12 pps mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                <div class="col-md-8 col-xs-8">
                    @include('frontend.pages.layouts.ititle')
                </div>
                <div class="col-md-4 col-xs-4 img_70 pps mmb videos">
                    @include('frontend.pages.layouts.img')
                </div>
            </a>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
    <a class="col-md-12 col-xs-12 pps mmb" href="{{$section_item->margin}}">
        <img src="{{asset('upload/images/homepage/'.$section_item->title_img)}}"  alt="{{$section_news->news_title}}">
    </a>
</div>
      