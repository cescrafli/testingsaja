<?php
// Script untuk tes API WhatsApp Fonnte
// Akses melalui: https://griyadjayasentosa.id/wp-content/themes/cobain-theme-final/test_wa.php?phone=08xxxxxxxxxx

// Cari wp-load.php di root WordPress
$wp_root = dirname(dirname(dirname(dirname(__FILE__))));
if (file_exists($wp_root . '/wp-load.php')) {
    require_once($wp_root . '/wp-load.php');
} else {
    die("Tidak dapat menemukan sistem WordPress (wp-load.php).");
}

$phone = isset($_GET['phone']) ? sanitize_text_field($_GET['phone']) : '628111021088';
$message = "Halo! Ini adalah pesan tes otomatis dari sistem API WhatsApp (Fonnte) website Griya Djaya Sentosa. Jika pesan ini masuk, berarti API berfungsi dengan baik.";

echo "Mencoba mengirim pesan WhatsApp ke nomor: " . esc_html($phone) . "<br>";
$result = gjs_send_whatsapp($phone, $message);

echo "<pre>";
print_r($result);
echo "</pre>";
echo "<br>Selesai.";
?>