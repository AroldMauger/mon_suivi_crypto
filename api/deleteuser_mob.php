<?php
include_once 'config.php'; 
include_once '../utils/user_functions.php';  

$response = [];

if(isset($_POST['username'])) {
    $result = deleteUser($_POST['username']);
    
    $response = [
        'success' => $result['success'],
        'message' => $result['message']
    ];
} else {
    $response = [
        'success' => false,
        'message' => "Veuillez fournir un nom d'utilisateur pour la suppression."
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>


