<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST');

include_once 'config.php'; 
include_once '../utils/user_functions.php';

error_log("Starting the script");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier si userId existe et n'est pas vide
    if (isset($data['userId']) && !empty($data['userId'])) {
        $userId = $data['userId'];
        
        $favoritesData = getFavorites($userId);

        // Vérifier si les données des favoris sont récupérées
        if ($favoritesData !== null) {
            $favorites = [];
            
            for ($i = 1; $i <= 3; $i++) {
                if (isset($favoritesData["fav$i"])) {
                    $favorites["fav$i"] = json_decode($favoritesData["fav$i"], true) ?? []; // Valeur par défaut []
                } else {
                    // Ajouter une entrée vide pour le favori si non trouvé
                    $favorites["fav$i"] = [];
                }
            }

            echo json_encode($favorites);
        } else {
            echo json_encode(["message" => "No favorites found for provided userId"]);
        }
    } else {
        echo json_encode(["message" => "userId is required"]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}

?>
