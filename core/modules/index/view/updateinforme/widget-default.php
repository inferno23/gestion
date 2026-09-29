<?php

if(count($_POST)>0){
	$user = InformeData::getById($_POST["user_id"]);
	$user->codigo_estudio = $_POST["codigo_estudio"];
        $user->codigo_informe = $_POST["codigo_informe"];
        $user->subcodigo = $_POST["subcodigo"];
          $user->descripcion = $_POST["descripcion"];
         $user->observacion = $_POST["observacion"];
      
        
	$user->update();
print "<script>window.location='index.php?view=informes';</script>";


}


?>