<?php
$connectionInfo = array(
    "UID" => "esgiAdmin",
    "pwd" => "Cisco!00",
    "Database" => "sqldb-livredor-prod-northeurope-01",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
);
$serverName = "tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433";

try {
    $conn = new PDO("sqlsrv:server = tcp:sql-livredor-prod-northeurope-01.database.windows.net,1433; Database = sqldb-livredor-prod-northeurope-01", "esgiAdmin", "Cisco!00");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents('../database.sql');

    if ($sql === false) {
        throw new Exception("Impossible de lire le fichier SQL !");
    }

    $conn->exec($sql);

    echo json_encode(['success' => true, 'message' => "Base de données initialisée avec succès !"]);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>
