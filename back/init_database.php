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

$sql = file_get_contents('./../database.sql');
/*$sql="-- Création de la table si elle n'existe pas
IF OBJECT_ID('dbo.messages', 'U') IS NULL
BEGIN
    CREATE TABLE dbo.messages (
        id INT IDENTITY(1,1) PRIMARY KEY,
        nom NVARCHAR(255) NOT NULL,
        message NVARCHAR(MAX) NOT NULL,
        date DATETIME NOT NULL DEFAULT GETDATE()
    );
END

-- Insertion des données
INSERT INTO dbo.messages (nom, message, date) VALUES
    (N'Jules SIMON', N'Ceci est un message test', '2025-04-14 10:00:00'),
    (N'Alban CABADET-BOGDANSKI', N'Youhouuuu ça fonctionne !', '2025-04-14 10:10:00'),
    (N'Rafaël FRON', N'Reste plus qu''à déployer dans Azure', '2025-04-14 10:15:00'),
    (N'Romain LENOIR', N'Je vais vous mettre 20 les gars, vous êtes trop forts !', '2025-04-14 10:20:00');";*/

$getResults = sqlsrv_query($conn, $sql);
if ($getResults === false) {
    die(print_r(sqlsrv_errors(), true));
}
sqlsrv_free_stmt($getResults);
sqlsrv_close($conn);
echo json_encode(['success' => true, 'message' => "Base de données initialisée avec succès !"]);

