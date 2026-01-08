<?php
session_start();
require_once "../models/Utilisateur.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $utilisateur = new Utilisateur();
    $res = $utilisateur->seConnecter($_POST['email'], $_POST['password']);
    if($res == "email_incorrect"){
        $_SESSION['msg'] = "email incorrect !!";
        header("Location: ../views/login.php");
        exit;
    }elseif($res == 'mdp_incorrect'){
        $_SESSION['msg'] = "mot de passe incorrect !!";
        header("Location: ../views/login.php");
        exit;
    }else{
        unset($_SESSION['msg']);
        $_SESSION['user_id'] = $res['id_utilisateur'];
        $_SESSION['nom'] = $res['nom'];
        $_SESSION['role'] = $res['role'];
        $_SESSION['email'] = $res['email'];
        if($res['role'] == 'Admin'){
            header("Location: ../views/dashboard.php");
            exit;
        }else{
            header("Location: ../views/categoriesClient.php");
            exit;
        }

    }
}
?>