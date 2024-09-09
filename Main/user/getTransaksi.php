<?php
header('Content-Type: application/json');

// Path ke file JSON
$jsonFilePath = '../data/transaksi.json';

// Periksa apakah file JSON ada
if (!file_exists($jsonFilePath)) {
    echo json_encode(['error' => 'File transaksi.json tidak ditemukan.']);
    exit;
}

// Baca konten file JSON
$jsonData = file_get_contents($jsonFilePath);

// Periksa apakah data kosong
if (empty(trim($jsonData))) {
    echo json_encode(['error' => 'Data kosong di file transaksi.json.']);
    exit;
}

// Decode JSON menjadi array PHP
$data = json_decode($jsonData, true);

// Periksa apakah data berhasil di-decode
if ($data === null) {
    echo json_encode(['error' => 'Gagal decode JSON, format tidak valid.']);
    exit;
}

// Return data JSON
echo json_encode($data);
?>
