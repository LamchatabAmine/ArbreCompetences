<?php
define('__PATH__', dirname(dirname(__FILE__)));

require_once __PATH__ . "\DAO\CompetencesDAO.php";

class CompetenceBLO
{
    private $competencesDao;
    public $errorMessage;

    public function __construct()
    {
        $this->competencesDao = new CompetencesDAO();
        $this->errorMessage = '';
    }

    public function GetAllCompetences()
    {
        return $this->competencesDao->GetAllCompetences();
    }

    public function GetCompetence($competenceID)
    {
        return $this->competencesDao->GetCompetence($competenceID);
    }

    public function AddCompetence(Competence $competence)
    {
        if (empty($competence->getReference()) || empty($competence->getCode()) || empty($competence->getNom())) {
            $this->errorMessage = 'Please fill in all required fileds .';
        } else {
            $this->competencesDao->AddCompetence($competence);
        }
    }

    public function UpdateCompetence(Competence $competence)
    {
        if (empty($competence->getReference()) || empty($competence->getCode()) || empty($competence->getNom())) {
            $this->errorMessage = 'Please fill in all required fields.';
        } else {
            $this->competencesDao->UpdateCompetence($competence);
        }
    }



    public function DeleteCompetence($competenceID)
    {
        $affectedRows = 0;
        $affectedRows = (int) $this->competencesDao->DeleteCompetence($competenceID);
        return $affectedRows;
    }
}
