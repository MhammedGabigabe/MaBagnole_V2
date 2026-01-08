<?php
require_once "BaseModel.php";

class Reservation extends BaseModel{
    private $idReservation;
    private $idVehicule;
    private $idClient;
    private $dateDebut;
    private $dateRetour;
    private $statut;
    private $lieuPrise;
    private $lieuRetour;
    private $dateReservation;

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

    public function getAll(){
        $requete = "SELECT r.*, u.nom, v.marque, v.modele ,v.prix_jour
                    FROM reservations r, utilisateurs u, vehicules v 
                    where r.id_client = u.id_utilisateur
                    AND r.id_vehi = v.id_vehicule;";
        $stmt = $this->db->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    }

    public function getReservByStatut($statut){
        $requete = "SELECT * FROM reservations WHERE statut = :st;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":st", $statut);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getReservCeMois(){
        $requete =" SELECT * FROM reservations WHERE MONTH(date_reservation) = MONTH(CURRENT_DATE())
                    AND YEAR(date_reservation) = YEAR(CURRENT_DATE())";
        $stmt = $this->db->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function refuserReservation($id){
        $requete = "UPDATE reservations SET statut = :st WHERE id_reservation = :idR;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":idR", $id);
        $stmt->bindValue(":st", "Refusee");
        $stmt->execute();
    }

    public function approuverReservation($id){
        $requete = "UPDATE reservations SET statut = :st WHERE id_reservation = :idR;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":idR", $id);
        $stmt->bindValue(":st", "Approuvee");
        $stmt->execute();
    }

    public function reserver(){
        $requete = "INSERT INTO reservations (date_debut, date_fin, lieu_prise, lieu_retour, id_client, id_vehi, statut)
                    VALUES (:dDeb,:dFin,:lPri,:lRet,:idC,:idV,:sta);";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":dDeb", $this->dateDebut);
        $stmt->bindParam(":dFin", $this->dateRetour);
        $stmt->bindParam(":lPri", $this->lieuPrise);
        $stmt->bindParam(":lRet", $this->lieuRetour);
        $stmt->bindParam(":idC", $this->idClient);
        $stmt->bindParam(":idV", $this->idVehicule);
        $stmt->bindValue(":sta", "En Attente");
        
        return $stmt->execute();
    }

    public function getReservationsByClient($idClient){
        $requete = "SELECT r.*, v.marque, v.modele, v.image, v.prix_jour
                FROM reservations r
                JOIN vehicules v ON r.id_vehi = v.id_vehicule
                WHERE r.id_client = :idClient
                ORDER BY r.date_reservation DESC";

        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":idClient", $idClient);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>