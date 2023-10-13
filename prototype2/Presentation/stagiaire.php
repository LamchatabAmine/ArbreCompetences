<?php
// require_once "./prototype1/Data/GestionStagiaire.php";
define('__Root__', dirname(dirname(__FILE__)));
include __Root__ . "/Manager/GestionStagiaire.php";
session_start();



// Trouver tous les stagiaire depuis la base de données 
$GestionStagiaire = new GestionStagiaire();
$StagiaresData = $GestionStagiaire->getStagiaires();

// echo "<pre>";
// echo "</pre>";











if (isset($_GET['alert']) && $_GET['alert'] == "cannot") {
    echo '<script>alert("You cant access in this page!!");</script>';
}

if (isset($_GET['alert']) && $_GET['alert'] == "success") {
    echo '<script>alert("Your profile Updated successfully!");</script>';
}


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Presentation/Style/style.css">
    <title>Arbre Competences</title>

</head>

<body>
    <div class="container">
        <h2>Arbre des Competences</h2>
        <div class="login">
            <a href="index.php">
                <input type="button" value="Login" style="color: #fff !important;
                    float: inline-end;
                    margin-bottom: 10px;
                    padding: 4px 20px;
                    background-color: black;
                    border: none;
                    font-size: 12px;
                    font-weight: bold;
                    cursor: pointer;
                    border-radius: 2px;
                    transition: opacity 0.3s; /* Add a smooth transition for the hover effect */
            " onmouseover="this.style.opacity = '0.8';" onmouseout="this.style.opacity = '1';">
            </a>
        </div>
        <table>
            <tr>
                <th>Nom</th>
                <th>CNE</th>
                <th>Ville</th>
                <th>Gestion</th>
            </tr>
            <?php
            foreach ($StagiaresData as $Stagiaire) {
            ?>
                <tr>
                    <td><?= $Stagiaire->getNom() ? $Stagiaire->getNom() : "null"; ?></td>
                    <td>
                        <?= $Stagiaire->getCNE() ? $Stagiaire->getCNE() : "null"; ?>
                    </td>
                    <td>
                        <?= $Stagiaire->getVille() ? $Stagiaire->getVille() : "null"; ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($_SESSION)) {
                            # code...
                            if ($_SESSION['CNE'] == $Stagiaire->getCNE()) {
                                // User can delete and edit their own row
                        ?>
                                <a href=" editer.php?id=<?php echo $Stagiaire->getId() ?>" style="color: green;">Éditer</a>
                                <a href="supprimer.php?id=<?php echo $Stagiaire->getId() ?>" style="color: red;">Supprime</a>
                                <a href="logout.php" style="color: red; float: inline-end;">Logout</a>
                            <?php
                            } else {
                                // User cannot edit or delete this row
                            ?>
                                <span style="color: gray;">Éditer</span>
                                <span style="color: gray;">Supprime</span>
                        <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>


</body>

</html>