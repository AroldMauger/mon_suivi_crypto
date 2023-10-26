<?php
include_once '../utils/user_functions.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"));
$result = deleteFavorite($_SESSION['user_id'], $data->fav);

echo json_encode($result);

?>
