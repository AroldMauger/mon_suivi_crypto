<?php
include_once '../utils/user_functions.php';

session_start();

if ($_FILES["profileImage"]["error"] > 0) {
    echo "Erreur lors du téléchargement : " . $_FILES["profileImage"]["error"];
    exit;
}

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour changer votre photo de profil.");
}

$uploadedPath = uploadProfileImage($_FILES["profileImage"]);

if ($uploadedPath) {
    if (updateUserPhoto($_SESSION['user_id'], $uploadedPath)) {
        echo "L'image ". htmlspecialchars(basename($_FILES["profileImage"]["name"])). " a été téléchargée et mise à jour dans la base de données.";
    } else {
        echo "Erreur lors de la mise à jour de la base de données.";
    }
} else {
    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
}

header("Location: /pages/crypto.php");
exit;

?>
