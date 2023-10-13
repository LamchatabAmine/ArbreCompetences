<?php
define('__Root__', dirname(dirname(__FILE__)));
include __Root__ . "/Manager/GestionStagiaire.php";
$GestionStagiaire = new GestionStagiaire();

if (!empty($_GET['id'])) {


    print_r($_GET['id']);
    // Trouver tous les employés depuis la base de données 
    $id = $_GET['id'];
    $GestionStagiaire->Supprimer($id);

    header('Location: index.php');
    exit();
}
