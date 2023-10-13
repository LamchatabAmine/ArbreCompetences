<?php
define('__Root__', dirname(dirname(__FILE__)));
include __Root__ . "/Manager/GestionStagiaire.php";

session_start();
$GestionStagiaire = new GestionStagiaire();
$VillesData = $GestionStagiaire->getVilles();


//check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_POST['login'])) {

    $gestionStagiaires = new GestionStagiaire();
    $Stagiaire = new Stagiaire($_POST['nom'], $_POST['CNE'], $_POST['ville']);
    $gestionStagiaires->Ajouter($Stagiaire);
    // create a session 
    // $_SESSION["loggedin"] = true;
    // $_SESSION["id"] = $_POST['id'];
    // $_SESSION["nom"] = $_POST['nom'];
    // // Make the first character of CNE uppercase
    // $_SESSION["CNE"] = ucfirst($_POST['CNE']);
    // // Change the value of $_POST["ville"] to uppercase
    // $_SESSION["ville"] = strtoupper($_POST['ville']);
    // set the name and CNE to class gestion
    // $Stagiaire->setNom($_POST['nom']);
    // $Stagiaire->setCNE(ucfirst($_POST['CNE']));
    // $Stagiaire->setVille(strtoupper($_POST['ville']));
    // call function ajouter to  add "stagiaire"
    // Check if there is a duplicate CNE
} else {
    // looks like a hack, send to index.php
    // header('Location: index.php');
    // echo "404 PAGE";
    // exit;
}


// if (isset($_POST['skip'])) {
//     // Redirect the user to "stagiaire.php"
//     header("Location: stagiaire.php");
//     exit; // Make sure to exit after the redirection to prevent further script execution
// }


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/style.css">
</head>

<body>

    <div class="contains">

        <h2>Login Form</h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="container">
                <label for="nom"><b>Nom</b></label>
                <input id="nom" type="text" placeholder="Enter Nom" name="nom" maxlength="50" required>

                <label for="CNE"><b>CNE</b></label>
                <input id="CNE" type="text" placeholder="Enter CNE" name="CNE" maxlength="11" required>

                <label for="ville">Select a city:</label>
                <select id="ville" name="ville">
                    <?php
                    foreach ($VillesData as $ville) {
                    ?>
                        <option value="<?= $ville["ville_id"] ?>"><?= $ville["Ville"] ?></option>
                    <?php
                    }
                    ?>
                </select>

                <!-- <label for="ville"><b>Ville</b></label> -->
                <!-- <input id="ville" type="text" placeholder="Enter ville" name="ville" maxlength="20" required> -->

                <button id="login" type="submit" name="login">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <a href="stagiaire.php" style="float: inline-end;">Skip</a>
            </div>
        </form>
    </div>






    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");

            form.addEventListener("submit", function(event) {
                const nomInput = document.getElementById("nom");
                const cneInput = document.getElementById("CNE");

                // Validate "nom" input
                const nomValue = nomInput.value.trim();
                if (/^[A-Za-z]+[ ]+ [A-Za-z]+$/.test(nomValue)) {
                    alert("Nom must contain only alphabetic characters.");
                    event.preventDefault();
                    return;
                }

                // Validate "CNE" input
                const cneValue = cneInput.value.trim();
                if (!/^[A-Za-z][0-9]{9}$/.test(cneValue)) {
                    alert("CNE must start with a character followed by 9 numbers.");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script> -->

    <script src="./Style/index.js"></script>
</body>

</html>