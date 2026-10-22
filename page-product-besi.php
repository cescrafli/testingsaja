<?php
/* Template Name: Product - Besi & Stainless */
get_header();

$upload_dir = get_template_directory_uri() . '/img/';
$view = isset($_GET['view']) ? $_GET['view'] : 'main';
$item_id = isset($_GET['item']) ? $_GET['item'] : '';

$items = [
    ['id' => 'besi-kanopi', 'title' => 'Kanopi', 'img' => 'a157a5d8-3d13-4de9-a016-558ce90472eb-EDIT-3.jpg'],
    ['id' => 'besi-pintu-besi', 'title' => 'Pintu Besi', 'img' => 'WhatsApp-Image-2024-08-13-at-13.31.07-33.jpeg'],
    ['id' => 'besi-pintu-garasi', 'title' => 'Pintu Garasi', 'img' => 'WhatsApp-Image-2024-08-13-at-15.13.37-6-1.jpeg'],
    ['id' => 'besi-railling', 'title' => 'Railling', 'img' => 'IMG_6347-4.jpg'],
];
?>
<style>
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }
.prod-sub-container { padding: 180px 0 100px; max-width: 1200px; margin: 0 auto; text-align: center; }
.prod-sub-subtitle { font-size: 14px; font-weight: 700; color: #cba85d; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; font-family: 'Outfit', sans-serif; }
.prod-sub-title { font-size: 46px; font-weight: 800; color: #1a202c; margin-bottom: 80px; font-family: 'Outfit', sans-serif; }

/* Grid */
.detail-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; margin-top: 40px; text-align: left; }
@media(max-width: 991px) { .detail-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 575px) { .detail-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; } }
.detail-card { display: flex; flex-direction: column; text-align: center; background: #fff; cursor: pointer; transition: transform 0.3s; text-decoration: none; }
.detail-card:hover { transform: translateY(-5px); }
.detail-card-img-wrapper { padding: 0; display: flex; align-items: center; justify-content: center; width: 100%; }
.detail-card-img { width: 100%; aspect-ratio: 1/1; object-fit: cover; }
.detail-card-text { padding: 20px 10px; }
.detail-card-cat { font-size: 13px; color: #bfa145; margin-bottom: 6px; }
.detail-card-title { font-size: 16px; font-weight: 700; color: #111; }
  @media(max-width: 575px) { .detail-card-title { font-size: 13px; } .detail-card-cat { font-size: 11px; } .detail-card-text { padding: 15px 5px; } }

.back-btn { display: inline-flex; align-items: center; gap: 8px; background: #f1f1f1; padding: 10px 20px; border-radius: 4px; color: #333; text-decoration: none; font-weight: 600; font-size: 14px; cursor: pointer; border: none; margin-bottom: 30px; transition: background 0.3s; }
.back-btn:hover { background: #e2e2e2; }

/* Single Item View */
.si-grid { display: flex; flex-wrap: wrap; gap: 50px; margin-top: 20px; text-align: left; }
.si-left { flex: 1 1 45%; background: #e0e0e0; position: relative; display: flex; align-items: center; justify-content: center; padding: 40px; border-radius: 4px; }
.si-left img { max-width: 100%; height: auto; mix-blend-mode: multiply; }
.si-arrow { position: absolute; top: 50%; transform: translateY(-50%); color: #fff; font-size: 30px; cursor: pointer; opacity: 0.7; }
.si-arrow:hover { opacity: 1; }
.si-arrow-left { left: 20px; }
.si-arrow-right { right: 20px; }
.si-dots { position: absolute; bottom: 15px; left: 0; width: 100%; display: flex; justify-content: center; gap: 8px; }
.si-dot { width: 6px; height: 6px; background: #999; border-radius: 50%; }
.si-dot.active { background: #555; }
.si-right { flex: 1 1 45%; }
.si-cat { font-size: 14px; color: #bfa145; font-weight: 600; margin-bottom: 10px; }
.si-title { font-size: 32px; font-weight: 800; color: #1a202c; margin-bottom: 25px; }
.si-desc { font-size: 15px; color: #4a5568; line-height: 1.8; margin-bottom: 25px; }
.si-list-title { font-size: 15px; font-weight: 700; color: #1a202c; margin-bottom: 15px; }
.si-list { padding-left: 20px; margin-bottom: 40px; }
.si-list li { font-size: 15px; color: #4a5568; margin-bottom: 8px; }
.si-wa-btn { display: inline-flex; align-items: center; gap: 10px; background: #bfa145; color: #fff; padding: 12px 25px; font-size: 14px; font-weight: 700; border-radius: 4px; text-decoration: none; transition: background 0.3s; }
.si-wa-btn:hover { background: #a68a36; color: #fff; }

/* Lightbox Styles */
.lightbox { display: none; position: fixed; z-index: 999999; padding-top: 60px; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); }
.lightbox-content { margin: auto; display: block; max-width: 90%; max-height: 85vh; object-fit: contain; animation: zoomIn 0.3s; }
.lightbox-close { position: absolute; top: 20px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer; transition: 0.3s; }
.lightbox-close:hover { color: #bbb; }
@keyframes zoomIn { from {transform:scale(0)} to {transform:scale(1)} }

/* Hover effect styles injected by AI */
.hover-banner {
    position: absolute; top: 50%; left: 15%; right: 15%; transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9); padding: 12px 10px; text-align: center;
    font-size: 18px; font-weight: 900; color: #000; letter-spacing: 0.5px;
    font-family: 'Oswald', 'Arial Black', sans-serif;
    text-transform: uppercase;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
    z-index: 2;
}
.prod-card-img-wrapper, .detail-card-img-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
}
.prod-card-img-wrapper {
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}
.prod-card-img {
    margin-bottom: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
}
.prod-card-img-wrapper::after, .detail-card-img-wrapper::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease; z-index: 1;
}
.prod-card:hover .prod-card-img-wrapper::after, .detail-card:hover .detail-card-img-wrapper::after { opacity: 1; }
.prod-card:hover .hover-banner, .detail-card:hover .hover-banner { opacity: 1; }

</style>


<div class="prod-sub-container container">
    
        <?php if ($view == 'main'): ?>
    <div style="text-align: left; margin-bottom: 20px;"><a href="<?php echo home_url('/product/'); ?>" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a></div>
    <div class="prod-sub-subtitle">PRODUCT</div>
    <h1 class="prod-sub-title">Besi & Stainless</h1>
    <div class="detail-grid">
        <?php foreach($items as $item): ?>
            <a href="?view=single&item=<?php echo $item['id']; ?>" class="detail-card">
                <div class="detail-card-img-wrapper">
                    <?php $item_img_src = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($upload_dir . $item['img'], 'large') : $upload_dir . $item['img']; ?>
                    <img src="<?php echo esc_url($item_img_src); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="detail-card-img" loading="lazy" decoding="async" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg';">
                    <div class="hover-banner">VIEW MORE</div>
</div>
                <div class="detail-card-text">
                    <div class="detail-card-cat">Besi & Stainless</div>
                    <div class="detail-card-title"><?php echo $item['title']; ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    
    <?php elseif ($view == 'single'): 
        $fallback_title = ucwords(str_replace('-', ' ', $item_id));
        $fallback_img = '';
        foreach($items as $arr_item) {
            if($arr_item['id'] == $item_id) {
                $fallback_title = $arr_item['title'];
                $fallback_img = $arr_item['img'];
                break;
            }
        }
    ?>
    <div style="text-align: left;"><a href="?" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a></div>
        <div class="si-grid">
            <div class="si-left" id="si-slider-container">
                <?php if(!empty($user_images)): ?>
                    <?php if(count($user_images) > 1): ?>
                        <div class="si-arrow si-arrow-left" onclick="moveSlider(-1)">&lsaquo;</div>
                        <div class="si-arrow si-arrow-right" onclick="moveSlider(1)">&rsaquo;</div>
                        <div class="si-dots">
                            <?php foreach($user_images as $index => $img): ?>
                                <div class="si-dot <?php echo ($index == 0) ? 'active' : ''; ?>" onclick="setSlider(<?php echo $index; ?>)"></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php foreach($user_images as $index => $img): ?>
                        <img class="si-slide-img" onclick="openLightbox(this.src)" src="<?php echo $img; ?>" alt="Gallery Image" style="<?php echo ($index == 0) ? 'display:block;' : 'display:none;'; ?> width:100%; object-fit:contain; max-height:400px; mix-blend-mode: multiply; cursor: zoom-in;">
                    <?php endforeach; ?>
                <?php else: 
                    $fallback_img_src = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($upload_dir . $fallback_img, 'large') : $upload_dir . $fallback_img;
                ?>
                    <img src="<?php echo esc_url($fallback_img_src); ?>" alt="<?php echo esc_attr($fallback_title); ?>" loading="lazy" decoding="async" style="width:100%; object-fit:contain; mix-blend-mode: multiply; cursor:zoom-in;" onclick="openLightbox(this.src)">
                <?php endif; ?>
            </div>
        <div class="si-right">
            <div class="si-cat">Besi & Stainless</div>
            <h2 class="si-title"><?php echo $fallback_title; ?></h2>
            <?php if($user_uploaded_content != ''): ?>
                <div class="si-desc custom-content"><?php echo $user_uploaded_content; ?></div>
            <?php else: ?>
                <div class="si-desc">Deskripsi untuk produk ini belum tersedia. Silakan hubungi kami melalui tombol di bawah untuk informasi lebih detail mengenai spesifikasi dan pemesanan.</div>
            <div class="si-list-title">Keunggulan:</div>
            <ul class="si-list">
                <li>Material Besi / Stainless yang kokoh</li>
                <li>Pengerjaan rapi dan presisi</li>
                <li>Tahan lama untuk pemakaian jangka panjang</li>
            </ul>
            <?php endif; ?>
            <a href="https://api.whatsapp.com/send/?phone=628111021088&text=Hi%2C+Saya+tertarik+dengan+produk+yang+ditawarkan+Griya+Djaya+Sentosa&type=phone_number&app_absent=0" target="_blank" class="si-wa-btn">
                <i class="icon-whatsapp" style="font-size: 18px;"></i> CONTACT US NOW
            </a>
        </div>
    </div>
    <?php endif; ?>

</div>


<script>
let currentSlide = 0;
function showSlide(index) {
    const slides = document.querySelectorAll('.si-slide-img');
    const dots = document.querySelectorAll('.si-dot');
    if (slides.length === 0) return;
    
    if (index >= slides.length) currentSlide = 0;
    else if (index < 0) currentSlide = slides.length - 1;
    else currentSlide = index;
    
    slides.forEach(slide => slide.style.display = 'none');
    dots.forEach(dot => dot.classList.remove('active'));
    
    slides[currentSlide].style.display = 'block';
    if(dots[currentSlide]) dots[currentSlide].classList.add('active');
}
function moveSlider(direction) {
    showSlide(currentSlide + direction);
}
function setSlider(index) {
    showSlide(index);
}

function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('imageLightbox').style.display = 'block';
}
function closeLightbox() {
    document.getElementById('imageLightbox').style.display = 'none';
}
</script>



<!-- Lightbox Modal -->
<div id="imageLightbox" class="lightbox" onclick="if(event.target !== document.getElementById('lightboxImg')) closeLightbox()">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img id="lightboxImg" class="lightbox-content">
</div>

<?php get_footer(); ?>

