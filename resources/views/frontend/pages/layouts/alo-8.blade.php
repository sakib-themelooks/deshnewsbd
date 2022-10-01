<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="col-md-12 col-xs-12 slider">
        <div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
            @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <div class="carousel-cell alobg img_500 videos">
            @if($section_news->thumb_url)
                <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
            @elseif($section_item->lazyload)
                @if($section_news->image)
                    <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                @else
                    <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
                @endif
            @elseif($section_news->image)
            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
            @else
            <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
            @endif
            <h1 class="box_text_color-3">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
            </div>
            @endforeach
        </div>
        <div class="carousel carousel-nav"
          data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
            @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
          <div class="carousel-cell img_90">
            @if($section_news->thumb_url)
                <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{$section_news->thumb_url}}"  alt="{{$section_news->news_title}}">
            @elseif($section_item->lazyload)
                @if($section_news->image)
                    <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                @else
                    <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
                @endif
            @elseif($section_news->image)
            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
            @else
            <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
            @endif
          </div>
          @endforeach
        </div>
    </div>
</div>
<style>.carousel-cell h1{margin-left:10px;z-index:99999}.flickity-enabled{position:relative}.flickity-enabled:focus{outline:0}.flickity-viewport{overflow:hidden;position:relative;height:100%}.flickity-slider{position:absolute;width:100%;height:100%}.flickity-enabled.is-draggable{-webkit-tap-highlight-color:transparent;tap-highlight-color:transparent;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.flickity-enabled.is-draggable .flickity-viewport{cursor:move;cursor:-webkit-grab;cursor:grab}.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down{cursor:-webkit-grabbing;cursor:grabbing}.flickity-prev-next-button{position:absolute;top:50%;width:44px;height:44px;border:none;border-radius:50%;background:hsla(0,0%,100%,.75);cursor:pointer;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.flickity-prev-next-button:hover{background:#fff}.flickity-prev-next-button:focus{outline:0;box-shadow:0 0 0 5px #09f}.flickity-prev-next-button:active{opacity:.6}.flickity-prev-next-button.previous{left:10px}.flickity-prev-next-button.next{right:10px}.flickity-prev-next-button:disabled{opacity:.3;cursor:auto}.flickity-prev-next-button svg{position:absolute;left:20%;top:20%;width:60%;height:60%}.flickity-prev-next-button .arrow{fill:#333}.carousel{background:#fafafa}.carousel-main{margin-bottom:8px}.carousel-cell{width:100%;height:504px;margin-right:8px;border-radius:5px}.carousel-nav .carousel-cell{height:90px;width:120px}.carousel-main img{display:block}</style>
<script type="text/javascript" src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>