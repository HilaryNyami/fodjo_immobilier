<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); 

// 1. Connexion à la BD (comme dans votre exemple)
require_once('models/H_databaseConnection.php');
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage", "root", "");

$Y_idEmployes = $Y_urlDecoder['H_idEmploye']; 

require('views/dashboard/dashboardView.php');
?>