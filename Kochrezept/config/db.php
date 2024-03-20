<?php
class Database
{
    private $db_host = "localhost:3306";
    private $db_name = "rezept";
    private $db_user = "root"; // eigener Nutzername von Server
    private $db_password = "Lms3112!"; // eigenes Passwort für Server
    public $pdo;

    // create connection
    public function __construct()
    {
        try {
            $pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        } catch (PDOException $pe){
            echo "fuck";
            echo $pe->getMessage();
        }
    }
}

?>