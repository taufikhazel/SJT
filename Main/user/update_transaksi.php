<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $file = '../data/transaksi.json';

    $currentData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $currentData[] = $data;

    if (file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT))) {
        echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error saving data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
