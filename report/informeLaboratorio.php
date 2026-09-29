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



$reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             $solicitante = $reservation->getMedic2();

require_once '../PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

Autoloader::register();

$word = new  PhpOffice\PhpWord\PhpWord();
$section1 = $word->AddSection();
$section1->addImage("../image/logo.jpg", array('width'=>110, 'height'=>110, 'align'=>'left'));
$section1->addText("Historial ",array("size"=>22,"bold"=>true,"align"=>"right"));

$detalle = str_replace("&amp;nbsp;",' ',$reservation->informe);

$detalle = htmlentities($detalle, null, 'utf-8');
//$section1->addText("    ".$detalle);
$detalle = html_entity_decode($detalle);
$html = '<h1>Adding element via HTML</h1>';
//$html.=$detalle;
//$html .= '<h2 style="text-align: center;"><u><strong>---</strong></u></h2><br /><u>Numero de Estudio:</u> 1580<br /><u>Turno:</u>28/06/2017<br /><u>Paciente:</u>Varas Maria Concepcion - DNI: 12649071<br /><u>Medico Solicitante:</u>Wayar Emma<br /><u>Obra Social:</u>PAMI<p><strong>                                                                EXAMINADO                                                VALOR DE REFERENCIA </strong></p><p><strong>HEMATIES ....................................:                                    /mm3                                Mujer     4.200.000 - 5.400.000</strong></p><p><strong>                                                                                                                                    Hombre  4.600.000 - 6.200.000</strong></p><p> </p><p><strong>HEMATOCRITO..............................:                                    %</strong></p><p><strong>HEMOGLOBINA.............................:                                    g/dl          </strong></p><p><strong>LEUCOCITOS................................:                                     mm3                                  6.000 - 9.000                                                </strong></p><p> </p><p><strong>GRANULOCITOS NEUTROFILOS...:                                     %                                       54 - 71   %                                                         </strong></p><p><strong>        Mielocitos.............................:                                     %                                       0           %                                   </strong></p><p><strong>        Metamielocitos ....................:                                      %                                      0 - 1       %                      </strong></p><p><strong>        Neut. en Cayado....................:                                     %                                      3 - 5       %                                    </strong></p><p><strong>        Neut. Segmentados ..............:                                     %                                      50 - 65   %                                </strong></p><p><strong>GRANULOCITOS EOSINOFILOS...:                                      %                                      1 - 4       %                                                         </strong></p><p><strong>GRANULOCITOS BASOFILOS ......:                                     %                                       0 - 1      %                                 </strong></p><p><strong>LINFOCITOS .................................:                                    %                                       20 - 35   %</strong></p><p><strong>MONOCITOS ................................:                                     %                                       4 - 8      %  </strong></p><p> </p><p><strong>ERITROSEDIMENTZACION  :         1 ra. Hora   :                    mm</strong></p><p><strong>                                                      2 da. Hora  :          -         mm          </strong></p><p>                                                  <strong>    I. de Katz   :           -</strong></p><p> </p><p> </p><p> </p><p><strong>                                                                                                                                                      </strong></p><p><strong>                                                                                                             </strong></p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p>';

///$html.=" ".$reservation->informe;


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