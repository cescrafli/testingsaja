<?php
require_once('../wp-load.php');
global $wpdb;

echo "Migrating wp_customer to wp_barcode...\n";

// 1. Add columns to wp_barcode
$columns = [
    'customer' => 'VARCHAR(255) NULL',
    'phone_customer' => 'VARCHAR(50) NULL',
    'location' => 'TEXT NULL',
    'kota' => 'VARCHAR(100) NULL',
    'provinsi' => 'VARCHAR(100) NULL',
    'kode_pos' => 'VARCHAR(20) NULL'
];

foreach ($columns as $col => $def) {
    $has_col = $wpdb->get_results("SHOW COLUMNS FROM wp_barcode LIKE '$col'");
    if (empty($has_col)) {
        $wpdb->query("ALTER TABLE wp_barcode ADD COLUMN $col $def");
        echo "Added column $col\n";
    }
}

// 2. Migrate Data
$customers = $wpdb->get_results("SELECT * FROM wp_customer");
if ($customers) {
    foreach ($customers as $c) {
        $wpdb->update('wp_barcode', [
            'customer' => $c->nama,
            'phone_customer' => $c->phone,
            'location' => $c->alamat,
            'kota' => $c->kota,
            'provinsi' => $c->provinsi,
            'kode_pos' => $c->kode_pos
        ], ['customerid' => $c->customerid]);
    }
    echo "Data migrated for " . count($customers) . " customers.\n";
}

$wpdb->query("DROP TABLE IF EXISTS wp_customer");
echo "Finished DB migration and deleted wp_customer.\n";
