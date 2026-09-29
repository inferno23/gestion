<?php

if(count($_POST)>0){
	$user = PacientData::getById($_POST["user_id"]);
	$user->name =  ucwords(strtolower($_POST["name"]));
	$user->lastname =  ucwords(strtolower($_POST["lastname"]));
        $user->no = $_POST["no"];
	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	
	$user->sick = $_POST["sick"];
	$user->medicaments = $_POST["medicaments"];
	$user->alergy = $_POST["alergy"];
           $user->osocial_id = $_POST["osocial_id"];
        $user->osocial_id2 = $_POST["osocial_id2"];
        $user->osocial_id3 = $_POST["osocial_id3"];

	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
        $user->numero_afiliado2 = $_POST["numero_afiliado2"];
         $user->numero_afiliado = $_POST["numero_afiliado"];
	$user->update();

	$fechaturno=$horaturno=$categoria=$estudio_id=Null;
	if(isset($_POST['fechaturno']) && $_POST['fechaturno']!="")
	{
		$fechaturno=$_POST['fechaturno'];
	}
	if(isset($_POST['horaturno']) && $_POST['horaturno']!="")
	{
		$horaturno=$_POST['horaturno'];
	}
//Core::alert("Actualizado exitosamente!");
        
        print "<script>window.location='index.php?view=turnopaciente&id=$user->id&date_at=$fechaturno&horaturno=$horaturno&category_id=$categoria&estudio_id=';</script>";
//print "<script>window.location='index.php?view=pacients';</script>";


}


?>