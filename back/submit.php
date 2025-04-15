<?php
// Permet d'éviter les erreurs 500
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once('../config/bdd.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $message = $_POST['message'] ?? null;

    if (!$nom || !$message) {
        echo json_encode(['error' => 'Nom ou message manquant']);
        exit;
    }

    try {
        $query = "INSERT INTO messages (nom, message, date) VALUES (?, ?, NOW())";
        $req = $pdo->prepare($query);
        $req->execute([$nom, $message]);

        echo json_encode(['success' => 'Message envoyé avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur d\'insertion dans la base de données']);
    }
}

$pdo = null;
?>