<?php
/**
*  del reserva 
* @author Marco Farfan 3888-15568587
**/

//ALTER TABLE `gastos` 	CHANGE COLUMN `des` `des` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci' AFTER `fecha`;
date_default_timezone_set('America/Argentina/Buenos_Aires');
$user = ReservationData::getById($_GET["id"]);

$estudio = $user->getEstudio();



$pacient  = $user->del();

$hoy = date("Y-m-d");
	


//print "<script>window.location='index.php?view=reservations';</script>";
Core::redir("./index.php?view=reservations&category_id=&date_at=$hoy&estudio_id=&medic_id=&osocial_id=");
    
?>