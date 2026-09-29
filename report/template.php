<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/PaymentData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
include "../core/modules/index/model/InformeData.php";
session_start();
 $reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             
             $informes = InformeData::getByEstudio($reservation->estudio_id);
             
             $medico_solicitante=null;
             if(!empty($reservation->medsoli))
              $medico_solicitante = $reservation->getMedic2();
             
             
require_once '../PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader;


Autoloader::register();

\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;

$plantilla=$reservation->estudio_id.'.docx';

$templateWord = new TemplateProcessor($plantilla);
 
$paciente = $pacient->lastname." ".$pacient->name;
$dni = $pacient->no;
$turno = $fecha= date("d/m/Y ",strtotime($reservation->date_at." "));/// un mes;
$solicitante = "No registrado";
if(!empty($medico_solicitante))
 $solicitante = $medico_solicitante->lastname." ".$medico_solicitante->name;


$obra ="".$osocial->nombre;
$items=$reservation->symtoms;
if(!empty($items)){
    $item1= $item2= $item3= $item4= $item5= $item6= $item7 =$item8 =null;
    $porciones = explode("-", $items);
    foreach($porciones as $k=>$valor)
    { 
      if( $k==0)            
                $item1= $valor;
      if( $k==1)            
                $item2= $valor;
      if( $k==2)            
                $item3= $valor;
      if( $k==3)            
                $item4= $valor;
      if( $k==4)            
                $item5= $valor;
      if( $k==5)            
                $item6= $valor;
      if( $k==6)            
                $item7= $valor;
      if( $k==7)            
                $item8= $valor;
    }
 //  echo $item1.'-'.$item2.'-'.$item3.'-'.$item4.'-'.$item5.'-'.$item6.'-'.$item7;
    foreach($informes as $valor)
    { 
        //print_r($valor->id);
      if( $valor->id==$item1)            
                $item1= $valor->observacion;
      if( $valor->id==$item2)            
                $item2= $valor->observacion;
      if( $valor->id==$item3)            
                $item3= $valor->observacion;
      if( $valor->id==$item4)            
                $item4= $valor->observacion;
      if( $valor->id==$item5)            
                $item5= $valor->observacion;
      if( $valor->id==$item6)            
                $item6= $valor->observacion;
      if($valor->id==$item7)            
                $item7= $valor->observacion;
        if( $valor->id==$item8)            
                $item8= $valor->observacion;
                        	    //debug( $k.'-'.$v);

    } 
  //  echo '-<br>'.$item1.'-<br>'.$item2.'-<br>'.$item3.'-<br>'.$item4.'-<br>'.$item5.'-<br>'.$item6.'-<br>'.$item7;
    
    $templateWord->setValue('item1',$item1);
    $templateWord->setValue('item2',$item2);
    $templateWord->setValue('item3',$item3);
    $templateWord->setValue('item4',$item4);
    $templateWord->setValue('item5',$item5);
    $templateWord->setValue('item6',$item6);
    $templateWord->setValue('item7',$item7);
      $templateWord->setValue('item8',$item8);

}
// --- Asignamos valores a la plantilla pasando por variable
$templateWord->setValue('dni',$dni);
$templateWord->setValue('paciente',$paciente);
$templateWord->setValue('turno',$turno);
$templateWord->setValue('solicitante',$solicitante);
$templateWord->setValue('obra',$obra);
$templateWord->setValue('id',$_GET["id"]);

// --- Guardamos el documento
$filename = "Informe-".$reservation->id.".docx";
$ruta="//FABIANA-PC/Users/Lenovo/Documents/"; //file://win-9og78e9s45q/Informes/Informe-4801
$ruta="//win-9og78e9s45q/Informes/Informe-4801"; //file://win-9og78e9s45q/Informes/Informe-4801
 //UPDATE `informe` SET `observacion` = descripcion WHERE `observacion` = ''
//$templateWord->saveAs($ruta.$filename);
$templateWord->saveAs($filename);

//header("Content-Disposition: attachment; filename=$filename; charset=iso-8859-1");
//echo file_get_contents($ruta.$filename);


$fp = file_get_contents($filename);
$x=$ruta.$filename;
$x=$filename;
header("Content-Disposition: attachment; filename=$x; charset=iso-8859-1");

//$txt= html_entity_decode($reservation->informe); 
echo $fp;
     
?>