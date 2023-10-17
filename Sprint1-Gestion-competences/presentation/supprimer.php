<?php
define('__ROOT__', dirname(__FILE__));
include "C:/xampp/htdocs/ArbreCompetences/Sprint1-Gestion-competences/BLL/CompetencesBLL.php"; // include class BLL

include(__ROOT__ . "/Layout/Loader.php");

if (isset($_POST['supprimerCompetence'])) {

    $competenceBLO = new CompetenceBLO();
    $id = $_POST['competenceID'];

    $competenceBLO->DeleteCompetence($id);

    header('Location: index.php?succsses=deletedSuccessfully');
    exit;
}
