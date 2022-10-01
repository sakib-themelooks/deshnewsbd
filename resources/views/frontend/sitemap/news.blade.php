<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    @foreach ($news as $news)
    <url>
        <loc>{{ route('page', $news->news_slug) }}</loc>
        <news:news>
            <news:publication>
                <news:name>deshnewsbd</news:name>
                <news:language>en</news:language>
            </news:publication>
            <news:publication_date>{{$news->updated_at}}</news:publication_date>
            <news:title>{{$news->news_title}}</news:title>
        </news:news>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>