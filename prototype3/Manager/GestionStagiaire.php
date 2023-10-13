

<?php
include __Root__ . "/Entities/Stagiaire.php";
include __Root__ . "/Entities/Villes.php";



// session_start();

class GestionStagiaire
{

    private $serverName = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname  = "prototype3";
    private $charset = "utf8mb4";
    protected $pdo;

    public function __construct()
    {
        $this->serverName = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "prototype3";
        $this->charset = "utf8mb4";

        // Connect to the database 
        try {
            $DB_con = "mysql:host=" . $this->serverName . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $this->pdo = new PDO($DB_con, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "is connected";
            return $this->pdo;
        } catch (PDOException $e) {
            // die("Failed to connect with MySQL: " . $e->getMessage());
            echo "Failed to connect with MySQL: " . $e->getMessage();
        }
    }

    public function getStagiaires()
    {
        $sql = "SELECT personne.id, personne.Nom, personne.CNE, ville.Ville FROM personne INNER JOIN ville ON personne.ville_id = ville.ville_id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $StagiairesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($StagiairesData);
        $Stagiaires = array();
        foreach ($StagiairesData as $StagiaireData) {
            $Villes = new Villes();
            $Villes->setVille($StagiaireData['Ville']);
            $Stagiaire = new Stagiaire($StagiaireData['Nom'], $StagiaireData['CNE'], $Villes->getVille());
            array_push($Stagiaires, $Stagiaire);
        }
        return $Stagiaires;
    }

    public function getVilles()
    {
        $sql = "SELECT ville_id, Ville FROM `ville`;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $VillesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($VillesData);
        return $VillesData;
    }

    public function Ajouter($Gestions)
    {
        $nom = $Gestions->getNom();
        $CNE = $Gestions->getCNE();
        $ville = $Gestions->getVille();
        // Prepare the SQL statement to check for duplicate CNE
        $sqlLogin = "SELECT personne.Id,personne.Nom, personne.CNE FROM personne INNER JOIN ville ON personne.ville_id = ville.ville_id
            WHERE personne.Nom = :nom AND personne.CNE = :CNE AND ville.ville_id = :ville;";
        $result = $this->pdo->prepare($sqlLogin);
        // Bind the values to the correct placeholders
        $result->bindParam(':nom', $nom, PDO::PARAM_STR);
        $result->bindParam(':CNE', $CNE, PDO::PARAM_STR);
        $result->bindParam(':ville', $ville, PDO::PARAM_STR);
        // Execute the prepared statement
        $result->execute();
        $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
        // Check if the stagiaire have account
        if ($fetch) {
            // login the stagiaire
            // create a session id 
            $_SESSION["id"] = $fetch[0]['Id'];
            $_SESSION["nom"] = $fetch[0]['Nom'];
            $_SESSION["CNE"] = $fetch[0]['CNE'];
            header('Location: stagiaire.php');
            return true;
        }

        // check if there is a stagiaire have this CNE in DB 
        $sqlChecking = "SELECT COUNT(*) FROM personne WHERE CNE = :CNE";
        $check = $this->pdo->prepare($sqlChecking);
        $check->bindParam(':CNE', $CNE, PDO::PARAM_STR);
        $check->execute();
        // Fetch the count of rows with the given CNE
        $count = $check->fetchColumn();
        if ($count > 0) {
            // A user with the same CNE exists
            echo '<script>alert("Ce CNE existe déjà!");</script>';
            return true;
        } else {
            // No user with the same CNE exists
            // Insert into personne table


            $sql = "INSERT INTO personne (Nom, CNE, ville_id) VALUES (:nom, :CNE, :ville_id)";
            $stmt = $this->pdo->prepare($sql);
            // Bind values to placeholders
            $stmt->bindParam(':nom', $Gestions->getNom());
            $stmt->bindParam(':CNE', $Gestions->getCNE());
            $stmt->bindParam(':ville_id', $Gestions->getVille());
            // Execute the prepared statement
            $stmt->execute();
            // Get the last inserted ID from the personne table
            $personneId = $this->pdo->lastInsertId();

            $_SESSION["id"] = $personneId;
            $_SESSION["nom"] = $Gestions->getNom();
            // Make the first character of CNE uppercase
            $_SESSION["CNE"] = ucfirst($Gestions->getCNE());
            // Change the value of $_POST["ville"] to uppercase
            $_SESSION["ville"] = strtoupper($Gestions->getVille());


            header('Location: stagiaire.php');
            return  false;
        }
    }



    public function Modifier($Gestions)
    {
        $id = $Gestions->getId();
        $nom = $Gestions->getNom();
        $CNE = $Gestions->getCNE();
        $ville = $Gestions->getVille();


        // check if there is a stagiaire have this CNE in DB 
        $sqlChecking = "SELECT CNE FROM personne WHERE CNE = :CNE";
        $check = $this->pdo->prepare($sqlChecking);
        $check->bindParam(':CNE', $CNE, PDO::PARAM_STR);
        $check->execute();
        // Fetch the count of rows with the given CNE
        $fetch = $check->fetchAll(PDO::FETCH_ASSOC);

        if ($fetch[0]['CNE'] != $_SESSION["CNE"]) {
            // A user with the same CNE exists
            echo '<script>alert("Ce CNE existe déjà!");</script>';
            return true;
        } else {
            // Update the 'personne' table
            $sqlPersonne = "UPDATE personne SET Nom=:nom, CNE=:CNE WHERE Id=:id";
            $stmtPersonne = $this->pdo->prepare($sqlPersonne);
            $stmtPersonne->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmtPersonne->bindParam(':CNE', $CNE, PDO::PARAM_STR);
            $stmtPersonne->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtPersonne->execute();

            // Update the 'ville' table
            $sqlVille = "UPDATE ville SET Ville=:ville WHERE personneId=:id";
            $stmtVille = $this->pdo->prepare($sqlVille);
            $stmtVille->bindParam(':ville', $ville, PDO::PARAM_STR);
            $stmtVille->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtVille->execute();

            // modifier a session
            if (isset($_SESSION["loggedin"])) {
                $_SESSION["nom"] = $nom;
                $_SESSION["CNE"] = $CNE;
                $_SESSION["ville"] = $ville;
            }

            header('Location: stagiaire.php?success');
            // exit();
        }
    }



    public function Supprimer($id)
    {
        // Prepare the SQL statement with a placeholder for the ID
        $sql = "DELETE FROM personne WHERE Id = :id";
        $stmt = $this->pdo->prepare($sql);

        // Bind the ID parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the prepared statement to delete the record
        $stmt->execute();

        // Check if any rows were affected (optional)
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            // Record deleted successfully
            // Destroy the session
            session_start(); // Start the session if it's not already started
            session_destroy(); // Destroy the session
            return true;
        } else {
            // No record was deleted
            return false;
        }
    }




    public function CountStagiaires()
    {
        $sql = "SELECT ville.ville_id, ville.Ville, COUNT(personne.Id) AS CountStagiaire FROM personne INNER JOIN ville ON personne.Ville_Id = ville.ville_id GROUP BY ville.ville_id, ville.Ville;";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $count = $result->fetchAll(PDO::FETCH_ASSOC);
        return $count;
    }

    // public function getCities()
    // {
    //     $sql = 'SELECT ville FROM ville' ;
    //     $result = $this->pdo->prepare($sql);
    //     $result->execute();
    //     $citiesData = $result->fetchAll(PDO::FETCH_ASSOC);

    //     return $citiesData;
    // }
}


?>