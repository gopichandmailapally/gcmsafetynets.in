-- ============================================
-- COMPLETE PAGE STRUCTURE DATABASE
-- Permanent storage for services, areas, and pages
-- This ensures accurate counts always
-- ============================================

-- ============================================
-- 1. SERVICES TABLE (64 Keywords)
-- ============================================
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL UNIQUE,
  `category` varchar(50) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_category` (`category`),
  KEY `idx_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert all 64 service keywords
INSERT INTO services (keyword, slug, category) VALUES
-- PIGEON NETS (13 keywords)
('Pigeon Nets', 'pigeon-nets', 'PIGEON NETS'),
('Pigeon Net', 'pigeon-net', 'PIGEON NETS'),
('Balcony Netting', 'balcony-netting', 'PIGEON NETS'),
('Pigeon Net For Balcony', 'pigeon-net-for-balcony', 'PIGEON NETS'),
('Pigeon Nets Installation', 'pigeon-nets-installation', 'PIGEON NETS'),
('Pigeon Bird Netting', 'pigeon-bird-netting', 'PIGEON NETS'),
('Pigeon Net Installation', 'pigeon-net-installation', 'PIGEON NETS'),
('Pigeon Net Near Me', 'pigeon-net-near-me', 'PIGEON NETS'),
('Pigeon Net For Balcony Near Me', 'pigeon-net-for-balcony-near-me', 'PIGEON NETS'),
('Pigeon Net Installation Near Me', 'pigeon-net-installation-near-me', 'PIGEON NETS'),
('Pigeon Safety Nets', 'pigeon-safety-nets', 'PIGEON NETS'),
('Pigeon Net Price', 'pigeon-net-price', 'PIGEON NETS'),
('Kabutar Jali Near Me', 'kabutar-jali-near-me', 'PIGEON NETS'),

-- BIRD NETS (9 keywords)
('Bird Nets', 'bird-nets', 'BIRD NETS'),
('Bird Net', 'bird-net', 'BIRD NETS'),
('Bird Net For Balcony', 'bird-net-for-balcony', 'BIRD NETS'),
('Bird Net Near Me', 'bird-net-near-me', 'BIRD NETS'),
('Nets For Birds', 'nets-for-birds', 'BIRD NETS'),
('Net For Birds', 'net-for-birds', 'BIRD NETS'),
('Industrial Bird Netting', 'industrial-bird-netting', 'BIRD NETS'),
('Bird Netting', 'bird-netting', 'BIRD NETS'),
('Anti Bird Netting', 'anti-bird-netting', 'BIRD NETS'),

-- SAFETY NETS (11 keywords)
('Safety Nets', 'safety-nets', 'SAFETY NETS'),
('Balcony Safety Nets', 'balcony-safety-nets', 'SAFETY NETS'),
('Safety Nets For Balconies', 'safety-nets-for-balconies', 'SAFETY NETS'),
('Duct Area Safety Nets', 'duct-area-safety-nets', 'SAFETY NETS'),
('Monkey Safety Nets', 'monkey-safety-nets', 'SAFETY NETS'),
('Construction Safety Nets', 'construction-safety-nets', 'SAFETY NETS'),
('Industrial Safety Nets', 'industrial-safety-nets', 'SAFETY NETS'),
('Fall Safety Nets', 'fall-safety-nets', 'SAFETY NETS'),
('Fall Protection Nets', 'fall-protection-nets', 'SAFETY NETS'),
('Children Safety Nets', 'children-safety-nets', 'SAFETY NETS'),
('Pet Safety Nets', 'pet-safety-nets', 'SAFETY NETS'),

-- SPORTS NETS (13 keywords)
('Cricket Nets', 'cricket-nets', 'SPORTS NETS'),
('Cricket Nets Price', 'cricket-nets-price', 'SPORTS NETS'),
('Cricket Nets Near Me', 'cricket-nets-near-me', 'SPORTS NETS'),
('Cricket Practice Net', 'cricket-practice-net', 'SPORTS NETS'),
('Cricket Practice Nets', 'cricket-practice-nets', 'SPORTS NETS'),
('Cricket Net Price', 'cricket-net-price', 'SPORTS NETS'),
('Cricket Indoor Nets Near Me', 'cricket-indoor-nets-near-me', 'SPORTS NETS'),
('Indoor Cricket Nets Near Me', 'indoor-cricket-nets-near-me', 'SPORTS NETS'),
('Sports Nets', 'sports-nets', 'SPORTS NETS'),
('Sports Netting', 'sports-netting', 'SPORTS NETS'),
('Cricket Netting', 'cricket-netting', 'SPORTS NETS'),
('Box Cricket Net', 'box-cricket-net', 'SPORTS NETS'),
('Cricket Net Installation', 'cricket-net-installation', 'SPORTS NETS'),

-- INVISIBLE GRILLS (9 keywords)
('Invisible Grills', 'invisible-grills', 'INVISIBLE GRILLS'),
('Invisible Grill Near Me', 'invisible-grill-near-me', 'INVISIBLE GRILLS'),
('SS Invisible Grills', 'ss-invisible-grills', 'INVISIBLE GRILLS'),
('Invisible Grill For Balcony', 'invisible-grill-for-balcony', 'INVISIBLE GRILLS'),
('Balcony Invisible Grill', 'balcony-invisible-grill', 'INVISIBLE GRILLS'),
('Invisible Grill For Balcony Near Me', 'invisible-grill-for-balcony-near-me', 'INVISIBLE GRILLS'),
('Invisible Safety Grill', 'invisible-safety-grill', 'INVISIBLE GRILLS'),
('Invisible Grill For Safety', 'invisible-grill-for-safety', 'INVISIBLE GRILLS'),
('Invisible Grill For Pigeons', 'invisible-grill-for-pigeons', 'INVISIBLE GRILLS'),

-- CLOTH HANGERS (9 keywords)
('Ceiling Cloth Hangers', 'ceiling-cloth-hangers', 'CLOTH HANGERS'),
('Dry Cloth Hangers', 'dry-cloth-hangers', 'CLOTH HANGERS'),
('Cloth Drying Hangers', 'cloth-drying-hangers', 'CLOTH HANGERS'),
('Cloth Hanger For Balcony', 'cloth-hanger-for-balcony', 'CLOTH HANGERS'),
('Pulley Cloth Drying Hanger', 'pulley-cloth-drying-hanger', 'CLOTH HANGERS'),
('Pulley Cloth Hanger', 'pulley-cloth-hanger', 'CLOTH HANGERS'),
('Laundry Hanger Dryer', 'laundry-hanger-dryer', 'CLOTH HANGERS'),
('Clothes Hanger To Dry Clothes', 'clothes-hanger-to-dry-clothes', 'CLOTH HANGERS'),
('Clothes Hanger Drier', 'clothes-hanger-drier', 'CLOTH HANGERS')
ON DUPLICATE KEY UPDATE keyword=VALUES(keyword);

-- ============================================
-- 2. AREAS TABLE (188 Locations)
-- ============================================
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL UNIQUE,
  `zone` varchar(50) DEFAULT 'Hyderabad',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_slug` (`slug`),
  KEY `idx_zone` (`zone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert all 188 areas
INSERT INTO areas (area_name, slug, zone) VALUES
('Abids', 'abids', 'Hyderabad'),
('Adikmet', 'adikmet', 'Hyderabad'),
('Afzalgunj', 'afzalgunj', 'Hyderabad'),
('Aliabad', 'aliabad', 'Hyderabad'),
('Alwal', 'alwal', 'Hyderabad'),
('Amberpet', 'amberpet', 'Hyderabad'),
('Ameerpet', 'ameerpet', 'Hyderabad'),
('Ananthagiri Hills', 'ananthagiri-hills', 'Hyderabad'),
('Asif Nagar', 'asif-nagar', 'Hyderabad'),
('Asifabad', 'asifabad', 'Hyderabad'),
('Attapur', 'attapur', 'Hyderabad'),
('Attapur Metro', 'attapur-metro', 'Hyderabad'),
('Ayyappa Society', 'ayyappa-society', 'Hyderabad'),
('Bachupally', 'bachupally', 'Hyderabad'),
('Badangpet', 'badangpet', 'Hyderabad'),
('Bagh Amberpet', 'bagh-amberpet', 'Hyderabad'),
('Bagh Lingampally', 'bagh-lingampally', 'Hyderabad'),
('Bahadurpura', 'bahadurpura', 'Hyderabad'),
('Balkampet', 'balkampet', 'Hyderabad'),
('Balnagar', 'balnagar', 'Hyderabad'),
('Bandlaguda', 'bandlaguda', 'Hyderabad'),
('Banjara Hills', 'banjara-hills', 'Hyderabad'),
('Barkas', 'barkas', 'Hyderabad'),
('Basheerbagh', 'basheerbagh', 'Hyderabad'),
('Begum Bazar', 'begum-bazar', 'Hyderabad'),
('Begumpet', 'begumpet', 'Hyderabad'),
('Boduppal', 'boduppal', 'Hyderabad'),
('Borabanda', 'borabanda', 'Hyderabad'),
('Bowenpally', 'bowenpally', 'Hyderabad'),
('Boysguda', 'boysguda', 'Hyderabad'),
('Champapet', 'champapet', 'Hyderabad'),
('Chanda Nagar', 'chanda-nagar', 'Hyderabad'),
('Chandanagar', 'chandanagar', 'Hyderabad'),
('Charminar', 'charminar', 'Hyderabad'),
('Chikkadpally', 'chikkadpally', 'Hyderabad'),
('Chintal', 'chintal', 'Hyderabad'),
('Chintalkunta', 'chintalkunta', 'Hyderabad'),
('Dabeerpura', 'dabeerpura', 'Hyderabad'),
('Dammaiguda', 'dammaiguda', 'Hyderabad'),
('Dar-ul-Shifa', 'dar-ul-shifa', 'Hyderabad'),
('Dhoolpet', 'dhoolpet', 'Hyderabad'),
('Dilsukhnagar', 'dilsukhnagar', 'Hyderabad'),
('Domalguda', 'domalguda', 'Hyderabad'),
('Dundigal', 'dundigal', 'Hyderabad'),
('East Marredpally', 'east-marredpally', 'Hyderabad'),
('ECIL', 'ecil', 'Hyderabad'),
('ECIL Cross Roads', 'ecil-cross-roads', 'Hyderabad'),
('Edi Bazar', 'edi-bazar', 'Hyderabad'),
('Erragadda', 'erragadda', 'Hyderabad'),
('Falaknuma', 'falaknuma', 'Hyderabad'),
('Fateh Nagar', 'fateh-nagar', 'Hyderabad'),
('Ferozguda', 'ferozguda', 'Hyderabad'),
('Film Nagar', 'film-nagar', 'Hyderabad'),
('Financial District', 'financial-district', 'Hyderabad'),
('Gachibowli', 'gachibowli', 'Hyderabad'),
('Gaddiannaram', 'gaddiannaram', 'Hyderabad'),
('Gajularamaram', 'gajularamaram', 'Hyderabad'),
('Gandhi Nagar', 'gandhi-nagar', 'Hyderabad'),
('Ghatkesar', 'ghatkesar', 'Hyderabad'),
('Golconda', 'golconda', 'Hyderabad'),
('Goshamahal', 'goshamahal', 'Hyderabad'),
('Gowlidoddy', 'gowlidoddy', 'Hyderabad'),
('Gudimelakunta', 'gudimelakunta', 'Hyderabad'),
('Habsiguda', 'habsiguda', 'Hyderabad'),
('Hafeezpet', 'hafeezpet', 'Hyderabad'),
('Hayathnagar', 'hayathnagar', 'Hyderabad'),
('Himayatnagar', 'himayatnagar', 'Hyderabad'),
('Hitech City', 'hitech-city', 'Hyderabad'),
('Hussainialam', 'hussainialam', 'Hyderabad'),
('Hyderguda', 'hyderguda', 'Hyderabad'),
('Ibrahim Bagh', 'ibrahim-bagh', 'Hyderabad'),
('Ibrahimpatnam', 'ibrahimpatnam', 'Hyderabad'),
('IDA Bollaram', 'ida-bollaram', 'Hyderabad'),
('IS Sadan', 'is-sadan', 'Hyderabad'),
('Izzat Nagar', 'izzat-nagar', 'Hyderabad'),
('Jagadgirigutta', 'jagadgirigutta', 'Hyderabad'),
('Jahanuma', 'jahanuma', 'Hyderabad'),
('Jamia Osmania', 'jamia-osmania', 'Hyderabad'),
('Jeedimetla', 'jeedimetla', 'Hyderabad'),
('Jubilee Hills', 'jubilee-hills', 'Hyderabad'),
('Kachiguda', 'kachiguda', 'Hyderabad'),
('Kailash Nagar', 'kailash-nagar', 'Hyderabad'),
('Kalimandir', 'kalimandir', 'Hyderabad'),
('Kamala Nagar', 'kamala-nagar', 'Hyderabad'),
('Kapra', 'kapra', 'Hyderabad'),
('Karkhana', 'karkhana', 'Hyderabad'),
('Karwan', 'karwan', 'Hyderabad'),
('Kattedan', 'kattedan', 'Hyderabad'),
('Khairtabad', 'khairtabad', 'Hyderabad'),
('Khajaguda', 'khajaguda', 'Hyderabad'),
('Kishanbagh', 'kishanbagh', 'Hyderabad'),
('Kismatkhan Gudda', 'kismatkhan-gudda', 'Hyderabad'),
('Kompally', 'kompally', 'Hyderabad'),
('Kondapur', 'kondapur', 'Hyderabad'),
('Kothapet', 'kothapet', 'Hyderabad'),
('KPHB Colony', 'kphb-colony', 'Hyderabad'),
('Kukatpally', 'kukatpally', 'Hyderabad'),
('Lakdikapul', 'lakdikapul', 'Hyderabad'),
('Lalapet', 'lalapet', 'Hyderabad'),
('Langer Houz', 'langer-houz', 'Hyderabad'),
('LB Nagar', 'lb-nagar', 'Hyderabad'),
('Lingampally', 'lingampally', 'Hyderabad'),
('Madannapet', 'madannapet', 'Hyderabad'),
('Madhapur', 'madhapur', 'Hyderabad'),
('Madinaguda', 'madinaguda', 'Hyderabad'),
('Mahdipatnam', 'mahdipatnam', 'Hyderabad'),
('Malakpet', 'malakpet', 'Hyderabad'),
('Mallapur', 'mallapur', 'Hyderabad'),
('Manikonda', 'manikonda', 'Hyderabad'),
('Marredpally', 'marredpally', 'Hyderabad'),
('Masab Tank', 'masab-tank', 'Hyderabad'),
('Meerpet', 'meerpet', 'Hyderabad'),
('Mehdipatnam', 'mehdipatnam', 'Hyderabad'),
('Mettuguda', 'mettuguda', 'Hyderabad'),
('Miyapur', 'miyapur', 'Hyderabad'),
('Moghalpura', 'moghalpura', 'Hyderabad'),
('Moosarambagh', 'moosarambagh', 'Hyderabad'),
('Moti Nagar', 'moti-nagar', 'Hyderabad'),
('Moula Ali', 'moula-ali', 'Hyderabad'),
('Musheerabad', 'musheerabad', 'Hyderabad'),
('Nacharam', 'nacharam', 'Hyderabad'),
('Nagaram', 'nagaram', 'Hyderabad'),
('Nagole', 'nagole', 'Hyderabad'),
('Nallakunta', 'nallakunta', 'Hyderabad'),
('Nampally', 'nampally', 'Hyderabad'),
('Nanakramguda', 'nanakramguda', 'Hyderabad'),
('Nanal Nagar', 'nanal-nagar', 'Hyderabad'),
('Narayanguda', 'narayanguda', 'Hyderabad'),
('Neredmet', 'neredmet', 'Hyderabad'),
('New Bowenpally', 'new-bowenpally', 'Hyderabad'),
('Nizampet', 'nizampet', 'Hyderabad'),
('Old Bowenpally', 'old-bowenpally', 'Hyderabad'),
('Old City', 'old-city', 'Hyderabad'),
('Old Malakpet', 'old-malakpet', 'Hyderabad'),
('Osman Nagar', 'osman-nagar', 'Hyderabad'),
('Osmangunj', 'osmangunj', 'Hyderabad'),
('Osmania University', 'osmania-university', 'Hyderabad'),
('Padmarao Nagar', 'padmarao-nagar', 'Hyderabad'),
('Panjagutta', 'panjagutta', 'Hyderabad'),
('Panjagutta Circle', 'panjagutta-circle', 'Hyderabad'),
('Paradise', 'paradise', 'Hyderabad'),
('Patancheru', 'patancheru', 'Hyderabad'),
('Patel Road', 'patel-road', 'Hyderabad'),
('Peerzadiguda', 'peerzadiguda', 'Hyderabad'),
('Pragathi Nagar', 'pragathi-nagar', 'Hyderabad'),
('Purani Haveli', 'purani-haveli', 'Hyderabad'),
('Qila Mohd. Nagar', 'qila-mohd-nagar', 'Hyderabad'),
('Quthbullapur', 'quthbullapur', 'Hyderabad'),
('Rajendranagar', 'rajendranagar', 'Hyderabad'),
('Ramakrishna Puram', 'ramakrishna-puram', 'Hyderabad'),
('Ramanthapur', 'ramanthapur', 'Hyderabad'),
('Ramnagar', 'ramnagar', 'Hyderabad'),
('RC Puram', 'rc-puram', 'Hyderabad'),
('Red Hills', 'red-hills', 'Hyderabad'),
('Safilguda', 'safilguda', 'Hyderabad'),
('Saidabad', 'saidabad', 'Hyderabad'),
('Sainikpuri', 'sainikpuri', 'Hyderabad'),
('Sanath Nagar', 'sanath-nagar', 'Hyderabad'),
('Sangareddy', 'sangareddy', 'Hyderabad'),
('Santosh Nagar', 'santosh-nagar', 'Hyderabad'),
('Saroornagar', 'saroornagar', 'Hyderabad'),
('Secunderabad', 'secunderabad', 'Hyderabad'),
('Serilingampally', 'serilingampally', 'Hyderabad'),
('Shaikpet', 'shaikpet', 'Hyderabad'),
('Shamirpet', 'shamirpet', 'Hyderabad'),
('Shamshabad', 'shamshabad', 'Hyderabad'),
('Shankarpally', 'shankarpally', 'Hyderabad'),
('Tank Bund', 'tank-bund', 'Hyderabad'),
('Tappachabutra', 'tappachabutra', 'Hyderabad'),
('Tarnaka', 'tarnaka', 'Hyderabad'),
('Tolichowki', 'tolichowki', 'Hyderabad'),
('Trimulgherry', 'trimulgherry', 'Hyderabad'),
('Umdanagar', 'umdanagar', 'Hyderabad'),
('Uppal', 'uppal', 'Hyderabad'),
('Uppuguda', 'uppuguda', 'Hyderabad'),
('Vanasthalipuram', 'vanasthalipuram', 'Hyderabad'),
('Vengal Rao Nagar', 'vengal-rao-nagar', 'Hyderabad'),
('Vidyanagar', 'vidyanagar', 'Hyderabad'),
('Vikrampuri', 'vikrampuri', 'Hyderabad'),
('Warasiguda', 'warasiguda', 'Hyderabad'),
('West Marredpally', 'west-marredpally', 'Hyderabad'),
('Yakutpura', 'yakutpura', 'Hyderabad'),
('Yousufguda', 'yousufguda', 'Hyderabad'),
('Zakir Hussain Colony', 'zakir-hussain-colony', 'Hyderabad'),
('Zamistanpur', 'zamistanpur', 'Hyderabad'),
('Zeregumbad', 'zeregumbad', 'Hyderabad'),
('Ziaguda', 'ziaguda', 'Hyderabad'),
('Zohra Nagar', 'zohra-nagar', 'Hyderabad')
ON DUPLICATE KEY UPDATE area_name=VALUES(area_name);

-- ============================================
-- 3. PILLAR PAGES TABLE (64 Pages)
-- One pillar page per service keyword
-- ============================================
CREATE TABLE IF NOT EXISTS `pillar_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `page_slug` varchar(200) NOT NULL UNIQUE,
  `page_type` enum('service_pillar') DEFAULT 'service_pillar',
  `is_generated` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_service_id` (`service_id`),
  KEY `idx_slug` (`page_slug`),
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. STATIC PAGES TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS `static_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_slug` varchar(100) NOT NULL UNIQUE,
  `page_type` enum('main','blog','other') DEFAULT 'main',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_slug` (`page_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert static pages
INSERT INTO static_pages (page_name, page_slug, page_type) VALUES
('Homepage', 'index', 'main'),
('About Us', 'about', 'main'),
('Contact', 'contact', 'main'),
('Gallery', 'gallery', 'main'),
('Reviews', 'reviews', 'main'),
('FAQs', 'faqs', 'main'),
('Videos', 'videos', 'main'),
('Estimation', 'estimation', 'main'),
('Privacy Policy', 'privacy-policy', 'main'),
('Terms & Conditions', 'terms-conditions', 'main')
ON DUPLICATE KEY UPDATE page_name=VALUES(page_name);

-- ============================================
-- 5. PAGE COUNT SUMMARY TABLE
-- Automatically calculated counts
-- ============================================
CREATE TABLE IF NOT EXISTS `page_count_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `calculation` varchar(200) DEFAULT NULL,
  `last_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_type` (`page_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert calculated counts
INSERT INTO page_count_summary (page_type, count, calculation) VALUES
('services', 64, 'COUNT(services)'),
('areas', 188, 'COUNT(areas)'),
('service_pages', 12032, '64 services × 188 areas'),
('pillar_pages', 64, 'One per service keyword'),
('static_pages', 10, 'Main pages only'),
('total_pages', 12106, '12032 + 64 + 10')
ON DUPLICATE KEY UPDATE count=VALUES(count), calculation=VALUES(calculation);

-- ============================================
-- 6. VIEW FOR EASY ACCESS
-- ============================================
CREATE OR REPLACE VIEW v_page_counts AS
SELECT 
    (SELECT COUNT(*) FROM services WHERE is_active = 1) as total_services,
    (SELECT COUNT(*) FROM areas WHERE is_active = 1) as total_areas,
    (SELECT COUNT(*) FROM services WHERE is_active = 1) * 
    (SELECT COUNT(*) FROM areas WHERE is_active = 1) as total_service_pages,
    (SELECT COUNT(*) FROM services WHERE is_active = 1) as total_pillar_pages,
    (SELECT COUNT(*) FROM static_pages WHERE is_active = 1) as total_static_pages,
    (SELECT COUNT(*) FROM services WHERE is_active = 1) * 
    (SELECT COUNT(*) FROM areas WHERE is_active = 1) + 
    (SELECT COUNT(*) FROM services WHERE is_active = 1) + 
    (SELECT COUNT(*) FROM static_pages WHERE is_active = 1) as grand_total;

-- ============================================
-- VERIFICATION QUERIES
-- ============================================

-- Check service count
-- SELECT COUNT(*) as service_count FROM services WHERE is_active = 1;
-- Expected: 64

-- Check area count
-- SELECT COUNT(*) as area_count FROM areas WHERE is_active = 1;
-- Expected: 188

-- Check page counts
-- SELECT * FROM v_page_counts;
-- Expected: 64 services, 188 areas, 12032 service pages, 64 pillar pages, 10 static pages, 12106 total

-- Get breakdown by category
-- SELECT category, COUNT(*) as count FROM services WHERE is_active = 1 GROUP BY category;
