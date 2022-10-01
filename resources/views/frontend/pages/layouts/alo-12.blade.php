<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="col-md-12 col-xs-12 mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
             @if($i == 1)
             <div class="col-md-4 col-xs-12 border">
                 <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                    <div class="col-md-12 col-xs-12 opinion">
                        @include('frontend.pages.layouts.ititle')
                    </div>
                    <div class="col-md-12 col-xs-12 userxx pps m-none videos">
                        <span style="font-size: 25px;text-align: left;color: black;padding: 20px !important;display: block;">{!! Str::limit(strip_tags($section_news->news_dsc), 160) !!}</span>
                    </div>
                    <div class="col-md-12 col-xs-12 authorsx">
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
                <div class="col-md-12 col-xs-12 m-b-1">
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                        <div class="col-md-2 col-xs-2 userxx pps videos">
                             @include('frontend.pages.layouts.img')
                        </div>
                        <div class="col-md-10 col-xs-10 border-bottom p-b-1">
                            @include('frontend.pages.layouts.ititle')
                            @if($section_news->userx)
                            <b class="authorsx">{{$section_news->userx}}</b>
                            @else
                            <b class="authorsx">{{$section_news->reporter->name}} {{$section_news->reporter->lname}}</b>
                            @endif
                            @if($section_news->sub_2)<span class="m-none">{{$section_news->sub_2}}</span>@endif
                        </div>
                    </a>
                </div>
                @elseif($i>2 && $i<=3)
                <div class="col-md-12 col-xs-12 m-b-1">
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                        <div class="col-md-2 col-xs-2 userxx pps videos">
                             @include('frontend.pages.layouts.img')
                        </div>
                        <div class="col-md-10 col-xs-10 border-bottom p-b-1">
                            @include('frontend.pages.layouts.ititle')
                            @if($section_news->userx)
                            <b class="authorsx">{{$section_news->userx}}</b>
                            @else
                            <b class="authorsx">{{$section_news->reporter->name}} {{$section_news->reporter->lname}}</b>
                            @endif
                            @if($section_news->sub_2)<span class="m-none">{{$section_news->sub_2}}</span>@endif
                        </div>
                    </a>
                </div>
                @elseif($i>3 && $i<=4)
                <div class="col-md-12 col-xs-12 m-b-1">
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                        <div class="col-md-2 col-xs-2 userxx pps videos">
                             @include('frontend.pages.layouts.img')
                        </div>
                        <div class="col-md-10 col-xs-10 border-bottom p-b-1">
                            @include('frontend.pages.layouts.ititle')
                            @if($section_news->userx)
                            <b class="authorsx">{{$section_news->userx}}</b>
                            @else
                            <b class="authorsx">{{$section_news->reporter->name}} {{$section_news->reporter->lname}}</b>
                            @endif
                            @if($section_news->sub_2)<span class="m-none">{{$section_news->sub_2}}</span>@endif
                        </div>
                    </a>
                </div>
                @elseif($i>4 && $i<=5)
                <div class="col-md-12 col-xs-12 m-b-1">
                    <a href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                        <div class="col-md-2 col-xs-2 userxx pps videos">
                             @include('frontend.pages.layouts.img')
                        </div>
                        <div class="col-md-10 col-xs-10 border-bottom p-b-1">
                            @include('frontend.pages.layouts.ititle')
                            @if($section_news->userx)
                            <b class="authorsx">{{$section_news->userx}}</b>
                            @else
                            <b class="authorsx">{{$section_news->reporter->name}} {{$section_news->reporter->lname}}</b>
                            @endif
                            @if($section_news->sub_2)<span class="m-none">{{$section_news->sub_2}}</span>@endif
                        </div>
                    </a>
                </div>
            </div>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>
</div>