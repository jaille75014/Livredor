<?php
// Permet d'éviter les erreurs 500
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
$serverName = "tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433";
$connStr = getenv('SQL_CONN');
$connectionOptions = array(
    "Database" => "sqldb-livredor-prod-northeurope-01",
    "Uid" => "esgiAdmin",
    "PWD" => $connStr,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0,
    "LoginTimeout" => 30
);


$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(json_encode(['error' => 'Connexion à la base de données échouée', 'details' => sqlsrv_errors()]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $message = $_POST['message'] ?? null;

    if (!$nom || !$message) {
        echo json_encode(['error' => 'Nom ou message manquant']);
        exit;
    }

    $tsql = "INSERT INTO messages (nom, message, date) VALUES (?, ?, GETDATE())";

    $params = array($nom, $message);
    $stmt = sqlsrv_query($conn, $tsql, $params);

    if ($stmt === false) {
        echo json_encode(['error' => 'Erreur lors de l\'insertion du message', 'details' => sqlsrv_errors()]);
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        exit;
    }

    echo json_encode(['success' => 'Message envoyé avec succès']);

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
