<?php

if(count($_POST)>0){
	$user = ValestData::getById($_POST["row_id"]);
	$user->codest = $_POST["estudio_id"];
        $user->codob = $_POST["osocial_id"];
        $user->coseguro = $_POST["coseguro"];
        $user->osocial = $_POST["osocial"];
        $user->codigo = $_POST["codigo"];
	$user->update();
print "<script>window.location='index.php?view=valests&estudio_id=&osocial_id=2';</script>";


}


?>