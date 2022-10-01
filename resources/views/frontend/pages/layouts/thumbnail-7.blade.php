<div class="{{$section_item->colmd}} col-xs-12">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
             @if($i == 1)
             <div class="col-md-4 col-xs-12" style="border: 1px solid #ddd;padding: 20px;">
                 <a class="col-md-12 col-xs-12 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                    <div class="col-md-12 col-xs-12 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                        <p style="margin:0;padding: 6px 15px;background: #001246;color: white;line-height: 45px;display: inline;">@if($section_news->sub_1)<span class="red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</p>
                    </div>
                    <div class="col-md-12 col-xs-12 userxx pps videos">
                        <span style="font-size: 23px;text-align: left;color: black;padding: 20px !important;">{!! Str::limit(strip_tags($section_news->news_dsc), 160) !!}</span>
                    </div>
                    <div class="authorsx">
                        <div class="col-md-2 col-xs-2 userxxs pps videos">
                         @include('frontend.pages.layouts.img')
                    </div>
                        @if($section_news->userx)
                        <b class="authorsx">{{$section_news->userx}}</b>
                        @else
                        <b class="authorsx">{{$section_news->reporter->name}} {{$section_news->reporter->lname}}</b>
                        @endif
                    </div>
                </a>
            </div>
            @elseif($i>1 && $i<=2)
            <div class="col-md-8 col-xs-12">
                <a class="col-md-12 col-xs-12 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="display: flex;">
                    <div class="col-md-2 col-xs-2 userxx pps videos">
                         @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-10 col-xs-10 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};border-bottom: 1px solid #e2e2e2;">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
                @elseif($i>2 && $i<=3)
                <a class="col-md-12 col-xs-12 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="display: flex;">
                    <div class="col-md-2 col-xs-2 userxx pps videos">
                         @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-10 col-xs-10 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};border-bottom: 1px solid #e2e2e2;">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
                @elseif($i>3 && $i<=4)
                <a class="col-md-12 col-xs-12 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="display: flex;">
                    <div class="col-md-2 col-xs-2 userxx pps videos">
                         @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-10 col-xs-10 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};border-bottom: 1px solid #e2e2e2;">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
                @elseif($i>4 && $i<=5)
                <a class="col-md-12 col-xs-12 mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}" style="display: flex;">
                    <div class="col-md-2 col-xs-2 userxx pps videos">
                         @include('frontend.pages.layouts.img')
                    </div>
                    <div class="col-md-10 col-xs-10 grid77" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};border-bottom: 1px solid #e2e2e2;">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                </a>
            </div>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
</div>