<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once('../config/bdd.php');

if (!isset($pdo)) {
    echo json_encode(['error' => 'La connexion PDO est introuvable']);
    exit;
}

$query = "SELECT nom, message, FORMAT(date, 'dd/MM/yyyy HH:mm') as date FROM messages ORDER BY id DESC";

try {
    $req = $pdo->prepare($query);
    $req->execute();
    $messages = $req->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($messages);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur SQL', 'details' => $e->getMessage()]);
}
?>
