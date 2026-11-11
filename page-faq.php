<?php
/* Template Name: Faq */
global $custom_css; $custom_css = 'faq'; get_header();
?>
<style>
/* ========================================================
   Clean White Hero Header Section (Projects Page Style)
   ======================================================== */
.faq-hero-white {
    background: #ffffff;
    padding: 104px 20px 36px;
    position: relative;
    text-align: center;
    border-bottom: 1px solid #f1f5f9;
}
.faq-hero-container {
    max-width: 860px;
    margin: 0 auto;
}
.faq-hero-title {
    color: #041e3a;
    font-size: clamp(24px, 3.8vw, 38px);
    font-weight: 700;
    line-height: 1.25;
    margin-bottom: 0;
    font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
    letter-spacing: -0.5px;
}
.faq-hero-subtitle-lead {
    font-size: clamp(15px, 2.2vw, 20px);
    font-weight: 600;
    color: #041e3a;
    display: block;
    margin-top: 4px;
    font-family: 'Outfit', 'Inter', sans-serif;
}
.faq-gold-arc {
    margin: 10px auto 16px;
    display: block;
}
.faq-hero-desc {
    font-size: clamp(14px, 1.6vw, 15px);
    color: #64748b;
    line-height: 1.65;
    margin-bottom: 22px;
    max-width: 680px;
    margin-left: auto;
    margin-right: auto;
}

/* Light-Themed Search Box */
.faq-search-wrap {
    max-width: 580px;
    margin: 0 auto 18px;
    position: relative;
}
.faq-search-input-box {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border-radius: 50px;
    padding: 5px 14px 5px 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    border: 1.5px solid #e2e8f0;
    transition: all 0.25s ease;
}
.faq-search-input-box:focus-within {
    border-color: #cba85d;
    background: #ffffff;
    box-shadow: 0 6px 20px rgba(203, 168, 93, 0.2);
}
.faq-search-icon {
    width: 18px;
    height: 18px;
    color: #041e3a;
    flex-shrink: 0;
    margin-right: 12px;
}
.faq-search-input {
    width: 100%;
    border: none;
    outline: none;
    background: transparent;
    font-size: 14.5px;
    color: #0f172a;
    font-family: inherit;
    padding: 7px 0;
}
.faq-search-input::placeholder {
    color: #94a3b8;
}
.faq-search-clear {
    background: #e2e8f0;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: none;
    align-items: center;
    justify-content: center;
    color: #475569;
    cursor: pointer;
    font-size: 15px;
    line-height: 1;
    transition: all 0.2s ease;
    flex-shrink: 0;
    margin-left: 8px;
}
.faq-search-clear:hover {
    background: #cbd5e1;
    color: #0f172a;
}

/* Category Filter Pills (Matches .projects-filters) */
.faq-filter-pills {
    display: flex;
    justify-content: center;
    gap: clamp(8px, 1.8vw, 12px);
    flex-wrap: wrap;
    margin-top: 6px;
    padding: 0;
    list-style: none;
}
.faq-pill {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #4a5568;
    padding: 7px 18px;
    border-radius: 25px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
    font-family: inherit;
}
.faq-pill:hover {
    color: #ffffff;
    background: #cba85d;
    border-color: #cba85d;
}
.faq-pill.active {
    color: #ffffff;
    background: #cba85d;
    border-color: #cba85d;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(203, 168, 93, 0.3);
}

/* ========================================================
   Main Content Layout (Two Columns)
   ======================================================== */
.faq-main-wrapper {
    background-color: #f8fafc;
    padding: 44px 0 70px;
}
.faq-grid-layout {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 36px;
    align-items: start;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Sticky Left Sidebar */
.faq-sidebar {
    position: sticky;
    top: 100px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.faq-side-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}
.faq-side-card-title {
    font-size: 16px;
    font-weight: 800;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.faq-side-card-desc {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 18px;
}
.faq-contact-list {
    list-style: none;
    padding: 0;
    margin: 0 0 18px;
}
.faq-contact-list-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: #334155;
    margin-bottom: 10px;
}
.faq-contact-list-item a {
    color: #041e3a;
    text-decoration: none;
    font-weight: 700;
}
.faq-contact-list-item a:hover {
    color: #cba85d;
}

.faq-btn-wa-full {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #25d366;
    color: #ffffff !important;
    font-weight: 700;
    font-size: 13.5px;
    padding: 12px 18px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px rgba(37, 211, 102, 0.25);
    width: 100%;
    box-sizing: border-box;
}
.faq-btn-wa-full:hover {
    background: #1eb956;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.35);
}

.faq-hours-mini {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 14px;
    margin-top: 14px;
    font-size: 12px;
    color: #475569;
}
.faq-hours-mini strong {
    color: #041e3a;
    display: block;
    margin-bottom: 2px;
}

/* Quick Category Links Card */
.faq-quick-links {
    list-style: none;
    padding: 0;
    margin: 0;
}
.faq-quick-links li {
    margin-bottom: 8px;
}
.faq-quick-links li:last-child {
    margin-bottom: 0;
}
.faq-quick-links a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    color: #041e3a;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
}
.faq-quick-links a:hover {
    background: #041e3a;
    color: #ffffff;
    border-color: #041e3a;
    transform: translateX(3px);
}
.faq-quick-links a svg {
    transition: transform 0.2s ease;
}
.faq-quick-links a:hover svg {
    transform: translateX(3px);
}

/* ========================================================
   Accordion List (Right Column)
   ======================================================== */
.faq-accordion-group {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.faq-item {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}
.faq-item:hover {
    border-color: #cbd5e1;
    box-shadow: 0 6px 20px rgba(4, 30, 58, 0.05);
}
.faq-item.active {
    border-color: #cba85d;
    box-shadow: 0 8px 25px rgba(203, 168, 93, 0.12);
}

.faq-trigger {
    width: 100%;
    text-align: left;
    background: #ffffff;
    border: none;
    padding: 20px 22px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}
.faq-item.active .faq-trigger {
    background: #fdfbf7;
}
.faq-trigger-content {
    flex-grow: 1;
}
.faq-badge-category {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 3px 8px;
    border-radius: 4px;
    margin-bottom: 6px;
}
.faq-badge-material { background: #eff6ff; color: #1e40af; }
.faq-badge-layanan { background: #f0fdf4; color: #166534; }
.faq-badge-proyek { background: #fefce8; color: #854d0e; }

.faq-question-title {
    font-size: 16.5px;
    font-weight: 700;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    line-height: 1.4;
    margin: 0;
    transition: color 0.2s ease;
}
.faq-item.active .faq-question-title {
    color: #9f7d2f;
}

.faq-toggle-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #041e3a;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
    transition: all 0.25s ease;
}
.faq-item.active .faq-toggle-icon {
    background: #cba85d;
    color: #ffffff;
    transform: rotate(180deg);
}

.faq-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease;
    background: #ffffff;
}
.faq-content-inner {
    padding: 0 22px 22px;
    font-size: 14.5px;
    color: #475569;
    line-height: 1.7;
    border-top: 1px solid #f1f5f9;
    padding-top: 16px;
}
.faq-content-inner p {
    margin: 0 0 10px;
}
.faq-content-inner p:last-child {
    margin-bottom: 0;
}
.faq-content-inner strong {
    color: #0f172a;
}
.faq-content-inner a {
    color: #cba85d;
    font-weight: 700;
    text-decoration: underline;
}

/* Empty Search Results */
.faq-empty-state {
    display: none;
    text-align: center;
    padding: 60px 20px;
    background: #ffffff;
    border-radius: 12px;
    border: 1px dashed #cbd5e1;
}
.faq-empty-icon {
    width: 48px;
    height: 48px;
    color: #94a3b8;
    margin: 0 auto 12px;
}
.faq-empty-title {
    font-size: 18px;
    font-weight: 700;
    color: #041e3a;
    margin-bottom: 6px;
}
.faq-empty-desc {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 20px;
    max-width: 440px;
    margin-left: auto;
    margin-right: auto;
}

/* ========================================================
   Bottom CTA Section
   ======================================================== */
.faq-bottom-cta {
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    padding: 60px 20px;
    text-align: center;
}
.faq-cta-box {
    max-width: 800px;
    margin: 0 auto;
}
.faq-cta-title {
    font-size: clamp(24px, 3.5vw, 34px);
    font-weight: 800;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    margin-bottom: 12px;
    line-height: 1.25;
}
.faq-cta-desc {
    font-size: 15px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 26px;
}
.faq-cta-buttons {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
}
.faq-btn-cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 26px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s ease;
}
.faq-btn-cta-wa {
    background: #25d366;
    color: #ffffff;
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.25);
}
.faq-btn-cta-wa:hover {
    background: #1eb956;
    transform: translateY(-2px);
    color: #ffffff;
}
.faq-btn-cta-contact {
    background: #041e3a;
    color: #ffffff;
}
.faq-btn-cta-contact:hover {
    background: #0b2f59;
    transform: translateY(-2px);
    color: #ffffff;
}

/* ========================================================
   Responsive Media Queries
   ======================================================== */
@media (max-width: 991px) {
    .faq-grid-layout {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .faq-sidebar {
        position: static;
    }
}
@media (max-width: 768px) {
    .faq-hero-white {
        padding: 84px 16px 28px !important;
    }
    .faq-main-wrapper {
        padding: 30px 0 50px;
    }
    .faq-trigger {
        padding: 16px 16px;
    }
    .faq-content-inner {
        padding: 0 16px 18px;
    }
    .faq-question-title {
        font-size: 15px;
    }
    .faq-pill {
        font-size: 12px;
        padding: 5px 12px;
    }
}
</style>

<main class="faq-page-main" style="background: #ffffff;">
    <!-- 1. Hero Header Section (Clean White - Projects Page Style) -->
    <section class="faq-hero-white">
        <div class="faq-hero-container">
            <h1 class="faq-hero-title">
                Pertanyaan yang Sering Diajukan<br>
                <span class="faq-hero-subtitle-lead">Seputar Produk, Pemesanan &amp; Garansi Resmi</span>
            </h1>
            <svg class="faq-gold-arc" width="300" height="15" viewBox="0 0 300 15">
                <path d="M 0,12 Q 150,0 300,12" stroke="#cba85d" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            </svg>
            <p class="faq-hero-desc">
                Temukan jawaban lengkap dan transparan seputar spesifikasi material kusen UPVC Conch, aluminium arsitektural, sistem fasad, alur pemesanan, hingga garansi resmi pekerjaan kami.
            </p>

            <!-- Live Search Bar -->
            <div class="faq-search-wrap">
                <div class="faq-search-input-box">
                    <svg class="faq-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Cari pertanyaan... (cth: garansi, survei, harga, upvc, waktu)" autocomplete="off">
                    <button type="button" id="faqSearchClear" class="faq-search-clear" aria-label="Hapus Pencarian">&times;</button>
                </div>
            </div>

            <!-- Category Filter Pills (Matches Projects page filter style) -->
            <div class="faq-filter-pills" id="faqFilterPills">
                <button type="button" class="faq-pill active" data-filter="all">Semua Kategori</button>
                <button type="button" class="faq-pill" data-filter="material">Material &amp; Spesifikasi</button>
                <button type="button" class="faq-pill" data-filter="layanan">Layanan &amp; Pemesanan</button>
                <button type="button" class="faq-pill" data-filter="proyek">Proyek &amp; Wilayah</button>
            </div>
        </div>
    </section>

    <!-- 2. Main Content Section: Two Columns -->
    <section class="faq-main-wrapper">
        <div class="faq-grid-layout">
            
            <!-- Kolom Kiri: Sidebar Konsultasi & Kontak -->
            <aside class="faq-sidebar">
                
                <!-- Card 1: Bantuan Cepat -->
                <div class="faq-side-card">
                    <div class="faq-side-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#041e3a" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        Butuh Jawaban Spesifik?
                    </div>
                    <p class="faq-side-card-desc">
                        Kirimkan denah arsitektur, gambar kerja, atau rincian spesifikasi Anda langsung ke konsultan teknis kami.
                    </p>
                    
                    <ul class="faq-contact-list">
                        <li class="faq-contact-list-item">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#041e3a" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span>Telp: <a href="tel:+622180476151">(021) 8047 6151</a></span>
                        </li>
                        <li class="faq-contact-list-item">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#041e3a" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span>Email: <a href="mailto:info@griyadjayasentosa.id">info@griyadjayasentosa.id</a></span>
                        </li>
                    </ul>

                    <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20konsultasi%20mengenai%20kebutuhan%20proyek%20saya" target="_blank" class="faq-btn-wa-full">
                        <svg width="17" height="17" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                        Chat WhatsApp Sekarang
                    </a>

                    <div class="faq-hours-mini">
                        <strong>Jam Layanan Workshop &amp; Kantor:</strong>
                        Senin &ndash; Sabtu: 08:00 &ndash; 17:00 WIB<br>
                        (Konsultasi online via WhatsApp tetap aktif)
                    </div>
                </div>

                <!-- Card 2: Navigasi Cepat -->
                <div class="faq-side-card">
                    <div class="faq-side-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#041e3a" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Tautan Penting
                    </div>
                    <ul class="faq-quick-links">
                        <li>
                            <a href="<?php echo home_url('/product/upvc/'); ?>">
                                <span>Katalog UPVC Conch</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo home_url('/product/alumunium/'); ?>">
                                <span>Kusen Aluminium YKK</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo home_url('/warranty/'); ?>">
                                <span>Portal Garansi Resmi</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo home_url('/contacts/'); ?>">
                                <span>Kirim Blueprint &amp; Form RAB</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </li>
                    </ul>
                </div>

            </aside>

            <!-- Kolom Kanan: Daftar Accordion FAQ -->
            <div class="faq-accordion-group" id="faqAccordionGroup">
                
                <!-- Item 1: Estimasi Waktu -->
                <div class="faq-item" data-category="layanan">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-layanan">Layanan &amp; Waktu</span>
                            <h3 class="faq-question-title">Berapa lama estimasi pengerjaan untuk proyek kusen atau fasad?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                Estimasi waktu pengerjaan bergantung pada volume pesanan dan tingkat kerumitan desain:
                            </p>
                            <p>
                                &bull; <strong>Proyek Rumah Tinggal (Skala Menengah):</strong> Umumnya memakan waktu <strong>7 &ndash; 14 hari kerja</strong> setelah pengukuran akhir (opname) terkonfirmasi dan approval gambar kerja teknis (shop drawing).<br>
                                &bull; <strong>Proyek Gedung &amp; Komersial:</strong> Linimasa fabrikasi dan pemasangan di lapangan diselaraskan penuh dengan <em>master schedule</em> kontraktor utama.<br>
                                &bull; Rincian jadwal kerja (time schedule) akan dilampirkan secara transparan di dalam surat penawaran (RAB).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 2: Garansi Resmi -->
                <div class="faq-item" data-category="material">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-material">Garansi &amp; Mutu</span>
                            <h3 class="faq-question-title">Apakah produk UPVC dan Aluminium dari Griya Djaya Sentosa bergaransi?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                <strong>Ya, 100% bergaransi resmi.</strong> Kami berkomitmen pada standar keandalan tinggi jangka panjang:
                            </p>
                            <p>
                                &bull; <strong>Profil UPVC Conch:</strong> Dilindungi garansi material pabrik hingga <strong>10 Tahun</strong> terhadap risiko perubahan warna, getas, keropos, atau melengkung akibat radiasi UV cuaca tropis.<br>
                                &bull; <strong>Aksesoris &amp; Hardware:</strong> Dilindungi garansi mekanisme fungsi (engsel, roda, handel, multi-point lock).<br>
                                &bull; <strong>Pemasangan Lapangan:</strong> Dilindungi garansi kebocoran air hujan (sealant watertight guarantee).<br>
                                Status keaslian barcode garansi proyek Anda dapat dicek dan diajukan klaim secara online di menu <a href="<?php echo home_url('/warranty/'); ?>">Portal Garansi Resmi</a>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 3: Wilayah Operasi -->
                <div class="faq-item" data-category="proyek">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-proyek">Wilayah Kerja</span>
                            <h3 class="faq-question-title">Di wilayah mana saja Griya Djaya Sentosa melayani fabrikasi dan pemasangan?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                Dengan 3 titik operasional (Workshop I Cileungsi Bogor, Workshop II Jati Asih Bekasi, dan Material Warehouse Cengkareng Jakarta Barat):
                            </p>
                            <p>
                                &bull; <strong>Jabodetabek, Jawa Barat, &amp; Banten:</strong> Melayani survei, fabrikasi presisi, pengiriman armada sendiri, dan instalasi tuntas di lokasi.<br>
                                &bull; <strong>Luar Pulau &amp; Seluruh Indonesia:</strong> Kami berpengalaman mengirimkan material modular berstandar ekspor beserta tim supervisi / teknisi instalasi ahli ke berbagai kota di Sumatra, Kalimantan, Sulawesi, hingga Bali &amp; Papua.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 4: Desain Custom -->
                <div class="faq-item" data-category="material">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-material">Material &amp; Desain</span>
                            <h3 class="faq-question-title">Apakah saya bisa memesan desain, dimensi, atau warna secara custom?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                <strong>Sangat bisa.</strong> Lebih dari 90% pekerjaan kami adalah fabrikasi <em>custom-made</em> menyesuaikan denah arsitektur dan selera interior Anda:
                            </p>
                            <p>
                                &bull; <strong>Tipe Bukaan:</strong> Pintu lipat (bi-fold), sliding/geser (2/3/4/6 daun), swing, jungkit/awning, pivot, kacamati (fixed), hingga kombinasi lengkung (bending arch).<br>
                                &bull; <strong>Pilihan Warna UPVC Conch:</strong> White (Putih murni), Black (Hitam doff), Coklat, Wood Golden Oak, dan Wood Dark Oak (serat kayu bertekstur alami).<br>
                                &bull; <strong>Pilihan Aluminium:</strong> YKK AP dan Alexindo dengan anodized finishing atau powder coating custom sesuai kode warna arsitek.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 5: Survei Lokasi -->
                <div class="faq-item" data-category="layanan">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-layanan">Survei &amp; RAB</span>
                            <h3 class="faq-question-title">Apakah tersedia layanan survei lokasi dan konsultasi teknis gratis?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                <strong>Ya, gratis tanpa dipungut biaya.</strong> Kami menyediakan survei pengukuran presisi dan konsultasi teknis untuk seluruh wilayah Jabodetabek:
                            </p>
                            <p>
                                &bull; Teknisi engineering kami akan datang membawa alat ukur laser presisi tinggi dan contoh sample fisik profil UPVC/Aluminium serta katalog warna.<br>
                                &bull; Hasil pengukuran akan langsung diproses ke dalam draft penawaran (RAB resmi) dengan rincian harga transparan dan spesifikasi material terurai jelas.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 6: Keunggulan UPVC Conch -->
                <div class="faq-item" data-category="material">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-material">Material Conch</span>
                            <h3 class="faq-question-title">Apa keunggulan kusen UPVC Conch dibandingkan material kayu atau aluminium biasa?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                Profil UPVC Conch merupakan material komposit modern generasi terbaru dengan 5 keunggulan utama:
                            </p>
                            <p>
                                1. <strong>Rangka Baja Galvanis Internal:</strong> Setiap profil diperkuat tulangan baja anti-karat di bagian dalam rongga, menjamin kekakuan struktural setara baja.<br>
                                2. <strong>Kedap Suara Hingga 40 dB:</strong> Sistem rongga multi-chamber dan double EPDM seal meredam kebisingan jalan raya secara signifikan.<br>
                                3. <strong>Efisiensi Termal &amp; Hemat Listrik AC:</strong> Non-konduktif (tidak menghantarkan panas luar ke dalam ruangan), ruangan terasa lebih sejuk.<br>
                                4. <strong>100% Anti-Rayap &amp; Anti-Korosi:</strong> Tidak akan keropos oleh rayap seperti kayu, dan tidak korosi garam di kawasan pesisir.<br>
                                5. <strong>Bebas Perawatan Cat:</strong> Warna permanen dari proses ekstrusi senyawa ASA, tidak perlu dicat ulang selamanya.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 7: Skala Proyek -->
                <div class="faq-item" data-category="proyek">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-proyek">Skala Pekerjaan</span>
                            <h3 class="faq-question-title">Apakah melayani renovasi rumah tinggal pribadi atau hanya proyek gedung besar?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                <strong>Kami melayani seluruh spektrum volume proyek:</strong>
                            </p>
                            <p>
                                &bull; <strong>Hunian Pribadi &amp; Renovasi:</strong> Mulai dari penggantian beberapa unit jendela/pintu kamar, renovasi fasad rumah tinggal, ruko, cafe, hingga villa pribadi.<br>
                                &bull; <strong>Proyek Skala Komersial &amp; Kontraktor:</strong> Fabrikasi massal untuk kawasan perumahan klaster, gedung perkantoran bertingkat, rumah sakit, hotel, dan fasad curtain wall bentang lebar.<br>
                                Setiap proyek ditangani dengan standar kontrol mutu (QC) workshop yang sama ketatnya.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 8: Alur Pemesanan -->
                <div class="faq-item" data-category="layanan">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-layanan">Alur Kerja</span>
                            <h3 class="faq-question-title">Bagaimana alur pemesanan dari tahap awal hingga pemasangan selesai?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                Alur kerja sama kami dirancang transparan, presisi, dan terstruktur:
                            </p>
                            <p>
                                1. <strong>Konsultasi &amp; Estimasi Awal:</strong> Kirimkan ukuran kasar, denah, atau foto lokasi via WhatsApp/Formulir Web untuk mendapatkan estimasi perkiraan biaya.<br>
                                2. <strong>Survei Lapangan:</strong> Verifikasi ukuran opening dinding presisi oleh tim teknisi kami.<br>
                                3. <strong>Penerbitan Surat Penawaran (RAB) &amp; SPK:</strong> Finalisasi spesifikasi material, jadwal pengerjaan, dan termin pembayaran.<br>
                                4. <strong>Fabrikasi Workshop:</strong> Perakitan dengan mesin potong CNC dan pemanas las 4-sudut otomatis di workshop GJS.<br>
                                5. <strong>Pengiriman &amp; Instalasi Lapangan:</strong> Pemasangan rapi oleh teknisi berpengalaman, aplikasi sealant perimeter, dan uji fungsi bukaan.<br>
                                6. <strong>Serah Terima &amp; Sertifikat Garansi:</strong> Pemeriksaan bersama (checklist QC) dan penyerahan barcode garansi resmi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 9: Spesifikasi Kaca & Aksesoris Hardware -->
                <div class="faq-item" data-category="material">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-material">Kaca &amp; Aksesoris</span>
                            <h3 class="faq-question-title">Pilihan jenis kaca dan merek aksesoris hardware apa saja yang digunakan?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                Kami hanya bermitra dengan produsen kaca dan hardware arsitektural kelas satu bersertifikasi:
                            </p>
                            <p>
                                &bull; <strong>Pilihan Kaca (Asahimas / Mulia Glass):</strong> Kaca bening (clear float) 5mm–12mm, Kaca Es (Frosted), Stopsol/Panasap (penolak panas matahari), Kaca Tempered Safety, Kaca Laminated (akustik kedap suara tinggi), hingga Double Glazing (Insulated Glass Unit/IGU).<br>
                                &bull; <strong>Aksesoris &amp; Hardware:</strong> Menggunakan merek terpercaya seperti <strong>Kinlong, Hopo, Roto Frank, GQ, Dekkson, dan Kenari Djaja</strong> yang dilengkapi sistem multi-point locking anti-congkel dan engsel heavy-duty stainless steel SUS 304.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 10: Sistem Pembayaran & Kontrak -->
                <div class="faq-item" data-category="layanan">
                    <button type="button" class="faq-trigger" aria-expanded="false">
                        <div class="faq-trigger-content">
                            <span class="faq-badge-category faq-badge-layanan">Pembayaran &amp; Legalitas</span>
                            <h3 class="faq-question-title">Bagaimana skema pembayaran dan legalitas kontrak kerja untuk kontraktor?</h3>
                        </div>
                        <div class="faq-toggle-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p>
                                PT Griya Djaya Sentosa adalah entitas badan usaha resmi dan PKP (Pengusaha Kena Pajak):
                            </p>
                            <p>
                                &bull; <strong>Skema Pembayaran Standar:</strong> Dilakukan bertahap (Down Payment tanda jadi survei/fabrikasi, termin progres pengiriman material, dan pelunasan saat serah terima BAST).<br>
                                &bull; <strong>Faktur Pajak &amp; Invoice Resmi:</strong> Kami menerbitkan invoice resmi, kwitansi perusahaan, serta Faktur Pajak PPN sesuai kebutuhan administrasi proyek korporat atau developer.<br>
                                &bull; <strong>Surat Perjanjian Kerja (SPK):</strong> Mengikat spesifikasi teknis material, merk profil, garansi, dan batas waktu penyelesaian secara berkekuatan hukum.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Empty State jika pencarian tidak menemukan hasil -->
                <div class="faq-empty-state" id="faqEmptyState">
                    <svg class="faq-empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                    <h4 class="faq-empty-title">Pertanyaan Tidak Ditemukan</h4>
                    <p class="faq-empty-desc">
                        Kata kunci yang Anda cari belum ada di daftar FAQ. Jangan ragu untuk bertanya langsung kepada konsultan teknis kami via WhatsApp.
                    </p>
                    <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20menanyakan%20hal%20lain%20terkait%20layanan%20proyek" target="_blank" class="faq-btn-cta faq-btn-cta-wa" style="border-radius: 50px;">
                        Tanyakan via WhatsApp Langsung &rarr;
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. Bottom Consultation Strip -->
    <section class="faq-bottom-cta">
        <div class="faq-cta-box">
            <h2 class="faq-cta-title">Siap Memulai Proyek Anda Bersama Kami?</h2>
            <p class="faq-cta-desc">
                Dapatkan survei lokasi pengukuran presisi se-Jabodetabek dan penawaran RAB transparan tanpa komitmen. Tim spesialis kami siap membantu mewujudkan arsitektur idaman Anda.
            </p>
            <div class="faq-cta-buttons">
                <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya" target="_blank" class="faq-btn-cta faq-btn-cta-wa">
                    <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    Konsultasi via WhatsApp
                </a>
                <a href="<?php echo home_url('/contacts/'); ?>" class="faq-btn-cta faq-btn-cta-contact">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><polyline points="9 15 12 12 15 15"></polyline></svg>
                    Kirim Blueprint &amp; Form Penawaran
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Interactive Accordion, Filter & Real-Time Search JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    const searchInput = document.getElementById('faqSearchInput');
    const searchClear = document.getElementById('faqSearchClear');
    const filterPills = document.querySelectorAll('.faq-pill');
    const emptyState = document.getElementById('faqEmptyState');
    let currentCategory = 'all';

    // 1. Accordion Toggle Logic
    faqItems.forEach(item => {
        const trigger = item.querySelector('.faq-trigger');
        const content = item.querySelector('.faq-content');

        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            const isActive = item.classList.contains('active');

            // Close all other items for a clean single-open accordion feel
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-trigger').setAttribute('aria-expanded', 'false');
                    otherItem.querySelector('.faq-content').style.maxHeight = null;
                }
            });

            if (isActive) {
                item.classList.remove('active');
                trigger.setAttribute('aria-expanded', 'false');
                content.style.maxHeight = null;
            } else {
                item.classList.add('active');
                trigger.setAttribute('aria-expanded', 'true');
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });

    // 2. Filter & Search Combined Function
    function filterFaqs() {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        faqItems.forEach(item => {
            const category = item.getAttribute('data-category');
            const title = item.querySelector('.faq-question-title').innerText.toLowerCase();
            const answer = item.querySelector('.faq-content-inner').innerText.toLowerCase();
            
            const matchesCategory = (currentCategory === 'all' || category === currentCategory);
            const matchesSearch = (!query || title.includes(query) || answer.includes(query));

            if (matchesCategory && matchesSearch) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
                // Close if hidden
                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                    item.querySelector('.faq-trigger').setAttribute('aria-expanded', 'false');
                    item.querySelector('.faq-content').style.maxHeight = null;
                }
            }
        });

        // Show/hide empty state
        if (visibleCount === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }

        // Show/hide clear search button
        if (query.length > 0) {
            searchClear.style.display = 'flex';
        } else {
            searchClear.style.display = 'none';
        }
    }

    // 3. Search Input Events
    if (searchInput) {
        searchInput.addEventListener('input', filterFaqs);
    }
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            filterFaqs();
            searchInput.focus();
        });
    }

    // 4. Category Pill Click Events
    filterPills.forEach(pill => {
        pill.addEventListener('click', function() {
            filterPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.getAttribute('data-filter');
            filterFaqs();
        });
    });
});
</script>

<?php
get_footer();
?>
