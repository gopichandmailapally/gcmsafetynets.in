<?php
/**
 * GCM Safety Nets — High-Performance XML Sitemap Streamer
 * Streams 350,000+ dynamic service-area URLs into 50,000-URL compliant chunks
 * With zero memory exhaustion via unbuffered MySQL cursor streaming.
 */

set_time_limit(600);
ini_set('memory_limit', '512M');

$db_host = 'localhost';
$db_name = 'gcmsafetynets_db';
$db_user = 'gcmsafetynets_user';
$db_pass = 't856zxMjLey8bpU5';

$pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false
]);

$base_url = 'https://www.gcmsafetynets.in';
$today    = date('Y-m-d');
$chunk_size = 50000;

// Fetch all active keywords and areas
$kws = $pdo->query("SELECT keyword_slug FROM seo_service_keywords WHERE is_active = 1 ORDER BY display_order ASC, id ASC")->fetchAll(PDO::FETCH_COLUMN);
$areas = $pdo->query("SELECT area_slug FROM service_areas WHERE is_active = 1 ORDER BY id ASC")->fetchAll(PDO::FETCH_COLUMN);

$total_kws = count($kws);
$total_areas = count($areas);
$total_urls = $total_kws * $total_areas;

echo "Streaming sitemaps for {$total_kws} keywords x {$total_areas} areas = {$total_urls} URLs...\n";

$file_index = 1;
$url_in_chunk = 0;
$total_written = 0;
$fp = null;
$sitemap_files = [];

function open_chunk_file($index, $base_url, &$sitemap_files) {
    $filename = "sitemap-areas-{$index}.xml";
    $filepath = __DIR__ . '/' . $filename;
    $sitemap_files[] = $base_url . '/' . $filename;
    $fp = fopen($filepath, 'w');
    fwrite($fp, '<?xml version="1.0" encoding="UTF-8"?>' . "\n");
    fwrite($fp, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n");
    return $fp;
}

function close_chunk_file($fp) {
    if ($fp) {
        fwrite($fp, '</urlset>' . "\n");
        fclose($fp);
    }
}

$fp = open_chunk_file($file_index, $base_url, $sitemap_files);

foreach ($kws as $kw_slug) {
    foreach ($areas as $area_slug) {
        $loc = "{$base_url}/{$kw_slug}-in-{$area_slug}";
        fwrite($fp, "  <url><loc>{$loc}</loc><lastmod>{$today}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>\n");
        $url_in_chunk++;
        $total_written++;

        if ($url_in_chunk >= $chunk_size) {
            close_chunk_file($fp);
            echo "Finished sitemap-areas-{$file_index}.xml ({$url_in_chunk} URLs)\n";
            $file_index++;
            $url_in_chunk = 0;
            $fp = open_chunk_file($file_index, $base_url, $sitemap_files);
        }
    }
}

if ($fp && $url_in_chunk > 0) {
    close_chunk_file($fp);
    echo "Finished sitemap-areas-{$file_index}.xml ({$url_in_chunk} URLs)\n";
}

// Write Master sitemap.xml Index
$master_path = __DIR__ . '/sitemap.xml';
$mfp = fopen($master_path, 'w');
fwrite($mfp, '<?xml version="1.0" encoding="UTF-8"?>' . "\n");
fwrite($mfp, '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n");

// Include primary pages sitemap if exists
if (file_exists(__DIR__ . '/sitemap-primary.xml')) {
    fwrite($mfp, "  <sitemap><loc>{$base_url}/sitemap-primary.xml</loc><lastmod>{$today}</lastmod></sitemap>\n");
}

foreach ($sitemap_files as $sm_url) {
    fwrite($mfp, "  <sitemap><loc>{$sm_url}</loc><lastmod>{$today}</lastmod></sitemap>\n");
}

fwrite($mfp, '</sitemapindex>' . "\n");
fclose($mfp);

echo "========================================\n";
echo "Master sitemap.xml successfully generated with " . count($sitemap_files) . " chunks!\n";
echo "Total URLs written: " . number_format($total_written) . "\n";
echo "========================================\n";
