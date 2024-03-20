<?php
class Database
{
    private $host = '127.0.0.1:3308';
    private $dbname = "arztpraxis";
    private $user = "root";
    private $pwd = "Lms3112";
    public $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pwd);
       
        }catch (Exception $e)
        {
            echo $e;
        }




    }
}



?>
