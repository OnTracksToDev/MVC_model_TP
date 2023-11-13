<?php

class Database
{

    //propriétés de notre class
    private $db_host;
    private $db_name;
    private $db_port;
    private $db_user;
    private $db_pass;

    //propriété DSN
    private $db_dsn;

    //PDO 
    private $pdo;

    public function __construct(
        $db_host = "localhost",
        $db_port = "3306",
        $db_name = "dwwn_solidev",
        $db_user = "root",
        $db_pass = "",
    ) {
        $this->db_user = $db_user;
        $this->db_port = $db_port;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_dsn = 'mysql:host=' . $this->db_host . ';port=' . $this->db_port . ';dbname=' . $this->db_name . ';charset=utf8';    }

    private function getPDO()
    {
        if ($this->pdo === null) {
            try {
                $db = new PDO($this->db_dsn, $this->db_user, $this->db_pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Oups PDO ne fonctionne pas' . $e->getMessage();
                die();
            }
            //Tout est ok pour avoir notre objet PDO!
            //PDO est appelé une seule fois
            $this->pdo = $db;
        }
        return $this->pdo;
    }


    public function query($statement, $params = [])
    {

        $stmt = $this->getPDO()->prepare($statement);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
