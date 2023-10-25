<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['error' => 'Utilisateur non connecté.']));
}

$pdo = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');

$id = $_SESSION['user_id'];  

$data = json_decode(file_get_contents("php://input"));
$favColumn = $data->fav;

$allowedColumns = ['fav1', 'fav2', 'fav3'];
if (!in_array($favColumn, $allowedColumns)) {
    die(json_encode(['error' => 'Invalid column name.']));
}

$stmt = $pdo->prepare("UPDATE user SET $favColumn = NULL WHERE id = :id");
$success = $stmt->execute(['id' => $id]);

echo json_encode(['success' => $success]);
?>
