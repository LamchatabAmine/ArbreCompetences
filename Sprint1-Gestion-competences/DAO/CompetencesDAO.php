<?php
define('__path__', dirname(dirname(__FILE__)));

require __path__ . "\DB\DBConnection.php";
require __path__ . "\Entities\Competence.php";

class CompetencesDAO
{
    private $pdo = null;

    public function __construct()
    {
        $databaseConnection = new DBConnection();
        $this->pdo = $databaseConnection->connect();
    }

    public function GetAllCompetences()
    {
        $sql = 'SELECT Id, Reference, Code, Nom, Description FROM Competences ORDER BY Reference;';
        $stmt = $this->pdo->query($sql);
        $competences_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $competences = [];

        foreach ($competences_data as $competence_data) {
            $competence = new Competence();
            $competence->setId($competence_data['Id']);
            $competence->setReference($competence_data['Reference']);
            $competence->setCode($competence_data['Code']);
            $competence->setNom($competence_data['Nom']);
            $competence->setDescription($competence_data['Description']);
            $competences[] = $competence;
        }

        return $competences;
    }


    public function AddCompetence(Competence $competence)
    {
        try {
            $sql = "INSERT INTO `Competences` (`Reference`, `Code`, `Nom`, `Description`) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $competence->getReference(),
                $competence->getCode(),
                $competence->getNom(),
                $competence->getDescription()
            ]);
            if ($stmt->rowCount() > 0) {
                header('Location: ./index.php?success=addedSuccessfully');
                exit;
            } else {
                throw new Exception('Failed to insert competence.');
            }
        } catch (Exception $e) {
            // Handle the exception, for example, log the error and display a user-friendly message
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function GetCompetence($competenceID)
    {
        try {
            $sql = "SELECT Id, Reference, Code, Nom, Description  FROM Competences WHERE Id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$competenceID]);
            $competence_data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($competence_data) {
                $competence = new Competence();
                $competence->setID($competence_data['Id']);
                $competence->setReference($competence_data['Reference']);
                $competence->setCode($competence_data['Code']);
                $competence->setNom($competence_data['Nom']);
                $competence->setDescription($competence_data['Description']); // Set the Description field
                return $competence;
            }
            return null;
        } catch (Exception $e) {
            // Handle the exception, for example, log the error and display a user-friendly message
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function UpdateCompetence(Competence $competence)
    {
        try {
            $sql = "UPDATE Competences SET Reference = ?, Code = ?, Nom = ?, Description = ? WHERE ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $competence->getReference(),
                $competence->getCode(),
                $competence->getNom(),
                $competence->getDescription(), // Update the Description field
                $competence->getId()
            ]);
            if ($stmt->rowCount() > 0) {
                header('Location: ./index.php?success=editedSuccessfully');
                exit;
            } else {
                throw new Exception('Failed to Update competence.');
            }
        } catch (Exception $e) {
            // Handle the exception, for example, log the error and display a user-friendly message
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function DeleteCompetence($competenceID)
    {
        try {
            $sql = "DELETE FROM Competences WHERE ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$competenceID]);
        } catch (Exception $e) {
            // Handle the exception, for example, log the error and display a user-friendly message
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}
