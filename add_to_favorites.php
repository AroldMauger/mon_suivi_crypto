<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die('Utilisateur non connecté.');
}
    $databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');
 
    $id = $_SESSION['user_id'];
    $stmt = $databaseHandler->prepare("SELECT fav1, fav2, fav3 FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

$data = json_decode(file_get_contents("php://input"));
$cryptoName = $data->cryptoName;
$cryptoPrice = $data->cryptoPrice;
$cryptoPercent = $data->cryptoPercent;

// Créez un objet JSON
$favData = json_encode([
    'name' => $cryptoName,
    'price' => $cryptoPrice,
    'percent' => $cryptoPercent
]);
for ($i = 1; $i <= 3; $i++) {
    if (!$row["fav$i"]) {
        $stmt = $databaseHandler->prepare("UPDATE user SET fav$i = :favData WHERE id = :id");
        $stmt->execute(['favData' => $favData, 'id' => $id]);
        break;
    }
}
?>