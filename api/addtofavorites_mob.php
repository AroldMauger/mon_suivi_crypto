<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

header('Content-Type: application/json');

// Obtient les données JSON de la requête
$data = json_decode(file_get_contents("php://input"));
$user_id = isset($data->userId) ? $data->userId : null;
if ($user_id !== null) {
    $_SESSION['user_id'] = $user_id;
}
// Vérifie si l'utilisateur est authentifié
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== $user_id) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

// À adapter : Vérifiez si l'authentification a réussi avec votre propre logique.
$userIsAuthenticated = true;  // Adaptez cette partie selon votre logique d'authentification.

// Si l'authentification a réussi
if ($userIsAuthenticated) {
    
    // Récupérez les données de la cryptomonnaie à partir de $data
    $cryptoName = $data->cryptoData->cryptoName;
    $cryptoPrice = $data->cryptoData->cryptoPrice;
    $cryptoPercent = $data->cryptoData->cryptoPercent;
    
    // Vous pouvez maintenant effectuer une boucle pour ajouter les favoris dans les colonnes fav1, fav2 et fav3
    $databaseHandler = getDatabaseConnection();

    for ($i = 1; $i <= 3; $i++) {
        $columnName = "fav$i";
        $stmt = $databaseHandler->prepare("SELECT $columnName FROM user WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (empty($result[$columnName])) {
            // La colonne $columnName est vide, vous pouvez ajouter la crypto ici
            $stmt = $databaseHandler->prepare("UPDATE user SET $columnName = :favData WHERE id = :id");
            $stmt->execute(['favData' => json_encode(['name' => $cryptoName, 'price' => $cryptoPrice, 'percent' => $cryptoPercent]), 'id' => $user_id]);
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Favori ajouté avec succès.']);
                exit;
            }
        }
    }
    
    // Si toutes les colonnes fav1, fav2 et fav3 sont déjà occupées, renvoyez un message d'erreur
    echo json_encode(['success' => false, 'message' => 'Toutes les positions de favoris sont occupées.']);
} else {
    // Échec de l'authentification, renvoyez la réponse JSON avec "success" à false
    echo json_encode(['success' => false, 'message' => 'Échec de l\'authentification.']);
}
?>
