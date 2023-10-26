<?php
include_once 'config.php'; 
include_once '../utils/user_functions.php'; 

$response = [];

if (isset($_POST['prenom'], $_POST['nom'], $_POST['datenaissance'], $_POST['email'], $_POST['username'], $_POST['motdepasse'])) {
    $result = addUser($_POST['prenom'], $_POST['nom'], $_POST['datenaissance'], $_POST['email'], $_POST['username'], $_POST['motdepasse']);
    
    $response = [
        'success' => $result['success'],
        'message' => $result['message']
    ];
} else {
    $response = [
        'success' => false,
        'message' => "Tous les champs sont requis."
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
