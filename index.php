<?php
// Permet d'éviter les erreurs 500
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="fr">


    <head>
        <meta charset="UTF-8">
        <title>Livre d'or</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/style.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    </head>




    <body>


        <div class="container mt-5">
            <h1 class="text-center mb-4"><?=getenv('SQL_CONN');?>Livre d’or</h1>
            

            <div class="mb-3 d-flex justify-content-center gap-2">
                <button id="initDB" class="btn btn-warning">Initialiser la base de données</button>
                <button id="dropDB" class="btn btn-danger">Supprimer la base de données</button>
            </div>



            <form id="livreForm" class="mb-4">
                <div class="mb-3">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="message" name="message" placeholder="Votre message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>

            <div id="messages" class="message-list"></div>
        </div>



        <footer class="text-center mt-5">
            <img src="assets/img/lv.png" alt="Ceinture LV" width="15%">
            <p>&copy; 2025 AJARIS</p>
        </footer>


        
        <script src="main.js"></script>
    
    
    </body>

</html>
