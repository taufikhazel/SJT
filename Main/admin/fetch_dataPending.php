<?php
// Read the JSON file
$jsonData = file_get_contents('../data/transaksi.json');

// Decode the JSON data into a PHP array
$data = json_decode($jsonData, true);

// Group data by "tanggal"
$groupedData = [];
foreach ($data as $transaction) {
    // Only include transactions with status "Belum Diproses"
    if ($transaction['status'] === 'Belum Diproses') {
        $date = $transaction['tanggal'];
        if (!isset($groupedData[$date])) {
            $groupedData[$date] = [];
        }
        $groupedData[$date][] = $transaction;
    }
}

// Sort dates by newest first
krsort($groupedData);

// Generate HTML
$html = '';
foreach ($groupedData as $date => $transactions) {
    $html .= '<div class="separator">';
    $html .= '<a href="#" class="tanggalBulan">' . $date . '</a>';
    $html .= '<div class="cardProfile">';

    foreach ($transactions as $transaction) {
        $html .= '<div class="leftContent">';
        $html .= '<div class="isiContentLeft">';
        $html .= '<a href="#" class="namaUser">' . $transaction['nama'] . '</a>';
        $html .= '<a href="#" class="jenisNamaMobil">' . $transaction['mobil'] . '</a>';
        $html .= '<a href="#" class="kodePesanan">Kode Pesanan : ' . $transaction['idTransaksi'] . '</a>';
        $html .= '<a href="#" class="statusMobil">Status : ' . $transaction['status'] . '</a>';
        $html .= '</div>';
        $html .= '</div>';
    }

    $html .= '</div>';
    $html .= '</div>'; 
}

echo $html;
