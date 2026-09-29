<?php

if(count($_POST)>0){
	$user = MedicData::getById($_POST["user_id"]);

	$category_id = "NULL";
	if($_POST["category_id"]!=""){ 
            $category_id = $_POST["category_id"];
            }
	$user->name = $_POST["name"];
	$user->category_id = $category_id;
	$user->lastname = $_POST["lastname"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
        $user->is_profesional = $_POST["is_profesional"];
		$user->atencion = $_POST["atencion"];
	$user->is_active =1;
        
        
	$user->update();


	/////////////   DiasMedicData ///////////////////////////
	$idMedic=$_POST["user_id"];
	DiasMedicData::delMedicId($idMedic);

	$lunes_hora = $_POST["lunes_hora"];
	$lunes_hora_fin = $_POST["lunes_hora_fin"];
	$lunes_tarde = $_POST["lunes_tarde"];
	$lunes_tarde_fin = $_POST["lunes_tarde_fin"];

	
	

	if(!empty($lunes_hora)||!empty($lunes_hora_fin) 
	||!empty($lunes_tarde) ||!empty($lunes_tarde_fin) ){
		$lunes = new DiasMedicData();
		$lunes->dia = "lunes";
		$lunes->idMedic = $idMedic;
	$lunes->matutinoIni = $lunes_hora;
	$lunes->matutinoFin = $lunes_hora_fin;
	$lunes->vespertinoIni = $lunes_tarde;
	$lunes->vespertinoFin = $lunes_tarde_fin ;
	$lunes->atiende = "";
	$lunes->add();
   }
	//////////////////////
	$martes_hora = $_POST["martes_hora"];
		$martes_hora_fin = $_POST["martes_hora_fin"];
		$martes_tarde = $_POST["martes_tarde"];
		$martes_tarde_fin = $_POST["martes_tarde_fin"];
	if(!empty($martes_hora)||!empty($martes_hora_fin) 
	||!empty($martes_tarde) ||!empty($martes_tarde_fin) ){
		$martes = new DiasMedicData();
		$martes->dia = "martes";
		
		$martes->idMedic = $idMedic;
	$martes->matutinoIni = $martes_hora;
	$martes->matutinoFin = $martes_hora_fin;
	$martes->vespertinoIni = $martes_tarde;
	$martes->vespertinoFin = $martes_tarde_fin ;
	$martes->atiende = "";
	
	$martes->add();
   }
	//////////////////////
	$miercoles_hora = $_POST["miercoles_hora"];
	$miercoles_hora_fin = $_POST["miercoles_hora_fin"];
	$miercoles_tarde = $_POST["miercoles_tarde"];
	$miercoles_tarde_fin = $_POST["miercoles_tarde_fin"];
	if(!empty($miercoles_hora)||!empty($miercoles_hora_fin) 
	||!empty($miercoles_tarde) ||!empty($miercoles_tarde_fin) ){
		$miercoles = new DiasMedicData();
		$miercoles->dia = "miercoles";
	$miercoles->idMedic = $idMedic;
	$miercoles->matutinoIni = $miercoles_hora;
	$miercoles->matutinoFin = $miercoles_hora_fin;
	$miercoles->vespertinoIni = $miercoles_tarde;
	$miercoles->vespertinoFin = $miercoles_tarde_fin ;
	$miercoles->atiende = "";
	$miercoles->add();
   }
	//////////////////////
	$jueves_hora = $_POST["jueves_hora"];
	$jueves_hora_fin = $_POST["jueves_hora_fin"];
	$jueves_tarde = $_POST["jueves_tarde"];
	$jueves_tarde_fin = $_POST["jueves_tarde_fin"];
	if(!empty($jueves_hora)||!empty($jueves_hora_fin) 
	||!empty($jueves_tarde) ||!empty($jueves_tarde_fin) ){
		$jueves = new DiasMedicData();
		$jueves->dia = "jueves";
	$jueves->idMedic = $idMedic;
	$jueves->matutinoIni = $jueves_hora;
	$jueves->matutinoFin = $jueves_hora_fin;
	$jueves->vespertinoIni = $jueves_tarde;
	$jueves->vespertinoFin = $jueves_tarde_fin ;
	$jueves->atiende = "";
	$jueves->add();
   }
	//////////////////////
	$viernes_hora = $_POST["viernes_hora"];
	$viernes_hora_fin = $_POST["viernes_hora_fin"];
	$viernes_tarde = $_POST["viernes_tarde"];
	$viernes_tarde_fin = $_POST["viernes_tarde_fin"];
	if(!empty($viernes_hora)||!empty($viernes_hora_fin) 
	||!empty($viernes_tarde) ||!empty($viernes_tarde_fin) ){
		
	$viernes	= new DiasMedicData();
	$viernes->dia = "viernes";
	$viernes->idMedic = $idMedic;
	$viernes->matutinoIni = $viernes_hora;
	$viernes->matutinoFin = $viernes_hora_fin;
	$viernes->vespertinoIni = $viernes_tarde;
	$viernes->vespertinoFin = $viernes_tarde_fin ;
	$viernes->atiende = "";
	$viernes->add();
   }
	//////////////////////
	$sabado_hora = $_POST["sabado_hora"];
	$sabado_hora_fin = $_POST["sabado_hora_fin"];
	$sabado_tarde = $_POST["sabado_tarde"];
	$sabado_tarde_fin = $_POST["sabado_tarde_fin"];
	if(!empty($sabado_hora)||!empty($sabado_hora_fin) 
	||!empty($sabado_tarde) ||!empty($sabado_tarde_fin) ){

	$sabado	= new DiasMedicData();
	$sabado->dia = "sabado";
	$sabado->idMedic = $idMedic;
	$sabado->matutinoIni = $sabado_hora;
	$sabado->matutinoFin = $sabado_hora_fin;
	$sabado->vespertinoIni = $sabado_tarde;
	$sabado->vespertinoFin = $sabado_tarde_fin ;
	$sabado->atiende = "";
	$sabado->add();
   }
	//////////////////////


print "<script>window.location='index.php?view=medics';</script>";


}


?>