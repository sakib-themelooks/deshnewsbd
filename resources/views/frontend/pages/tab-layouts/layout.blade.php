@foreach($get_news as $news)
<a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}" class="col-md-3 col-xs-6 mmb">
   
        <div class="mix5_news_img pps videos">
            <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
       
            <div class="mix77 pps" style="background:rgb(255,255,255);color:#666666;padding:8px;">
               <p>{{$news->news_title}}</p></div>
    </div>
</a>
@endforeach