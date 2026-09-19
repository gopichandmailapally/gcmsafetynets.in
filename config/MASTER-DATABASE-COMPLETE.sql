-- ============================================
-- MASTER DATABASE - COMPLETE SYSTEM
-- GCM Safety Nets - Permanent Database Structure
-- ============================================
-- Total Pages: 12,106
-- - Service Pages: 12,032 (64 keywords × 188 areas)
-- - Pillar Pages: 64 (one per keyword)
-- - Main Pages: 10 (static pages)
-- ============================================

-- ============================================
-- 1. SERVICES TABLE (64 Keywords)
-- Core service keywords - PERMANENT DATA
-- ============================================
DROP TABLE IF EXISTS `generated_pages`;
DROP TABLE IF EXISTS `pillar_pages`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `faqs`;
DROP TABLE IF EXISTS `keywords`;
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `areas`;
DROP TABLE IF EXISTS `main_pages`;
DROP TABLE IF EXISTS `page_count_summary`;

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` varchar(50) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text,
  `icon` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_id` (`service_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='64 Service Keywords - PERMANENT';

-- Insert all 64 service keywords
INSERT INTO `services` (`service_id`, `service_name`, `slug`, `category`, `is_active`, `display_order`) VALUES
-- PIGEON NETS (13 keywords)
('pigeon-nets', 'Pigeon Nets', 'pigeon-nets', 'PIGEON NETS', 1, 1),
('pigeon-net', 'Pigeon Net', 'pigeon-net', 'PIGEON NETS', 1, 2),
('balcony-netting', 'Balcony Netting', 'balcony-netting', 'PIGEON NETS', 1, 3),
('pigeon-net-for-balcony', 'Pigeon Net For Balcony', 'pigeon-net-for-balcony', 'PIGEON NETS', 1, 4),
('pigeon-nets-installation', 'Pigeon Nets Installation', 'pigeon-nets-installation', 'PIGEON NETS', 1, 5),
('pigeon-bird-netting', 'Pigeon Bird Netting', 'pigeon-bird-netting', 'PIGEON NETS', 1, 6),
('pigeon-net-installation', 'Pigeon Net Installation', 'pigeon-net-installation', 'PIGEON NETS', 1, 7),
('pigeon-net-near-me', 'Pigeon Net Near Me', 'pigeon-net-near-me', 'PIGEON NETS', 1, 8),
('pigeon-net-for-balcony-near-me', 'Pigeon Net For Balcony Near Me', 'pigeon-net-for-balcony-near-me', 'PIGEON NETS', 1, 9),
('pigeon-net-installation-near-me', 'Pigeon Net Installation Near Me', 'pigeon-net-installation-near-me', 'PIGEON NETS', 1, 10),
('pigeon-safety-nets', 'Pigeon Safety Nets', 'pigeon-safety-nets', 'PIGEON NETS', 1, 11),
('pigeon-net-price', 'Pigeon Net Price', 'pigeon-net-price', 'PIGEON NETS', 1, 12),
('kabutar-jali-near-me', 'Kabutar Jali Near Me', 'kabutar-jali-near-me', 'PIGEON NETS', 1, 13),
-- BIRD NETS (9 keywords)
('bird-nets', 'Bird Nets', 'bird-nets', 'BIRD NETS', 1, 14),
('bird-net', 'Bird Net', 'bird-net', 'BIRD NETS', 1, 15),
('bird-net-for-balcony', 'Bird Net For Balcony', 'bird-net-for-balcony', 'BIRD NETS', 1, 16),
('bird-net-near-me', 'Bird Net Near Me', 'bird-net-near-me', 'BIRD NETS', 1, 17),
('nets-for-birds', 'Nets For Birds', 'nets-for-birds', 'BIRD NETS', 1, 18),
('net-for-birds', 'Net For Birds', 'net-for-birds', 'BIRD NETS', 1, 19),
('industrial-bird-netting', 'Industrial Bird Netting', 'industrial-bird-netting', 'BIRD NETS', 1, 20),
('bird-netting', 'Bird Netting', 'bird-netting', 'BIRD NETS', 1, 21),
('anti-bird-netting', 'Anti Bird Netting', 'anti-bird-netting', 'BIRD NETS', 1, 22),
-- SAFETY NETS (11 keywords)
('safety-nets', 'Safety Nets', 'safety-nets', 'SAFETY NETS', 1, 23),
('balcony-safety-nets', 'Balcony Safety Nets', 'balcony-safety-nets', 'SAFETY NETS', 1, 24),
('safety-nets-for-balconies', 'Safety Nets For Balconies', 'safety-nets-for-balconies', 'SAFETY NETS', 1, 25),
('duct-area-safety-nets', 'Duct Area Safety Nets', 'duct-area-safety-nets', 'SAFETY NETS', 1, 26),
('monkey-safety-nets', 'Monkey Safety Nets', 'monkey-safety-nets', 'SAFETY NETS', 1, 27),
('construction-safety-nets', 'Construction Safety Nets', 'construction-safety-nets', 'SAFETY NETS', 1, 28),
('industrial-safety-nets', 'Industrial Safety Nets', 'industrial-safety-nets', 'SAFETY NETS', 1, 29),
('fall-safety-nets', 'Fall Safety Nets', 'fall-safety-nets', 'SAFETY NETS', 1, 30),
('fall-protection-nets', 'Fall Protection Nets', 'fall-protection-nets', 'SAFETY NETS', 1, 31),
('children-safety-nets', 'Children Safety Nets', 'children-safety-nets', 'SAFETY NETS', 1, 32),
('pet-safety-nets', 'Pet Safety Nets', 'pet-safety-nets', 'SAFETY NETS', 1, 33),
-- SPORTS NETS (13 keywords)
('cricket-nets', 'Cricket Nets', 'cricket-nets', 'SPORTS NETS', 1, 34),
('cricket-nets-price', 'Cricket Nets Price', 'cricket-nets-price', 'SPORTS NETS', 1, 35),
('cricket-nets-near-me', 'Cricket Nets Near Me', 'cricket-nets-near-me', 'SPORTS NETS', 1, 36),
('cricket-practice-net', 'Cricket Practice Net', 'cricket-practice-net', 'SPORTS NETS', 1, 37),
('cricket-practice-nets', 'Cricket Practice Nets', 'cricket-practice-nets', 'SPORTS NETS', 1, 38),
('cricket-net-price', 'Cricket Net Price', 'cricket-net-price', 'SPORTS NETS', 1, 39),
('cricket-indoor-nets-near-me', 'Cricket Indoor Nets Near Me', 'cricket-indoor-nets-near-me', 'SPORTS NETS', 1, 40),
('indoor-cricket-nets-near-me', 'Indoor Cricket Nets Near Me', 'indoor-cricket-nets-near-me', 'SPORTS NETS', 1, 41),
('sports-nets', 'Sports Nets', 'sports-nets', 'SPORTS NETS', 1, 42),
('sports-netting', 'Sports Netting', 'sports-netting', 'SPORTS NETS', 1, 43),
('cricket-netting', 'Cricket Netting', 'cricket-netting', 'SPORTS NETS', 1, 44),
('box-cricket-net', 'Box Cricket Net', 'box-cricket-net', 'SPORTS NETS', 1, 45),
('cricket-net-installation', 'Cricket Net Installation', 'cricket-net-installation', 'SPORTS NETS', 1, 46),
-- INVISIBLE GRILLS (9 keywords)
('invisible-grills', 'Invisible Grills', 'invisible-grills', 'INVISIBLE GRILLS', 1, 47),
('invisible-grill-near-me', 'Invisible Grill Near Me', 'invisible-grill-near-me', 'INVISIBLE GRILLS', 1, 48),
('ss-invisible-grills', 'SS Invisible Grills', 'ss-invisible-grills', 'INVISIBLE GRILLS', 1, 49),
('invisible-grill-for-balcony', 'Invisible Grill For Balcony', 'invisible-grill-for-balcony', 'INVISIBLE GRILLS', 1, 50),
('balcony-invisible-grill', 'Balcony Invisible Grill', 'balcony-invisible-grill', 'INVISIBLE GRILLS', 1, 51),
('invisible-grill-for-balcony-near-me', 'Invisible Grill For Balcony Near Me', 'invisible-grill-for-balcony-near-me', 'INVISIBLE GRILLS', 1, 52),
('invisible-safety-grill', 'Invisible Safety Grill', 'invisible-safety-grill', 'INVISIBLE GRILLS', 1, 53),
('invisible-grill-for-safety', 'Invisible Grill For Safety', 'invisible-grill-for-safety', 'INVISIBLE GRILLS', 1, 54),
('invisible-grill-for-pigeons', 'Invisible Grill For Pigeons', 'invisible-grill-for-pigeons', 'INVISIBLE GRILLS', 1, 55),
-- CLOTH HANGERS (9 keywords)
('ceiling-cloth-hangers', 'Ceiling Cloth Hangers', 'ceiling-cloth-hangers', 'CLOTH HANGERS', 1, 56),
('dry-cloth-hangers', 'Dry Cloth Hangers', 'dry-cloth-hangers', 'CLOTH HANGERS', 1, 57),
('cloth-drying-hangers', 'Cloth Drying Hangers', 'cloth-drying-hangers', 'CLOTH HANGERS', 1, 58),
('cloth-hanger-for-balcony', 'Cloth Hanger For Balcony', 'cloth-hanger-for-balcony', 'CLOTH HANGERS', 1, 59),
('pulley-cloth-drying-hanger', 'Pulley Cloth Drying Hanger', 'pulley-cloth-drying-hanger', 'CLOTH HANGERS', 1, 60),
('pulley-cloth-hanger', 'Pulley Cloth Hanger', 'pulley-cloth-hanger', 'CLOTH HANGERS', 1, 61),
('laundry-hanger-dryer', 'Laundry Hanger Dryer', 'laundry-hanger-dryer', 'CLOTH HANGERS', 1, 62),
('clothes-hanger-to-dry-clothes', 'Clothes Hanger To Dry Clothes', 'clothes-hanger-to-dry-clothes', 'CLOTH HANGERS', 1, 63),
('clothes-hanger-drier', 'Clothes Hanger Drier', 'clothes-hanger-drier', 'CLOTH HANGERS', 1, 64)
ON DUPLICATE KEY UPDATE service_name=VALUES(service_name), category=VALUES(category);

-- ============================================
-- 2. KEYWORDS TABLE (Links to services)
-- ============================================
CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `search_volume` int(11) DEFAULT 0,
  `difficulty` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword_slug` (`slug`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='64 Keywords linked to services';

-- Insert keywords (same as services for this system)
INSERT INTO `keywords` (`service_id`, `keyword`, `slug`, `search_volume`, `is_active`, `display_order`)
SELECT `id`, `service_name`, `slug`, 1000, 1, `display_order` FROM `services`
ON DUPLICATE KEY UPDATE keyword=VALUES(keyword);

-- ============================================
-- 3. AREAS TABLE (188 Hyderabad Locations)
-- PERMANENT DATA - Never delete
-- ============================================
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `zone` varchar(50) DEFAULT 'Hyderabad',
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_zone` (`zone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='188 Hyderabad Areas - PERMANENT';

-- Insert all 188 Hyderabad areas
INSERT INTO `areas` (`area_name`, `slug`, `zone`, `is_active`, `display_order`) VALUES
('Abids', 'abids', 'Hyderabad', 1, 1),('Adikmet', 'adikmet', 'Hyderabad', 1, 2),('Afzalgunj', 'afzalgunj', 'Hyderabad', 1, 3),
('Aliabad', 'aliabad', 'Hyderabad', 1, 4),('Alwal', 'alwal', 'Hyderabad', 1, 5),('Amberpet', 'amberpet', 'Hyderabad', 1, 6),
('Ameerpet', 'ameerpet', 'Hyderabad', 1, 7),('Ananthagiri Hills', 'ananthagiri-hills', 'Hyderabad', 1, 8),('Asif Nagar', 'asif-nagar', 'Hyderabad', 1, 9),
('Asifabad', 'asifabad', 'Hyderabad', 1, 10),('Attapur', 'attapur', 'Hyderabad', 1, 11),('Attapur Metro', 'attapur-metro', 'Hyderabad', 1, 12),
('Ayyappa Society', 'ayyappa-society', 'Hyderabad', 1, 13),('Bachupally', 'bachupally', 'Hyderabad', 1, 14),('Badangpet', 'badangpet', 'Hyderabad', 1, 15),
('Bagh Amberpet', 'bagh-amberpet', 'Hyderabad', 1, 16),('Bagh Lingampally', 'bagh-lingampally', 'Hyderabad', 1, 17),('Bahadurpura', 'bahadurpura', 'Hyderabad', 1, 18),
('Balkampet', 'balkampet', 'Hyderabad', 1, 19),('Balnagar', 'balnagar', 'Hyderabad', 1, 20),('Bandlaguda', 'bandlaguda', 'Hyderabad', 1, 21),
('Banjara Hills', 'banjara-hills', 'Hyderabad', 1, 22),('Barkas', 'barkas', 'Hyderabad', 1, 23),('Basheerbagh', 'basheerbagh', 'Hyderabad', 1, 24),
('Begum Bazar', 'begum-bazar', 'Hyderabad', 1, 25),('Begumpet', 'begumpet', 'Hyderabad', 1, 26),('Boduppal', 'boduppal', 'Hyderabad', 1, 27),
('Borabanda', 'borabanda', 'Hyderabad', 1, 28),('Bowenpally', 'bowenpally', 'Hyderabad', 1, 29),('Boysguda', 'boysguda', 'Hyderabad', 1, 30),
('Champapet', 'champapet', 'Hyderabad', 1, 31),('Chanda Nagar', 'chanda-nagar', 'Hyderabad', 1, 32),('Chandanagar', 'chandanagar', 'Hyderabad', 1, 33),
('Charminar', 'charminar', 'Hyderabad', 1, 34),('Chikkadpally', 'chikkadpally', 'Hyderabad', 1, 35),('Chintal', 'chintal', 'Hyderabad', 1, 36),
('Chintalkunta', 'chintalkunta', 'Hyderabad', 1, 37),('Dabeerpura', 'dabeerpura', 'Hyderabad', 1, 38),('Dammaiguda', 'dammaiguda', 'Hyderabad', 1, 39),
('Dar-ul-Shifa', 'dar-ul-shifa', 'Hyderabad', 1, 40),('Dhoolpet', 'dhoolpet', 'Hyderabad', 1, 41),('Dilsukhnagar', 'dilsukhnagar', 'Hyderabad', 1, 42),
('Domalguda', 'domalguda', 'Hyderabad', 1, 43),('Dundigal', 'dundigal', 'Hyderabad', 1, 44),('East Marredpally', 'east-marredpally', 'Hyderabad', 1, 45),
('ECIL', 'ecil', 'Hyderabad', 1, 46),('ECIL Cross Roads', 'ecil-cross-roads', 'Hyderabad', 1, 47),('Edi Bazar', 'edi-bazar', 'Hyderabad', 1, 48),
('Erragadda', 'erragadda', 'Hyderabad', 1, 49),('Falaknuma', 'falaknuma', 'Hyderabad', 1, 50),('Fateh Nagar', 'fateh-nagar', 'Hyderabad', 1, 51),
('Ferozguda', 'ferozguda', 'Hyderabad', 1, 52),('Film Nagar', 'film-nagar', 'Hyderabad', 1, 53),('Financial District', 'financial-district', 'Hyderabad', 1, 54),
('Gachibowli', 'gachibowli', 'Hyderabad', 1, 55),('Gaddiannaram', 'gaddiannaram', 'Hyderabad', 1, 56),('Gajularamaram', 'gajularamaram', 'Hyderabad', 1, 57),
('Gandhi Nagar', 'gandhi-nagar', 'Hyderabad', 1, 58),('Ghatkesar', 'ghatkesar', 'Hyderabad', 1, 59),('Golconda', 'golconda', 'Hyderabad', 1, 60),
('Goshamahal', 'goshamahal', 'Hyderabad', 1, 61),('Gowlidoddy', 'gowlidoddy', 'Hyderabad', 1, 62),('Gudimelakunta', 'gudimelakunta', 'Hyderabad', 1, 63),
('Habsiguda', 'habsiguda', 'Hyderabad', 1, 64),('Hafeezpet', 'hafeezpet', 'Hyderabad', 1, 65),('Hayathnagar', 'hayathnagar', 'Hyderabad', 1, 66),
('Himayatnagar', 'himayatnagar', 'Hyderabad', 1, 67),('Hitech City', 'hitech-city', 'Hyderabad', 1, 68),('Hussainialam', 'hussainialam', 'Hyderabad', 1, 69),
('Hyderguda', 'hyderguda', 'Hyderabad', 1, 70),('Ibrahim Bagh', 'ibrahim-bagh', 'Hyderabad', 1, 71),('Ibrahimpatnam', 'ibrahimpatnam', 'Hyderabad', 1, 72),
('IDA Bollaram', 'ida-bollaram', 'Hyderabad', 1, 73),('IS Sadan', 'is-sadan', 'Hyderabad', 1, 74),('Izzat Nagar', 'izzat-nagar', 'Hyderabad', 1, 75),
('Jagadgirigutta', 'jagadgirigutta', 'Hyderabad', 1, 76),('Jahanuma', 'jahanuma', 'Hyderabad', 1, 77),('Jamia Osmania', 'jamia-osmania', 'Hyderabad', 1, 78),
('Jeedimetla', 'jeedimetla', 'Hyderabad', 1, 79),('Jubilee Hills', 'jubilee-hills', 'Hyderabad', 1, 80),('Kachiguda', 'kachiguda', 'Hyderabad', 1, 81),
('Kailash Nagar', 'kailash-nagar', 'Hyderabad', 1, 82),('Kalimandir', 'kalimandir', 'Hyderabad', 1, 83),('Kamala Nagar', 'kamala-nagar', 'Hyderabad', 1, 84),
('Kapra', 'kapra', 'Hyderabad', 1, 85),('Karkhana', 'karkhana', 'Hyderabad', 1, 86),('Karwan', 'karwan', 'Hyderabad', 1, 87),
('Kattedan', 'kattedan', 'Hyderabad', 1, 88),('Khairtabad', 'khairtabad', 'Hyderabad', 1, 89),('Khajaguda', 'khajaguda', 'Hyderabad', 1, 90),
('Kishanbagh', 'kishanbagh', 'Hyderabad', 1, 91),('Kismatkhan Gudda', 'kismatkhan-gudda', 'Hyderabad', 1, 92),('Kompally', 'kompally', 'Hyderabad', 1, 93),
('Kondapur', 'kondapur', 'Hyderabad', 1, 94),('Kothapet', 'kothapet', 'Hyderabad', 1, 95),('KPHB Colony', 'kphb-colony', 'Hyderabad', 1, 96),
('Kukatpally', 'kukatpally', 'Hyderabad', 1, 97),('Lakdikapul', 'lakdikapul', 'Hyderabad', 1, 98),('Lalapet', 'lalapet', 'Hyderabad', 1, 99),
('Langer Houz', 'langer-houz', 'Hyderabad', 1, 100),('LB Nagar', 'lb-nagar', 'Hyderabad', 1, 101),('Lingampally', 'lingampally', 'Hyderabad', 1, 102),
('Madannapet', 'madannapet', 'Hyderabad', 1, 103),('Madhapur', 'madhapur', 'Hyderabad', 1, 104),('Madinaguda', 'madinaguda', 'Hyderabad', 1, 105),
('Mahdipatnam', 'mahdipatnam', 'Hyderabad', 1, 106),('Malakpet', 'malakpet', 'Hyderabad', 1, 107),('Mallapur', 'mallapur', 'Hyderabad', 1, 108),
('Manikonda', 'manikonda', 'Hyderabad', 1, 109),('Marredpally', 'marredpally', 'Hyderabad', 1, 110),('Masab Tank', 'masab-tank', 'Hyderabad', 1, 111),
('Meerpet', 'meerpet', 'Hyderabad', 1, 112),('Mehdipatnam', 'mehdipatnam', 'Hyderabad', 1, 113),('Mettuguda', 'mettuguda', 'Hyderabad', 1, 114),
('Miyapur', 'miyapur', 'Hyderabad', 1, 115),('Moghalpura', 'moghalpura', 'Hyderabad', 1, 116),('Moosarambagh', 'moosarambagh', 'Hyderabad', 1, 117),
('Moti Nagar', 'moti-nagar', 'Hyderabad', 1, 118),('Moula Ali', 'moula-ali', 'Hyderabad', 1, 119),('Musheerabad', 'musheerabad', 'Hyderabad', 1, 120),
('Nacharam', 'nacharam', 'Hyderabad', 1, 121),('Nagaram', 'nagaram', 'Hyderabad', 1, 122),('Nagole', 'nagole', 'Hyderabad', 1, 123),
('Nallakunta', 'nallakunta', 'Hyderabad', 1, 124),('Nampally', 'nampally', 'Hyderabad', 1, 125),('Nanakramguda', 'nanakramguda', 'Hyderabad', 1, 126),
('Nanal Nagar', 'nanal-nagar', 'Hyderabad', 1, 127),('Narayanguda', 'narayanguda', 'Hyderabad', 1, 128),('Neredmet', 'neredmet', 'Hyderabad', 1, 129),
('New Bowenpally', 'new-bowenpally', 'Hyderabad', 1, 130),('Nizampet', 'nizampet', 'Hyderabad', 1, 131),('Old Bowenpally', 'old-bowenpally', 'Hyderabad', 1, 132),
('Old City', 'old-city', 'Hyderabad', 1, 133),('Old Malakpet', 'old-malakpet', 'Hyderabad', 1, 134),('Osman Nagar', 'osman-nagar', 'Hyderabad', 1, 135),
('Osmangunj', 'osmangunj', 'Hyderabad', 1, 136),('Osmania University', 'osmania-university', 'Hyderabad', 1, 137),('Padmarao Nagar', 'padmarao-nagar', 'Hyderabad', 1, 138),
('Panjagutta', 'panjagutta', 'Hyderabad', 1, 139),('Panjagutta Circle', 'panjagutta-circle', 'Hyderabad', 1, 140),('Paradise', 'paradise', 'Hyderabad', 1, 141),
('Patancheru', 'patancheru', 'Hyderabad', 1, 142),('Patel Road', 'patel-road', 'Hyderabad', 1, 143),('Peerzadiguda', 'peerzadiguda', 'Hyderabad', 1, 144),
('Pragathi Nagar', 'pragathi-nagar', 'Hyderabad', 1, 145),('Purani Haveli', 'purani-haveli', 'Hyderabad', 1, 146),('Qila Mohd. Nagar', 'qila-mohd-nagar', 'Hyderabad', 1, 147),
('Quthbullapur', 'quthbullapur', 'Hyderabad', 1, 148),('Rajendranagar', 'rajendranagar', 'Hyderabad', 1, 149),('Ramakrishna Puram', 'ramakrishna-puram', 'Hyderabad', 1, 150),
('Ramanthapur', 'ramanthapur', 'Hyderabad', 1, 151),('Ramnagar', 'ramnagar', 'Hyderabad', 1, 152),('RC Puram', 'rc-puram', 'Hyderabad', 1, 153),
('Red Hills', 'red-hills', 'Hyderabad', 1, 154),('Safilguda', 'safilguda', 'Hyderabad', 1, 155),('Saidabad', 'saidabad', 'Hyderabad', 1, 156),
('Sainikpuri', 'sainikpuri', 'Hyderabad', 1, 157),('Sanath Nagar', 'sanath-nagar', 'Hyderabad', 1, 158),('Sangareddy', 'sangareddy', 'Hyderabad', 1, 159),
('Santosh Nagar', 'santosh-nagar', 'Hyderabad', 1, 160),('Saroornagar', 'saroornagar', 'Hyderabad', 1, 161),('Secunderabad', 'secunderabad', 'Hyderabad', 1, 162),
('Serilingampally', 'serilingampally', 'Hyderabad', 1, 163),('Shaikpet', 'shaikpet', 'Hyderabad', 1, 164),('Shamirpet', 'shamirpet', 'Hyderabad', 1, 165),
('Shamshabad', 'shamshabad', 'Hyderabad', 1, 166),('Shankarpally', 'shankarpally', 'Hyderabad', 1, 167),('Tank Bund', 'tank-bund', 'Hyderabad', 1, 168),
('Tappachabutra', 'tappachabutra', 'Hyderabad', 1, 169),('Tarnaka', 'tarnaka', 'Hyderabad', 1, 170),('Tolichowki', 'tolichowki', 'Hyderabad', 1, 171),
('Trimulgherry', 'trimulgherry', 'Hyderabad', 1, 172),('Umdanagar', 'umdanagar', 'Hyderabad', 1, 173),('Uppal', 'uppal', 'Hyderabad', 1, 174),
('Uppuguda', 'uppuguda', 'Hyderabad', 1, 175),('Vanasthalipuram', 'vanasthalipuram', 'Hyderabad', 1, 176),('Vengal Rao Nagar', 'vengal-rao-nagar', 'Hyderabad', 1, 177),
('Vidyanagar', 'vidyanagar', 'Hyderabad', 1, 178),('Vikrampuri', 'vikrampuri', 'Hyderabad', 1, 179),('Warasiguda', 'warasiguda', 'Hyderabad', 1, 180),
('West Marredpally', 'west-marredpally', 'Hyderabad', 1, 181),('Yakutpura', 'yakutpura', 'Hyderabad', 1, 182),('Yousufguda', 'yousufguda', 'Hyderabad', 1, 183),
('Zakir Hussain Colony', 'zakir-hussain-colony', 'Hyderabad', 1, 184),('Zamistanpur', 'zamistanpur', 'Hyderabad', 1, 185),('Zeregumbad', 'zeregumbad', 'Hyderabad', 1, 186),
('Ziaguda', 'ziaguda', 'Hyderabad', 1, 187),('Zohra Nagar', 'zohra-nagar', 'Hyderabad', 1, 188)
ON DUPLICATE KEY UPDATE area_name=VALUES(area_name);

-- ============================================
-- 4. GENERATED PAGES TABLE (12,032 Service Pages)
-- Tracks all service × area combinations
-- ============================================
CREATE TABLE IF NOT EXISTS `generated_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `word_count` int(11) DEFAULT 0,
  `status` enum('pending','generating','completed','failed') DEFAULT 'pending',
  `generated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `keyword_id` (`keyword_id`),
  KEY `area_id` (`area_id`),
  KEY `idx_status` (`status`),
  CONSTRAINT `generated_pages_ibfk_1` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE,
  CONSTRAINT `generated_pages_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='12,032 Service Pages (64 × 188)';

-- ============================================
-- 5. PILLAR PAGES TABLE (64 Pages)
-- One pillar page per service keyword
-- ============================================
CREATE TABLE IF NOT EXISTS `pillar_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file_path` varchar(500) DEFAULT NULL,
  `word_count` int(11) DEFAULT 0,
  `is_generated` tinyint(1) DEFAULT 0,
  `generated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `pillar_pages_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='64 Pillar Pages (one per keyword)';

-- ============================================
-- 6. MAIN PAGES TABLE (10 Static Pages)
-- ============================================
CREATE TABLE IF NOT EXISTS `main_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `page_type` enum('main','utility','legal') DEFAULT 'main',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='10 Main Static Pages';

-- Insert main pages
INSERT INTO `main_pages` (`page_name`, `slug`, `page_type`, `is_active`) VALUES
('Homepage', 'index', 'main', 1),
('About Us', 'about', 'main', 1),
('Contact', 'contact', 'main', 1),
('Gallery', 'gallery', 'main', 1),
('Reviews', 'reviews', 'main', 1),
('FAQs', 'faqs', 'main', 1),
('Videos', 'videos', 'main', 1),
('Blogs', 'blogs', 'main', 1),
('Estimation', 'estimation', 'utility', 1),
('Privacy Policy', 'privacy-policy', 'legal', 1)
ON DUPLICATE KEY UPDATE page_name=VALUES(page_name);

-- ============================================
-- 7. REVIEWS TABLE (Linked to Services & Areas)
-- For generating multiple review versions
-- ============================================
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `review_text` text NOT NULL,
  `review_date` date DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `area_id` (`area_id`),
  KEY `idx_rating` (`rating`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Reviews linked to services and areas';

-- ============================================
-- 8. BLOGS TABLE (Linked to Services & Areas)
-- For generating multiple blog versions
-- ============================================
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text,
  `featured_image` varchar(500) DEFAULT NULL,
  `author` varchar(100) DEFAULT 'GCM Safety Nets',
  `word_count` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `service_id` (`service_id`),
  KEY `area_id` (`area_id`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Blogs linked to services and areas';

-- ============================================
-- 9. FAQS TABLE (Linked to Services & Areas)
-- For generating multiple FAQ versions
-- ============================================
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `area_id` (`area_id`),
  KEY `idx_display_order` (`display_order`),
  CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  CONSTRAINT `faqs_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='FAQs linked to services and areas';

-- ============================================
-- 10. PAGE COUNT SUMMARY TABLE
-- Automatically tracks all page counts
-- ============================================
CREATE TABLE IF NOT EXISTS `page_count_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `calculation` varchar(200) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_type` (`page_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Page count tracking';

-- Insert page counts
INSERT INTO `page_count_summary` (`page_type`, `count`, `calculation`) VALUES
('services', 64, 'COUNT(services)'),
('areas', 188, 'COUNT(areas)'),
('service_pages', 12032, '64 services × 188 areas'),
('pillar_pages', 64, 'One per service keyword'),
('main_pages', 10, 'Static pages'),
('total_pages', 12106, '12032 + 64 + 10')
ON DUPLICATE KEY UPDATE count=VALUES(count), calculation=VALUES(calculation);

-- ============================================
-- 11. VERIFICATION VIEW
-- Easy access to all counts
-- ============================================
CREATE OR REPLACE VIEW v_page_counts AS
SELECT 
    (SELECT COUNT(*) FROM services WHERE is_active = 1) as total_services,
    (SELECT COUNT(*) FROM areas WHERE is_active = 1) as total_areas,
    (SELECT COUNT(*) FROM services WHERE is_active = 1) * 
    (SELECT COUNT(*) FROM areas WHERE is_active = 1) as total_service_pages,
    (SELECT COUNT(*) FROM pillar_pages) as total_pillar_pages,
    (SELECT COUNT(*) FROM main_pages WHERE is_active = 1) as total_main_pages,
    (SELECT COUNT(*) FROM reviews WHERE is_active = 1) as total_reviews,
    (SELECT COUNT(*) FROM blogs WHERE is_published = 1) as total_blogs,
    (SELECT COUNT(*) FROM faqs WHERE is_active = 1) as total_faqs,
    (SELECT COUNT(*) FROM services WHERE is_active = 1) * 
    (SELECT COUNT(*) FROM areas WHERE is_active = 1) + 
    (SELECT COUNT(*) FROM pillar_pages) + 
    (SELECT COUNT(*) FROM main_pages WHERE is_active = 1) as grand_total_pages;

-- ============================================
-- 12. VERIFICATION QUERIES
-- Run these to verify everything is correct
-- ============================================

-- Show complete summary
SELECT 
    'Services (Keywords)' as item, 
    COUNT(*) as count 
FROM services WHERE is_active = 1
UNION ALL
SELECT 'Areas', COUNT(*) FROM areas WHERE is_active = 1
UNION ALL
SELECT 'Service Pages (64×188)', (SELECT COUNT(*) FROM services WHERE is_active = 1) * (SELECT COUNT(*) FROM areas WHERE is_active = 1)
UNION ALL
SELECT 'Pillar Pages', 64
UNION ALL
SELECT 'Main Pages', COUNT(*) FROM main_pages WHERE is_active = 1
UNION ALL
SELECT 'TOTAL PAGES', 
    (SELECT COUNT(*) FROM services WHERE is_active = 1) * (SELECT COUNT(*) FROM areas WHERE is_active = 1) + 64 + 
    (SELECT COUNT(*) FROM main_pages WHERE is_active = 1);

-- Show breakdown by category
SELECT category, COUNT(*) as keyword_count 
FROM services WHERE is_active = 1 
GROUP BY category 
ORDER BY keyword_count DESC;

-- Show content linking capability
SELECT 
    'Reviews can link to' as feature,
    CONCAT(COUNT(DISTINCT s.id), ' services × ', COUNT(DISTINCT a.id), ' areas = ', 
           COUNT(DISTINCT s.id) * COUNT(DISTINCT a.id), ' combinations') as capability
FROM services s, areas a WHERE s.is_active = 1 AND a.is_active = 1
UNION ALL
SELECT 'Blogs can link to',
    CONCAT(COUNT(DISTINCT s.id), ' services × ', COUNT(DISTINCT a.id), ' areas = ', 
           COUNT(DISTINCT s.id) * COUNT(DISTINCT a.id), ' combinations')
FROM services s, areas a WHERE s.is_active = 1 AND a.is_active = 1
UNION ALL
SELECT 'FAQs can link to',
    CONCAT(COUNT(DISTINCT s.id), ' services × ', COUNT(DISTINCT a.id), ' areas = ', 
           COUNT(DISTINCT s.id) * COUNT(DISTINCT a.id), ' combinations')
FROM services s, areas a WHERE s.is_active = 1 AND a.is_active = 1;

-- ============================================
-- DATABASE COMPLETE
-- This structure is PERMANENT and will persist
-- across all future updates
-- ============================================
