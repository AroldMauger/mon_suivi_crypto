<?php
$databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');
 
$query = "SELECT id, username, email, datenaissance FROM user";
$statement = $databaseHandler->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Manrope:wght@400;500;700&family=Noto+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/70fabb1b7e.js" crossorigin="anonymous"></script>
</head>
<body class="body-admin">
    <header class="header-in-admin">
        <div class="logo-and-title-in-cryptopage">
          <a href="index.php">
               <img class="logo-in-cryptopage" src="assets/logo-crypto.png">
          </a>
          <h1 class="main-title-in-cryptopage">MON SUIVI CRYPTO</h1>
        </div>
        <nav class="nav-bar-cryptopage">
            <a href="logout.php" class="nav-button">Log out</a>
            
            <a href="logout.php" class="nav-icone-mobile">
               <i class="fa-solid fa-right-from-bracket icone-nav-bar"></i>
            </a>
        </nav>  
    </header>
    <h2 class="title-in-admin-page">Liste de tous les utilisateurs du site</h2>
    <div class="all-users-container">
    <?php foreach ($users as $user): ?>
    <div class="single-user-container">
        <span class="admin-info-user" id="admin-username">Utilisateur : <?php echo htmlspecialchars($user['username']); ?></span>
        <span class="admin-info-user" id="admin-email">Email : <?php echo htmlspecialchars($user['email']); ?></span>
        <span class="admin-info-user" id="admin-datenaissance">Date de naissance : <?php echo htmlspecialchars($user['datenaissance']); ?></span>
        <form action="admin_delete_user.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <button type="submit" class="admin-delete-user-button">SUPPRIMER</button>
        </form>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>