<?php
    $serverName = "sql-livredor-prod-northeurope-01.database.windows.net"; // update me
    $connectionOptions = array(
        "Database" => "sql-livredor-prod-northeurope-01.database.windows.net", // update me
        "Uid" => "esgiAdmin", // update me
        "PWD" => "Cisco!00" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT * FROM etudiants";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    
    sqlsrv_free_stmt($getResults);
?>
