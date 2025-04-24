<?php
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

echo "✅ Connexion à la base SQL réussie !<br>";

// Test SELECT
$tsql = "SELECT * FROM etudiants"; // LIMIT dans SQL Server = TOP
$getResults = sqlsrv_query($conn, $tsql);

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
sqlsrv_close($conn);
?>
