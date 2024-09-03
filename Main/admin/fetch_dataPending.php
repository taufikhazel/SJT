<?php
$jsonData = file_get_contents('../data/transaksi.json');
$mobilData = file_get_contents('../data/mobil.json');

$data = json_decode($jsonData, true);
$dataMobil = json_decode($mobilData, true); 

$mobilMap = [];
foreach ($dataMobil as $mobil) {
    $mobilMap[$mobil['idMobil']] = $mobil['namaMobil'];
}

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
        $idMobil = $transaction['mobil'];
        $namaMobil = isset($mobilMap[$idMobil]) ? $mobilMap[$idMobil] : 'Unknown Mobil';

        $html .= '<div class="leftContent" onclick="saveDataAndRedirect(' . $transaction['idTransaksi'] . ')">';
        $html .= '<div class="isiContentLeft">';
        $html .= '<a href="#" class="namaUser">' . $transaction['nama'] . '</a>';
        $html .= '<a href="#" class="jenisNamaMobil">' . $namaMobil . '</a>';
        $html .= '<a href="#" class="kodePesanan">Kode Pesanan : ' . $transaction['idTransaksi'] . '</a>';
        $html .= '<a href="#" class="statusMobil">Status : ' . $transaction['status'] . '</a>';
        $html .= '</div>';
        $html .= '</div>';
    }

    $html .= '</div>';
    $html .= '</div>'; 
}

echo $html;
?>