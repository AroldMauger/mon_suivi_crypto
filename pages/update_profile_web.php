<?php
session_start();
require '../utils/user_functions.php';

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['error' => 'Utilisateur non connecté.']));
}

$data = json_decode(file_get_contents("php://input"));

$response = updateUserProfile($_SESSION['user_id'], $data->username, $data->email, $data->datenaissance);

header('Content-Type: application/json');
echo json_encode($response);

?>
