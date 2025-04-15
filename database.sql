CREATE DATABASE IF NOT EXISTS livredor 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE livredor;

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO messages (nom, message, date) VALUES
    ('Jules SIMON', 'Ceci est un message test', '2025-04-14 10:00:00'),
    ('Alban CABADET-BOGDANSKI', 'Youhouuuu ça fonctionne !', '2025-04-14 10:10:00'),
    ('Rafaël FRON', 'Reste plus qu\'à déployer dans Azure', '2025-04-14 10:15:00'),
    ('Romain LENOIR', 'Je vais vous mettre 20 les gars, vous êtes trop forts !', '2025-04-14 10:20:00');