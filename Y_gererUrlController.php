<?php

// 1. Connexion à la BD (comme dans votre exemple)
require_once('models/H_databaseConnection.php');
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage", "root", "");

//**********appel du fichier des fonctions creer ************ */
require("models/H_functionsModels.php");

// 2. Recuperer L'url apres le nom des domaine et prendre la derniere partie
$Y_url = explode('/', trim($_SERVER['REQUEST_URI'],'/'))[1];

// 3. Decoder l'URL et charger la page correspondante
if (!empty($Y_url)) {

    // Fonction pour décoder l'URL
    $Y_urlDecoder = decodeUrl($Y_url);

    // Verifie si la page existe et a bien été envoyée
    if (isset($Y_urlDecoder['page'])) {
        $Y_pageController = $Y_urlDecoder['page'] . 'Controller.php';

        if(file_exists("controller/$Y_pageController")){
            require("controller/$Y_pageController");
        }else{
            echo "Page Introuvable";
        }

    }
}
?>