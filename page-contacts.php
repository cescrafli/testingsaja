<?php
/* Template Name: Contacts */
global $custom_css; $custom_css = 'contacts'; get_header();

$message_status = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_blueprint'])) {
    $nama_pengirim = sanitize_text_field($_POST['nama_pengirim']);
    $nomor_telpon = sanitize_text_field($_POST['nomor_telpon']);
    $perusahaan = sanitize_text_field($_POST['perusahaan']);
    $tipe = sanitize_text_field($_POST['tipe']);
    $material = sanitize_text_field($_POST['material']);
    $estimasi = sanitize_text_field($_POST['estimasi']);
    $catatan = sanitize_textarea_field($_POST['catatan']);
    
    $to = 'griyadjayaupvc@gmail.com';
    $subject = 'New Submission from ' . $nama_pengirim;
    $body = "Nama Pengirim: $nama_pengirim\nNomor Telepon: $nomor_telpon\nNama Perusahaan: $perusahaan\nTipe Proyek: $tipe\nSpesifikasi Material: $material\nEstimasi Linimasa: $estimasi\n\nKebutuhan Teknis & Catatan:\n$catatan";
    $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: Website GJS <no-reply@griyadjayasentosa.id>');
    
    $attachments = array();
    $has_blueprint = false;
    
    // Check if at least one file was uploaded
    if (!empty($_FILES['blueprint_files']['name'][0])) {
        $has_blueprint = true;
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }
        
        $files = $_FILES['blueprint_files'];
        $count = count($files['name']);
        
        for ($i = 0; $i < $count; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $uploadedfile = array(
                    'name'     => $files['name'][$i],
                    'type'     => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error'    => $files['error'][$i],
                    'size'     => $files['size'][$i]
                );
                
                $upload_overrides = array( 'test_form' => false );
                $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                
                if ( $movefile && ! isset( $movefile['error'] ) ) {
                    $attachments[] = $movefile['file'];
                } else {
                    $message_status = 'error';
                    $error_msg = $movefile['error'];
                    break;
                }
            }
        }
    }
    
    if ($message_status !== 'error') {
        $sent = wp_mail($to, $subject, $body, $headers, $attachments);
        if ($sent) {
            $message_status = 'success';
        } else {
            $message_status = 'error';
            $error_msg = 'Gagal mengirim email. Silakan hubungi kami langsung via WhatsApp.';
        }
    }
}
?>

<style>
/* Force blue header */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

/* Header spacing */
.blueprint-container { padding: 160px 24px 80px; max-width: 1000px; margin: 0 auto; }

.blueprint-wrapper { display: flex; flex-wrap: wrap; gap: 50px; }
.bp-left { flex: 1 1 55%; min-width: 280px; }
.bp-right { flex: 1 1 40%; min-width: 280px; }

.bp-subtitle { font-size: 12px; font-weight: 800; color: #1a202c; letter-spacing: 1px; margin-bottom: 5px; text-transform: uppercase; }
.bp-title { font-size: 40px; font-weight: 900; color: #041e3a; margin-bottom: 15px; font-family: 'Arial Black', Impact, sans-serif; letter-spacing: -1px; line-height: 1.1; }
.bp-desc { font-size: 15px; color: #4a5568; line-height: 1.6; margin-bottom: 40px; }

.bp-section-title { font-size: 12px; font-weight: 800; color: #1a202c; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 25px; border-bottom: 1px solid #eaeaea; padding-bottom: 10px; }

.bp-form-row { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px; }
.bp-form-group { flex: 1; min-width: 100%; }
.bp-form-group label { display: block; font-size: 11px; font-weight: 800; color: #1a202c; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
.bp-form-group input, .bp-form-group textarea {
    width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 4px; font-size: 14px; color: #111; outline: none; transition: border 0.3s; background: #fff;
}
.bp-form-group input::placeholder, .bp-form-group textarea::placeholder { color: #a0aec0; }
.bp-form-group input:focus, .bp-form-group textarea:focus { border-color: #041e3a; }

.bp-btn {
    width: 100%; background: #0f9d58; color: #fff; border: none; padding: 18px; border-radius: 4px; font-size: 14px; font-weight: 700; text-transform: uppercase; cursor: pointer; transition: background 0.3s; letter-spacing: 1px; margin-top: 10px;
}
.bp-btn:hover { background: #0b8043; }
.bp-btn-footer { text-align: center; font-size: 10px; font-weight: 800; color: #1a202c; margin-top: 15px; text-transform: uppercase; letter-spacing: 1px; }

/* Drag and Drop Zone */
.bp-upload-zone {
    border: 2px dashed #eab308; background: #fffdf5; border-radius: 8px; height: 100%; min-height: 500px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 40px; position: relative; cursor: pointer; transition: all 0.3s;
}
.bp-upload-zone:hover, .bp-upload-zone.dragover { background: #fff9db; }
.bp-upload-input { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 10; }

.bp-upload-icon { margin-bottom: 25px; }
.bp-upload-icon svg { width: 70px; height: 70px; color: #eab308; }
.bp-upload-title { font-size: 20px; font-weight: 900; color: #041e3a; margin-bottom: 15px; font-family: 'Arial Black', sans-serif; letter-spacing: -0.5px; }
.bp-upload-desc { font-size: 13px; color: #4a5568; line-height: 1.6; margin-bottom: 40px; }
.bp-upload-btn-fake { font-size: 12px; font-weight: 800; color: #1a202c; text-transform: uppercase; letter-spacing: 1px; }

.bp-file-name { margin-top: 15px; font-weight: bold; color: #0f9d58; font-size: 14px; }

/* Notice */
.bp-notice { margin-bottom: 30px; padding: 20px; border-radius: 4px; font-size: 15px; font-weight: 600; text-align: center; }
.bp-notice.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.bp-notice.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
.bp-preview-container { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px; }
.bp-preview-item { position: relative; width: 100px; height: 100px; border-radius: 8px; overflow: hidden; border: 1px solid #ddd; background: #f9f9f9; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
.bp-preview-img { width: 100%; height: 100%; object-fit: cover; }
.bp-preview-file { font-size: 11px; text-align: center; padding: 8px; word-break: break-all; color: #555; font-weight: 600; line-height: 1.3; }
.bp-remove-btn { position: absolute; top: 5px; right: 5px; background: rgba(220, 53, 69, 0.9); color: white; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1; padding: 0; transition: background 0.2s; z-index: 10; }
.bp-remove-btn:hover { background: #c82333; }
</style>

<div class="blueprint-container container">

        <?php if ($message_status === 'success'): ?>
        <?php if ($has_blueprint): ?>
            <div class="bp-notice success">Blueprint berhasil dikirim! Tim teknis kami akan segera meninjaunya dan menghubungi Anda.</div>
        <?php else: ?>
            <div class="bp-notice success">Pertanyaan berhasil dikirim! Tim teknis kami akan segera meninjaunya dan menghubungi Anda kembali.</div>
        <?php endif; ?>
    <?php elseif ($message_status === 'error'): ?>
        <div class="bp-notice error"><?php echo esc_html($error_msg); ?></div>
    <?php endif; ?>

    <form class="blueprint-wrapper" method="POST" enctype="multipart/form-data">
        <div class="bp-left">
            <div class="bp-subtitle">MULAI PROYEK ANDA</div>
            <h1 class="bp-title">CERITAKAN PROYEK ANDA</h1>
            <p class="bp-desc">Unggah file CAD, gambar arsitektur, atau spesifikasi teknis Anda. Tim teknis kami akan meninjau detail blueprint Anda secara saksama dan segera menghubungi Anda kembali dengan solusi dan penawaran teknis terbaik.</p>
            
            <div class="bp-section-title">TENTANG PROYEK ANDA</div>
            
            <div class="bp-form-row">
                <div class="bp-form-group">
                    <label>NAMA ANDA</label>
                    <input type="text" name="nama_pengirim" placeholder="Nama lengkap Anda" required>
                </div>
                <div class="bp-form-group">
                    <label>NOMOR TELEPON / WA</label>
                    <input type="text" name="nomor_telpon" placeholder="cth. 08123456789" required>
                </div>
            </div>
            
            <div class="bp-form-row">
                <div class="bp-form-group">
                    <label>NAMA PERUSAHAAN (Opsional)</label>
                    <input type="text" name="perusahaan" placeholder="cth. Atelier Barat">
                </div>
                <div class="bp-form-group">
                    <label>TIPE PROYEK</label>
                    <input type="text" name="tipe" placeholder="Kerangka Struktural" required>
                </div>
            </div>
            
            <div class="bp-form-row">
                <div class="bp-form-group">
                    <label>SPESIFIKASI MATERIAL</label>
                    <input type="text" name="material" placeholder="cth. Baja Tahan Karat 316 / Corten" required>
                </div>
                <div class="bp-form-group">
                    <label>ESTIMASI LINIMASA</label>
                    <input type="text" name="estimasi" placeholder="cth. Selesai Q4 2024" required>
                </div>
            </div>
            
            <div class="bp-form-row">
                <div class="bp-form-group">
                    <label>CATATAN TAMBAHAN (ukuran, warna, tenggat)</label>
                    <textarea name="catatan" rows="4" placeholder="Uraikan semua persyaratan beban, preferensi penyelesaian (finishing), atau batasan lokasi pemasangan..." required></textarea>
                </div>
            </div>
            
        </div>
        
        <div class="bp-right">
            <div class="bp-upload-zone" id="bp-dropzone">
                <input type="file" name="blueprint_files[]" class="bp-upload-input" id="bp-file-input" multiple accept="image/*,.pdf,.dwg,.dxf,.step">
                <div class="bp-upload-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><polyline points="9 15 12 12 15 15"></polyline></svg>
                </div>
                <h3 class="bp-upload-title">TARIK BLUEPRINT KE SINI (OPSIONAL)</h3>
                <p class="bp-upload-desc">Mendukung format DWG, DXF, PDF, atau STEP.<br>Ukuran maks file: 150MB per lembar.</p>
                <div class="bp-upload-btn-fake">PILIH DARI PENYIMPANAN LOKAL</div>
                <div id="bp-preview-container" class="bp-preview-container"></div>
            </div>
        </div>
        <div class="bp-bottom" style="flex: 1 1 100%; min-width: 100%;">
            <button type="submit" name="submit_blueprint" class="bp-btn">KIRIM &amp; MINTA PENAWARAN</button>
            <div class="bp-btn-footer">EKSEKUSI MENGIKUTI PRESISI.</div>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dt = new DataTransfer();
    const fileInput = document.getElementById('bp-file-input');
    const previewContainer = document.getElementById('bp-preview-container');
    const dropZone = document.getElementById('bp-dropzone');
    
    fileInput.addEventListener('change', function(e) {
        for (let i = 0; i < this.files.length; i++) {
            dt.items.add(this.files[i]);
        }
        updatePreview();
    });
    
    function updatePreview() {
        previewContainer.innerHTML = '';
        fileInput.files = dt.files;
        
        Array.from(dt.files).forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'bp-preview-item';
            
            const removeBtn = document.createElement('button');
            removeBtn.className = 'bp-remove-btn';
            removeBtn.innerHTML = '&times;';
            removeBtn.type = 'button';
            // Stop click propagation so removing doesn't trigger the file dialog again
            removeBtn.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                dt.items.remove(index);
                updatePreview();
            };
            
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.className = 'bp-preview-img';
                const reader = new FileReader();
                reader.onload = function(e) { img.src = e.target.result; }
                reader.readAsDataURL(file);
                item.appendChild(img);
            } else {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'bp-preview-file';
                // Trim long names
                const displayName = file.name.length > 20 ? file.name.substring(0,17) + '...' : file.name;
                fileDiv.innerText = displayName;
                item.appendChild(fileDiv);
            }
            
            item.appendChild(removeBtn);
            previewContainer.appendChild(item);
        });
    }
    
    // Drag and Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });
    function preventDefaults (e) { e.preventDefault(); e.stopPropagation(); }
    ['dragenter', 'dragover'].forEach(eventName => { dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'), false); });
    ['dragleave', 'drop'].forEach(eventName => { dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'), false); });
    
    dropZone.addEventListener('drop', function(e) {
        const droppedFiles = e.dataTransfer.files;
        for (let i = 0; i < droppedFiles.length; i++) {
            dt.items.add(droppedFiles[i]);
        }
        updatePreview();
    });
});
</script>

<?php get_footer(); ?>
