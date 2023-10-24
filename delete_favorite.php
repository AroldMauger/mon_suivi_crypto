<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');

$data = json_decode(file_get_contents("php://input"));
$favColumn = $data->fav;

$stmt = $pdo->prepare("UPDATE user SET $favColumn = NULL WHERE id = '64'");
$success = $stmt->execute();

echo json_encode(['success' => $success]);
?>
