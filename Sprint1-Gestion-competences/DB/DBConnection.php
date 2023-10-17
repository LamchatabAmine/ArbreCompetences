<?php 
class DBConnection {
    private $host = "localhost";
    private $user = 'root';
    private $dbname = 'arbercompetences';
    private $password = '';

    public function connect() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $db = new PDO($dsn, $this->user, $this->password);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // echo "we are Connected";
            return $db;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
