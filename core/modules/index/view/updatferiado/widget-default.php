<?php

if(count($_POST)>0){

        echo "<br> update  Feriados  ";
	$user = FeriadosData::getById($_POST["id"]);
	$user->des = $_POST["des"];
        $user->fecha = $_POST["fecha"];
       
      
	$user->update();
        $hoy= date("Y-m-d");
        
print "<script>window.location='index.php?view=feriados';</script>";


}


?>