<?php
define('__Root__', dirname(dirname(__FILE__)));

include __Root__ . "/Manager/GestionStagiaire.php";
session_start();
$gestionStagiaires = new GestionStagiaire();
$Stagiaire = new Stagiaire();


// if ( $_SESSION["id"] != $_GET['id']) {
//     header('Location: stagiaire.php?alert=cannot');
//     exit;
// }



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Stagiaire->setId($_POST['id']);
    $Stagiaire->setNom($_POST['nom']);
    $Stagiaire->setCNE($_POST['CNE']);
    $Stagiaire->setVille($_POST['ville']);
    $gestionStagiaires->Modifier($Stagiaire);
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/style.css">
    <title>Modifier : </title>
</head>

<body>

    <h2>Modification de voter profile : </h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="container">
            <label for="nom"><b>Nom</b></label>
            <input id="nom" type="text" placeholder="Enter Nom" name="nom" value=<?= $_SESSION['nom'] ?> maxlength="50" required>

            <label for="CNE"><b>CNE</b></label>
            <input id="CNE" type="text" placeholder="Enter CNE" name="CNE" value=<?= $_SESSION['CNE'] ?> maxlength="11" required>

            <label for="ville"><b>Ville</b></label>
            <input id="ville" type="text" placeholder="Enter ville" name="ville" value=<?= $_SESSION['ville'] ?> maxlength="20" required>

            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
            <button id="edit" type="submit" name="edit"><b>Modifier</b> </button>
            <button type="button" class="cancelbtn"><a href="stagiaire.php" style="color: #fff;">Cancel</a> </button>
        </div>
    </form>



    <script src="./Style/index.js"></script>

</body>

</html>