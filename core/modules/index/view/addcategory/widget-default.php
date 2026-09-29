<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

if(count($_POST)>0){
	$user = new CategoryData();
	$user->name = $_POST["name"];
	$user->add();

print "<script>window.location='index.php?view=categories';</script>";


}


?>