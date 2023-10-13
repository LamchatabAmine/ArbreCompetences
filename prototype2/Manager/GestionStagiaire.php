

<?php
include __Root__ . "/Entities/Stagiaire.php";
include __Root__ . "/Entities/Villes.php";

// session_start();

class GestionStagiaire
{

    private $serverName = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname  = "prototype2";
    private $charset = "utf8mb4";
    protected $pdo;

    public function __construct()
    {
        $this->serverName = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "prototype2";
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
        $sql = "SELECT personne.id, personne.Nom, personne.CNE, ville.Ville  FROM personne INNER JOIN ville ON personne.id = ville.personneId;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $StagiairesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Stagiaires = array();
        foreach ($StagiairesData as $StagiaireData) {
            $Stagiaire = new Stagiaire();
            $Villes = new Villes();
            $Stagiaire->setId($StagiaireData['id']);
            $Stagiaire->setNom($StagiaireData['Nom']);
            $Stagiaire->setCNE($StagiaireData['CNE']);
            $Villes->setVille($StagiaireData['Ville']);
            $Stagiaire->setVille($Villes->getVille());
            array_push($Stagiaires, $Stagiaire);
        }
        return $Stagiaires;
    }


    public function Ajouter($Gestions)
    {
        $nom = $Gestions->getNom();
        $CNE = $Gestions->getCNE();
        $ville = $Gestions->getVille();
        // Prepare the SQL statement to check for duplicate CNE
        $sqlLogin = "SELECT personne.Id
            FROM personne
            INNER JOIN ville ON personne.id = ville.personneId
            WHERE personne.Nom = :nom AND personne.CNE = :CNE AND ville.Ville = :ville;";
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
            $sql = "INSERT INTO personne (Nom, CNE) VALUES(:nom, :CNE)";
            $stmt = $this->pdo->prepare($sql);
            // Bind values to placeholders
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':CNE', $CNE);
            // Execute the prepared statement
            $stmt->execute();

            // Get the last inserted ID from the personne table
            $personneId = $this->pdo->lastInsertId();
            // Insert into ville table
            $sql2 = "INSERT INTO ville (personneId, Ville) VALUES(:personneId, :ville)";
            $stmt2 = $this->pdo->prepare($sql2);

            $stmt2->bindParam(':personneId', $personneId);
            $stmt2->bindParam(':ville', $ville);
            $stmt2->execute();
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
}


?>