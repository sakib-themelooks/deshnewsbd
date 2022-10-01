@foreach($get_news as $i => $news)
    <div class="col-md-12 col-xs-12">
        <a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="grid77" style="background: #fff;display: inline-block;color: black;">
            <span style="font-size: 45px;">{{$i}}</span>
            @include('frontend.pages.tab-layouts.ititle')
        </a>
    </div>
@endforeach