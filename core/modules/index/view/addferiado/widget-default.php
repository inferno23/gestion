<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

if(count($_POST)>0){
	$user = new FeriadosData();
	$user->fecha = $_POST["fecha"];
       
        $user->des = $_POST["des"];
		
		$user->user_id  = 1;
	$user->add();

print "<script>window.location='index.php?view=feriados';</script>";


}


?>