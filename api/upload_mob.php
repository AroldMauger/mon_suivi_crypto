<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../utils/user_functions.php';

session_start();

header('Content-Type: application/json');

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if (json_last_error() !== JSON_ERROR_NONE || !isset($input['user_id'])) {
    echo json_encode(['success' => false, 'message' => "L'ID utilisateur n'est pas défini ou erreur de JSON."]);
    exit;
}

$_SESSION['user_id'] = $input['user_id'];

if (!isset($input['profileImage'])) {
    echo json_encode(['success' => false, 'message' => "Aucune image fournie."]);
    exit;
}

$uploadedPath = saveBase64Image($input['profileImage']);

if ($uploadedPath) {
    $fullImagePath = getFullImageUrl($uploadedPath); // Cette fonction doit construire l'URL complète de l'image
    if (updateUserPhoto($_SESSION['user_id'], $uploadedPath)) {
        $fullImageUrl = getFullImageUrl($uploadedPath); // Assurez-vous que cette fonction renvoie l'URL complète
        echo json_encode([
            'success' => true,
            'message' => "L'image a été téléchargée et mise à jour dans la base de données.",
            'imageUrl' => $fullImageUrl // Cette clé 'imageUrl' est celle que vous utiliserez dans votre code Kotlin
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => "Erreur lors de la mise à jour de la base de données."]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => "Erreur lors de l'enregistrement de l'image."]);
}

function saveBase64Image($base64Image) {
    $base64Image = preg_replace('#^data:image/\w+;base64,#i', '', $base64Image);
    $data = base64_decode($base64Image);

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/photos/";
    $filename = uniqid() . ".png"; 
    $target_file = $target_dir . $filename;

    if (file_put_contents($target_file, $data)) {
        return "/photos/" . $filename;
    }

    return false;
}

function getFullImageUrl($relativePath) {
    // Utilisez l'adresse IP spéciale d'Android pour l'émulateur pour accéder au serveur local
    $domain = 'http://10.0.2.2'; // Remplacez par votre domaine réel lors du déploiement
    return $domain . $relativePath;
}

?>
