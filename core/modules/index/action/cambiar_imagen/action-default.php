<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	$r = ReservationData::getById($_POST["id"]);
	
$id=$_POST["id"];
$imagen=$_POST["imagen"];

if($imagen =="1")
   $imagen="imagen";
if($imagen =="2")
   $imagen="imagen2";
if($imagen =="3")
   $imagen="imagen3";
if($imagen =="4")
   $imagen="imagen4";
if($imagen =="5")
   $imagen="imagen5";
      /////////fileToUpload  imagen//////////////////////

      $target_dir =  getcwd() ."/image/".$id."/";
      echo $target_dir . "\n";
      
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if $uploadOk is set to 0 by an error

    if (isset($_FILES['archivo'])){
	
	
      $nombre_archivo =$_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];
      $archivo= $_FILES['archivo']['tmp_name'];
	
	//Comprobamos si el fichero es una imagen
	if ($_FILES['archivo']['type']=='image/png' || $_FILES['archivo']['type']=='image/jpeg'){
	
	//Subimos el fichero al servidor+
      $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
      if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["archivo"]["name"])). " has been uploaded.";
            
            $archivo = htmlspecialchars( basename( $_FILES["archivo"]["name"]));




      } else {
                echo "No se logro subir la imagen.";
      }


      $sql = "UPDATE reservation SET $imagen = '$archivo' WHERE reservation.id = $r->id;";

//echo ''.$sql;
		 $r->cambiarImagen($sql);

           
      
	
       }
    }

    Core::redir("./index.php?view=view_turno&id=$r->id");








}


?>