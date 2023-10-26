<?php
include_once '../utils/user_functions.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;

    if ($userId) {
        $response = deleteUserById($userId);
    } else {
        $response = [
            'success' => false,
            'message' => "ID de l'utilisateur non fourni."
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => "Méthode non prise en charge."
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>