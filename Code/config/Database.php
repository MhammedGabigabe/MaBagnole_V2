<?php

class Database{
    private $pdo;
    private static $instance = null;

    private function __construct (){
        try{
            $this->pdo = new PDO("mysql:host=localhost;dbname=mabagnole;","root","");
        }catch(PDOException $e){
            throw new Exception("Erreur de connexion !!". $e->getMessage());
        }
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(){
        return $this->pdo;
    }
}
?>