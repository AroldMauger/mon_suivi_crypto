<?php
$databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');

// Assurez-vous d'obtenir les données entrantes
$data = json_decode(file_get_contents("php://input"));

// Préparez la requête de mise à jour
$query = "UPDATE user SET username = :username, email = :email, datenaissance = :datenaissance WHERE id = '64'";
$statement = $databaseHandler->prepare($query);

// Liez les paramètres
$statement->bindParam(':username', $data->username);
$statement->bindParam(':email', $data->email);
$statement->bindParam(':datenaissance', $data->datenaissance);

// Exécutez la requête
$success = $statement->execute();

header('Content-Type: application/json');

// Vérifiez si la mise à jour a réussi et renvoyez une réponse appropriée
if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour']);
}
?>