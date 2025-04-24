<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = 'sql-livredor-prod-northeurope-01.database.windows.net';
$dbname = 'sqldb-livredor-prod-northeurope-01';
$username = 'esgiAdmin';
$password = 'Cisco!00';
$dsn = "mysql:host=$server;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DROP DATABASE `$dbname`";
    $pdo->exec($sql);

    echo json_encode(['success' => true, 'message' => "Base de données '$dbname' supprimée avec succès !"]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erreur PDO : ' . $e->getMessage()]);
}
?>
