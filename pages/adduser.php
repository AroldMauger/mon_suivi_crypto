<?php

try {
    $databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');
    
        $sql = "INSERT INTO user (prenom, nom, datenaissance, email, username, motdepasse)
                VALUES (:prenom, :nom, :datenaissance, :email, :username, :motdepasse)";

        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':datenaissance', $_POST['datenaissance']);
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':username', $_POST['username']);
        $statement->bindParam(':motdepasse', $_POST['motdepasse']);

        $statement->execute();
        $message = "Merci ! Votre compte : {$_POST['username']} a bien été créé!";
        
        $databaseHandler = null;
    
}
catch (Exception $e) {
    $message = "Erreur lors de la création du compte. Probleme : " . $e->getMessage();
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
        <a href="/index.php" class="returntomain-button">Accueil</a>
    </nav>  
    <div class="signup-confirmation-message-container">
    <p class="signup-confirmation-message confirmation-message">
    <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
    </p>
</div>
<script>
    const confirmationMessage = document.querySelector(".signup-confirmation-message");

    if(confirmationMessage.textContent.includes("Erreur") ) {
        confirmationMessage.style.color = "red";
    } 
</script>

</body>
</html>
