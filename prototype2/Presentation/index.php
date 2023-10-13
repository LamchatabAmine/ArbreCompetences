<?php
define('__Root__', dirname(dirname(__FILE__)));
include __Root__ . "/Manager/GestionStagiaire.php";

session_start();
//check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_POST['login'])) {
    $gestionStagiaires = new GestionStagiaire();
    $Stagiaire = new Stagiaire();
    // create a session 
    $_SESSION["loggedin"] = true;
    // $_SESSION["id"] = $_POST['id'];
    $_SESSION["nom"] = $_POST['nom'];
    // Make the first character of CNE uppercase
    $_SESSION["CNE"] = ucfirst($_POST['CNE']);
    // Change the value of $_POST["ville"] to uppercase
    $_SESSION["ville"] = strtoupper($_POST['ville']);
    // set the name and CNE to class gestion
    $Stagiaire->setNom($_POST['nom']);
    $Stagiaire->setCNE(ucfirst($_POST['CNE']));
    $Stagiaire->setVille(strtoupper($_POST['ville']));
    // call function ajouter to  add "stagiaire"
    $gestionStagiaires->Ajouter($Stagiaire);
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
    <!-- <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .contains {
            width: 60%;
            margin: 0 auto;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }


        select {
            font-size: 0.9rem;
            padding: 2px 5px;
        }


        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }


        .container {
            padding: 16px;
        }

        span.CNE {
            float: right;
            /* padding-top: 16px; */
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.CNE {
                display: block;
                float: none;
            }
        }
    </style> -->
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

                <label for="ville"><b>Ville</b></label>
                <input id="ville" type="text" placeholder="Enter ville" name="ville" maxlength="20" required>

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