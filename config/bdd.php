<?php
$serverName = "tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433";
$connStr = getenv('SQL_CONN');
$connectionOptions = array(
    "Database" => "sqldb-livredor-prod-northeurope-01", // C'était incorrect dans ta version
    "Uid" => "esgiAdmin",
    "PWD" => $connStr,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0,
    "LoginTimeout" => 30
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Affiche les erreurs si échec
}

?>
