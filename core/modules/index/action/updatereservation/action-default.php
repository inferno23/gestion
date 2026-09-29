<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	$r = ReservationData::getById($_POST["id"]);
	
    $id=$_POST["id"];
    $r->title = $_POST["title"];
    
    //echo($_POST["estudio_id"]);
    $r->note = $_POST["note"];
    $r->pacient_id = $_POST["pacient_id"];
    $r->medic_id = $_POST["medic_id"];
    $r->estudio_id = $_POST["estudio_id"];
    $r->tipo_pago = $_POST["tipo_pago"];
     $estudio = EstudioData::getById($_POST["estudio_id"]);
    
    $r->category_id = $estudio->category_id;
    $r->osocial_id = $_POST["osocial_id"];
    
    $r->estudio2 = $_POST["estudio2"];
    $r->estudio3 = $_POST["estudio3"];
    $r->estudio4 = $_POST["estudio4"];
    $r->estudio5 = $_POST["estudio5"];

    $r->estudio2 =   $r->estudio3 =     $r->estudio4 =     $r->estudio5 = 0;
    $precio =$precio2 =  $precio3 =  $precio4 = $precio5 = 0;

    $volver = $_POST["volver"];
    if(empty($volver) || $volver=="")
    $volver = "agenda";
    
    
    $r->date_at = $_POST["date_at"];
    $r->time_at = $_POST["time_at"];

    $r->hora_fin = $_POST["hora_fin"];
    $r->user_id = $_SESSION["user_id"];
    $r->tipo = $_POST["tipo"];
    $r->status_id = $_POST["status_id"];
    $r->payment_id = $_POST["payment_id"]; 
    $r->price = $_POST["price"];
    $r->observacion_coseguro = $_POST["observacion_coseguro"];
     $valor=ValestData::getRepeated( $r->estudio_id,$r->osocial_id);
   
     if(empty($valor))
     $precio = 0;
 else
 $precio = $valor->coseguro;

  
 // echo("precio".$precio.$precio2."title3".$precio3.$precio4." title5".$precio5);

  $r->price = $precio +$precio2 +$precio3 +$precio4+$precio5  ;
  $r->precio_obra = 0 ; // todos particular 



    
    $r->sick = $_POST["sick"];
    $r->symtoms = $_POST["symtoms"];
    $r->medicaments = $_POST["medicaments"];
     $r->caja = $_POST["caja"];
     if(isset($_POST["tecnico_id"]) ){
         $r->tecnico_id = $_POST["tecnico_id"];
     }else
      $r->tecnico_id = 0;
     
     
      if(isset($_POST["medic_id"]) ){
         $r->medic_id = $_POST["medic_id"];
     }else
         $r->medic_id = 0;
     
      if(isset($_POST["medsoli"]) ){
         $r->medsoli = $_POST["medsoli"];
     }else
      $r->medsoli = 0;
     
     $historial_detalle=$r->detalle ;
      
      


      if(!empty($_POST["detalle"])){
            $detalle=Htmlspecialchars ($_POST["detalle"],ENT_QUOTES); 
             $r->detalle = $detalle." <br>  \n ".$historial_detalle;
             //echo $textook;
      
      }
      
      
      
      
      
       $r->fecha_atencion = $_POST["fecha_atencion"];
        $r->hora_atencion = $_POST["hora_atencion"];
      //  echo $_POST["fecha_informe"];
 
         $u = UserData::getById(Session::getUID());
         
      $r->user_informe = $u->id;
      if(!empty($_POST["informe"])){
            $textook=Htmlspecialchars ($_POST["informe"],ENT_QUOTES); 
             $r->informe = $textook;
             //echo $textook;
      
      }

      /////////fileToUpload  imagen//////////////////////

      $target_dir =  getcwd() ."/image/".$id."/";
     // echo $target_dir . "\n";
      
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if $uploadOk is set to 0 by an error
//echo "antesss";
//print_r($_POST["fileToUpload"]);
//print_r($_FILES);

    if (isset($_FILES['fileToUpload'])){
	
      echo "The file has been uploaded.";
      
	$cantidad= count($_FILES["fileToUpload"]["tmp_name"]);
	$j=0;

	for ($i=0; $i<6; $i++){
	//Comprobamos si el fichero es una imagen
	if ($_FILES['fileToUpload']['type'][$i]=='image/png' || $_FILES['fileToUpload']['type'][$i]=='image/jpeg'){
	
	//Subimos el fichero al servidor+
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
        $j++;
        //  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
            if($j==0)
            $r->imagen = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i]));
            if($j==1)
            $r->imagen2 = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i]));
            if($j==2)
            $r->imagen3 = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i]));
            if($j==3)
            $r->imagen4 = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i]));
            if($j==4)
            $r->imagen5 = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i]));




      }  else {
        echo "<br>No se logro subir la imagen.";
    }

    // echo "<br>salllee de foto";

    }else{/// no es imagen pewro subo pdf excel 
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
    // echo "<br> The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
    
    }
    } /// fin pregunta tipo de archivo 

    }/// fin for 
}   /// fin si tiene fileToUpload

//////////guardar //////////////////////////////////////  

 //////////guardar //////////////////////////////////////   
    
	$r->update();

//***************************************************************************/
 
//Core::redir("./index.php?view=$volver&category_id=&estudio_id=&medic_id=$r->medic_id&osocial_id=&date_at=".$_POST["date_at"]);
Core::redir("./index.php?view=view_turno&id=$r->id");


}


?>