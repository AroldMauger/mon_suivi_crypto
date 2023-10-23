<?php
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

if ($statement->execute()) {
    $message = "Merci ! Votre compte : {$_POST['username']} a bien été créé!";
} else {
    $message = "Erreur lors de la création du compte.";
}

$databaseHandler = null;
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
    <p class="signup-confirmation-message confirmation-message"><?= $message; ?></p>
</div>
</body>
</html>
