<?php
if ($_FILES["profileImage"]["error"] > 0) {
    echo "Erreur lors du téléchargement : " . $_FILES["profileImage"]["error"];
    exit;
}

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour changer votre photo de profil.");
}

$databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');

$target_dir = "photos/"; // Dossier pour stocker les images
$target_file = $target_dir . basename($_FILES["profileImage"]["name"]);

if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
    // Mettez à jour la base de données pour refléter le nouveau chemin de l'image
    $query = "UPDATE user SET photo = :photo WHERE id = :id";
    $statement = $databaseHandler->prepare($query);
    $statement->bindParam(':photo', $target_file);
    $statement->bindParam(':id', $_SESSION['user_id']);
    
    if($statement->execute()) {
        echo "L'image ". htmlspecialchars(basename($_FILES["profileImage"]["name"])). " a été téléchargée et mise à jour dans la base de données.";
    } else {
        echo "Erreur lors de la mise à jour de la base de données.";
    }
} else {
    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
}
header("Location: crypto.php");
exit;
?>
