<?php
/* Template Name: Product */
global $custom_css; $custom_css = 'product'; get_header();
?>

<!-- product main content start -->
<main class="product-page section" style="padding: 104px 0 44px !important; background: #ffffff;">
    <style>
    @media (max-width: 768px) { 
        .product-page.section { padding: 84px 0 32px !important; } 
    }

    /* ========================================================
       DESIGN REFERENCE: PROJECTS PAGE (Clean White & Navy Style)
       ======================================================== */
    .product-wrapper {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
        font-family: 'Outfit', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Hero Header */
    .product-hero-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .product-hero-badge {
        font-size: 13px;
        font-weight: 700;
        color: #cba85d;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: inline-block;
        margin-bottom: 8px;
    }
    .product-hero-title {
        color: #041e3a;
        font-size: clamp(24px, 3.8vw, 38px);
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 0;
        letter-spacing: -0.5px;
    }
    .product-gold-arc {
        margin: 10px auto 16px;
        display: block;
    }
    .product-hero-desc {
        font-size: clamp(14px, 1.6vw, 15.5px);
        color: #64748b;
        line-height: 1.65;
        max-width: 760px;
        margin: 0 auto 24px;
    }

    /* Trust Strip Badges (Matches Projects / Contacts Style) */
    .product-trust-strip {
        display: flex;
        justify-content: center;
        gap: clamp(8px, 1.8vw, 14px);
        flex-wrap: wrap;
        margin-bottom: clamp(24px, 3.5vw, 40px);
    }
    .product-trust-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 7px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        transition: all 0.25s ease;
    }
    .product-trust-pill:hover {
        border-color: #cba85d;
        background: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(203, 168, 93, 0.15);
    }
    .product-trust-pill svg {
        color: #cba85d;
        flex-shrink: 0;
    }

    /* Product Grid & Cards (Projects Card Aesthetics) */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px 24px;
        margin-bottom: 64px;
    }
    @media (max-width: 1024px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px 20px;
        }
    }
    @media (max-width: 640px) {
        .product-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    .product-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        text-align: left;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px rgba(4, 30, 58, 0.12);
        border-color: #cba85d;
    }

    /* Card Image */
    .product-card-image {
        position: relative;
        width: 100%;
        height: 230px;
        overflow: hidden;
        background: #f8fafc;
    }
    .product-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .product-card:hover .product-card-image img {
        transform: scale(1.06);
    }

    /* Floating Badges */
    .product-card-badge-top {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(4, 30, 58, 0.9);
        color: #cba85d;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(203, 168, 93, 0.4);
        letter-spacing: 0.5px;
        text-transform: uppercase;
        z-index: 2;
    }
    .product-card-badge-sub {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.95);
        color: #041e3a;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        z-index: 2;
    }

    /* Card Body */
    .product-card-body {
        padding: 22px 20px 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .product-card-cat {
        font-size: 11.5px;
        font-weight: 700;
        color: #cba85d;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
        display: block;
    }
    .product-card-title {
        font-size: 19px;
        font-weight: 700;
        color: #041e3a;
        margin-bottom: 10px;
        line-height: 1.35;
        transition: color 0.25s ease;
    }
    .product-card:hover .product-card-title {
        color: #cba85d;
    }
    .product-card-desc {
        font-size: 13.5px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 18px;
        flex-grow: 1;
    }

    /* Card Highlights / Features */
    .product-card-features {
        list-style: none;
        padding: 0;
        margin: 0 0 20px;
        display: flex;
        flex-direction: column;
        gap: 7px;
        border-top: 1px dashed #e2e8f0;
        padding-top: 14px;
    }
    .product-card-features li {
        font-size: 12.5px;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 8px;
        line-height: 1.4;
    }
    .product-card-features li svg {
        color: #cba85d;
        flex-shrink: 0;
    }

    /* Card Button */
    .product-card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #cba85d;
        color: #ffffff;
        padding: 9px 18px;
        border-radius: 6px;
        font-size: 13.5px;
        font-weight: 600;
        transition: all 0.25s ease;
        align-self: flex-start;
        margin-top: auto;
    }
    .product-card:hover .product-card-btn {
        background: #041e3a;
        color: #ffffff;
    }

    /* ========================================================
       SECTION 2: MENGAPA MEMILIH GJS (Split Layout Redesign)
       ======================================================== */
    .product-why-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 48px 36px;
        margin-bottom: 64px;
    }
    @media (max-width: 768px) {
        .product-why-section {
            padding: 32px 20px;
        }
    }
    .product-why-grid {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 48px;
        align-items: center;
    }
    @media (max-width: 991px) {
        .product-why-grid {
            grid-template-columns: 1fr;
            gap: 36px;
        }
    }
    .product-why-subtitle {
        font-size: 13px;
        font-weight: 700;
        color: #cba85d;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    .product-why-title {
        font-size: clamp(22px, 2.8vw, 32px);
        font-weight: 700;
        color: #041e3a;
        line-height: 1.3;
        margin-bottom: 24px;
    }

    /* Accordion in Light Theme */
    .product-accordion {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .product-acc-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .product-acc-item.active {
        border-color: #cba85d;
        box-shadow: 0 4px 14px rgba(203, 168, 93, 0.12);
    }
    .product-acc-header {
        font-size: 15.5px;
        font-weight: 600;
        color: #041e3a;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        cursor: pointer;
        user-select: none;
        transition: color 0.25s ease;
    }
    .product-acc-item.active .product-acc-header {
        color: #cba85d;
    }
    .product-acc-icon {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
        color: #cba85d;
        flex-shrink: 0;
    }
    .product-acc-item.active .product-acc-icon {
        transform: rotate(180deg);
    }
    .product-acc-body {
        font-size: 14px;
        color: #64748b;
        line-height: 1.65;
        padding: 0 20px 18px;
        display: none;
        border-top: 1px solid #f1f5f9;
        margin-top: 4px;
        padding-top: 12px;
    }

    /* Visual Showcase & Quote Card */
    .product-showcase-wrap {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 12px 32px rgba(4, 30, 58, 0.1);
        border: 1px solid #e2e8f0;
    }
    .product-showcase-img {
        width: 100%;
        height: 440px;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 640px) {
        .product-showcase-img {
            height: 260px;
        }
    }
    .product-quote-card {
        background: #ffffff;
        padding: 24px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        margin-top: -30px;
        margin-left: 16px;
        margin-right: 16px;
        position: relative;
        z-index: 3;
    }
    .product-quote-text {
        font-size: 14px;
        font-style: italic;
        color: #334155;
        margin-bottom: 12px;
        line-height: 1.6;
    }
    .product-quote-author {
        font-size: 13px;
        font-weight: 700;
        color: #041e3a;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ========================================================
       SECTION 3: PILAR SPESIFIKASI & MATERIEL (6 Feature Cards)
       ======================================================== */
    .product-specs-section {
        margin-bottom: 64px;
    }
    .product-specs-header {
        text-align: center;
        margin-bottom: 36px;
    }
    .product-specs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    @media (max-width: 991px) {
        .product-specs-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 600px) {
        .product-specs-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }
    .product-spec-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 26px 20px;
        text-align: center;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .product-spec-card:hover {
        transform: translateY(-4px);
        border-color: #cba85d;
        box-shadow: 0 10px 24px rgba(203, 168, 93, 0.15);
    }
    .product-spec-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 16px;
        border: 1.5px solid #cba85d;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cba85d;
        background: #fdfaf3;
        transition: background-color 0.25s ease, transform 0.25s ease;
    }
    .product-spec-card:hover .product-spec-icon {
        background: #cba85d;
        color: #ffffff;
        transform: scale(1.05);
    }
    .product-spec-icon svg {
        width: 28px;
        height: 28px;
        stroke-width: 1.8;
    }
    .product-spec-title {
        font-size: 16px;
        font-weight: 700;
        color: #041e3a;
        margin-bottom: 8px;
    }
    .product-spec-desc {
        font-size: 13px;
        color: #64748b;
        line-height: 1.55;
        margin: 0;
    }

    /* ========================================================
       SECTION 4: CTA KONSULTASI & ESTIMASI RAB (Projects Style)
       ======================================================== */
    .product-cta-card {
        background: linear-gradient(135deg, #041e3a 0%, #03162b 100%);
        border: 1px solid rgba(203, 168, 93, 0.35);
        border-radius: 16px;
        padding: 44px 32px;
        text-align: center;
        color: #ffffff;
        box-shadow: 0 12px 32px rgba(4, 30, 58, 0.15);
        position: relative;
        overflow: hidden;
    }
    .product-cta-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(203,168,93,0.2) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .product-cta-title {
        font-size: clamp(20px, 2.6vw, 30px);
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    .product-cta-desc {
        font-size: 14.5px;
        color: #cbd5e1;
        max-width: 680px;
        margin: 0 auto 28px;
        line-height: 1.6;
    }
    .product-cta-actions {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .product-cta-btn-gold {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #cba85d;
        color: #041e3a;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(203, 168, 93, 0.3);
        transition: all 0.25s ease;
    }
    .product-cta-btn-gold:hover {
        background: #e0be6c;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(203, 168, 93, 0.45);
        color: #041e3a;
    }
    .product-cta-btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #25d366;
        color: #ffffff;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(37, 211, 102, 0.25);
        transition: all 0.25s ease;
    }
    .product-cta-btn-wa:hover {
        background: #22bf5b;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        color: #ffffff;
    }
    </style>

    <div class="product-wrapper">
        
        <!-- HERO / HEADER SECTION (White Design Reference from Projects) -->
        <div class="product-hero-header">
            <span class="product-hero-badge">PRODUK & SISTEM ARSITEKTURAL RESMI</span>
            <h1 class="product-hero-title">
                Sistem Kusen, Kaca & Eksterior-Interior Arsitektural<br>
                Solusi Presisi Hunian Modern hingga Gedung Komersial
            </h1>
            <svg class="product-gold-arc" width="300" height="15" viewBox="0 0 300 15">
                <path d="M 0,12 Q 150,0 300,12" stroke="#cba85d" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            </svg>
            <p class="product-hero-desc">
                Jelajahi seluruh lini produk fabrikasi presisi Griya Djaya Sentosa. Dirancang dengan teknologi mutakhir, material bersertifikasi SNI dan internasional, serta didukung garansi resmi pabrik hingga 10 tahun.
            </p>

            <!-- Trust Strip (Projects / Contacts Style) -->
            <div class="product-trust-strip">
                <span class="product-trust-pill">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    Garansi Resmi Profil 10 Tahun
                </span>
                <span class="product-trust-pill">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Gratis Survei Lapangan & RAB
                </span>
                <span class="product-trust-pill">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    Fabrikasi Workshop & Mesin CNC
                </span>
                <span class="product-trust-pill">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                    Kedap Suara 30-40dB & Anti Bocor
                </span>
            </div>
        </div>

        <!-- PRODUCT CARDS GRID (Projects Style Card Redesign) -->
        <div class="product-grid" id="productGrid">
            
            <!-- CARD 1: UPVC -->
            <a href="<?php echo home_url('/product/upvc/'); ?>" class="product-card" data-category="upvc">
                <div class="product-card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.17.33.png" alt="Pintu & Jendela uPVC Conch Falken" loading="lazy">
                    <span class="product-card-badge-top">Garansi 10 Tahun</span>
                    <span class="product-card-badge-sub">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="#cba85d" stroke-width="2.5" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        Conch & Falken
                    </span>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat">Sistem Pintu & Jendela</span>
                    <h3 class="product-card-title">Pintu & Jendela uPVC Elegan</h3>
                    <p class="product-card-desc">
                        Sistem kusen uPVC kedap suara maksimal (30–40 dB), anti rayap seumur hidup, tahan cuaca tropis, dan diperkuat besi hollow galvanis di dalam profil.
                    </p>
                    <ul class="product-card-features">
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Profil Orisinil Conch & Falken Grade A
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Multi-Point Lock & Karet EPDM Anti Bocor
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Pilihan Warna: Putih, Cokelat, Hitam & Wood
                        </li>
                    </ul>
                    <span class="product-card-btn">
                        Lihat Detail Produk
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>

            <!-- CARD 2: ALUMUNIUM -->
            <a href="<?php echo home_url('/product/alumunium/'); ?>" class="product-card" data-category="alumunium">
                <div class="product-card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.21.32.png" alt="Kusen & Jendela Alumunium YKK Alexindo" loading="lazy">
                    <span class="product-card-badge-top">Struktur Kokoh</span>
                    <span class="product-card-badge-sub">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="#cba85d" stroke-width="2.5" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        YKK AP & Alexindo
                    </span>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat">Kusen Arsitektural</span>
                    <h3 class="product-card-title">Kusen & Jendela Alumunium Presisi</h3>
                    <p class="product-card-desc">
                        Profil alumunium berbobot ringan dengan kekuatan struktural tinggi. Tersedia dimensi 3 & 4 inch dengan finishing Powder Coating dan Anodize anti karat.
                    </p>
                    <ul class="product-card-features">
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Pilihan Merek: YKK AP, Alexindo, Forta
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Finishing Tahan UV & Anti Korosi Garam
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Model Sliding, Swing, Lipat & Pivot
                        </li>
                    </ul>
                    <span class="product-card-btn">
                        Lihat Detail Produk
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>

            <!-- CARD 3: KACA -->
            <a href="<?php echo home_url('/product/kaca/'); ?>" class="product-card" data-category="kaca">
                <div class="product-card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.20.40.png" alt="Partisi & Kanopi Kaca Tempered" loading="lazy">
                    <span class="product-card-badge-top">Safety Glass</span>
                    <span class="product-card-badge-sub">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="#cba85d" stroke-width="2.5" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        Tempered & Laminated
                    </span>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat">Kaca Arsitektural</span>
                    <h3 class="product-card-title">Partisi & Kanopi Kaca Tempered</h3>
                    <p class="product-card-desc">
                        Tingkatkan kesan luas, elegan, dan mewah dengan pencahayaan alami optimal. Menggunakan kaca tempered 8mm–12mm bersertifikasi SNI dan aksesoris stainless 304.
                    </p>
                    <ul class="product-card-features">
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Partisi Kantor Frameless & Shower Box
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Kanopi Spider Fitting & Railing Balkon Kaca
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Kaca Tempered, Laminated & Fluted Glass
                        </li>
                    </ul>
                    <span class="product-card-btn">
                        Lihat Detail Produk
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>

            <!-- CARD 4: BESI & STAINLESS -->
            <a href="<?php echo home_url('/product/besi-stainless/'); ?>" class="product-card" data-category="besi">
                <div class="product-card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.19.41.png" alt="Pagar Besi & Railing Stainless Steel" loading="lazy">
                    <span class="product-card-badge-top">Heavy Duty</span>
                    <span class="product-card-badge-sub">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="#cba85d" stroke-width="2.5" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        Stainless 304 & Galvanis
                    </span>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat">Struktur & Keamanan</span>
                    <h3 class="product-card-title">Pagar Besi, Railing & Kanopi</h3>
                    <p class="product-card-desc">
                        Keamanan berpadu estetika kontemporer. Fabrikasi presisi besi hollow galvanis dan stainless steel SUS 304 dengan finishing anti karat dan opsi motif laser cutting.
                    </p>
                    <ul class="product-card-features">
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Pagar Geser, Pintu Lipat & Pintu Dorong
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Railing Tangga, Void & Kanopi Rangka Besi
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Finishing Epoxy Primer & Polyurethane
                        </li>
                    </ul>
                    <span class="product-card-btn">
                        Lihat Detail Produk
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>

            <!-- CARD 5: FASAD -->
            <a href="<?php echo home_url('/product/fasad/'); ?>" class="product-card" data-category="fasad">
                <div class="product-card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Curtain-Wall-2-2.png" alt="Fasad Gedung ACP & Curtain Wall" loading="lazy" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/ACP-2-1.png';">
                    <span class="product-card-badge-top">Eksterior Gedung</span>
                    <span class="product-card-badge-sub">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="#cba85d" stroke-width="2.5" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        ACP Seven & Marks
                    </span>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat">Sistem Fasad Eksterior</span>
                    <h3 class="product-card-title">Fasad (ACP & Curtain Wall)</h3>
                    <p class="product-card-desc">
                        Solusi arsitektur modern untuk gedung kantor, showroom, dan ruko komersial. Menggunakan Aluminium Composite Panel tahan radiasi UV dan kaca curtain wall kedap angin.
                    </p>
                    <ul class="product-card-features">
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            ACP Seven, Marks, Alucobond Resmi
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Curtain Wall Stick System & Unitized
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Tahan UV, Anti Retak & Mudah Pemeliharaan
                        </li>
                    </ul>
                    <span class="product-card-btn">
                        Lihat Detail Produk
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>

            <!-- CARD 6: INTERIOR -->
            <a href="<?php echo home_url('/product/interior/'); ?>" class="product-card" data-category="interior">
                <div class="product-card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/interior-hero.jpg" alt="Interior Design & Fitting Out Presisi" loading="lazy" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.20.40.png';">
                    <span class="product-card-badge-top">Custom Fit-Out</span>
                    <span class="product-card-badge-sub">
                        <svg viewBox="0 0 24 24" width="13" height="13" stroke="#cba85d" stroke-width="2.5" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        3D Design & Joinery
                    </span>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat">Interior & Visual</span>
                    <h3 class="product-card-title">Interior (Design & Fitting Out)</h3>
                    <p class="product-card-desc">
                        Layanan satu atap mulai dari denah tata ruang 2D, visualisasi 3D realistis, hingga eksekusi fabrikasi workshop custom kitchen set, wardrobe, backdrop TV, dan wall panel.
                    </p>
                    <ul class="product-card-features">
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Gambar Kerja DED & Render 3D Photoreal
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Kitchen Set, Wardrobe & Kisi-Kisi Kayu
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Bahan Plywood / Multiplex & Finishing HPL Duco
                        </li>
                    </ul>
                    <span class="product-card-btn">
                        Lihat Detail Produk
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </span>
                </div>
            </a>

        </div>

        <!-- SECTION 2: MENGAPA MEMILIH KAMI (White/Slate Split Layout) -->
        <div class="product-why-section">
            <div class="product-why-grid">
                <div>
                    <div class="product-why-subtitle">STANDAR KUALITAS GRIYA DJAYA SENTOSA</div>
                    <h2 class="product-why-title">Menghadirkan Solusi Fabrikasi Presisi & Bergaransi untuk Hunian Impian Anda</h2>
                    
                    <div class="product-accordion">
                        <div class="product-acc-item active">
                            <div class="product-acc-header" onclick="toggleProductAcc(this)">
                                <span>Material Terbaik Bersertifikasi</span>
                                <svg class="product-acc-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="product-acc-body" style="display: block;">
                                Kami hanya menggunakan bahan baku pilihan dari produsen resmi berstandar SNI dan internasional (uPVC Conch/Falken, Alumunium YKK AP/Alexindo, Kaca Asahimas). Hal ini memastikan setiap produk memiliki daya tahan cuaca maksimal dan usia pakai puluhan tahun.
                            </div>
                        </div>

                        <div class="product-acc-item">
                            <div class="product-acc-header" onclick="toggleProductAcc(this)">
                                <span>Perakitan Mesin CNC & Presisi Milimeter</span>
                                <svg class="product-acc-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="product-acc-body">
                                Dikerjakan langsung di workshop sendiri dengan dukungan mesin potong presisi dan sistem pengelasan sudut otomatis. Sambungan sudut rapat tanpa celah, kedap debu, serta lolos uji kebocoran air hujan.
                            </div>
                        </div>

                        <div class="product-acc-item">
                            <div class="product-acc-header" onclick="toggleProductAcc(this)">
                                <span>Kustomisasi Model & Dimensi Fleksibel</span>
                                <svg class="product-acc-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="product-acc-body">
                                Menyediakan berbagai variasi bukaan (sliding, swing, folding, jungkit, pivot) hingga bentuk lengkung (bending custom). Bebas disesuaikan dengan konsep denah arsitektur dan gaya interior Anda.
                            </div>
                        </div>

                        <div class="product-acc-item">
                            <div class="product-acc-header" onclick="toggleProductAcc(this)">
                                <span>Harga Kompetitif & Transparansi Biaya</span>
                                <svg class="product-acc-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="product-acc-body">
                                Dapatkan penawaran harga tangan pertama (first-hand fabricator) tanpa perantara. Dilengkapi rincian Rencana Anggaran Biaya (RAB) yang transparan dan gratis layanan survei lokasi se-Jabodetabek.
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="product-showcase-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.20.40.png" alt="Showcase Interior & Kaca Griya Djaya Sentosa" class="product-showcase-img">
                    </div>
                    <div class="product-quote-card">
                        <p class="product-quote-text">
                            "Detail menentukan kualitas. Kami tidak hanya mengedepankan kekuatan dan kekokohan konstruksi, tetapi juga estetika arsitektur yang memberi rasa nyaman jangka panjang."
                        </p>
                        <div class="product-quote-author">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#cba85d" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Manajemen Griya Djaya Sentosa
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: SPESIFIKASI & PILAR MATERIAL (6 Clean White Feature Cards) -->
        <div class="product-specs-section">
            <div class="product-specs-header">
                <span class="product-hero-badge">KEUNGGULAN MATERIAL & SPESIFIKASI</span>
                <h2 style="color: #041e3a; font-size: clamp(22px, 3vw, 32px); font-weight: 700; margin-bottom: 8px;">
                    Standar Teknis Material Pilihan
                </h2>
                <p style="color: #64748b; font-size: 14px; max-width: 600px; margin: 0 auto;">
                    Setiap material kami uji kelayakan dan ketahanannya terhadap cuaca ekstrem tropis Indonesia.
                </p>
            </div>

            <div class="product-specs-grid">
                <div class="product-spec-card">
                    <div class="product-spec-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    </div>
                    <h4 class="product-spec-title">Kusen uPVC Conch & Falken</h4>
                    <p class="product-spec-desc">Insulasi termal optimal menghemat energi AC, kedap suara jalanan hingga 40 dB, dan bebas korosi seumur hidup.</p>
                </div>

                <div class="product-spec-card">
                    <div class="product-spec-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h4 class="product-spec-title">Alumunium YKK & Alexindo</h4>
                    <p class="product-spec-desc">Ketebalan presisi standar arsitektural dengan lapisan anodize / powder coating premium tahan gores dan anti karat.</p>
                </div>

                <div class="product-spec-card">
                    <div class="product-spec-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h4 class="product-spec-title">Kaca Tempered & Laminated</h4>
                    <p class="product-spec-desc">Kekuatan benturan 5x lipat kaca biasa. Pecahan tumpul granular aman (safety glass) untuk partisi dan kanopi eksterior.</p>
                </div>

                <div class="product-spec-card">
                    <div class="product-spec-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    </div>
                    <h4 class="product-spec-title">Besi Galvanis & Stainless 304</h4>
                    <p class="product-spec-desc">Pengelasan argon rapi dan finishing epoxy anti karat. Sangat kokoh untuk perlindungan gerbang, pagar, dan railing.</p>
                </div>

                <div class="product-spec-card">
                    <div class="product-spec-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h4 class="product-spec-title">Fasad ACP & Curtain Wall</h4>
                    <p class="product-spec-desc">Panel komposit PVDF tahan sinar ultraviolet dan cuaca ekstrem, menjadikan tampilan gedung komersial lebih megah dan berkelas.</p>
                </div>

                <div class="product-spec-card">
                    <div class="product-spec-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <h4 class="product-spec-title">Interior Fit-Out & Joinery</h4>
                    <p class="product-spec-desc">Material plywood kualitas tinggi, finishing HPL Taco/Duco rapi, didukung perancangan 3D realistis sesuai luas ruangan.</p>
                </div>
            </div>
        </div>

        <!-- SECTION 4: CALL TO ACTION (CTA Banner) -->
        <div class="product-cta-card">
            <h3 class="product-cta-title">Siap Wujudkan Proyek Kusen & Bangunan Berkualitas?</h3>
            <p class="product-cta-desc">
                Konsultasikan gambar kerja, spesifikasi teknis, atau jadwalkan survei pengukuran gratis ke lokasi proyek Anda bersama tim engineering Griya Djaya Sentosa.
            </p>
            <div class="product-cta-actions">
                <a href="https://api.whatsapp.com/send/?phone=628111021088&text=Halo+Griya+Djaya+Sentosa%2C+saya+ingin+konsultasi+mengenai+produk+dan+estimasi+RAB+proyek&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer" class="product-cta-btn-wa">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.06-2.02-.486-1.637-.674-2.704-2.316-2.785-2.425-.082-.108-.667-.887-.667-1.691s.423-1.2.574-1.354c.15-.154.327-.193.436-.193.11 0 .218.002.312.008.102.006.239-.039.373.285.144.348.491 1.198.534 1.285.044.088.073.19.015.304-.058.114-.088.185-.174.286-.088.101-.184.225-.263.303-.088.087-.18.182-.078.358.102.176.453.748.973 1.212.671.599 1.236.784 1.412.871.176.087.28.073.385-.047.105-.12.449-.523.569-.702.12-.18.24-.15.405-.09.165.06 1.05.495 1.23.585.18.09.3.135.344.21.045.075.045.435-.099.84zM12 2C6.477 2 2 6.477 2 12c0 1.81.488 3.504 1.336 4.966L2.05 22l5.188-1.361A9.956 9.956 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"></path></svg>
                    Konsultasi Cepat via WhatsApp
                </a>
                <a href="<?php echo home_url('/contacts/'); ?>" class="product-cta-btn-gold">
                    Ajukan Gambar Kerja & Blueprint &rarr;
                </a>
            </div>
        </div>

    </div>
</main>
<!-- product main content end -->

<script>
// Interactive Accordion Function for "Mengapa Memilih Kami"
function toggleProductAcc(element) {
    var item = element.parentElement;
    var body = item.querySelector('.product-acc-body');
    var isActive = item.classList.contains('active');

    // Close all accordion items
    var allItems = document.querySelectorAll('.product-acc-item');
    allItems.forEach(function(el) {
        el.classList.remove('active');
        var elBody = el.querySelector('.product-acc-body');
        if (elBody) elBody.style.display = 'none';
    });

    // If was not active, open it
    if (!isActive) {
        item.classList.add('active');
        if (body) body.style.display = 'block';
    }
}
</script>

<?php get_footer(); ?>
