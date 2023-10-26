<?php
include_once '../utils/user_functions.php';

session_start();

header('Content-Type: application/json');

if ($_FILES["profileImage"]["error"] > 0) {
    echo json_encode(['success' => false, 'message' => "Erreur lors du téléchargement : " . $_FILES["profileImage"]["error"]]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => "Vous devez être connecté pour changer votre photo de profil."]);
    exit;
}

$uploadedPath = uploadProfileImage($_FILES["profileImage"]);

if ($uploadedPath) {
    if (updateUserPhoto($_SESSION['user_id'], $uploadedPath)) {
        echo json_encode(['success' => true, 'message' => "L'image ". htmlspecialchars(basename($_FILES["profileImage"]["name"])). " a été téléchargée et mise à jour dans la base de données."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Erreur lors de la mise à jour de la base de données."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Désolé, une erreur s'est produite lors du téléchargement de votre fichier."]);
}

?>
