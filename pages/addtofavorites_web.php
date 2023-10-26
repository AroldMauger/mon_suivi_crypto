<?php
require '../utils/user_functions.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    die('Utilisateur non connecté.');
}

$data = json_decode(file_get_contents("php://input"));
$favData = json_encode([
    'name' => $data->cryptoName,
    'price' => $data->cryptoPrice,
    'percent' => $data->cryptoPercent
]);

if (!addFavorite($_SESSION['user_id'], $favData)) {
    echo "Tous les emplacements favoris sont occupés.";
}

?>
