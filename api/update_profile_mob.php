<?php
include_once '../utils/user_functions.php';

// Récupérer les données JSON du corps de la requête
$data = json_decode(file_get_contents("php://input"));

// Vérifier si l'ID utilisateur est présent
if (!isset($data->user_id)) {
    die(json_encode(['error' => 'Utilisateur non spécifié.']));
}

$user_id = $data->user_id;

$response = updateUserProfile($user_id, $data->username, $data->email, $data->datenaissance);

header('Content-Type: application/json');
echo json_encode($response);
?>
