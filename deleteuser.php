<?php

try {
    $databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');
    
    if(isset($_POST['username'])) {

        $sql = "DELETE FROM user WHERE username = :username";

        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':username', $_POST['username']);
        
        $statement->execute();

        // Si des lignes ont été affectées, alors un utilisateur a bien été supprimé
        if($statement->rowCount() > 0) {
            $message = "Le compte : {$_POST['username']} a bien été supprimé!";
        } else {
            $message = "Aucun compte trouvé avec le nom d'utilisateur : {$_POST['username']}.";
        }
        
    } else {
        $message = "Veuillez fournir un nom d'utilisateur pour la suppression.";
    }

    $databaseHandler = null;
}
catch (Exception $e) {
    $message = "Erreur lors de la suppression du compte. Probleme : " . $e->getMessage();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon suivi crypto</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="nav-bar-signup-page">
        <a href="/index.html" class="returntomain-button">Accueil</a>
    </nav>  
    <div class="signup-confirmation-message-container">
    <p class="signup-confirmation-message confirmation-message">
    <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); // pour effacer le message après l'affichage
        }
        ?>
    </p>
</div>
</body>
</html>
