<?php
/**
 * GCM Safety Nets — Dynamic High-Performance Service Area Engine
 * Dynamically serves {service}-in-{area} pages for 12,000+ combinations
 * With hyper-local SEO, schema markup, and instant database hydration.
 */

define('GCM_INIT', true);
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// Parse query parameters
$service_slug = strtolower(trim($_GET['service'] ?? ''));
$area_slug    = strtolower(trim($_GET['area'] ?? ''));

if (empty($service_slug) || empty($area_slug)) {
    http_response_code(404);
    if (file_exists(__DIR__ . '/404.php')) {
        require __DIR__ . '/404.php';
    } else {
        echo '<h1>404 Not Found</h1>';
    }
    exit;
}

$_db = Database::getInstance();

// 1. Fetch Service Keyword
$service_row = $_db->fetchOne(
    "SELECT * FROM seo_service_keywords WHERE keyword_slug = ? AND is_active = 1 LIMIT 1",
    [$service_slug],
    's'
);

if (!$service_row) {
    // Check main services table fallback
    $main_svc = $_db->fetchOne(
        "SELECT * FROM services WHERE service_slug = ? AND is_active = 1 LIMIT 1",
        [$service_slug],
        's'
    );
    if ($main_svc) {
        $service_row = [
            'keyword_name' => $main_svc['service_name'],
            'keyword_slug' => $main_svc['service_slug'],
            'category'     => strtoupper(str_replace('-', ' ', $main_svc['service_slug'])),
            'search_volume'=> 1000
        ];
    }
}

// 2. Fetch Area
$area_row = $_db->fetchOne(
    "SELECT * FROM service_areas WHERE area_slug = ? AND is_active = 1 LIMIT 1",
    [$area_slug],
    's'
);

// If either service or area not recognized, return 404
if (!$service_row || !$area_row) {
    http_response_code(404);
    if (file_exists(__DIR__ . '/404.php')) {
        require __DIR__ . '/404.php';
    } else {
        echo '<h1>404 Page Not Found</h1>';
    }
    exit;
}

$service_name = htmlspecialchars($service_row['keyword_name']);
$area_name    = htmlspecialchars($area_row['area_name']);
$category     = strtoupper($service_row['category'] ?? 'SAFETY NETS');
$zone         = htmlspecialchars($area_row['zone'] ?? 'Hyderabad');

// Page Metadata
$page_title       = "{$service_name} in {$area_name}, Hyderabad | GCM Safety Nets";
$meta_description = "Certified {$service_name} installation in {$area_name}, Hyderabad. Garware UV-treated materials, 5-year warranty, same-day installation. Call 9912399224 for free site visit.";
$meta_keywords    = "{$service_name}, {$service_name} in {$area_name}, {$service_slug} hyderabad, safety nets in {$area_slug}, pigeon nets {$area_slug}, balcony safety nets {$area_slug}";
$current_page     = 'services';

// Check for custom unique content in DB
$page_slug = $service_slug . '-in-' . $area_slug;
$custom_page = $_db->fetchOne(
    "SELECT page_title, meta_description, meta_keywords, content FROM generated_pages WHERE slug = ? AND is_published = 1 LIMIT 1",
    [$page_slug],
    's'
);

$custom_content = '';
if ($custom_page && !empty($custom_page['content'])) {
    if (!empty($custom_page['page_title'])) {
        $page_title = htmlspecialchars($custom_page['page_title']);
    }
    if (!empty($custom_page['meta_description'])) {
        $meta_description = htmlspecialchars($custom_page['meta_description']);
    }
    if (!empty($custom_page['meta_keywords'])) {
        $meta_keywords = htmlspecialchars($custom_page['meta_keywords']);
    }
    $raw_content = $custom_page['content'];
    // Strip any remaining nested document tags
    $raw_content = preg_replace('/<!DOCTYPE[^>]*>/i', '', $raw_content);
    $raw_content = preg_replace('/<\/?(html|head|body)[^>]*>/i', '', $raw_content);
    $raw_content = preg_replace('/<title>[^<]*<\/title>/i', '', $raw_content);
    $raw_content = preg_replace('/<meta[^>]*>/i', '', $raw_content);
    $raw_content = preg_replace('/<style\b[^>]*>.*?<\/style>/is', '', $raw_content);
    $custom_content = trim($raw_content);
}

// Hero background image selection
$hero_img = SITE_URL . '/assets/img/services/safety-nets.jpg';
if (strpos($category, 'PIGEON') !== false || strpos($service_slug, 'pigeon') !== false) {
    $hero_img = SITE_URL . '/assets/img/services/pigeon-nets.jpg';
} elseif (strpos($category, 'BIRD') !== false || strpos($service_slug, 'bird') !== false) {
    $hero_img = SITE_URL . '/assets/img/services/bird-nets.jpg';
} elseif (strpos($category, 'SPORTS') !== false || strpos($service_slug, 'cricket') !== false) {
    $hero_img = SITE_URL . '/assets/img/services/cricket-nets.jpg';
} elseif (strpos($category, 'INVISIBLE') !== false || strpos($service_slug, 'invisible') !== false) {
    $hero_img = SITE_URL . '/assets/img/services/invisible-grills.jpg';
} elseif (strpos($category, 'CLOTH') !== false || strpos($service_slug, 'cloth') !== false || strpos($service_slug, 'hanger') !== false) {
    $hero_img = SITE_URL . '/assets/img/services/cloth-hangers.jpg';
}

// Sidebar Data
$_cat_kws = $_db->fetchAll(
    "SELECT keyword_name, keyword_slug FROM seo_service_keywords WHERE is_active = 1 ORDER BY display_order ASC"
);

$_all_areas = $_db->fetchAll(
    "SELECT area_name, area_slug FROM service_areas WHERE is_active = 1 ORDER BY area_name ASC"
);

// Nearby areas (8-12 for interlinking)
$_nearby_areas = array_slice($_all_areas, 0, 15);

// Category Specifications & Details
$cat_specs = [
    'PIGEON NETS' => [
        'material' => '100% Virgin Garware High-Density Polyethylene (HDPE) & Translucent Nylon',
        'mesh_size' => '25mm to 30mm (Prevents pigeons from entering without blocking light/air)',
        'thickness' => '0.8mm to 1.2mm multi-strand braided twine',
        'breaking_load' => 'Up to 60 kg per single mesh square',
        'warranty' => '5 Years Replacement Warranty',
        'ideal_for' => 'Balconies, French windows, AC outdoor units, duct areas, and utility spaces in ' . $area_name,
        'rate' => 'Starting from ₹18 - ₹25 per sq.ft.'
    ],
    'BIRD NETS' => [
        'material' => 'UV-Stabilized Monofilament Polyethylene (Weatherproof)',
        'mesh_size' => '15mm (Small birds & sparrows) / 25mm (Pigeons & crows)',
        'thickness' => '1.0mm - 1.5mm high-tenacity nylon',
        'breaking_load' => 'Up to 75 kg tensile capacity',
        'warranty' => '5 Years Replacement Warranty',
        'ideal_for' => 'Residential terraces, commercial buildings, courtyards, and warehouses in ' . $area_name,
        'rate' => 'Starting from ₹20 - ₹28 per sq.ft.'
    ],
    'SAFETY NETS' => [
        'material' => 'High-Tensile Braided Nylon & Polypropylene Rope (Tested for heavy impact)',
        'mesh_size' => '40mm to 50mm heavy-duty diamond/square mesh',
        'thickness' => '2.5mm to 4.0mm heavy braided cord',
        'breaking_load' => 'Tested up to 250 kg - 350 kg fall protection weight',
        'warranty' => '5 Years Replacement Warranty',
        'ideal_for' => 'Child safety, balcony fall protection, open ducts, staircases, and construction in ' . $area_name,
        'rate' => 'Starting from ₹22 - ₹35 per sq.ft.'
    ],
    'SPORTS NETS' => [
        'material' => 'UV-Treated Garware Nylon & Knotted Polyethylene (Abrasion resistant)',
        'mesh_size' => '40mm to 50mm square mesh',
        'thickness' => '2.0mm to 3.5mm thick impact-absorbing twine',
        'breaking_load' => 'Withstands high-velocity leather and tennis cricket ball impacts',
        'warranty' => '3 to 5 Years Replacement Warranty',
        'ideal_for' => 'Cricket practice pitches, box cricket arenas, rooftop sports cages, and football boundary in ' . $area_name,
        'rate' => 'Starting from ₹16 - ₹26 per sq.ft.'
    ],
    'INVISIBLE GRILLS' => [
        'material' => 'Marine-Grade AISI 316 Stainless Steel Cable with Transparent Nylon Coating',
        'mesh_size' => '2-inch, 3-inch, or 4-inch spacing options',
        'thickness' => '2.0mm, 2.5mm, or 3.0mm high-tensile steel wire rope',
        'breaking_load' => 'Over 400 kg tensile breaking strength',
        'warranty' => '5 to 10 Years Anti-Rust Warranty',
        'ideal_for' => 'Unobstructed scenic balcony views, window safety, child security, and modern luxury flats in ' . $area_name,
        'rate' => 'Starting from ₹110 - ₹160 per sq.ft.'
    ],
    'CLOTH HANGERS' => [
        'material' => 'Rust-Proof 202/304 Stainless Steel Pipes with Heavy-Duty Nylon Pulley Ropes',
        'mesh_size' => 'Available in 4, 6, and 8 rod configurations (Lengths: 4ft to 8ft)',
        'thickness' => 'Heavy gauge stainless steel tubes with smooth ceiling anchor brackets',
        'breaking_load' => 'Supports 25 kg to 35 kg of wet laundry easily',
        'warranty' => '2 to 3 Years Warranty on Pulley Mechanism',
        'ideal_for' => 'Apartment balconies, utility rooms, and space-saving ceiling laundry drying in ' . $area_name,
        'rate' => 'Starting from ₹1,499 - ₹2,999 per complete set'
    ]
];

$specs = $cat_specs[$category] ?? $cat_specs['SAFETY NETS'];

// Structured FAQs for Google FAQPage Schema
$faqs_data = [
    [
        'q' => "What is the cost of {$service_name} installation in {$area_name}, Hyderabad?",
        'a' => "The price for {$service_name} in {$area_name} starts at {$specs['rate']}. Pricing depends on the total square footage, selected material grade (e.g. Garware Nylon, SS 316 wire), and height of the installation. We provide a 100% free doorstep inspection and measurement in {$area_name} with an exact upfront quote."
    ],
    [
        'q' => "How quickly can GCM Safety Nets complete {$service_name} installation in {$area_name}?",
        'a' => "Our technicians are stationed across Hyderabad, including {$area_name}. We offer same-day inspection and can complete standard installations in 2 to 4 hours without causing any disruption to your home or daily routine."
    ],
    [
        'q' => "Does {$service_name} block sunlight or airflow in {$area_name} apartments?",
        'a' => "Not at all. Our {$service_name} solutions use thin, high-tensile, translucent materials that allow 100% natural light and full cross-ventilation while providing complete protection from bird nuisance, accidental falls, or intrusion."
    ],
    [
        'q' => "What warranty is provided for {$service_name} in {$area_name}?",
        'a' => "We provide a written {$specs['warranty']} against manufacturing defects, UV degradation, and anchor loosening. If any issue arises during the warranty period, our {$area_name} team will replace or repair it free of charge."
    ],
    [
        'q' => "Are your installation technicians trained and insured for high-rise buildings in {$area_name}?",
        'a' => "Yes, all GCM Safety Nets technicians are certified, fully insured, and equipped with professional safety harnesses, helmets, and industrial anchor fasteners for high-rise apartment and villa installations."
    ]
];

// Include Modern Header
include __DIR__ . '/includes/modern-header.php';

// Restore page service and area names in case menu header loops used same variable names
$service_name = htmlspecialchars($service_row['keyword_name']);
$area_name    = htmlspecialchars($area_row['area_name']);
?>

<!-- Schema Markup (JSON-LD) for Local SEO & Rich Snippets -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Service",
      "@id": "https://www.gcmsafetynets.in/<?php echo $service_slug . '-in-' . $area_slug; ?>#service",
      "name": "<?php echo addslashes($service_name); ?> in <?php echo addslashes($area_name); ?>, Hyderabad",
      "serviceType": "<?php echo addslashes($service_name); ?>",
      "provider": {
        "@type": "HomeAndConstructionBusiness",
        "name": "GCM Safety Nets",
        "telephone": "+91-9912399224",
        "url": "https://www.gcmsafetynets.in",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Plot No 42, H.No 2-3-512/A, B.S. Maktha, Begumpet",
          "addressLocality": "Hyderabad",
          "addressRegion": "Telangana",
          "postalCode": "500016",
          "addressCountry": "IN"
        }
      },
      "areaServed": {
        "@type": "AdministrativeArea",
        "name": "<?php echo addslashes($area_name); ?>, Hyderabad"
      },
      "offers": {
        "@type": "Offer",
        "price": "18",
        "priceCurrency": "INR",
        "availability": "https://schema.org/InStock",
        "url": "https://www.gcmsafetynets.in/<?php echo $service_slug . '-in-' . $area_slug; ?>"
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://www.gcmsafetynets.in/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Services",
          "item": "https://www.gcmsafetynets.in/services"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "<?php echo addslashes($service_name); ?> in <?php echo addslashes($area_name); ?>",
          "item": "https://www.gcmsafetynets.in/<?php echo $service_slug . '-in-' . $area_slug; ?>"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php
        $faq_elements = [];
        foreach ($faqs_data as $faq_item) {
            $faq_elements[] = json_encode([
                '@type' => 'Question',
                'name'  => $faq_item['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $faq_item['a']
                ]
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        echo implode(",\n        ", $faq_elements);
        ?>
      ]
    }
  ]
}
</script>

<!-- Hero Section -->
<section style="position:relative;width:100%;min-height:480px;background:#1E293B;display:flex;align-items:center;overflow:hidden;">
  <div style="position:absolute;inset:0;background-image:url('<?php echo $hero_img; ?>');background-size:cover;background-position:center;animation:gcm-kb 20s ease infinite;"></div>
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(15,23,42,.82) 0%,rgba(30,41,59,.88) 100%);"></div>
  
  <div style="max-width:1200px;margin:0 auto;padding:60px 20px;position:relative;z-index:3;width:100%;">
    <!-- Breadcrumb -->
    <div style="font-size:13px;color:rgba(255,255,255,.75);margin-bottom:20px;">
      <a href="<?php echo SITE_URL; ?>/" style="color:rgba(255,255,255,.85);text-decoration:none;">Home</a>
      <span style="margin:0 8px;opacity:.5;">&rsaquo;</span>
      <a href="<?php echo SITE_URL; ?>/services" style="color:rgba(255,255,255,.85);text-decoration:none;">Services</a>
      <span style="margin:0 8px;opacity:.5;">&rsaquo;</span>
      <span style="color:#10B981;font-weight:600;"><?php echo $service_name; ?> in <?php echo $area_name; ?></span>
    </div>

    <!-- Title & Tagline -->
    <h1 style="font-size:42px;font-weight:800;color:#fff;margin:0 0 16px;line-height:1.2;text-shadow:0 4px 20px rgba(0,0,0,.45);max-width:850px;font-family:'Poppins', sans-serif;">
      No.1 <?php echo $service_name; ?> in <?php echo $area_name; ?>, Hyderabad
    </h1>
    <p style="font-size:18px;color:rgba(255,255,255,.9);margin:0 0 32px;max-width:680px;line-height:1.6;">
      Certified, durable and custom-fitted <?php echo strtolower($service_name); ?> for residential apartments, villas, and commercial spaces across <?php echo $area_name; ?>. Free home inspection &amp; instant quote.
    </p>

    <!-- CTA Buttons -->
    <div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:36px;">
      <a href="tel:+919912399224" style="display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#10B981,#059669);color:white;padding:14px 28px;border-radius:12px;text-decoration:none;font-weight:700;font-size:16px;box-shadow:0 8px 24px rgba(16,185,129,.4);">
        <i class="fas fa-phone-alt"></i> Call: 9912399224
      </a>
      <a href="#contact-form" style="display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#F59E0B,#D97706);color:white;padding:14px 28px;border-radius:12px;text-decoration:none;font-weight:700;font-size:16px;box-shadow:0 8px 24px rgba(245,158,11,.4);">
        <i class="fas fa-clipboard-check"></i> Get Free Quote
      </a>
      <a href="https://wa.me/919912399224?text=<?php echo urlencode('Hi GCM Safety Nets, I need ' . $service_name . ' in ' . $area_name); ?>" target="_blank" style="display:inline-flex;align-items:center;gap:10px;background:#25D366;color:white;padding:14px 24px;border-radius:12px;text-decoration:none;font-weight:700;font-size:16px;">
        <i class="fab fa-whatsapp"></i> WhatsApp Us
      </a>
    </div>

    <!-- Trust Badges -->
    <div style="display:flex;gap:24px;flex-wrap:wrap;padding-top:12px;border-top:1px solid rgba(255,255,255,.15);">
      <span style="color:rgba(255,255,255,.95);font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fas fa-check-circle" style="color:#10B981;"></i> Garware Certified Nets</span>
      <span style="color:rgba(255,255,255,.95);font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fas fa-shield-alt" style="color:#10B981;"></i> 5-Year Written Warranty</span>
      <span style="color:rgba(255,255,255,.95);font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fas fa-clock" style="color:#10B981;"></i> Same-Day Service in <?php echo $area_name; ?></span>
      <span style="color:rgba(255,255,255,.95);font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fas fa-star" style="color:#F59E0B;"></i> 4.9/5 Rated (1,280+ Reviews)</span>
    </div>
  </div>
</section>

<!-- Main Page Layout Container -->
<div class="gcm-wrap">
  <div class="gcm-grid">

    <!-- Main Content Column -->
    <div class="gcm-main">

      <?php if (!empty($custom_content)): ?>
        <!-- Preserved Unique Custom Content -->
        <div class="gcm-card">
          <div class="gcm-content">
            <?php echo $custom_content; ?>
          </div>
        </div>
        <!-- Section 1: Overview in Area -->
        <div class="gcm-card">
          <h2 style="font-size:26px;color:#1e293b;margin-top:0;margin-bottom:16px;font-weight:700;">
            Professional <?php echo $service_name; ?> in <?php echo $area_name; ?>, Hyderabad
          </h2>
          <p style="font-size:16px;line-height:1.7;color:#475569;margin-bottom:16px;">
            Are you looking for reliable and high-quality <strong><?php echo $service_name; ?> in <?php echo $area_name; ?></strong>? 
            <strong>GCM Safety Nets</strong> is Hyderabad's trusted pioneer in residential and commercial netting solutions. Whether you live in a high-rise apartment, gated villa community, or manage an office complex in <strong><?php echo $area_name; ?></strong>, our team provides custom-measured, precision-engineered netting to protect your premises.
          </p>
          <p style="font-size:16px;line-height:1.7;color:#475569;margin-bottom:16px;">
            Rapid urbanization and construction around <strong><?php echo $area_name; ?></strong> and neighbouring areas of Hyderabad often attract birds and pigeons looking for nesting spots on balconies, AC ledges, and window sills. Our UV-treated, translucent netting stops bird droppings and eliminates health risks while preserving complete ventilation, panoramic outdoor views, and aesthetic charm.
          </p>
        </div>
      <?php endif; ?>

        <!-- Section 2: Technical Specifications -->
        <div class="gcm-card">
          <h2 style="font-size:24px;color:#1e293b;margin-top:0;margin-bottom:16px;font-weight:700;">
            Material Specifications &amp; Durability Standards
          </h2>
          <p style="font-size:15px;color:#64748b;margin-bottom:20px;">
            We exclusively use tested industrial-grade materials designed to endure Hyderabad's intense heat, heavy monsoon rain, and high wind pressure:
          </p>
          
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:16px;margin-bottom:20px;">
            <div style="background:#f8fafc;padding:18px;border-radius:10px;border-left:4px solid #10B981;">
              <strong style="display:block;color:#0f172a;font-size:15px;margin-bottom:4px;">Raw Material Quality</strong>
              <span style="color:#475569;font-size:14px;"><?php echo $specs['material']; ?></span>
            </div>
            <div style="background:#f8fafc;padding:18px;border-radius:10px;border-left:4px solid #3b82f6;">
              <strong style="display:block;color:#0f172a;font-size:15px;margin-bottom:4px;">Mesh Sizing</strong>
              <span style="color:#475569;font-size:14px;"><?php echo $specs['mesh_size']; ?></span>
            </div>
            <div style="background:#f8fafc;padding:18px;border-radius:10px;border-left:4px solid #f59e0b;">
              <strong style="display:block;color:#0f172a;font-size:15px;margin-bottom:4px;">Tensile Cord Thickness</strong>
              <span style="color:#475569;font-size:14px;"><?php echo $specs['thickness']; ?></span>
            </div>
            <div style="background:#f8fafc;padding:18px;border-radius:10px;border-left:4px solid #8b5cf6;">
              <strong style="display:block;color:#0f172a;font-size:15px;margin-bottom:4px;">Impact Breaking Load</strong>
              <span style="color:#475569;font-size:14px;"><?php echo $specs['breaking_load']; ?></span>
            </div>
          </div>
        </div>

        <!-- Section 3: Why Choose GCM in this Area -->
        <div class="gcm-card">
          <h2 style="font-size:24px;color:#1e293b;margin-top:0;margin-bottom:16px;font-weight:700;">
            Why Choose GCM Safety Nets in <?php echo $area_name; ?>?
          </h2>
          <ul style="list-style:none;padding:0;margin:0;display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:14px;">
            <li style="display:flex;align-items:flex-start;gap:12px;font-size:15px;color:#334155;">
              <i class="fas fa-shield-alt" style="color:#10B981;font-size:18px;margin-top:3px;"></i>
              <span><strong>5-Year Written Warranty:</strong> Complete replacement warranty against sunlight deterioration and breaking.</span>
            </li>
            <li style="display:flex;align-items:flex-start;gap:12px;font-size:15px;color:#334155;">
              <i class="fas fa-bolt" style="color:#3b82f6;font-size:18px;margin-top:3px;"></i>
              <span><strong>Rapid Same-Day Service:</strong> Local technicians available across <?php echo $area_name; ?> for urgent installations.</span>
            </li>
            <li style="display:flex;align-items:flex-start;gap:12px;font-size:15px;color:#334155;">
              <i class="fas fa-anchor" style="color:#f59e0b;font-size:18px;margin-top:3px;"></i>
              <span><strong>Corrosion-Proof Anchors:</strong> Stainless steel (SS) hook fasteners that never rust or stain your building walls.</span>
            </li>
            <li style="display:flex;align-items:flex-start;gap:12px;font-size:15px;color:#334155;">
              <i class="fas fa-rupee-sign" style="color:#10B981;font-size:18px;margin-top:3px;"></i>
              <span><strong>Transparent Pricing:</strong> Free on-site inspection, zero hidden charges, and best price guarantee.</span>
            </li>
          </ul>
        </div>

        <!-- Section 4: Installation Process -->
        <div class="gcm-card">
          <h2 style="font-size:24px;color:#1e293b;margin-top:0;margin-bottom:16px;font-weight:700;">
            Our 5-Step Installation Process in <?php echo $area_name; ?>
          </h2>
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));gap:14px;">
            <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
              <div style="width:40px;height:40px;background:#10B981;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-weight:700;">1</div>
              <strong style="display:block;font-size:14px;color:#1e293b;margin-bottom:4px;">Free Site Visit</strong>
              <p style="font-size:13px;color:#64748b;margin:0;">Doorstep measurement in <?php echo $area_name; ?></p>
            </div>
            <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
              <div style="width:40px;height:40px;background:#3b82f6;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-weight:700;">2</div>
              <strong style="display:block;font-size:14px;color:#1e293b;margin-bottom:4px;">Exact Quotation</strong>
              <p style="font-size:13px;color:#64748b;margin:0;">Upfront pricing with material choices</p>
            </div>
            <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
              <div style="width:40px;height:40px;background:#f59e0b;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-weight:700;">3</div>
              <strong style="display:block;font-size:14px;color:#1e293b;margin-bottom:4px;">Anchor Fastening</strong>
              <p style="font-size:13px;color:#64748b;margin:0;">Heavy-duty stainless steel wall anchors</p>
            </div>
            <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
              <div style="width:40px;height:40px;background:#8b5cf6;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-weight:700;">4</div>
              <strong style="display:block;font-size:14px;color:#1e293b;margin-bottom:4px;">Tension Fitting</strong>
              <p style="font-size:13px;color:#64748b;margin:0;">Tight lacing with zero sagging</p>
            </div>
            <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
              <div style="width:40px;height:40px;background:#059669;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-weight:700;">5</div>
              <strong style="display:block;font-size:14px;color:#1e293b;margin-bottom:4px;">Warranty Card</strong>
              <p style="font-size:13px;color:#64748b;margin:0;">5-Year written assurance handed over</p>
            </div>
          </div>
        </div>

        <!-- Section 5: Transparent Pricing Table -->
        <div class="gcm-card">
          <h2 style="font-size:24px;color:#1e293b;margin-top:0;margin-bottom:16px;font-weight:700;">
            <?php echo $service_name; ?> Pricing Guide in <?php echo $area_name; ?>, Hyderabad
          </h2>
          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:15px;">
              <thead>
                <tr style="background:#f1f5f9;text-align:left;">
                  <th style="padding:12px 16px;border-bottom:2px solid #cbd5e1;color:#1e293b;">Netting Type</th>
                  <th style="padding:12px 16px;border-bottom:2px solid #cbd5e1;color:#1e293b;">Material Grade</th>
                  <th style="padding:12px 16px;border-bottom:2px solid #cbd5e1;color:#1e293b;">Estimated Price</th>
                  <th style="padding:12px 16px;border-bottom:2px solid #cbd5e1;color:#1e293b;">Warranty</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;font-weight:600;">Pigeon / Bird Netting</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;">Garware Virgin Nylon</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#10B981;font-weight:700;">₹18 - ₹25 / sq.ft.</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">5 Years</td>
                </tr>
                <tr style="background:#fafafa;">
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;font-weight:600;">Balcony Child Safety Nets</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;">High-Tensile Braided Cord</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#10B981;font-weight:700;">₹22 - ₹35 / sq.ft.</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">5 Years</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;font-weight:600;">Invisible Grills</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;">AISI 316 Stainless Steel Wire</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#10B981;font-weight:700;">₹110 - ₹160 / sq.ft.</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">5 to 10 Years</td>
                </tr>
                <tr style="background:#fafafa;">
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;font-weight:600;">Cricket &amp; Sports Nets</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;">Heavy UV-Resistant HDPE</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#10B981;font-weight:700;">₹16 - ₹26 / sq.ft.</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">3 to 5 Years</td>
                </tr>
              </tbody>
            </table>
          </div>
          <p style="font-size:13px;color:#94a3b8;margin-top:10px;margin-bottom:0;">* Note: Exact pricing is determined after site inspection based on balcony height, scaffolding requirement, and total square footage.</p>
        </div>

        <!-- Section 6: FAQs -->
        <div class="gcm-card">
          <h2 style="font-size:24px;color:#1e293b;margin-top:0;margin-bottom:20px;font-weight:700;">
            Frequently Asked Questions about <?php echo $service_name; ?> in <?php echo $area_name; ?>
          </h2>
          
          <?php foreach ($faqs_data as $idx => $f): ?>
            <div style="margin-bottom:16px;padding:16px 20px;background:#f8fafc;border-radius:10px;border-left:4px solid #6366f1;">
              <h3 style="font-size:16px;color:#1e293b;margin:0 0 8px;font-weight:700;">
                Q: <?php echo htmlspecialchars($f['q']); ?>
              </h3>
              <p style="font-size:15px;line-height:1.6;color:#475569;margin:0;">
                <?php echo htmlspecialchars($f['a']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Section 7: Customer Reviews -->
        <div class="gcm-card">
          <h2 style="font-size:24px;color:#1e293b;margin-top:0;margin-bottom:16px;font-weight:700;">
            Verified Customer Reviews from <?php echo $area_name; ?> &amp; Hyderabad
          </h2>
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:16px;">
            <div style="background:#f8fafc;padding:18px;border-radius:10px;border:1px solid #e2e8f0;">
              <div style="color:#f59e0b;font-size:14px;margin-bottom:8px;">&#9733;&#9733;&#9733;&#9733;&#9733; (5/5)</div>
              <p style="font-size:14px;color:#334155;line-height:1.5;margin-bottom:10px;">
                "Outstanding installation of <?php echo strtolower($service_name); ?> in our apartment at <?php echo $area_name; ?>. The team arrived on time, installed within 2 hours, and left everything spotless. Highly recommended!"
              </p>
              <strong style="font-size:13px;color:#0f172a;">Rajesh V. — Resident, <?php echo $area_name; ?></strong>
            </div>
            <div style="background:#f8fafc;padding:18px;border-radius:10px;border:1px solid #e2e8f0;">
              <div style="color:#f59e0b;font-size:14px;margin-bottom:8px;">&#9733;&#9733;&#9733;&#9733;&#9733; (5/5)</div>
              <p style="font-size:14px;color:#334155;line-height:1.5;margin-bottom:10px;">
                "Very prompt and professional service in <?php echo $area_name; ?>. The Garware net quality is solid and invisible from a distance. Pigeon trouble completely stopped from day one."
              </p>
              <strong style="font-size:13px;color:#0f172a;">Sneha Reddy — <?php echo $area_name; ?>, Hyderabad</strong>
            </div>
          </div>
        </div>

      <!-- Section 8: Nearby Localities in Hyderabad (Cross-Linking) -->
      <div class="gcm-card">
        <h3 style="font-size:20px;color:#1e293b;margin-top:0;margin-bottom:14px;font-weight:700;">
          <?php echo $service_name; ?> in Nearby Hyderabad Localities
        </h3>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
          <?php foreach ($_nearby_areas as $_nb): ?>
            <?php if ($_nb['area_slug'] !== $area_slug): ?>
              <a href="<?php echo SITE_URL . '/' . $service_slug . '-in-' . $_nb['area_slug']; ?>" 
                 style="display:inline-block;padding:7px 14px;background:#f1f5f9;color:#334155;text-decoration:none;border-radius:8px;font-size:13px;transition:all .2s;"
                 onmouseover="this.style.background='#10b981';this.style.color='#fff';"
                 onmouseout="this.style.background='#f1f5f9';this.style.color='#334155';">
                <?php echo $service_name; ?> in <?php echo htmlspecialchars($_nb['area_name']); ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>

    </div><!-- /main -->

    <!-- Sidebar Column -->
    <div class="gcm-sidebar">

      <!-- Fast Free Quote Form -->
      <div class="gcm-card" id="contact-form">
        <h3 class="gcm-sb-title" style="margin-top:0;margin-bottom:12px;color:#0f172a;">
          &#128221; Get Free Quote in <?php echo $area_name; ?>
        </h3>
        <p style="font-size:13px;color:#64748b;margin-bottom:14px;">
          Fill in details for instant quote &amp; free doorstep inspection today:
        </p>

        <div id="gcm-form-msg" style="display:none;padding:10px 14px;border-radius:8px;margin-bottom:12px;font-size:14px;font-weight:600;"></div>

        <form id="gcm-inquiry-form" onsubmit="gcmSubmitForm(event)">
          <input type="hidden" name="form_type" value="service_area_page">
          <input type="hidden" name="service"   value="<?php echo $service_name; ?>">
          <input type="hidden" name="area"      value="<?php echo $area_name; ?>">

          <input type="text" name="name" placeholder="Your Name *" required minlength="3" 
                 style="width:100%;padding:11px 12px;border:1.5px solid #e2e8f0;border-radius:8px;margin-bottom:10px;font-size:14px;outline:none;">

          <input type="tel" name="phone" placeholder="Phone Number *" required pattern="[6-9][0-9]{9}" title="10-digit Indian mobile number" 
                 style="width:100%;padding:11px 12px;border:1.5px solid #e2e8f0;border-radius:8px;margin-bottom:10px;font-size:14px;outline:none;">

          <input type="email" name="email" placeholder="Email Address *" required 
                 style="width:100%;padding:11px 12px;border:1.5px solid #e2e8f0;border-radius:8px;margin-bottom:10px;font-size:14px;outline:none;">

          <textarea name="message" placeholder="Your requirement (e.g. 2 balconies, Pigeon netting) *" rows="3" required minlength="10" 
                    style="width:100%;padding:11px 12px;border:1.5px solid #e2e8f0;border-radius:8px;margin-bottom:10px;font-size:14px;resize:vertical;outline:none;"></textarea>

          <button type="submit" id="gcm-form-btn" 
                  style="width:100%;background:linear-gradient(135deg,#10B981,#059669);color:white;border:none;padding:13px;border-radius:8px;font-weight:700;cursor:pointer;font-size:15px;box-shadow:0 4px 12px rgba(16,185,129,.3);">
            Submit Inquiry &#x27A4;
          </button>
        </form>

        <script>
        function gcmSubmitForm(e){
          e.preventDefault();
          var btn = document.getElementById('gcm-form-btn');
          var msg = document.getElementById('gcm-form-msg');
          btn.disabled = true; btn.textContent = 'Submitting...';
          var fd = new FormData(document.getElementById('gcm-inquiry-form'));
          fetch('<?php echo SITE_URL; ?>/contact.php', { method: 'POST', body: fd })
            .then(function(r){ return r.json(); })
            .then(function(d){
              msg.style.display = 'block';
              if(d.success){
                msg.style.background = '#d1fae5'; msg.style.color = '#065f46';
                msg.innerHTML = '&#10003; ' + d.message;
                document.getElementById('gcm-inquiry-form').reset();
                btn.textContent = 'Sent Successfully!';
              } else {
                msg.style.background = '#fee2e2'; msg.style.color = '#991b1b';
                msg.innerHTML = '&#9888; ' + (d.message || 'Error occurred.');
                btn.disabled = false; btn.textContent = 'Submit Inquiry \u27a4';
              }
            })
            .catch(function(){
              msg.style.display = 'block'; msg.style.background = '#fee2e2'; msg.style.color = '#991b1b';
              msg.innerHTML = '&#9888; Please call us directly at 9912399224.';
              btn.disabled = false; btn.textContent = 'Submit Inquiry \u27a4';
            });
        }
        </script>
      </div>

      <!-- Quick Call Badge -->
      <div class="gcm-card" style="background:linear-gradient(135deg,#0f172a,#1e293b);color:white;">
        <h4 style="color:#fff;margin:0 0 8px;font-size:18px;">&#128222; Need Instant Help?</h4>
        <p style="font-size:14px;color:rgba(255,255,255,.8);margin:0 0 14px;">
          Speak directly with our Hyderabad netting specialist for <?php echo $area_name; ?>:
        </p>
        <a href="tel:+919912399224" style="display:block;background:#10B981;color:white;text-align:center;padding:12px;border-radius:8px;font-weight:700;font-size:16px;text-decoration:none;">
          Call: 9912399224
        </a>
      </div>

      <!-- All Services in this Area -->
      <?php if (!empty($_cat_kws)): ?>
      <div class="gcm-card">
        <h3 class="gcm-sb-title" style="margin-top:0;">All Services in <?php echo $area_name; ?></h3>
        <div class="gcm-sb-links" style="max-height:360px;overflow-y:auto;">
          <?php foreach($_cat_kws as $_kw): ?>
            <?php $_isActive = ($_kw['keyword_slug'] === $service_slug); ?>
            <a href="<?php echo SITE_URL . '/' . $_kw['keyword_slug'] . '-in-' . $area_slug; ?>"
               class="<?php echo $_isActive ? 'active' : ''; ?>"
               style="<?php echo $_isActive ? 'font-weight:700;color:#10B981;' : ''; ?>">
              <?php if($_isActive): ?>&#128205; <?php endif; ?><?php echo htmlspecialchars($_kw['keyword_name']); ?> in <?php echo $area_name; ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- This Service in All Areas -->
      <?php if (!empty($_all_areas)): ?>
      <div class="gcm-card">
        <h3 class="gcm-sb-title" style="margin-top:0;"><?php echo $service_name; ?> in Hyderabad Areas</h3>
        <div class="gcm-sb-links" style="max-height:360px;overflow-y:auto;">
          <?php foreach($_all_areas as $_a): ?>
            <?php $_isActive = ($_a['area_slug'] === $area_slug); ?>
            <a href="<?php echo SITE_URL . '/' . $service_slug . '-in-' . $_a['area_slug']; ?>"
               class="<?php echo $_isActive ? 'active' : ''; ?>"
               style="<?php echo $_isActive ? 'font-weight:700;color:#10B981;' : ''; ?>">
              <?php if($_isActive): ?>&#128205; <?php endif; ?><?php echo $service_name; ?> in <?php echo htmlspecialchars($_a['area_name']); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </div><!-- /sidebar -->

  </div>
</div>

<?php
// Include Modern Footer
include __DIR__ . '/includes/modern-footer.php';
?>
