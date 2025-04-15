<?php

$server = 'livredor-sql-serv.database.windows.net';
$dbname = 'livredor-sql-db';
$username = 'admAJR';
$password = 'Cisco!00';

try {
    $pdo = new PDO("sqlsrv:server=$server;Database=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à Azure SQL Server";
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
    exit;
}
?>