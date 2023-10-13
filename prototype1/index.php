<?php
// require_once "./prototype1/Data/GestionStagiaire.php";
include "./GestionStagiaire.php";



// Trouver tous les stagiaire depuis la base de données 
$GestionStagiaire = new GestionStagiaire();
$StagiaresData = $GestionStagiaire->getStagiaires();

// echo "<pre>";
// print_r($StagiaresData);
// echo "</pre>";


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./UI/Style/style.css">
    <title>Arbre Competences</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <h2>Arbre des Competences</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>CNE</th>
                <th>Ville</th>
            </tr>
            <?php
            foreach ($StagiaresData as $Stagiaire) {
            ?>
                <tr>
                    <td><?= $Stagiaire->getNom() ? $Stagiaire->getNom() : "null" ?></td>
                    <td>
                        <?= $Stagiaire->getCNE() ? $Stagiaire->getCNE() : "null"; ?>
                    </td>
                    <td>
                        <?= $Stagiaire->getVille() ? $Stagiaire->getVille() : "null"; ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>


</body>

</html>