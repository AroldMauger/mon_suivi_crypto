<?php
include_once '../utils/user_functions.php';

session_start();

$data = json_decode(file_get_contents("php://input"));
$user_id = isset($data->userId) ? $data->userId : null;

if ($user_id !== null) {
    $_SESSION['user_id'] = $user_id;

    $result = deleteFavoriteFromName($_SESSION['user_id'], $data->fav);
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => 'User ID is missing or null in the JSON data.']);
}
function deleteFavoriteFromName($userId, $cryptoName) {
    $databaseHandler = getDatabaseConnection();

    // Colonnes de favoris
    $favColumns = ['fav1', 'fav2', 'fav3'];

    foreach ($favColumns as $column) {
        // Récupérer la valeur JSON de la colonne
        $stmt = $databaseHandler->prepare("SELECT $column FROM user WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result !== false && isset($result[$column])) {
            $crypto = json_decode($result[$column], true);

            // Vérifier si le nom de la cryptomonnaie correspond
            if ($crypto && isset($crypto['name']) && $crypto['name'] === $cryptoName) {
                // Mettre à jour la colonne pour la rendre NULL
                $stmt = $databaseHandler->prepare("UPDATE user SET $column = NULL WHERE id = :id");
                $stmt->execute(['id' => $userId]);
                return ['success' => true];
            }
        }
    }

    return ['success' => false, 'message' => "Failed to remove favorite"];
}


?>
