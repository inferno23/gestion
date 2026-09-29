<?php

if(count($_POST)>0){
	$user = OsocialData::getById($_POST["user_id"]);
	$user->name = $_POST["nombre"];
	$user->update();
print "<script>window.location='index.php?view=osocials';</script>";


}


?>