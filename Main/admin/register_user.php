<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $userFile = '../data/user.json';
    
    $currentUsers = file_exists($userFile) ? json_decode(file_get_contents($userFile), true) : [];
    
    $lastIdUser = 0;
    foreach ($currentUsers as $user) {
        if ((int)$user['idUser'] > $lastIdUser) {
            $lastIdUser = (int)$user['idUser'];
        }
    }
    
    $newIdUser = $lastIdUser + 1;
    
    $newUser = array(
        'idUser' => $newIdUser,
        'username' => $data['username'],
        'password' => $data['password'],
        'mobil' => $data['mobil']
    );
    
    $currentUsers[] = $newUser;
    
    if (file_put_contents($userFile, json_encode($currentUsers, JSON_PRETTY_PRINT))) {
        echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error saving user data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
