<?php
$serverName = "tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "sqldb-livredor-prod-northeurope-01", 
    "Uid" => "esgiAdmin",
    "PWD" => "Cisco!00",
    "Encrypt" => 1,
    "TrustServerCertificate" => 0,
    "LoginTimeout" => 30
);

// Établir la connexion
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); 
}

$sql = file_get_contents('./../database.sql');


$getResults = sqlsrv_query($conn, $sql);
if ($getResults === false) {
    die(print_r(sqlsrv_errors(), true));
}
sqlsrv_free_stmt($getResults);
sqlsrv_close($conn);
echo json_encode(['success' => true, 'message' => "Base de données initialisée avec succès !"]);

