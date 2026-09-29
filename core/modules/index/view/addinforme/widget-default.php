<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

if(count($_POST)>0){
	$user = new InformeData();
	$user->codigo_estudio = $_POST["codigo_estudio"];
        $user->codigo_informe = $_POST["codigo_informe"];
        $user->subcodigo = $_POST["subcodigo"];
          $user->descripcion = $_POST["descripcion"];
         $user->observacion = $_POST["observacion"];
	$user->add();

print "<script>window.location='index.php?view=informes';</script>";


}


?>