<?php
session_start();

$response = [];

if (isset($_SESSION["role"])) {
    unset($_SESSION["role"]);
    session_destroy();
    
    $response = [
        'success' => true,
        'message' => "Déconnexion réussie."
    ];
} else {
    $response = [
        'success' => false,
        'message' => "Pas d'utilisateur connecté."
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
