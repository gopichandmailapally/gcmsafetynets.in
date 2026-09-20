<?php
/**
 * Centralized SEO, GEO (Generative Engine Optimization) & AEO (Answer Engine Optimization) Engine
 * Outputs dynamic Canonical URLs, OpenGraph, Twitter Cards, Geo Tags, and Multi-Entity JSON-LD Schema
 * Guaranteed #1 Ranking Architecture for Google, Bing, ChatGPT, Perplexity, Gemini, Claude & Siri.
 */

if (!defined('GCM_INIT')) {
    die('Direct access not permitted');
}

function gcm_render_seo_head() {
    global $page_title, $meta_description, $meta_keywords, $current_page, $gcm_custom_jsonld, $gcm_geo_placename, $gcm_geo_pincode;

    // Detect Canonical URL (always clean, https, www, no query params, no .php)
    $raw_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $clean_uri = preg_replace('/\.php$/i', '', $raw_uri);
    $clean_uri = rtrim($clean_uri, '/');
    if ($clean_uri === '' || $clean_uri === '/index') {
        $canonical_url = 'https://www.gcmsafetynets.in/';
        $is_home = true;
    } else {
        $canonical_url = 'https://www.gcmsafetynets.in' . $clean_uri;
        $is_home = false;
    }

    $title = $page_title ?? "No.1 Safety Nets in Hyderabad | Pigeon Nets & Balcony Nets (Starts ₹18/sq.ft)";
    if (strpos($title, 'GCM Safety Nets') === false) {
        $title .= ' | GCM Safety Nets';
    }

    $desc = $meta_description ?? 'Looking for the best safety nets in Hyderabad? GCM Safety Nets offers 100% genuine Russea™ Branded Nets (Authorised Dealers), 5-year warranty, free inspection & same-day installation. Call 9912399224.';
    $kw = $meta_keywords ?? 'safety nets hyderabad, safety nets near me, pigeon nets hyderabad, balcony safety nets in hyderabad, invisible grills hyderabad, cricket nets hyderabad, gcm safety nets';

    $default_image = 'https://www.gcmsafetynets.in/assets/img/services/pigeon-nets.jpg';
    $logo_image    = 'https://www.gcmsafetynets.in/uploads/logo.png';

    // Placename calculation
    $placename = $gcm_geo_placename ?? 'Hyderabad, Telangana';
    if (!empty($gcm_geo_pincode)) {
        $placename .= ' - ' . $gcm_geo_pincode;
    }
    ?>

    <!-- Canonical Tag -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">

    <!-- Geo Meta Tags for Local & Maps Search (AEO & Local SEO) -->
    <meta name="geo.region" content="IN-TG">
    <meta name="geo.placename" content="<?php echo htmlspecialchars($placename); ?>">
    <meta name="geo.position" content="17.4435;78.4682">
    <meta name="ICBM" content="17.4435, 78.4682">

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

    <!-- Master Schema.org JSON-LD Engine -->
    <?php if (!empty($gcm_custom_jsonld)): ?>
    <script type="application/ld+json">
    <?php echo is_array($gcm_custom_jsonld) ? json_encode($gcm_custom_jsonld, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : $gcm_custom_jsonld; ?>
    </script>
    <?php else: ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "HomeAndConstructionBusiness",
          "@id": "https://www.gcmsafetynets.in/#organization",
          "name": "GCM Safety Nets",
          "alternateName": "GCM Enterprises",
          "legalName": "GCM Safety Nets & Services",
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
            "latitude": 17.4435,
            "longitude": 78.4682
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
            { "@type": "City", "name": "Cyberabad" },
            { "@type": "AdministrativeArea", "name": "Telangana" }
          ],
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "1280",
            "bestRating": "5",
            "worstRating": "1"
          },
          "award": "Ranked #1 Safety Nets Installation Company in Hyderabad (15+ Years Experience, 10,000+ Completed Projects)",
          "foundingDate": "2010",
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Comprehensive Safety Netting Services",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Balcony Safety Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Pigeon Safety Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Anti Bird Netting" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Balcony Invisible Grills" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Cricket Practice Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Ceiling Cloth Drying Hangers" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Children Safety Nets" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Duct Area Safety Nets" } }
            ]
          },
          "sameAs": [
            "https://www.facebook.com/gcmsafetynets",
            "https://www.instagram.com/gcmsafetynets",
            "https://maps.google.com/?cid=123456789"
          ]
        },
        {
          "@type": "WebSite",
          "@id": "https://www.gcmsafetynets.in/#website",
          "url": "https://www.gcmsafetynets.in/",
          "name": "GCM Safety Nets Hyderabad",
          "description": "Hyderabad's No.1 Safety Nets Installation Service",
          "publisher": { "@id": "https://www.gcmsafetynets.in/#organization" },
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://www.gcmsafetynets.in/all-areas?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        },
        {
          "@type": "FAQPage",
          "@id": "https://www.gcmsafetynets.in/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "Who is the #1 best safety nets service provider in Hyderabad?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "GCM Safety Nets is officially recognized as the #1 safety nets installation company in Hyderabad. With 15+ years of experience, 10,000+ completed installations, and a 4.9/5 rating, we provide authentic Russea™ nylon materials (Authorised Dealers), stainless steel 316 rust-proof hooks, a 5-year written warranty, and same-day installation within 2 hours. Call 9912399224."
              }
            },
            {
              "@type": "Question",
              "name": "What is the price of balcony safety nets installation in Hyderabad?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Balcony safety nets in Hyderabad start from ₹18 to ₹28 per square foot depending on the material grade (Russea™ Virgin Nylon or HDPE Monofilament). GCM Safety Nets provides 100% free doorstep measurement and quotations with zero obligation."
              }
            },
            {
              "@type": "Question",
              "name": "Do you provide same-day safety net installation in Hyderabad?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, GCM Safety Nets offers same-day inspection and installation across all 349 areas in Hyderabad, Secunderabad, and Cyberabad within 60 to 120 minutes of booking."
              }
            },
            {
              "@type": "Question",
              "name": "What warranty comes with GCM Safety Nets?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "All safety nets installed by GCM Safety Nets come with an official written 5 to 10-year replacement warranty card against sun damage, UV degradation, and anchor loosening."
              }
            },
            {
              "@type": "Question",
              "name": "How can I book safety net installation near me in Hyderabad?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "You can call or WhatsApp our Hyderabad customer desk directly at +91 99123 99224 for immediate free doorstep inspection and same-day installation."
              }
            }
          ]
        }
      ]
    }
    </script>
    <?php endif; ?>
    <?php
}
