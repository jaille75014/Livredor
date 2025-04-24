<?php
// Permet d'éviter les erreurs 500
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
$serverName = "tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "sqldb-livredor-prod-northeurope-01", // C'était incorrect dans ta version
    "Uid" => "esgiAdmin",
    "PWD" => "Cisco!00",
    "Encrypt" => 1,
    "TrustServerCertificate" => 0,
    "LoginTimeout" => 30
);

// Établir la connexion
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Affiche les erreurs si échec
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $message = $_POST['message'] ?? null;

    if (!$nom || !$message) {
        echo json_encode(['error' => 'Nom ou message manquant']);
        exit;
    }


    $query = 'INSERT INTO messages (nom, message, date) VALUES ('.$nom','.$message.', NOW())";
$getResults = sqlsrv_query($conn, $query);


        echo json_encode(['success' => 'Message envoyé avec succès']);
  sqlsrv_free_stmt($getResults);
sqlsrv_close($conn);
?>
