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
    echo json_encode([
        'success' => false,
        'error' => 'Connexion échouée',
        'details' => sqlsrv_errors()
    ]);
}

$tsql = "DROP TABLE messages"; 
$getResults = sqlsrv_query($conn, $tsql);
if ($getResults === false) {
    echo json_encode([
        'success' => false,
        'error' => 'Impossible de drop',
        'details' => sqlsrv_errors()
    ]);
}  

sqlsrv_free_stmt($getResults);
sqlsrv_close($conn);
exit;
?>
