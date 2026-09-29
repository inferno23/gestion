<?php

if(count($_POST)>0){
	$user = GastosData::getById($_POST["id"]);
	$user->des = $_POST["des"];
        $user->fecha = $_POST["fecha"];
        $user->monto = $_POST["monto"];
      
	$user->update();
        $hoy= date("Y-m-d");
        
print "<script>window.location='index.php?view=gastos&date_at=$hoy';</script>";


}


?>