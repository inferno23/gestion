<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	

	$user = AlarmaData::getById($_POST["id"]);
	
   

	$user->fecha = $_POST["date_at"];
    $user->hora = $_POST["time_at"];

    $user->detalle = $_POST["detalle"];
	$user->activa = $_POST["activa"];
	
	$reservation = ReservationData::getById($user->reservation_id);


	$pacient = $reservation->getPacient();
	$estudio = $reservation->getEstudio();
	 $osocial = $reservation->getOsocial();
	 $categoria = $reservation->getCategory();
	 

	$titulo=$pacient->name." ".$pacient->lastname." - Dni:".$pacient->no." -telf: ".$pacient->phone; 
	$titulo=$titulo." - ".$categoria->name." - ".$estudio->descripcion." ";
	$user->titulo = $titulo ." - ". substr( $user->detalle, 0, 54);  // abcd;
	$user->update();

//print "<script>window.location='index.php?view=tecnicos';</script>";
//http://localhost/gestion/index.php?view=agenda&category_id=&estudio_id=&medic_id&osocial_id=&date_at=2023-01-16
Core::redir("./index.php?view=agenda&category_id=&estudio_id=&medic_id&osocial_id=&date_at=".$user->fecha);


}


?>