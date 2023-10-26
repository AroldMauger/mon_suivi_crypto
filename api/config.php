<?php

$host = '127.0.0.1';
$dbname = 'monsuivicryptodb';
$user = 'monsuivicrypto';
$password = 'mystudiproject';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=3307;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

function getDatabaseConnection() {
    global $dsn, $user, $password, $options;
    
    try {
        $pdo = new PDO($dsn, $user, $password, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Dans un environnement de production, vous pourriez vouloir masquer les détails de l'erreur pour des raisons de sécurité.
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
?>
