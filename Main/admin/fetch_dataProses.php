<?php
$jsonData = file_get_contents('../data/transaksi.json');

$data = json_decode($jsonData, true);

$filteredData = array_filter($data, function($transaction) {
    return $transaction['status'] === 'Diproses';
});

$html = '';
foreach ($filteredData as $transaction) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($transaction['nama']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['user']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['tanggal']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['idTransaksi']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['noTelp']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['bukti']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['alamat']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['kota']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['harga']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['mobil']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['status']) . '</td>';
    $html .= '<td><button class="btn btn-primary" id="cekProsesBtn">Cek</button></td>';
    $html .= '</tr>';
}

echo $html;
?>
