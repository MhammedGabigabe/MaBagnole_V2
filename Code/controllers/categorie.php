<?php
require_once "../models/Categorie.php";

$categorie =new Categorie();

$listeCategories = $categorie->getAll();
$nbCategorie = count($listeCategories);



$cat_a_modifier = null;
if(isset($_POST['id_a_modifier'])){
    $cat_a_modifier = $categorie->getById($_POST['id_a_modifier']);
}

if(isset($_POST['modifier'])){
    $categorie->setId($_POST['modifier']);
    $categorie->setNom($_POST['nom']);
    $categorie->setDescription($_POST['description']);
    $categorie->setImage($_POST['image']);
    $categorie->modifierCategorie();
    header("Location: ../views/categories.php");
    exit;
}

if(isset($_POST['ajouter_seul'])){
    
    $categorie->setNom($_POST['nom']);
    $categorie->setDescription($_POST['description']);
    $categorie->setImage($_POST['image']);

    $categorie->ajouterCategorie();
    header("Location: ../views/categories.php");
    exit;
}

if(isset($_POST['ajouter_mass'])){
    $texte = $_POST['categories_list'];
    $lignes = explode("\n",$texte);
    $categories = [];

    foreach($lignes as $ligne){
        $parties = explode(";", $ligne, 3);
        $nom = trim($parties[0] ?? "");
        $desc = trim($parties[1] ?? null);
        $img = trim($parties[2] ?? null);

        if($nom !== ""){
            $categories[] = ['nom'=> $nom, 'desc'=> $desc, 'img'=> $img];
        }
    }
    $categorie->ajouterEnMasse($categories);
    header("Location: ../views/categories.php");
    exit;
}

if(isset($_POST['supprimer_cat'])){
    $id = $_POST['supprimer_cat'];
    $categorie->supprimerCategorie($id);
    header("Location: ../views/categories.php");
    exit;
}

?>