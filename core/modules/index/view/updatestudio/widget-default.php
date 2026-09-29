<?php

if(count($_POST)>0){
	$user = EstudioData::getById($_POST["user_id"]);
	$user->descripcion =ucwords(strtolower($_POST["descripcion"])); // Hello World! $_POST["name"];

        $user->category_id = $_POST["category_id"];
        $user->preparativos = $_POST["preparativos"];
        $user->caja = $_POST["caja"];
         $user->espera = $_POST["espera"];
          $user->lugar = $_POST["lugar"];
      
        if(!empty($_POST["informe"])){
            $detalle=Htmlspecialchars ($_POST["informe"],ENT_QUOTES); 
             $user->informe  = $detalle;
             //echo $textook;
      
      }
      
      
        
	$user->update();
print "<script>window.location='index.php?view=estudios';</script>";


}


?>