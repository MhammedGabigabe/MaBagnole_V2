<?php
require_once "../models/Vehicule.php";

$vehicule = new Vehicule();


$listeVehicules = $vehicule->getAll();

if(isset($_POST['btn_recherche'])){
    $recherche = $_POST['recherche'] ?? null;
    if ($recherche) {
        $listeVehicules = $vehicule->searchVehicules($recherche);
    } else {
        $listeVehicules = $vehicule->getAll();
    }
}

$vehiDisp = $vehicule->vehiculesDispo();
$vehiLouee = $vehicule->vehiculesLouee();

if(isset($_POST['vehiculesCat'])){
    $vehicule->idCategorie = $_POST['vehiculesCat'];
    $listeVehicules = $vehicule->vehiculesCat();
}


$vehi_a_modifier = null;
if(isset($_POST['editModal_vehi'])){
    $vehi_a_modifier = $vehicule->getById($_POST['editModal_vehi']);
}

if(isset($_POST['maj'])){
    $vehicule->idVeicule = $_POST['maj'];
    $vehicule->modele = $_POST['modele'];
    $vehicule->marque = $_POST['marque'];
    $vehicule->immatriculation = $_POST['immatriculation'];
    $vehicule->prixJour = $_POST['prix_jour'];
    $vehicule->image = $_POST['image'];
    $vehicule->boiteVitesse = $_POST['boite_vitesse'];
    $vehicule->motorisation = $_POST['motorisation'];
    $vehicule->idCategorie = $_POST['id_categ'];
    $vehicule->modifierVehicule();
    header("Location: ../views/vehicules.php");
    exit;
}

if(isset($_POST['ajouter_seul'])){
    $vehicule->immatriculation = $_POST['immatriculation'];
    $vehicule->modele = $_POST['modele'];
    $vehicule->marque = $_POST['marque'];
    $vehicule->prixJour = $_POST['prix_jour'];
    $vehicule->image = $_POST['image'];
    $vehicule->boiteVitesse = $_POST['boite_vitesse'];
    $vehicule->motorisation = $_POST['motorisation'];
    $vehicule->idCategorie = $_POST['id_categ'];

    $vehicule->ajouterVehicule();
    header("Location: ../views/vehicules.php");
    exit;
}

if(isset($_POST['mass_add_vehicles'])){
    $texte = $_POST['vehicles_data'];
    $lignes = explode("\n",$texte);
    $vehicules = [];

    foreach($lignes as $ligne){
        $parties = explode("|", $ligne, 5);
        $marque = trim($parties[0] ?? "");
        $modele = trim($parties[1] ?? "");
        $prix = trim($parties[2] ?? "");
        $id_Cat = trim($parties[3] ?? "");
        $imm = trim($parties[4] ?? "");

        if($marque !== ""){
            $vehicules[] = ['marque'=> $marque, 'modele'=> $modele, 'prix'=>$prix, 'id_Cat'=> $id_Cat, 'imm'=>$imm];
        }
    }
    $vehicule->ajouterEnMasse($vehicules);
    header("Location: ../views/vehicules.php");
    exit;
}

if(isset($_POST['supprimer_vehi'])){
    $id = $_POST['supprimer_vehi'];
    $vehicule->supprimerVehicule($id);
    header("Location: ../views/vehicules.php");
    exit;
}



if(isset($_POST['deatilsVehicule'])){
    $id = $_POST['deatilsVehicule'];
    $_SESSION['idVehicule'] = $id;
    $deatilsVehi = $vehicule->getById($id);
}

$limit = 3; 
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

$offset = ($page - 1) * $limit;

$recherche = $_POST['recherche'] ?? null;
 

$listeVehiculesPag = $vehicule->getVehiculesDisponibles($limit, $offset, $recherche);
$totalVehicules = $vehicule->countVehiculesDisponibles($recherche);
$totalPages = ceil($totalVehicules / $limit);

?>