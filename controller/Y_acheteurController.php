<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); 
//var_dump($_SESSION ['url']);

// 1. Connexion à la BD (comme dans votre exemple)
require_once('../models/H_databaseConnection.php');
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage", "root", "");

//**********appel du fichier des fonctions creer ************ */
require("../models/H_functionsModels.php");

// 2. selection des acheteurs et leurs selection
$Y_executeAcheteurs = F_executeRequeteSql("SELECT * FROM acheteur INNER JOIN selection ON acheteur.idAcheteur = selection.idAcheteur INNER JOIN blocs ON selection.idBloc = blocs.idBloc INNER JOIN sites ON blocs.numeroTitreFoncier = sites.numeroTitreFoncier");
$H_executeBloc = F_executeRequeteSql("SELECT * FROM blocs ");
$H_executeSites = F_executeRequeteSql("SELECT * FROM sites");
$H_executeEmployes = F_executeRequeteSql("SELECT nomEmploye FROM employe");
require('../views/acheteur/acheteurView.php');
?>