<?php
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


$query = "SELECT nom, message, FORMAT(date, 'dd/MM/yyyy HH:mm') as date FROM messages ORDER BY id DESC;";
$getResults = sqlsrv_query($conn, $query);

if ($getResults === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Affiche les lignes retournées
echo "<pre>";
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    print_r($row);
}
echo "</pre>";

sqlsrv_free_stmt($getResults);
sqlsrv_close($conn); echo json_encode(['error' => 'Erreur SQL', 'details' => $e->getMessage()]);
}
?>
