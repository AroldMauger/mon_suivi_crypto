<?php
include_once 'config.php'; 
include_once '../utils/user_functions.php'; 

$response = [];

if (isset($_POST['username'], $_POST['motdepasse'])) {
    $result = loginUser($_POST['username'], $_POST['motdepasse']);
    
    if ($result['success']) {
        $user_id = $result['user_id'];
        $query = "SELECT username, email, datenaissance, fav1, fav2, fav3, photo FROM user WHERE id = :user_id";
        $statement = getDatabaseConnection()->prepare($query);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $userInfo = $statement->fetch(PDO::FETCH_ASSOC);

        $response = [
            'success' => true,
            'message' => $result['message'],
            'user_id' => $result['user_id'],
            'user_info' => $userInfo
        ];
    } else {
        $response = [
            'success' => false,
            'message' => $result['message']
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => "Nom d'utilisateur et mot de passe sont requis."
    ];
}


header('Content-Type: application/json');
echo json_encode($response);
?>
