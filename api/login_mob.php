<?php
include_once 'config.php'; 
include_once '../utils/user_functions.php'; 

$response = [];

if (isset($_POST['username'], $_POST['motdepasse'])) {
    $result = loginUser($_POST['username'], $_POST['motdepasse']);
    
    $response = [
        'success' => $result['success'],
        'message' => $result['message'],
        'user_id' => $result['user_id'] ?? null,
        'role' => $result['role'] ?? null
    ];
} else {
    $response = [
        'success' => false,
        'message' => "Nom d'utilisateur et mot de passe sont requis."
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
