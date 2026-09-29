<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

if(count($_POST)>0){
	$user = new OsocialData();
	$user->nombre = $_POST["name"];
	$user->add();

print "<script>window.location='index.php?view=osocials';</script>";


}


?>