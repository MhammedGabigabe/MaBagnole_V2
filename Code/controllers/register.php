<?php
session_start();
require_once "../models/Client.php";

$client =new Client();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $client->nom = $_POST['nom'];
    $client->email = $_POST['email'];
    $client->mdp = $_POST['password'];
    $client->telephone = $_POST['telephone'];
    $client->cin = $_POST['cin'];

    $res = $client->sInscrire();

    if($res == "email_utilise"){
        $_SESSION['msg'] = "email deja utilisé !";
        header("Location: ../views/register.php");
        exit;
    }elseif($res == "erreur"){
        $_SESSION['msg'] = "erreur lors de l'inscription !";
        header("Location: ../views/register.php");
        exit;
    }else{
        header("Location: ../views/login.php");
        exit;
    }
}




?>