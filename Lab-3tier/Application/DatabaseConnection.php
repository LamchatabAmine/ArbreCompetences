<?php
/**
 * User: Arif Uddin
 * Date: 4/6/12
 * Time: 4:51 PM
 */

class DatabaseConnection
{

    private $dbUser;
    private $dbPassword;
    private $dbName;
    private $dbHost;
    private $pdo;

    public function __construct()
    {
        $this->dbUser = 'root';
        $this->dbPassword = '';
        $this->dbName = 'lab';
        $this->dbHost = 'localhost';
        $this->pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function GetDB()
    {
        return $this->pdo;
    }
}

