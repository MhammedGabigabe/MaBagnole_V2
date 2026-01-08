<?php
require_once "Utilisateur.php";

class Client extends Utilisateur{
    private $dateCreation;
    private $telephone;
    private $cin;
    private $isActive;

    public function __set($p,$v){
        if(property_exists($this, $p)){
            $this->$p = $v;
        }else{
            throw new Exception("la propriété '$p' n'existe pas dans la classe" . get_class($this));
        }
    }

    public function __get($p){
        if(property_exists($this, $p)){
            return $this->$p;
        }else{
            throw new Exception("la propriété '$p' n'existe pas dans la classe". get_class($this));
        }
    }

    public function sInscrire(){
        $utilisateur = $this->getByEmail($this->email);
        if(!$utilisateur){
            $requete = "INSERT INTO utilisateurs (nom,email,mdp,role,telephone,cin)
                        VALUES (:n, :e, :mdp, :r, :t, :c);";

            $mdpHash = password_hash($this->mdp,PASSWORD_DEFAULT);

            $stmt = $this->db->prepare($requete);
            $stmt->bindparam(":n", $this->nom);
            $stmt->bindparam(":e", $this->email);
            $stmt->bindparam(":mdp", $mdpHash);
            $stmt->bindValue(":r", "Client");
            $stmt->bindparam(":t", $this->telephone);
            $stmt->bindparam(":c", $this->cin);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }          
            return "erreur";

        }else return "email_utilise";
    }

    public function getAll(){
        $requete = "SELECT * FROM utilisateurs where role = :r";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(":r", "Client");
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else return false;
    }
}

?>