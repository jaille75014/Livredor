<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

function sendJson($success, $message, $extra = []) {
    echo json_encode(array_merge([
        'success' => $success,
        'message' => $message
    ], $extra));
    exit; // 💣 NE JAMAIS OUBLIER ÇA
}

$serverName = "tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "sqldb-livredor-prod-northeurope-01",
    "Uid" => "esgiAdmin",
    "PWD" => "Cisco!00",
    "Encrypt" => 1,
    "TrustServerCertificate" => 0,
    "LoginTimeout" => 30
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    sendJson(false, "Connexion échouée", ['details' => sqlsrv_errors()]);
}

// Tu peux récupérer dynamiquement la table si tu veux (GET, POST, etc.)
$tableName = 'etudiants';

$tsql = "DROP TABLE [$tableName]";
$getResults = sqlsrv_query($conn, $tsql);

if ($getResults === false) {
    sendJson(false, "Erreur lors de DROP TABLE", ['details' => sqlsrv_errors()]);
}

sqlsrv_free_stmt($getResults);
sqlsrv_close($conn);

sendJson(true, "Table supprimée avec succès !");
