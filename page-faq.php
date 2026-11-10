<?php
/* Template Name: Faq */
global $custom_css; $custom_css = 'faq'; get_header();
?>
<style>
/* Solid Header */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

/* Clean & Right-side Up Watermark Banner */
.page .media {
    -webkit-transform: none !important;
    transform: none !important;
    opacity: 0.12 !important;
    right: 2% !important;
    bottom: -15% !important;
    max-width: 480px !important;
    pointer-events: none !important;
}

/* Sticky Left Sidebar on Desktop */
@media screen and (min-width: 1024px) {
    .faq_header {
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }
}

@media (max-width: 768px) {
    .faq.section { padding: 32px 0 !important; }
    .faq_accordion-item .trigger { padding: 14px 16px !important; font-size: 14px !important; }
    .faq_accordion-item .content { padding: 14px 16px !important; }
    .faq_accordion-item .content .text { font-size: 13.5px !important; }
    .faq-contact-card { padding: 16px !important; margin-top: 20px !important; }
}

/* Accordion Polish */
.faq_accordion-item .trigger {
    border-radius: 8px 8px 0 0;
    transition: all 0.25s ease;
    cursor: pointer;
}
.faq_accordion-item .trigger:not([aria-expanded="true"]) {
    border-radius: 8px;
}
.faq_accordion-item .trigger[aria-expanded="true"] {
    color: #cba85d !important;
    border-color: #cba85d #cba85d transparent !important;
    background-color: #fafbfc;
}
.faq_accordion-item .trigger[aria-expanded="true"] .icon .icon-plus {
    opacity: 0;
}
.faq_accordion-item .trigger[aria-expanded="true"] .icon .icon-minus {
    opacity: 1;
    color: #cba85d;
}
.faq_accordion-item .collapse.show .content {
    border-color: #cba85d !important;
    border-radius: 0 0 8px 8px;
    background-color: #fafbfc;
}
.faq_accordion-item .content .text {
    color: #475569;
    line-height: 1.7;
    font-size: 15px;
}

/* Quick Contact Card on Left */
.faq-contact-card {
    margin-top: 28px;
    padding: 22px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
}
.faq-contact-card-title {
    font-size: 14px;
    font-weight: 700;
    color: #041e3a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}
.faq-contact-card p {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 16px;
}
.faq-wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25d366;
    color: #ffffff !important;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 18px;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.2s ease;
}
.faq-wa-btn:hover {
    background: #1eb954;
    transform: translateY(-2px);
}
</style>

<?php get_template_part("template-parts/page-banner"); ?>

<section class="faq section" style="padding: 44px 0 48px !important;">
    <div class="container">
        <!-- Kiri: Header & Kontak -->
        <div class="faq_header section_header">
            <span class="subtitle">Pertanyaan yang Sering Diajukan</span>
            <h2 class="title" style="font-family: 'Outfit', sans-serif;">
                Masih Ada yang Ingin Ditanyakan?
                <span class="highlight" style="color: #0da574;">Hubungi Kami</span>
            </h2>
            <p class="text" style="color: #64748b; line-height: 1.6;">
                Tim konsultan teknis kami siap membantu kebutuhan spesifikasi, fabrikasi, dan instalasi proyek Anda—mulai dari rumah tinggal hingga gedung komersial.
            </p>
            <div class="wrapper">
                <a class="btn" href="<?php echo home_url('/contacts/'); ?>" style="background: #041e3a; color: #fff; border-radius: 50px;">Hubungi Kami</a>
            </div>

            <!-- Quick Help Box -->
            <div class="faq-contact-card">
                <div class="faq-contact-card-title">Respon Cepat Tim Teknis</div>
                <p>Butuh jawaban instan untuk spesifikasi gambar kerja atau penawaran harga (RAB)?</p>
                <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya" target="_blank" class="faq-wa-btn">
                    <svg width="16" height="16" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    WhatsApp: 0811-1021-088
                </a>
            </div>
        </div>

        <!-- Kanan: Accordion FAQ -->
        <div class="faq_accordion" id="faq_accordion">
            <!-- 1. Estimasi Waktu -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false">
                    <span class="question h5">Berapa lama estimasi pengerjaan untuk proyek kusen atau fasad?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseOne" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Estimasi waktu pengerjaan bergantung pada volume pesanan dan tingkat kerumitan desain. Untuk proyek rumah tinggal skala menengah umumnya memakan waktu 7–14 hari kerja setelah pengukuran fix dan approval gambar kerja. Untuk proyek gedung komersial, jadwal kerja disesuaikan dengan master schedule kontraktor. Tim kami akan memberikan estimasi waktu yang transparan bersama surat penawaran (RAB).
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. Garansi & Klaim -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                    <span class="question h5">Apakah produk UPVC dan Aluminium dari Griya Djaya Sentosa bergaransi?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseTwo" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Ya, seluruh produk resmi kami dilindungi garansi. Profil UPVC Conch memiliki garansi resmi hingga 10 tahun terhadap perubahan warna dan kelenturan profil. Kami juga memberikan garansi untuk hardware/aksesori serta garansi kebocoran pemasangan. Anda dapat memverifikasi status dan mengajukan klaim garansi secara langsung melalui portal online kami di menu <a href="<?php echo home_url('/warranty/'); ?>" style="color: #cba85d; font-weight: 600;">Garansi</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. Wilayah Operasi -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                    <span class="question h5">Di wilayah mana saja Griya Djaya Sentosa beroperasi?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseThree" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Workshop dan gudang material kami berlokasi strategis di Cileungsi (Bogor), Jatiasih (Bekasi), dan Cengkareng (Jakarta Barat). Kami melayani fabrikasi serta pemasangan langsung di seluruh wilayah Jabodetabek, Jawa Barat, Banten, dan siap mengirimkan material serta tim teknisi untuk proyek di luar pulau di seluruh Indonesia.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 4. Desain Custom -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false">
                    <span class="question h5">Apakah saya bisa memesan desain atau spesifikasi secara custom?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseFour" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Bisa dan sangat direkomendasikan. Kami memiliki fasilitas fabrikasi modern untuk memproduksi kusen, pintu, dan jendela dengan spesifikasi custom penuh—mulai dari profil UPVC Conch (putih, hitam, motif serat kayu), aluminium YKK/Alexindo, pintu lipat bi-fold, sliding, swing, jungkit, hingga sistem fasad curtain wall dan kanopi kaca tempered.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 5. Survei Lokasi -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false">
                    <span class="question h5">Apakah tersedia layanan survei lokasi dan konsultasi teknis gratis?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseFive" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Ya. Kami menyediakan layanan konsultasi spesifikasi gambar kerja serta survei pengukuran langsung ke lokasi proyek tanpa dipungut biaya untuk wilayah operasional Jabodetabek dan sekitarnya. Tim kami akan membawa contoh sample material fisik agar Anda dapat melihat kualitasnya secara langsung.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 6. Keunggulan UPVC Conch -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false">
                    <span class="question h5">Apa keunggulan kusen UPVC Conch dibandingkan material konvensional?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseSix" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            UPVC Conch memiliki rangka baja galvanis di bagian dalam profil sehingga sangat kokoh. Keunggulan utamanya meliputi kemampuan kedap suara hingga 40 dB, isolasi suhu ruangan (menghemat konsumsi AC), 100% anti-rayap, tahan air & tidak lapuk, tahan api (self-extinguishing), serta bebas biaya pengecatan ulang selamanya.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 7. Skala Proyek -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false">
                    <span class="question h5">Apakah melayani proyek rumah tinggal pribadi atau hanya proyek gedung?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseSeven" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Kami melayani semua skala proyek secara profesional. Mulai dari renovasi atau pembangunan rumah tinggal pribadi (1 unit jendela atau pintu), ruko, villa, cafe, hingga proyek skala besar seperti gedung perkantoran, rumah sakit, hotel, dan kawasan perumahan klaster.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 8. Alur Pemesanan -->
            <div class="faq_accordion-item">
                <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false">
                    <span class="question h5">Bagaimana alur pemesanan dari awal hingga pemasangan selesai?</span>
                    <span class="icon">
                        <i class="icon icon-plus"></i>
                        <i class="icon icon-minus"></i>
                    </span>
                </button>
                <div id="collapseEight" class="collapse" data-bs-parent="#faq_accordion">
                    <div class="content">
                        <p class="text">
                            Alur kerja kami sangat terstruktur: <strong>1. Konsultasi:</strong> Kirimkan gambar kerja/denah atau kebutuhan ukuran Anda. <strong>2. Survei:</strong> Tim kami melakukan verifikasi ukuran presisi di lokasi. <strong>3. Penawaran RAB:</strong> Kami menerbitkan rincian spesifikasi dan harga resmi. <strong>4. Fabrikasi:</strong> Proses perakitan presisi di workshop kami. <strong>5. Instalasi & Handover:</strong> Pemasangan di lokasi oleh teknisi berpengalaman disertai serah terima garansi resmi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA Section (Menggantikan galeri foto miring) -->
<section class="faq-cta-section" style="background: #f8fafc; padding: 56px 0 60px; border-top: 1px solid #e2e8f0; text-align: center;">
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <h3 style="color: #041e3a; font-size: clamp(22px, 3vw, 32px); font-weight: 800; margin-bottom: 14px; font-family: 'Outfit', sans-serif;">
            Punya Pertanyaan Lain Terkait Proyek Anda?
        </h3>
        <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 28px;">
            Konsultasikan gambar kerja, spesifikasi material, dan estimasi biaya (RAB) proyek Anda langsung bersama konsultan teknis kami tanpa dipungut biaya.
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya" target="_blank" style="background: #25d366; color: #ffffff; padding: 13px 30px; border-radius: 50px; font-weight: 700; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(37,211,102,0.25);">
                <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                Konsultasi WhatsApp Sekarang
            </a>
            <a href="<?php echo home_url('/projects/'); ?>" style="background: #041e3a; color: #ffffff; padding: 13px 28px; border-radius: 50px; font-weight: 700; font-size: 14px; text-decoration: none;">
                Lihat Portofolio Proyek
            </a>
        </div>
    </div>
</section>
</main>
<?php
get_footer();
?>
