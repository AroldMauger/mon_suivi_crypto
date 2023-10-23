<?php

$databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');

$statement = $databaseHandler->query('SELECT * FROM user');
$infos = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($infos);


$databaseHandler = null;
?>