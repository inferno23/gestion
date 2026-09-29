<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/PaymentData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
session_start();

require_once '../PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

Autoloader::register();

$word = new  PhpOffice\PhpWord\PhpWord();

$reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             $solicitante = $reservation->getMedic2();


$section1 = $word->AddSection();
$section1->addImage("../image/logo3.png", array('width'=>110, 'height'=>110, 'align'=>'left'));
$section1->addText("Historial ",array("size"=>22,"bold"=>true,"align"=>"right"));



//$html=$reservation->informe;
$html = '<h1>Adding element via HTML</h1>';
$html .= '<p>Some well formed HTML snippet needs to be used</p>';
$html .= '<p>With for example <strong>some<sup>1</sup> <em>inline</em> formatting</strong><sub>1</sub></p>';
$html .= '<p>Unordered (bulleted) list:</p>';
$html .= '<ul><li>Item 1</li><li>Item 2</li><ul><li>Item 2.1</li><li>Item 2.1</li></ul></ul>';
$html .= '<p>Ordered (numbered) list:</p>';
$html .= '<ol><li>Item 1</li><li>Item 2</li></ol>';
//print_r($html);
\PhpOffice\PhpWord\Shared\Html::addHtml($section1, $html);

$word->addTableStyle('table1', $styleTable,$styleFirstRow);
$styleTable = array('borderSize' => 6, 'borderColor' => '888888', 'cellMargin' => 40);
$styleFirstRow = array('borderBottomColor' => '0000FF', 'bgColor' => 'AAAAAA');

/// datos bancarios
$section1->addText("");
$section1->addText("");
$section1->addText("");
$section1->addText("Generado por Marko Farfan  v2.0");
$filename =$_GET["id"].time().".docx";
#$word->setReadDataOnly(true);
$word->save($filename,"Word2007");
//chmod($filename,0444);
header("Content-Disposition: attachment; filename='$filename'");
readfile($filename); // or echo file_get_contents($filename);
unlink($filename);  // remove temp file



?>