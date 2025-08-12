<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); 

// 1. Connexion à la BD
require_once('models/H_databaseConnection.php');
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage", "root", "");
$Y_idEmployes = $Y_urlDecoder['H_idEmploye'];
$_SESSION['H_idEmploye'] = $Y_idEmployes;

// Sélection de TOUS les employés avec leurs informations de poste
$H_executeEmployes = F_executeRequeteSql("SELECT employe.*, typeemploye.libelleFonction FROM employe INNER JOIN typeemploye ON employe.idTypeEmploye = typeemploye.idTypeEmploye ORDER BY employe.dateCreateEmploye DESC");

// Ajoutez un check pour s'assurer que les données sont bien un tableau (ou un objet traversable)
if (!is_array($H_executeEmployes) && !($H_executeEmployes instanceof Traversable)) {
    $H_executeEmployes = []; // Initialisez comme un tableau vide pour éviter les erreurs si la requête échoue
}

// Convertissez TOUS les acheteurs en JSON pour le JavaScript
$items_json = json_encode($H_executeEmployes);

//recuperation de tous les types d'employés dans la base de données
$H_executeTypeEmployes = F_executeRequeteSql("SELECT * FROM typeemploye");

// 4. Inclusion de la vue
require('views/employes/employesView.php');

?>