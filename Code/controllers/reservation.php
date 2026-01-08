<?php

require_once "../models/Reservation.php";
require_once "../models/Vehicule.php";

$vehicule = new Vehicule();

$reservation = new Reservation();


$nbReserEnAtt = count($reservation->getReservByStatut('en attente'));
$nbResCeMois = count($reservation->getReservCeMois());
$listeReservs = $reservation->getAll();

if(isset($_POST['accepter'])){
    $reservation->approuverReservation($_POST['accepter']);
    header("Location: ../views/reservations.php");
    exit;
}

if(isset($_POST['refuser'])){
    $reservation->refuserReservation($_POST['refuser']);
    header("Location: ../views/reservations.php");
    exit;
}

$mesReservations = $reservation->getReservationsByClient($_SESSION['user_id']);

// if($_SESSION['idVehicule']){
//     $deatilsVehi = $vehicule->getById($_SESSION['idVehicule']);
// }

if(isset($_POST['confirmeReservation'])){
    $reservation->idVehicule = $_POST['id_vehi'];
    $reservation->idClient = $_POST['id_client'];
    $reservation->dateDebut = $_POST['date_debut'];
    $reservation->dateRetour = $_POST['date_fin'];
    $reservation->lieuPrise = $_POST['lieu_prise'];
    $reservation->lieuRetour = $_POST['lieu_retour'];

    $reservation->reserver();
    header("Location: ../views/reservationsClient.php");
    exit;

}
?>