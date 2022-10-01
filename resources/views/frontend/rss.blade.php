<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'.PHP_EOL ?>
<rss version="2.0" charset="utf-8"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>{{Config::get('siteSetting.site_name')}}</title>
    <link>{{ url('/') }}</link>
    <description>patrika71.com is a rapid growing online news portal from Bangladesh. It starts its journey with a dream to provide trusted, neutral and informative news in and outside Bangladesh.</description>
    <language>en-us</language>
@foreach($get_feeds as $feed_news)
    <item>
        <title>{{ $feed_news->news_title }}</title>
        <link>{{ route('newsDetails', [$feed_news->categoryList->cat_slug_en, $feed_news->id])}}</link>
        <guid>8fa5fc06666af6d4c06aeb3c089{{ $feed_news->id }}</guid>
        <pubDate>{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}</pubDate>
        <author>{{ $feed_news->reporter->name }}</author>
        <description><![CDATA[{!! Str::limit($feed_news->news_dsc, 50000 ) !!}]]></description>
        <content:encoded>
            <![CDATA[
            <html>
            <head>
            <link rel="canonical" href="{{ route('newsDetails', [$feed_news->categoryList->cat_slug_en, $feed_news->id])}}">
            <meta charset="utf-8">
            <meta property="op:generator" content="facebook-instant-articles-sdk-php">
            <meta property="op:generator:version" content="1.10.0">
            <meta property="op:generator:application" content="facebook-instant-articles-wp">
            <meta property="op:generator:application:version" content="4.2.1">
            <meta property="op:generator:transformer" content="facebook-instant-articles-sdk-php">
            <meta property="op:generator:transformer:version" content="1.10.0">
            <meta property="op:markup_version" content="v1.0">
            <meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default">
            <meta property="fb:article_style" content="default">
            </head>
            <body>
            <article>
                <header>
                    <h1>{{ $feed_news->news_title }}</h1>
                    <time class='op-published' datetime='{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}'>{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}</time>
                    <time class='op-modified' dateTime='{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}'>{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}</time>
                    <address>{{ $feed_news->reporter->name }}</address>
                    @if($feed_news->image)<img src='{{ asset('upload/images/news/'. $feed_news->image->source_path)}}' />@endif
                    <figure class='op-ad'>
                      <iframe width='300' height='250' style='border:0; margin:0;' src='https://www.facebook.com/adnw_request?placement=2893384537601213_2893384584267875&adtype=banner300x250'></iframe>
                    </figure>
                </header>
                <p>{!! $feed_news->news_dsc !!}</p>
                <figure class='op-tracker'>
                    <iframe hidden>
                        <script>
                            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
                            ga('create', 'G-MV2PG2GSQZ', 'auto');
                            ga('set', 'campaignSource', 'Facebook');
                            ga('set', 'campaignMedium', 'Facebook Instant Articles');
                            ga('set', 'referrer', 'ia_document.referrer');
                            ga('set', 'title', '{{ $feed_news->news_title }}');
                            ga('send', 'pageview');
                        </script>
                    </iframe>
                </figure>
                <footer>
                    <small>{{Config::get('siteSetting.site_name')}}© এই ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার বেআইনি</small>
                </footer>
                <figure class='op-ad'>
                  <iframe width='300' height='250' style='border:0; margin:0;' src='https://www.facebook.com/adnw_request?placement=2893384537601213_2893384584267875&adtype=banner300x250'></iframe>
                </figure>
            </article>
            </body>
            </html>
            ]]>
        </content:encoded>
    </item>
@endforeach
  </channel>
</rss>
