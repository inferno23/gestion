<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

if(count($_POST)>0){
	$user = new GastosData();
	$user->fecha = $_POST["fecha"];
        $user->monto = $_POST["monto"];
        $user->des = $_POST["des"];
		$user->cierre = 0;
		$user->user_id  = 1;
	$user->add();

print "<script>window.location='index.php?view=gastos';</script>";


}


?>