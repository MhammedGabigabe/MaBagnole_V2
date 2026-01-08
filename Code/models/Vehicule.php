<?php
require_once "BaseModel.php";

class Vehicule extends BaseModel {
    private $idVeicule;
    private $immatriculation;
    private $modele;
    private $marque;
    private $prixJour;
    private $disponibilite;
    private $image;
    private $boiteVitesse;
    private $motorisation;
    private $idCategorie;

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

    public function ajouterVehicule(){
        $requete = "INSERT INTO `vehicules`(`modele`, `marque`, `prix_jour`, `image`, `boite_vitesse`, `motorisation`, `id_categ`, `immatriculation`) 
                    VALUES (:mod, :mar, :prix, :img, :boiVit, :mot, :idC, :im);";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":mod", $this->modele);
        $stmt->bindParam(":mar", $this->marque);
        $stmt->bindParam(":prix", $this->prixJour);
        $stmt->bindParam(":img", $this->image);
        $stmt->bindParam(":boiVit", $this->boiteVitesse);
        $stmt->bindParam(":mot", $this->motorisation);
        $stmt->bindParam(":idC", $this->idCategorie);
        $stmt->bindParam(":im", $this->immatriculation);
        return $stmt->execute();
    }

    public function getAll(){
        $requete = "SELECT v.*, c.nom FROM vehicules v, categories c where v.id_categ = c.id_categorie;";
        $stmt = $this->db->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterEnMasse($vehicules){
        $requete = "INSERT INTO `vehicules`(`modele`, `marque`, `prix_jour`, `id_categ`, `immatriculation`) 
                    VALUES (:mod, :mar, :prix, :idC, :im);";
        $stmt = $this->db->prepare($requete);

        foreach ($vehicules as $vehi) {
            $stmt->bindValue(":mod", $vehi['modele']);
            $stmt->bindValue(":mar", $vehi['marque']);
            $stmt->bindValue(":prix", $vehi['prix']);
            $stmt->bindValue(":idC", $vehi['id_Cat']);
            $stmt->bindValue(":im", $vehi['imm']);
            $stmt->execute();
        }
    }

    public function supprimerVehicule($id){
        $requete = "DELETE FROM vehicules WHERE id_vehicule = :id;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function getById($id){
        $requete = "SELECT * FROM vehicules WHERE id_vehicule = :id;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modifierVehicule(){
        $requete = "UPDATE `vehicules` 
                    SET `modele`= :mod,`marque`= :mar,`prix_jour`= :prix,`image`= :img,
                    `boite_vitesse`= :boiVit,`motorisation`= :mot,`id_categ`= :idC,
                    `immatriculation`= :im 
                    WHERE `id_vehicule`= :idV;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":mod", $this->modele);
        $stmt->bindParam(":mar", $this->marque);
        $stmt->bindParam(":prix", $this->prixJour);
        $stmt->bindParam(":img", $this->image);
        $stmt->bindParam(":boiVit", $this->boiteVitesse);
        $stmt->bindParam(":mot", $this->motorisation);
        $stmt->bindParam(":idC", $this->idCategorie);
        $stmt->bindParam(":im", $this->immatriculation);
        $stmt->bindParam(":idV", $this->idVeicule);
        return $stmt->execute();
    }

    public function vehiculesDispo(){
        $requete = "SELECT COUNT(*) as total FROM vehicules WHERE disponibilite = :d;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(":d", 1);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function vehiculesLouee(){
        $requete = "SELECT COUNT(*) as total FROM vehicules WHERE disponibilite = :d;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindValue(":d", 0);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function vehiculesCat(){
        $requete = "SELECT * FROM vehicules WHERE id_categ = :idC;";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":idC", $this->idCategorie);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchVehicules($motCle) {
        $requete = " SELECT * FROM vehicules WHERE marque LIKE :mot 
                     OR modele LIKE :mot OR motorisation LIKE :mot OR boite_vitesse LIKE :mot";
        $motCle = "%$motCle%";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(":mot", $motCle);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVehiculesDisponibles($limit, $offset, $recherche = null)
    {
        $requete = "SELECT * FROM vehicules WHERE disponibilite = 1";

        if ($recherche) {
            $requete .= " AND (marque LIKE :recherche OR modele LIKE :recherche)";
        }

        $requete .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($requete);

        if ($recherche) {
            $stmt->bindValue(':recherche', "%$recherche%", PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countVehiculesDisponibles($recherche = null)
    {
        $requete = "SELECT COUNT(*) FROM vehicules WHERE disponibilite = 1";

        if ($recherche) {
            $requete .= " AND (marque LIKE :recherche OR modele LIKE :recherche)";
        }

        $stmt = $this->db->prepare($requete);

        if ($recherche) {
            $stmt->bindValue(':recherche', "%$recherche%", PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }   


}
?>