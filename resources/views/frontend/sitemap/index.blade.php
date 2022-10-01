<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{url('sitemap.xml')}}/categories</loc>
    </sitemap>

    <sitemap>
        <loc>{{url('sitemap.xml')}}/pages</loc>
    </sitemap>

    <sitemap>
        <loc>{{url('sitemap.xml')}}/posts</loc>
    </sitemap>

    @for($i=0; $i <(App\Models\News::count() /500); $i++) <sitemap>
        <loc>{{url('sitemap.xml/articles'. ($i>0 ? '?page='.$i+1 : null))}}</loc>
        </sitemap>
        @endfor
</sitemapindex>