<?php
session_start();

$host = '127.0.0.1';
$db   = 'monsuivicryptodb';
$user = 'monsuivicrypto';
$pass = 'mystudiproject';
$charset = 'utf8mb4';
$port = '3307';

$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if (isset($_POST['username']) && isset($_POST['motdepasse'])) {
        $username = $_POST['username'];
        $password = $_POST['motdepasse'];

        // Pour l'administrateur (je vous conseille de changer cette partie)
        if ($username == "admincrypto" && $password == "Studi20@") {
            $_SESSION["role"] = "administrateur";
            header("Location: admin.php");
            exit;
        }

        // Pour un utilisateur standard
        $stmt = $pdo->prepare('SELECT id, username, motdepasse FROM user WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password == $user['motdepasse']) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: crypto.php');
            exit;
        } else {
            echo "Informations d'identification incorrectes.";
        }
    }
    var_dump($username);

    var_dump($user);


} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

