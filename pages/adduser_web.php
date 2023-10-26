<?php
require '../utils/user_functions.php';

if (isset($_POST['prenom'], $_POST['nom'], $_POST['datenaissance'], $_POST['email'], $_POST['username'], $_POST['motdepasse'])) {
    $result = addUser($_POST['prenom'], $_POST['nom'], $_POST['datenaissance'], $_POST['email'], $_POST['username'], $_POST['motdepasse']);
    $message = $result['message'];
} else {
    $message = "Tous les champs sont requis.";
}

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
