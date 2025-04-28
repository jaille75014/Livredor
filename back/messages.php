<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

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
    echo json_encode([
        'success' => false,
        'error' => 'Erreur de connexion à la base de données.',
        'details' => sqlsrv_errors()
    ]);
    exit;
}

$query = "SELECT nom, message, FORMAT(date, 'dd/MM/yyyy HH:mm') as date FROM messages ORDER BY id DESC";
$getResults = sqlsrv_query($conn, $query);

if ($getResults === false) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur d\'exécution de la requête SQL.',
        'details' => sqlsrv_errors()
    ]);
    exit;
}

$messages = array();
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    $messages[] = $row;
}

if (empty($messages)) {
    echo json_encode([
        'success' => true,
        'messages' => []
    ]);
} else {
    echo json_encode([
        'success' => true,
        'messages' => $messages
    ]);
}

sqlsrv_free_stmt($getResults);
sqlsrv_close($conn);
?>