<?php
header('Content-Type: application/json');

$jsonFilePath = '../data/transaksi.json'; 

if (file_exists($jsonFilePath)) {
    $jsonData = file_get_contents($jsonFilePath);
    echo $jsonData; // Return the JSON data
} else {
    echo json_encode(['error' => 'File not found']); 
}
?>
