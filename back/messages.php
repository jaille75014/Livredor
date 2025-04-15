<?php
// Permet d'éviter les erreurs 500
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once('../config/bdd.php');



$query = "SELECT nom, message, DATE_FORMAT(date, '%d/%m/%Y %H:%i') as date FROM messages ORDER BY id DESC";
$req = $pdo->prepare($query);
$req->execute();

$messages = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);

$pdo = null;
?>