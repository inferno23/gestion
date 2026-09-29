<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

if(count($_POST)>0){
	$user = new EstudioData();
	$user->descripcion =ucwords(strtolower($_POST["name"])); // Hello World! $_POST["name"];

        $user->category_id = $_POST["category_id"]; 
        $user->preparativos = $_POST["preparativos"];
          $user->caja = $_POST["caja"];
          $user->espera = $_POST["espera"];
          $user->lugar = $_POST["lugar"];
         $user->informe = "";
	$user->add();

print "<script>window.location='index.php?view=estudios';</script>";


}


?>