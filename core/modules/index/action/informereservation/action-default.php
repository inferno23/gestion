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
    
     $estudio = EstudioData::getById($_POST["estudio_id"]);
    
    $r->category_id = $estudio->category_id;
    $r->osocial_id = $_POST["osocial_id"];
    $r->date_at = $_POST["date_at"];
    $r->time_at = $_POST["time_at"];
    $r->user_id = $_SESSION["user_id"];
    $r->tipo = $_POST["tipo"];
    $r->status_id = $_POST["status_id"];
    $r->payment_id = $_POST["payment_id"]; 
    $r->price = $_POST["price"];
    $r->observacion_coseguro = $_POST["observacion_coseguro"];
     $valor=ValestData::getRepeated( $r->estudio_id,$r->osocial_id);
    if(empty($valor))
        $r->precio_obra = 0;
    else
     $r->precio_obra = $valor->osocial;
    
    $r->sick = $_POST["sick"];
    
    $r->medicaments = $_POST["medicaments"];
     $r->caja = $_POST["caja"];
     if(isset($_POST["tecnico_id"]) ){
         $r->tecnico_id = $_POST["tecnico_id"];
     }else
      $r->tecnico_id = 0;
      if(isset($_POST["medsoli"]) ){
         $r->medsoli = $_POST["medsoli"];
     }else
      $r->medsoli = 0;
     
     
      
      
       $r->fecha_atencion = $_POST["fecha_atencion"];
        $r->hora_atencion = $_POST["hora_atencion"];
         $r->fecha_informe = $_POST["fecha_informe"];
         
      $r->user_informe = $_POST["user_informe"];
      
      ///echo  $_POST["informe1"]."-".$_POST["informe2"] .$_POST["informe3"]."-".$_POST["informe4"]."-".$_POST["informe5"];
          
    $symtoms = $_POST["informe1"]."-".$_POST["informe2"];
    if(!empty($_POST["informe3"]) )
        $symtoms = $symtoms."-".$_POST["informe3"];
    
        if(!empty($_POST["informe4"]) )
        $symtoms = $symtoms."-".$_POST["informe4"];
        
        if(!empty($_POST["informe5"]) )
        $symtoms = $symtoms."-".$_POST["informe5"];
        
        if(!empty($_POST["informe6"]) )
        $symtoms = $symtoms."-".$_POST["informe6"];
        
        if(!empty($_POST["informe7"]) )
        $symtoms = $symtoms."-".$_POST["informe7"];
    $r->symtoms =$symtoms;
	$r->update();

//******************************rutaaa paar regresar*********************************************/
        $osocial_id=$medic_id=$category_id=$estudio_id="";
      if(  isset($_GET["estudio_id"]) && ( $_GET["estudio_id"]!=""))
             $estudio_id=$_GET["estudio_id"];
       if(  isset($_GET["category_id"]) && ( $_GET["category_id"]!=""))
             $category_id=$_GET["category_id"];
       if(  isset($_GET["medic_id"]) && ( $_GET["medic_id"]!=""))
             $medic_id=$_GET["medic_id"];
       if(  isset($_GET["osocial_id"]) && ( $_GET["osocial_id"]!=""))
             $osocial_id=$_GET["osocial_id"];
       
//***************************************************************************/
     
        
              // print "<script>window.open('./report/doc.php?id=$r->id', '_blank');</script>";
            print "<script>window.open('./report/template.php?id=$r->id', '_blank');</script>";
         
       Core::redir("./index.php?view=turnos_atendidos&estudio_id=$estudio_id&category_id=$category_id&medic_id=$medic_id&osocial_id=$osocial_id&date_at=$r->date_at");
       //$ruta= "&category_id=".$category_id."&estudio_id=".$estudio_id."&medic_id=".$medic_id."&osocial_id=".$osocial_id;
            //      echo $ruta;
        
        
      

}


?>