IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = 'livredor')
BEGIN
    CREATE DATABASE livredor;
END
GO

USE livredor;
GO

IF OBJECT_ID('dbo.messages', 'U') IS NULL
BEGIN
    CREATE TABLE dbo.messages (
        id INT IDENTITY(1,1) PRIMARY KEY,
        nom NVARCHAR(255) NOT NULL,
        message NVARCHAR(MAX) NOT NULL,
        date DATETIME NOT NULL DEFAULT GETDATE()
    );
END
GO

INSERT INTO dbo.messages (nom, message, date) VALUES
    (N'Jules SIMON', N'Ceci est un message test', '2025-04-14 10:00:00'),
    (N'Alban CABADET-BOGDANSKI', N'Youhouuuu ça fonctionne !', '2025-04-14 10:10:00'),
    (N'Rafaël FRON', N'Reste plus qu''à déployer dans Azure', '2025-04-14 10:15:00'),
    (N'Romain LENOIR', N'Je vais vous mettre 20 les gars, vous êtes trop forts !', '2025-04-14 10:20:00');
GO