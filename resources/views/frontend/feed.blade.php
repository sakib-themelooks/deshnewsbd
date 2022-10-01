<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'.PHP_EOL ?>
<rss version="2.0"
  xmlns:atom="http://www.w3.org/2005/Atom"
 >
<channel>
  <title>{{Config::get('siteSetting.site_name')}}</title>
  <link>{{ url('/') }}</link>
  <atom:link href="{{route('feed')}}" type="application/rss+xml" rel="self"/>
  <description>{{Config::get('siteSetting.description')}}</description>
  <image>
    <url>{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}</url>
    <title>{{Config::get('siteSetting.site_name')}}</title>
    <link>{{ url('/') }}</link>
  </image>
  
      <copyright>{{config('siteSetting.copyright_text')}}</copyright>
    <language>bn</language>

@foreach($get_feeds as $feed_news)


  <item>
    <title><![CDATA[{{$feed_news->news_title}}]]></title>
    <link>{{ route('newsDetails', [$feed_news->categoryList->slug, $feed_news->id])}}</link>
    <pubDate>{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}</pubDate>
    <category>@if($feed_news->categoryList) {{ $feed_news->categoryList->category_bd }} @else category @endif</category>
    <guid isPermaLink="false">{{ route('newsDetails', [$feed_news->categoryList->slug, $feed_news->id])}}</guid>
    
    <description><![CDATA[
     @if($feed_news->image)<img src="{{ asset('upload/images/news/'. $feed_news->image->source_path)}}" />@endif
    @if($feed_news->news_dsc){!! $feed_news->news_dsc !!}@endif]]></description>
     
    <author><![CDATA[ @if($feed_news->reporter) {{ $feed_news->reporter->name }} @else {{Config::get('siteSetting.site_name')}} @endif  ]]></author>
    
    <image>
      <url>@if($feed_news->image){{ asset('upload/images/news/'. $feed_news->image->source_path)}}@else{{ asset('upload/images/default.jpg')}}@endif</url>
    </image>
  </item>
@endforeach

</channel>
</rss>