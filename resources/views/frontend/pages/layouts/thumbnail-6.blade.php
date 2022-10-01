<div class="{{$section_item->colmd}} col-xs-12">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="row mix1"> 
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 mixsection_news_img mmb" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                <div class="col-md-12 col-xs-12 mix5_news_img pps videos">
                    @include('frontend.pages.layouts.img')
                </div>
                <div class="mix3">
                    <div class="usern">
                        @if($section_news->reporter->photo)
                        <img class="author-image" src="{{asset('upload/images/users/'.$section_news->reporter->photo)}}"  alt="{{$section_news->reporter->name}} {{$section_news->reporter->lname}}">
                        @else
                        <img class="author-image" src="{{ asset('upload/images/author.jpg')}}"  alt="">
                        @endif
                    </div>
                    <div class="d-flex justify-content-start flex-column ml-2">
                        @if($section_news->userx)
                        <p class="authorss">{{$section_news->userx}}</p>
                        @else
                        <p class="authorss">{{$section_news->reporter->name}}<br>{{$section_news->reporter->lname}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 mix777" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};margin-top: 1em;">
                    @include('frontend.pages.layouts.ititle')
                </div>
            </a>
            <?php $i++; ?>
        @endforeach
    </div>
</div>