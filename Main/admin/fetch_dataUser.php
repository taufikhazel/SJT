<?php
$jsonData = file_get_contents('../data/transaksi.json');

$data = json_decode($jsonData, true);

$uniqueUsers = [];
foreach ($data as $transaction) {
    if (!empty($transaction['user']) && !isset($uniqueUsers[$transaction['user']])) {
        $uniqueUsers[$transaction['user']] = $transaction;
    }
}

$html = '';
foreach ($uniqueUsers as $user => $transaction) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($transaction['nama']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['user']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['tanggal']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['noTelp']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['alamat']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['kota']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['harga']) . '</td>';
    $html .= '<td>' . htmlspecialchars($transaction['mobil']) . '</td>';
    $html .= '<td><button class="btn btn-primary" onclick="userCek(\'' . htmlspecialchars($transaction['user']) . '\')">Cek</button></td>';
    $html .= '</tr>';
}

echo $html;
?>
