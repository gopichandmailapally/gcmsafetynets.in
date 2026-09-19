<?php
/**
 * GCM Safety Nets — Master Dynamic Sitemap Generator
 * Generates Google-compliant XML sitemaps for all 22,000+ service-area landing pages
 */

define('GCM_INIT', true);
require_once __DIR__ . '/config/config.php';

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}

$start_time = microtime(true);
$base_url = 'https://www.gcmsafetynets.in';
$today = date('Y-m-d');

// 1. Fetch active keywords & areas
$keywords = $pdo->query("SELECT keyword_slug FROM seo_service_keywords WHERE is_active = 1 ORDER BY display_order ASC")->fetchAll(PDO::FETCH_COLUMN);
$areas    = $pdo->query("SELECT area_slug FROM service_areas WHERE is_active = 1 ORDER BY area_name ASC")->fetchAll(PDO::FETCH_COLUMN);

echo "Loaded " . count($keywords) . " services and " . count($areas) . " areas...\n";

$all_urls = [];
foreach ($keywords as $kw) {
    foreach ($areas as $ar) {
        $all_urls[] = $base_url . '/' . $kw . '-in-' . $ar;
    }
}

$total_urls = count($all_urls);
echo "Total service-area URLs to index: {$total_urls}\n";

// 2. Chunk into sitemaps of 5,000 URLs each
$chunk_size = 5000;
$chunks = array_chunk($all_urls, $chunk_size);
$sitemap_files = [];

foreach ($chunks as $idx => $url_chunk) {
    $file_num = $idx + 1;
    $filename = "sitemap-areas-{$file_num}.xml";
    $filepath = __DIR__ . '/' . $filename;
    
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
    
    foreach ($url_chunk as $u) {
        $xml .= '  <url>' . PHP_EOL;
        $xml .= '    <loc>' . htmlspecialchars($u) . '</loc>' . PHP_EOL;
        $xml .= '    <lastmod>' . $today . '</lastmod>' . PHP_EOL;
        $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
        $xml .= '    <priority>0.8</priority>' . PHP_EOL;
        $xml .= '  </url>' . PHP_EOL;
    }
    
    $xml .= '</urlset>' . PHP_EOL;
    
    file_put_contents($filepath, $xml);
    $sitemap_files[] = $filename;
    echo "Generated {$filename} with " . count($url_chunk) . " URLs.\n";
}

// 3. Update Master sitemap.xml index
$index_xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$index_xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

$index_xml .= '  <sitemap>' . PHP_EOL;
$index_xml .= '    <loc>' . $base_url . '/sitemap-main.xml</loc>' . PHP_EOL;
$index_xml .= '    <lastmod>' . $today . '</lastmod>' . PHP_EOL;
$index_xml .= '  </sitemap>' . PHP_EOL;

$index_xml .= '  <sitemap>' . PHP_EOL;
$index_xml .= '    <loc>' . $base_url . '/sitemap-services.xml</loc>' . PHP_EOL;
$index_xml .= '    <lastmod>' . $today . '</lastmod>' . PHP_EOL;
$index_xml .= '  </sitemap>' . PHP_EOL;

$index_xml .= '  <sitemap>' . PHP_EOL;
$index_xml .= '    <loc>' . $base_url . '/sitemap-blogs.xml</loc>' . PHP_EOL;
$index_xml .= '    <lastmod>' . $today . '</lastmod>' . PHP_EOL;
$index_xml .= '  </sitemap>' . PHP_EOL;

foreach ($sitemap_files as $sm) {
    $index_xml .= '  <sitemap>' . PHP_EOL;
    $index_xml .= '    <loc>' . $base_url . '/' . $sm . '</loc>' . PHP_EOL;
    $index_xml .= '    <lastmod>' . $today . '</lastmod>' . PHP_EOL;
    $index_xml .= '  </sitemap>' . PHP_EOL;
}

$index_xml .= '</sitemapindex>' . PHP_EOL;

file_put_contents(__DIR__ . '/sitemap.xml', $index_xml);
echo "Updated master sitemap.xml with " . count($sitemap_files) . " area sitemaps!\n";

$duration = round(microtime(true) - $start_time, 2);
echo "SUCCESS! Total {$total_urls} URLs indexed across sitemaps in {$duration} seconds.\n";
