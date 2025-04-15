<?php
$connectionInfo = array("UID" => "admAJR", "pwd" => "Cisco!00", "Database" => "livredor-sql-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:livredor-sql-serv.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);


try {
    $conn = new PDO("sqlsrv:server = tcp:livredor-sql-serv.database.windows.net,1433; Database = livredor-sql-db", "admAJR", "Cisco!00");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo json_encode(['success' => true, 'message' => "Base de données '$dbname' initialisée avec succès !"]);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>