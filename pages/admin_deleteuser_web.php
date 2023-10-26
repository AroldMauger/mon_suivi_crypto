<?php
require '../utils/user_functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;

    if ($userId) {
        $response = deleteUserById($userId);
        $message = $response['message'];
    } else {
        $message = "ID de l'utilisateur non fourni.";
    }

    header('Location: admin_web.php');
    exit;
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
