<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($allArticles as $anArticle)
        <url>
            <loc>{{ URL::route("article", [$anArticle->category_alias,$anArticle->slug.'-'.$anArticle->id]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($anArticle->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
    @foreach($allCates as $aCate)
        <url>
            <loc>{{ URL::route("category", [$aCate->alias]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($aCate->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
        <url>
            <loc>http://trumhack.com/nap-so-garena.html</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime('2015-12-16 09:35:00')) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
</urlset>