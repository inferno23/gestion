<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/PaymentData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
include "../core/modules/index/model/UserData.php";
session_start();

require_once '../PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

Autoloader::register();

 $reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             $solicitante = $reservation->getMedic2();


$word = new  PhpOffice\PhpWord\PhpWord();


$section1 = $word->createSection(array('marginLeft'=>15, 'marginRight'=>6, 'marginTop'=>70, 'marginBottom'=>70));
//$section1 = $word->AddSection();
$section1->addImage("../image/logo.jpg", array('width'=>110, 'height'=>110, 'align'=>'left'));
$section1->addText("    Gobernador Tello 590 tel (03888) 422798",array("size"=>10,"bold"=>true,"align"=>"right"));
$section1->addText("    San Pedro de Jujuy - CP:4500",array("size"=>10,"bold"=>true,"align"=>"right"));
$section1->addText("");
$section1->addText("  Turno ",array("size"=>12,"bold"=>true,"align"=>"right"));



$total = 0;
$fecha= date("d/m/Y ",strtotime($reservation->date_at." "));/// un mes
$section1->addText("");
$section1->addText("    ".$estudio->id." ".$estudio->descripcion,array("size"=>8,"bold"=>true,"align"=>"right"));
//$section1->addText("".$estudio->id." ".$estudio->descripcion);
$section1->addText("");
$section1->addText("    Paciente: ");
$section1->addText("    ".$pacient->lastname." ".$pacient->name);
$section1->addText("");
$section1->addText("    Turno:".$fecha."");
$section1->addText("    Hora: ".$reservation->time_at);
$section1->addText("");
$section1->addText("    Solicitado Por: ");
$section1->addText("    ".$solicitante->lastname." ".$solicitante->name);
$section1->addText("");
$section1->addText("    Realizado Por: ");
$section1->addText("     ".$medic->lastname." ".$medic->name);
$section1->addText("");
$section1->addText("    Obra Social: ".$osocial->id." ".$osocial->nombre);
$section1->addText("");
$leyendaRecepcion="    Firma Recepcion";
if (!empty($reservation->user_id)){
     $usuario  = UserData::getById($reservation->user_id);
    $leyendaRecepcion="    ".$usuario->lastname." ".$usuario->name;
}
  

$section1->addText("$leyendaRecepcion");
$section1->addText("");
$section1->addText("    Firma Tecnico");
$section1->addText("");
$section1->addText("    Firma Profesional");
$section1->addText("");
$section1->addText("");
$section1->addText("    Preparacion",array("size"=>12,"bold"=>true,"align"=>"right"));
$section1->addText("");

 $leyendaPreparativos=" ";
 //$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
 
 if (!empty($estudio->preparativos)){
     $leyendaPreparativos=" ".$estudio->preparativos." ";
     $preparativos = explode(".", $leyendaPreparativos);
     $resultado = count($preparativos);     
     foreach ($preparativos as $prepa) {
          $section1->addText("   *$prepa");
        $section1->addText("");
     }
        
}



 /**

$section1->addText("   *Traer estudio anterior");
$section1->addText("");
$section1->addText("    *Ayuno de 8 horas");
$section1->addText("");
$section1->addText("    *Tomar un litro y medio agua");
$section1->addText("     Horas antes del estudio");
$section1->addText("");
$section1->addText("    *Traer Toalla de Mano");
$section1->addText("");
*/
//$filename = time().".docx";
$filename = "turno-".$reservation->id.".docx";
#$word->setReadDataOnly(true);
$word->save($filename,"Word2007");
//chmod($filename,0444);
header("Content-Disposition: attachment; filename='$filename'");
readfile($filename); // or echo file_get_contents($filename);
unlink($filename);  // remove temp file



?>