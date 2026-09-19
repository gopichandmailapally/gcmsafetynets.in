<?php
/**
 * Centralized SEO, GEO (Generative Engine Optimization) & AEO (Answer Engine Optimization) Engine
 * Outputs dynamic Canonical URLs, OpenGraph, Twitter Cards, Geo Tags, and Multi-Entity JSON-LD Schema
 */

if (!defined('GCM_INIT')) {
    die('Direct access not permitted');
}

function gcm_render_seo_head() {
    global $page_title, $meta_description, $meta_keywords, $current_page;

    // Detect Canonical URL (always clean, https, www, no query params, no .php)
    $raw_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $clean_uri = preg_replace('/\.php$/i', '', $raw_uri);
    $clean_uri = rtrim($clean_uri, '/');
    if ($clean_uri === '' || $clean_uri === '/index') {
        $canonical_url = 'https://www.gcmsafetynets.in/';
    } else {
        $canonical_url = 'https://www.gcmsafetynets.in' . $clean_uri;
    }

    $title = $page_title ?? "Hyderabad's Largest Netting Solutions Provider | GCM Safety Nets";
    if (strpos($title, 'GCM Safety Nets') === false) {
        $title .= ' | GCM Safety Nets';
    }

    $desc = $meta_description ?? 'Professional safety nets, pigeon nets, bird nets, invisible grills, sports nets, and cloth hangers installation in Hyderabad. 5 Year Warranty. Free inspection. Call 9912399224.';
    $kw = $meta_keywords ?? 'safety nets hyderabad, pigeon nets near me, balcony safety nets, bird netting, invisible grills, gcm safety nets';

    // Context Detection: Area page vs Pillar vs Home
    $is_area_page = (strpos($clean_uri, '-in-') !== false);
    $area_name = 'Hyderabad';
    $service_name = 'Safety Nets Installation';

    if ($is_area_page) {
        $parts = explode('-in-', trim($clean_uri, '/'));
        if (count($parts) >= 2) {
            $service_slug = $parts[0];
            $area_slug = $parts[1];
            $service_name = ucwords(str_replace('-', ' ', $service_slug));
            $area_name = ucwords(str_replace('-', ' ', $area_slug));
        }
    } elseif ($clean_uri !== '' && $clean_uri !== '/') {
        $slug = trim($clean_uri, '/');
        $service_name = ucwords(str_replace('-', ' ', $slug));
    }

    $default_image = 'https://www.gcmsafetynets.in/assets/img/services/pigeon-nets.jpg';
    $logo_image = 'https://www.gcmsafetynets.in/uploads/logo.png';
    ?>

    <!-- Canonical Tag -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">

    <!-- Geo Meta Tags for Local & Maps Search (AEO & Local SEO) -->
    <meta name="geo.region" content="IN-TG">
    <meta name="geo.placename" content="<?php echo htmlspecialchars($area_name . ', Hyderabad'); ?>">
    <meta name="geo.position" content="17.385044;78.486671">
    <meta name="ICBM" content="17.385044, 78.486671">

    <!-- Open Graph (Facebook, WhatsApp, LinkedIn) -->
    <meta property="og:locale" content="en_IN">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($desc); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:site_name" content="GCM Safety Nets">
    <meta property="og:image" content="<?php echo $default_image; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($desc); ?>">
    <meta name="twitter:image" content="<?php echo $default_image; ?>">

    <!-- AI & Generative Engine Optimization (GEO) Directives -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <!-- JSON-LD Structured Data Engine -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "HomeAndConstructionBusiness",
          "@id": "https://www.gcmsafetynets.in/#localbusiness",
          "name": "GCM Safety Nets",
          "alternateName": "GCM Enterprises",
          "url": "https://www.gcmsafetynets.in",
          "telephone": "+91-9912399224",
          "email": "gcmsafetynets@gmail.com",
          "priceRange": "₹₹",
          "image": "<?php echo $default_image; ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "<?php echo $logo_image; ?>"
          },
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Plot No 42, H.No 2-3-512/A, B.S. Maktha, Begumpet",
            "addressLocality": "Hyderabad",
            "addressRegion": "Telangana",
            "postalCode": "500016",
            "addressCountry": "IN"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 17.385044,
            "longitude": 78.486671
          },
          "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "07:00",
            "closes": "21:00"
          },
          "areaServed": [
            { "@type": "City", "name": "Hyderabad" },
            { "@type": "City", "name": "Secunderabad" },
            { "@type": "AdministrativeArea", "name": "Telangana" }
          ],
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "1280",
            "bestRating": "5",
            "worstRating": "1"
          },
          "sameAs": [
            "https://www.facebook.com/gcmsafetynets",
            "https://www.instagram.com/gcmsafetynets",
            "https://maps.google.com/?cid=123456789"
          ]
        },
        {
          "@type": "Service",
          "@id": "<?php echo htmlspecialchars($canonical_url); ?>#service",
          "name": "<?php echo htmlspecialchars($service_name . ' in ' . $area_name); ?>",
          "serviceType": "<?php echo htmlspecialchars($service_name); ?>",
          "provider": { "@id": "https://www.gcmsafetynets.in/#localbusiness" },
          "areaServed": {
            "@type": "Place",
            "name": "<?php echo htmlspecialchars($area_name . ', Hyderabad'); ?>"
          },
          "offers": {
            "@type": "Offer",
            "priceCurrency": "INR",
            "priceSpecification": {
              "@type": "UnitPriceSpecification",
              "price": "18.00",
              "priceCurrency": "INR",
              "unitText": "SQFT"
            },
            "availability": "https://schema.org/InStock",
            "validFrom": "2026-01-01"
          },
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Safety Netting Installation Solutions",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Balcony Safety Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Pigeon Safety Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Anti Bird Netting" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Balcony Invisible Grills" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Cricket Practice Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Ceiling Cloth Drying Hangers" } }
            ]
          }
        },
        {
          "@type": "BreadcrumbList",
          "@id": "<?php echo htmlspecialchars($canonical_url); ?>#breadcrumb",
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
              "item": "https://www.gcmsafetynets.in/all-areas"
            }
            <?php if ($is_area_page): ?>
            ,{
              "@type": "ListItem",
              "position": 3,
              "name": "<?php echo htmlspecialchars($service_name . ' in ' . $area_name); ?>",
              "item": "<?php echo htmlspecialchars($canonical_url); ?>"
            }
            <?php endif; ?>
          ]
        },
        {
          "@type": "FAQPage",
          "@id": "<?php echo htmlspecialchars($canonical_url); ?>#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is the starting price for safety nets installation in <?php echo htmlspecialchars($area_name); ?>, Hyderabad?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Safety net installation by GCM Safety Nets in <?php echo htmlspecialchars($area_name); ?>, Hyderabad starts from ₹18 to ₹28 per square foot depending on material grade (Garware Nylon or HDPE monofilament). Free doorstep inspection and exact quotes are provided with zero obligation."
              }
            },
            {
              "@type": "Question",
              "name": "Do you provide same day safety nets installation in <?php echo htmlspecialchars($area_name); ?>?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, GCM Safety Nets offers same-day inspection and installation services across <?php echo htmlspecialchars($area_name); ?> and all 188+ areas in Hyderabad. Typical balcony installation takes only 1 to 2 hours."
              }
            },
            {
              "@type": "Question",
              "name": "What warranty comes with GCM Safety Nets in Hyderabad?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "We provide a genuine 5-year warranty with a certified warranty card. Our nets are UV-stabilized, weather-resistant, and installed with marine-grade 316 stainless steel hooks."
              }
            },
            {
              "@type": "Question",
              "name": "How can I book safety net installation near me in <?php echo htmlspecialchars($area_name); ?>?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "You can call or WhatsApp our Hyderabad customer support directly at +91 99123 99224 for immediate free inspection booking and same-day service."
              }
            }
          ]
        }
      ]
    }
    </script>
    <?php
}
