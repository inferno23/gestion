<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/
date_default_timezone_set('America/Argentina/Buenos_Aires');
//ALTER TABLE `gastos` CHANGE `des` `des` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
$user = ReservationData::getById($_GET["id"]);
$pacient  = $user->getPacient();

Core::alert("deviolverrr Turno  al paciente! ");


$user->devolver($user->id);




//print "<script>window.location='index.php?view=reservations';</script>";
Core::redir("./index.php?view=reservations&category_id=$user->category_id&date_at=$user->date_at&estudio_id=&medic_id=$user->medic_id&osocial_id=");
    
?>