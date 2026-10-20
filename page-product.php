<?php
/* Template Name: Product */
global $custom_css; $custom_css = 'product'; get_header();
?>
<style>
/* Force blue header */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

/* Global reset for product page */
.prod-page { font-family: 'Inter', sans-serif; color: #1e293b; background-color: #f3f4f6; padding-top: 80px; }
.prod-container { max-width: 1200px; margin: 0 auto; padding: 60px 20px; }

/* Colors */
:root {
    --gold: #cba85d;
    --dark-blue: #0f172a;
    --text-gray: #475569;
    --bg-light: #f8fafc;
}

/* HERO SECTION (From Image 1) */
.hero-sec {
    background-color: var(--dark-blue);
    background-image: linear-gradient(to right, rgba(15,23,42,0.9), rgba(15,23,42,0.7)), url('<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.20.40.png');
    background-size: cover;
    background-position: center;
    padding: 100px 20px;
    text-align: center;
    color: white;
}
.hero-title { font-size: 42px; font-weight: 800; margin-bottom: 15px; line-height: 1.2; }
.hero-subtitle { font-size: 16px; font-weight: 400; color: #cbd5e1; }

/* SECTION 1: CARDS (From Image 2) */
.s1-wrap { padding: 80px 24px 40px; }
.s1-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px; max-width: 1200px; margin: 0 auto; }
@media(max-width: 1024px) { .s1-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 600px) { .s1-grid { grid-template-columns: 1fr; } }

.s1-card {
    background-color: var(--dark-blue);
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}
.s1-card:hover { transform: translateY(-5px); }
.s1-img { width: 100%; height: 200px; object-fit: cover; }
.s1-content { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
.s1-title { font-size: 18px; font-weight: 700; color: var(--gold); margin-bottom: 10px; line-height: 1.3; }
.s1-desc { font-size: 14px; color: #cbd5e1; line-height: 1.5; margin-bottom: 20px; flex-grow: 1; }
.s1-btn { 
    background-color: var(--gold); color: #000; font-size: 13px; font-weight: 700; 
    padding: 8px 16px; border-radius: 6px; display: inline-block; align-self: flex-start;
    text-transform: uppercase; letter-spacing: 0.5px;
}

/* SECTION 2: SPLIT LAYOUT (From Image 2) */
.s2-wrap { padding: 80px 20px; background-color: #f3f4f6; }
.s2-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1200px; margin: 0 auto; align-items: center; }
@media(max-width: 900px) { .s2-grid { grid-template-columns: 1fr; gap: 40px; } }

.s2-subtitle { font-size: 13px; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; }
.s2-title { font-size: 32px; font-weight: 800; color: var(--dark-blue); line-height: 1.3; margin-bottom: 30px; }

/* Accordion */
.s2-accordion { display: flex; flex-direction: column; gap: 0; }
.s2-acc-item { border-bottom: 1px solid #e2e8f0; padding: 16px 0; }
.s2-acc-title { 
    font-size: 16px; font-weight: 600; color: var(--gold); 
    display: flex; justify-content: space-between; align-items: center; 
    cursor: pointer; 
}
.s2-acc-title i { transition: transform 0.3s ease; }
.s2-acc-title.active i { transform: rotate(180deg); }
.s2-acc-content { font-size: 14px; color: var(--text-gray); line-height: 1.6; padding-top: 10px; display: none; }

/* Image Quote */
.s2-img-wrap { position: relative; border-radius: 12px; overflow: hidden; height: 500px; }
.s2-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.s2-quote-box {
    position: absolute; right: -20px; top: 50%; transform: translateY(-50%);
    background: #ffffff; padding: 24px; border-radius: 8px; width: 280px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid #f1f5f9;
}
@media(max-width: 1250px) { .s2-quote-box { right: 20px; } }
@media(max-width: 600px) { .s2-quote-box { position: relative; right: 0; top: 0; transform: none; width: 100%; margin-top: -30px; margin-bottom: 20px; } .s2-grid { gap: 40px; } }
.s2-quote-text { font-size: 14px; font-style: italic; color: var(--dark-blue); margin-bottom: 15px; line-height: 1.6; }
.s2-quote-author { font-size: 13px; font-weight: 700; color: var(--dark-blue); }

/* SECTION 3: BOTTOM GRID (From Image 2) */
.s3-wrap { padding: 60px 24px 100px; background-color: transparent; }
.s3-grid { display: grid; grid-template-columns: 1.2fr 3fr; gap: 60px; max-width: 1200px; margin: 0 auto; align-items: start; }
@media(max-width: 1024px) { .s3-grid { grid-template-columns: 1fr; gap: 40px; } }

/* Left Text Blocks */
.s3-left { display: flex; flex-direction: column; gap: 40px; }

.s3-text-title { font-size: 18px; font-weight: 800; color: var(--dark-blue); margin-bottom: 12px; line-height: 1.3; }
.s3-text-desc { font-size: 13px; color: var(--text-gray); line-height: 1.6; }

/* Right Icons Blocks */
.s3-right { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px 20px; }
@media(max-width: 991px) { .s3-right { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 575px) { .s3-right { grid-template-columns: 1fr; } }
.s3-icon-box { text-align: center; }
.s3-icon { 
    width: 60px; height: 60px; margin: 0 auto 15px; 
    border: 1px solid var(--gold); border-radius: 8px; 
    display: flex; align-items: center; justify-content: center; color: var(--gold);
}
.s3-icon svg { width: 30px; height: 30px; stroke-width: 1.5; }
.s3-icon-title { font-size: 14px; font-weight: 700; color: var(--dark-blue); margin-bottom: 8px; }
.s3-icon-desc { font-size: 12px; color: var(--text-gray); line-height: 1.5; }

</style>

<div class="prod-page">

    <!-- HERO SECTION -->
    <div class="hero-sec">
        <h1 class="hero-title">Solusi Lengkap Kusen, Kaca & Eksterior<br>Untuk Skala Perumahan Hingga Proyek Besar</h1>
        <p class="hero-subtitle">Griya Djaya Sentosa - Partner Konstruksi Terpercaya</p>
    </div>

    <!-- SECTION 1: CARDS -->
    <div class="s1-wrap">
        <div class="s1-grid">
            <a href="<?php echo home_url('/product/upvc/'); ?>" class="s1-card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.17.33.png" alt="UPVC" class="s1-img">
                <div class="s1-content">
                    <h3 class="s1-title">Pintu & Jendela UPVC Elegan</h3>
                    <p class="s1-desc">Kedap suara, anti rayap, dan tahan cuaca. Solusi modern untuk hunian yang nyaman.</p>
                    <span class="s1-btn">LIHAT DETAIL</span>
                </div>
            </a>
            
            <a href="<?php echo home_url('/product/alumunium/'); ?>" class="s1-card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.21.32.png" alt="Alumunium" class="s1-img">
                <div class="s1-content">
                    <h3 class="s1-title">Kusen Alumunium Tahan Lama</h3>
                    <p class="s1-desc">Kuat, presisi, dan anti karat. Tersedia dalam berbagai warna dan profil elegan.</p>
                    <span class="s1-btn">LIHAT DETAIL</span>
                </div>
            </a>
            
            <a href="<?php echo home_url('/product/kaca/'); ?>" class="s1-card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.20.40.png" alt="Kaca" class="s1-img">
                <div class="s1-content">
                    <h3 class="s1-title">Partisi & Kanopi Kaca</h3>
                    <p class="s1-desc">Ciptakan kesan luas dan pencahayaan maksimal dengan instalasi kaca tempered.</p>
                    <span class="s1-btn">LIHAT DETAIL</span>
                </div>
            </a>
            
            <a href="<?php echo home_url('/product/besi-stainless/'); ?>" class="s1-card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.19.41.png" alt="Besi & Stainless" class="s1-img">
                <div class="s1-content">
                    <h3 class="s1-title">Pagar Besi & Railing Custom</h3>
                    <p class="s1-desc">Keamanan berpadu estetika. Fabrikasi besi dan stainless steel untuk rumah Anda.</p>
                    <span class="s1-btn">LIHAT DETAIL</span>
                </div>
            </a>
            <a href="<?php echo home_url('/product/fasad/'); ?>" class="s1-card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/ACP-2-1.png" alt="Fasad" class="s1-img" style="object-fit: contain; background: #fff;">
                <div class="s1-content">
                    <h3 class="s1-title">Fasad (ACP & Curtain Wall)</h3>
                    <p class="s1-desc">Solusi estetika dan durabilitas tinggi untuk eksterior bangunan modern Anda.</p>
                    <span class="s1-btn">LIHAT DETAIL</span>
                </div>
            </a>
            <a href="<?php echo home_url('/product/interior/'); ?>" class="s1-card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/interior-hero.jpg" alt="Interior" class="s1-img" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/ACP-2-1.png';">
                <div class="s1-content">
                    <h3 class="s1-title">Interior (Design & Fitting Out)</h3>
                    <p class="s1-desc">Solusi perancangan visual 3D, partisi kaca, wall panel, dan pengerjaan interior presisi.</p>
                    <span class="s1-btn">LIHAT DETAIL</span>
                </div>
            </a>
        </div>
    </div>

    <!-- SECTION 2: SPLIT -->
    <div class="s2-wrap">
        <div class="s2-grid">
            <div>
                <div class="s2-subtitle">GRIYA DJAYA SENTOSA PILIHAN TEPAT</div>
                <h2 class="s2-title">Menemukan Solusi Fabrikasi UPVC, Alumunium, dan Kaca untuk Kebutuhan Anda</h2>
                
                <div class="s2-accordion">
                    <div class="s2-acc-item">
                        <div class="s2-acc-title active" onclick="toggleAcc(this)">Material Terbaik <i class="fa fa-chevron-down"></i></div>
                        <div class="s2-acc-content" style="display:block;">Bahan baku pilihan dari supplier terpercaya untuk memastikan setiap hasil pekerjaan memiliki daya tahan maksimal dan umur panjang.</div>
                    </div>
                    <div class="s2-acc-item">
                        <div class="s2-acc-title" onclick="toggleAcc(this)">Kualitas Terjamin <i class="fa fa-chevron-down"></i></div>
                        <div class="s2-acc-content">Dikerjakan oleh tenaga ahli berpengalaman dengan standar Quality Control yang ketat pada setiap tahap produksi.</div>
                    </div>
                    <div class="s2-acc-item">
                        <div class="s2-acc-title" onclick="toggleAcc(this)">Banyak Pilihan <i class="fa fa-chevron-down"></i></div>
                        <div class="s2-acc-content">Menyediakan berbagai variasi model, warna, dan ukuran yang dapat disesuaikan (custom) dengan konsep desain bangunan Anda.</div>
                    </div>
                    <div class="s2-acc-item">
                        <div class="s2-acc-title" onclick="toggleAcc(this)">Harga Terjangkau <i class="fa fa-chevron-down"></i></div>
                        <div class="s2-acc-content">Harga yang kompetitif tanpa mengorbankan kualitas. Kami memberikan solusi terbaik sesuai dengan budget Anda.</div>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="s2-img-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Screenshot-2024-10-30-at-11.20.40.png" alt="Interior Kaca">
                    <div class="s2-quote-box">
                        <p class="s2-quote-text">"Detail menentukan kualitas. Kami tidak hanya mengedepankan kekuatan, tapi juga keindahan estetika bangunan."</p>
                        <div class="s2-quote-author">- Manajemen Griya Djaya Sentosa</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: BOTTOM GRID -->
    <div class="s3-wrap">
        <div class="s3-grid">
            <div class="s3-left">
                <div>
                    <h4 class="s3-text-title">Menyediakan Kebutuhan Konstruksi Anda</h4>
                    <p class="s3-text-desc">Kualitas material dan presisi pemasangan adalah prioritas utama kami, baik untuk hunian pribadi maupun proyek komersial skala besar.</p>
                </div>
                <div>
                    <h4 class="s3-text-title">Keamanan & Estetika Menjadi Satu</h4>
                    <p class="s3-text-desc">Keamanan berpadu estetika. Fabrikasi besi, stainless, dan kanopi kaca tempered untuk perlindungan prima bangunan Anda.</p>
                </div>
            </div>
            
            <div class="s3-right">
                <div class="s3-icon-box">
                    <div class="s3-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    </div>
                    <h5 class="s3-icon-title">UPVC</h5>
                    <p class="s3-icon-desc">Lindungi area rumah dari bising dan cuaca ekstrem dengan kusen UPVC.</p>
                </div>
                <div class="s3-icon-box">
                    <div class="s3-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h5 class="s3-icon-title">Alumunium</h5>
                    <p class="s3-icon-desc">Hadirkan kekuatan sekaligus estetika minimalis.</p>
                </div>
                <div class="s3-icon-box">
                    <div class="s3-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h5 class="s3-icon-title">Kaca</h5>
                    <p class="s3-icon-desc">Tingkatkan kesan luas dan mewah dengan partisi kaca tempered.</p>
                </div>
                <div class="s3-icon-box">
                    <div class="s3-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    </div>
                    <h5 class="s3-icon-title">Besi & Stainless</h5>
                    <p class="s3-icon-desc">Wujudkan akses aman dengan pagar besi & railing stainless.</p>
                </div>
                <div class="s3-icon-box">
                    <div class="s3-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h5 class="s3-icon-title">Fasad (ACP)</h5>
                    <p class="s3-icon-desc">Solusi estetika dan durabilitas tinggi untuk eksterior bangunan modern.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function toggleAcc(element) {
    const content = element.nextElementSibling;
    
    // Close others
    const allContents = document.querySelectorAll('.s2-acc-content');
    const allTitles = document.querySelectorAll('.s2-acc-title');
    allContents.forEach(c => {
        if(c !== content) {
            c.style.display = 'none';
        }
    });
    allTitles.forEach(t => {
        if(t !== element) {
            t.classList.remove('active');
            t.style.color = 'var(--text-gray)';
        }
    });
    
    // Toggle current
    if(content.style.display === 'block') {
        content.style.display = 'none';
        element.classList.remove('active');
        element.style.color = 'var(--text-gray)';
    } else {
        content.style.display = 'block';
        element.classList.add('active');
        element.style.color = 'var(--gold)';
    }
}
</script>

<?php get_footer(); ?>
