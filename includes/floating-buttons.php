<script src="/assets/js/geo_resolver.js"></script>
<?php
/**
 * GCM Safety Nets - Unified Floating Action Buttons
 * WhatsApp, Phone, and Scroll-to-Top
 */

require_once __DIR__ . "/whatsapp_helper.php";

// Safe normalization without character mask stripping bugs
$raw_phone = defined("COMPANY_PHONE") ? (string)COMPANY_PHONE : "9912399224";
$clean_digits = preg_replace('/[^0-9]/', '', $raw_phone);
if (strlen($clean_digits) === 12 && substr($clean_digits, 0, 2) === '91') {
    $clean_digits = substr($clean_digits, 2);
}
if (strlen($clean_digits) !== 10) {
    $clean_digits = "9912399224";
}

$phone_call_href = 'tel:+91' . $clean_digits;
$phone_display   = '+91 99123 99224';
$whatsapp_num    = defined("COMPANY_WHATSAPP") ? COMPANY_WHATSAPP : "919912399224";
$smart_wa_url    = getGcmWhatsAppUrl();
?>

<!-- Floating Action Buttons -->
<div class="floating-buttons" id="gcmFloatingButtons">
    <!-- WhatsApp Button (Smart Dynamic Lead System) -->
    <a href="<?php echo htmlspecialchars($smart_wa_url); ?>" 
       class="floating-btn whatsapp-btn gcm-fab-whatsapp" 
       target="_blank" 
       rel="noopener noreferrer"
       title="Chat on WhatsApp"
       aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="floating-btn-text">WhatsApp</span>
    </a>
    
    <!-- Phone Button -->
    <a href="<?php echo $phone_call_href; ?>" 
       class="floating-btn phone-btn" 
       title="Call Us (<?php echo $phone_display; ?>)"
       aria-label="Call Us (<?php echo $phone_display; ?>)">
        <i class="fas fa-phone"></i>
        <span class="floating-btn-text">Call Us</span>
    </a>
    
    <!-- Scroll to Top Button -->
    <button class="floating-btn scroll-top-btn" 
            id="scrollTopBtn" 
            onclick="scrollToTop()" 
            title="Scroll to Top"
            aria-label="Scroll to Top"
            style="display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

<style>
.floating-buttons {
    position: fixed;
    bottom: 24px;
    right: 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    z-index: 99999;
}

.floating-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFFFFF !important;
    text-decoration: none !important;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
    font-size: 24px;
}

.floating-btn:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
}

.floating-btn-text {
    position: absolute;
    right: 70px;
    background: rgba(15, 23, 42, 0.95);
    color: #FFFFFF;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    pointer-events: none;
}

.floating-btn-text::after {
    content: "";
    position: absolute;
    right: -6px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 6px solid rgba(15, 23, 42, 0.95);
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
}

.floating-btn:hover .floating-btn-text {
    opacity: 1;
    visibility: visible;
    right: 75px;
}

.whatsapp-btn {
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    animation: pulse-whatsapp 2s infinite;
}

.phone-btn {
    background: linear-gradient(135deg, #0066CC 0%, #0052A3 100%);
}

.scroll-top-btn {
    background: linear-gradient(135deg, #FF6600 0%, #E55A00 100%);
}

.scroll-top-btn.show {
    display: flex !important;
    animation: fadeInUp 0.3s ease;
}

@keyframes pulse-whatsapp {
    0%, 100% {
        box-shadow: 0 4px 16px rgba(37, 211, 102, 0.4);
    }
    50% {
        box-shadow: 0 4px 24px rgba(37, 211, 102, 0.6), 0 0 0 8px rgba(37, 211, 102, 0.2);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .floating-buttons {
        bottom: 16px;
        right: 16px;
        gap: 10px;
    }
    
    .floating-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .floating-btn-text {
        display: none !important;
    }
}
</style>

<script>
// Smart Dynamic WhatsApp Click Handler for GCM Safety Nets (Hyderabad & India)
document.addEventListener("click", function(e) {
    var waLink = e.target.closest('a[href*="wa.me"], a[href*="whatsapp.com"], .whatsapp-btn, .btn-whatsapp, .fab-whatsapp, .gcm-fab-whatsapp');
    if (!waLink) return;
    
    e.preventDefault();
    
    var currentUrl = window.location.href.split("#")[0];
    var path = window.location.pathname;
    var title = document.title || "";
    var h1Elem = document.querySelector("h1");
    var h1 = h1Elem ? h1Elem.innerText.trim() : "";
    var checkStr = (h1 + " " + title + " " + path).toLowerCase();
    
    // 1. Detect Service
    var service = "";
    if (checkStr.includes("cloth-hanger") || checkStr.includes("cloth hanger") || checkStr.includes("drying-hanger") || checkStr.includes("drying stand") || checkStr.includes("ceiling cloth")) {
        service = "Balcony & Ceiling Cloth Drying Hangers";
    } else if (checkStr.includes("invisible-grill") || checkStr.includes("invisible grill")) {
        service = "Stainless Steel Invisible Grills";
    } else if (checkStr.includes("box-cricket") || checkStr.includes("box cricket")) {
        service = "Box Cricket Ground Setup & Netting";
    } else if (checkStr.includes("cricket")) {
        service = "Cricket Practice Pitch Nets Installation";
    } else if (checkStr.includes("sports")) {
        service = "Sports & Ground Perimeter Netting";
    } else if (checkStr.includes("spike")) {
        service = "Bird & Pigeon Protection Spikes";
    } else if (checkStr.includes("pigeon")) {
        service = "Pigeon Safety Nets Installation";
    } else if (checkStr.includes("child")) {
        service = "Children & Pet Balcony Safety Nets";
    } else if (checkStr.includes("balcony")) {
        service = "Balcony Safety Nets Installation";
    } else if (checkStr.includes("duct")) {
        service = "Duct Area Safety Nets";
    } else if (checkStr.includes("coconut")) {
        service = "Coconut Tree Safety Nets";
    } else if (h1) {
        service = h1.replace(/[–—|\-].*$/, "").trim();
    } else {
        service = "Safety Nets & Invisible Grills";
    }
    
    // 2. Detect Locality
    var location = "";
    var match = path.match(/-in-([a-z0-9-]+)/i);
    if (match && match[1]) {
        var areaSlug = match[1];
        if (typeof resolveSmartGeoLocation === "function") {
            location = resolveSmartGeoLocation(areaSlug);
        } else {
            var areaFormatted = areaSlug.split("-").map(function(w) { return w.charAt(0).toUpperCase() + w.slice(1); }).join(" ");
            location = areaFormatted + ", Telangana";
        }
    } else {
        location = "Hyderabad, Telangana (All Areas & Pan-India Supply)";
    }
    
    // 3. Pricing Line
    var pricingText = "Please share pricing per sq.ft, technical specifications, and installation availability.";
    if (checkStr.includes("hanger") || checkStr.includes("drying")) {
        pricingText = "Please share pricing per piece / set, model options, technical specifications, and installation availability.";
    } else if (checkStr.includes("spike")) {
        pricingText = "Please share pricing per piece / per strip, technical specifications, and installation availability.";
    } else if (checkStr.includes("box cricket") || checkStr.includes("turf")) {
        pricingText = "Please share turnkey court setup cost / pricing per sq.ft, technical specifications, and installation availability.";
    }
    
    var msg = "Hi GCM Safety Nets, I would like to inquire about *" + service + "* in *" + location + "*.

" +
              "• Service: " + service + "
" +
              "• Location: " + location + "
" +
              "• Page: " + currentUrl + "
" +
              "• Website: www.gcmsafetynets.in

" +
              pricingText;
              
    var targetPhone = "<?php echo preg_replace('/[^0-9]/', '', $whatsapp_num); ?>";
    window.open("https://wa.me/" + targetPhone + "?text=" + encodeURIComponent(msg), "_blank");
});
</script>
