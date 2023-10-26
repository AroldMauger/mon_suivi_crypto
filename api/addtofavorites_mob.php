<?php
include_once '../utils/user_functions.php';

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"));
$favData = json_encode([
    'name' => $data->cryptoName,
    'price' => $data->cryptoPrice,
    'percent' => $data->cryptoPercent
]);

if (addFavorite($_SESSION['user_id'], $favData)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Tous les emplacements favoris sont occupés.']);
}

?>
