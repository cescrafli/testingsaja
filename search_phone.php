<?php
require_once('wp-load.php');
global $wpdb;

$phone = '085852317383';

echo "Mencari di wp_barcode (Kolom phone_customer):\n";
$barcode_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM wp_barcode WHERE phone_customer LIKE %s", '%' . $wpdb->esc_like($phone) . '%'));
if($barcode_results) {
    foreach($barcode_results as $row) {
        echo "- Barcode: {$row->BarcodeID}, Customer: {$row->customer}, Phone: {$row->phone_customer}\n";
    }
} else {
    echo "Tidak ada data di wp_barcode.\n";
}

echo "\nMencari di wp_request (Kolom phone):\n";
$request_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM wp_request WHERE phone LIKE %s", '%' . $wpdb->esc_like($phone) . '%'));
if($request_results) {
    foreach($request_results as $row) {
        echo "- Barcode: {$row->barcodeid}, Kategori: {$row->category}, Phone Alternatif: {$row->phone}, Status di Barcode: ";
        $status = $wpdb->get_var($wpdb->prepare("SELECT status FROM wp_barcode WHERE BarcodeID = %s", $row->barcodeid));
        echo "{$status}\n";
    }
} else {
    echo "Tidak ada data di wp_request.\n";
}
