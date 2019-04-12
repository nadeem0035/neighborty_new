<?php header('Content-type: text/xml'); ?>
<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc>
        <priority>1.0</priority>
    </url>

    <?php foreach($pages as $page) { ?>

        <url>
            <loc><?= base_url().$page->slug ?></loc>
            <priority>0.80</priority>
            <changefreq>daily</changefreq>
            <lastmod><?=date('Y-m-d\TH:i:sP', time());?></lastmod>
        </url>


    <?php } ?>


    <url>
        <loc><?= base_url().'search?type=rent' ?></loc>
        <priority>0.80</priority>
        <changefreq>daily</changefreq>
        <lastmod><?=date('Y-m-d\TH:i:sP', time());?></lastmod>
    </url>

    <url>
        <loc><?= base_url().'search?type=sale' ?></loc>
        <priority>0.80</priority>
        <changefreq>daily</changefreq>
        <lastmod><?=date('Y-m-d\TH:i:sP', time());?></lastmod>
    </url>




    <?php foreach($properties as $property) { ?>

        <url>
            <loc><?= base_url().'property/'.$property->slug.'-'.$property->id ?></loc>
            <priority>0.64</priority>
            <changefreq>daily</changefreq>
            <lastmod><?=date('Y-m-d\TH:i:sP', time());?></lastmod>
        </url>


    <?php } ?>



</urlset>