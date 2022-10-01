<?php
    $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
    $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
    $recent_news = DB::table('news')
        ->join('categories', 'news.category', '=', 'categories.id')
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->where('news.status', 'active')
        ->limit($section_item->item_number)
        ->orderBy('news.id', 'DESC')
        ->where('news.lang', $lang)->where('publish_date', '<=', $date)
        ->select('news.*','categories.category_bd', 'categories.slug', 'media_galleries.source_path', 'media_galleries.title')->get();
?>
<div class="breaking-newss flex align-c bg-w">
    <h2 style="margin-bottom:0">{{$section_item->item_title}}</h2>
    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
    @foreach($recent_news as $recent)<a href="{{route('newsDetails', [$recent->slug, $recent->id])}}" style="display:inline-block"><p class="m-b-0 p-3 flex align-c p-l-10"><img width="20" class="p-r-5 img-fluid" src="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}" alt="{{$recent->news_title}}"> {{$recent->news_title}}</p></a>@endforeach
    </marquee>
</div>