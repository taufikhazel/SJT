<?php
$jsonData = file_get_contents('../data/transaksi.json');

$data = json_decode($jsonData, true);

$groupedData = [];
foreach ($data as $transaction) {
    if ($transaction['status'] === 'Belum Diproses') {
        $date = $transaction['tanggal'];
        if (!isset($groupedData[$date])) {
            $groupedData[$date] = [];
        }
        $groupedData[$date][] = $transaction;
    }
}

krsort($groupedData);

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
