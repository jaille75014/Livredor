<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = 'livredor-sql-serv.database.windows.net';
$dbname = 'livredor-sql-db';
$username = 'admAJR';
$password = 'Cisco!00';
$dsn = "mysql:host=$server;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents('../database.sql');

    if ($sql === false) {
        throw new Exception("Impossible de lire le fichier SQL !");
    }

    $pdo->exec($sql);

    echo json_encode(['success' => true, 'message' => 'Base de données initialisée avec succès !']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur PDO : ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur : ' . $e->getMessage()]);
}
?>