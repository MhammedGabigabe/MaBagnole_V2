<?php
require_once "BaseModel.php";

class Utilisateur extends BaseModel{
    protected $idUtilisateur;
    protected $nom;
    protected $email;
    protected $mdp;
    protected $role;

    public function __set($p, $v){
        if(property_exists($this, $p)){
            $this->$p = $v;
        }else{
            throw new Exception("la propriété '$p' n'existe pas dans la classe" .get_class($this));
        }
    }

    public function __get($p){
        if(property_exists($this,$p)){
            return $this->$p;
        }else{
            throw new Exception("la propriété '$p' n'existe pas dans la classe" .get_class($this));
        }
    }

    public function getByEmail($email){
        $requete = "SELECT * FROM utilisateurs WHERE email = :e;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindparam(":e",$email);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
        
    }
    
    public function seConnecter($email, $pw){
        $utilisateur = $this->getByEmail($email);
        if($utilisateur === false){
            return "email_incorrect";
        }
        if(!password_verify($pw, $utilisateur['mdp'])){
            return "mdp_incorrect";
        }
        return $utilisateur;
    }

}

?>