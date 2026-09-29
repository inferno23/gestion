<?php
$ruta="file://WIN-9OG78E9S45Q/Informes/Informe-".$_GET["id"].".doc"; //file://win-9og78e9s45q/Informes/Informe-4801
 
 $ruta="//FABIANA-PC/Users/Lenovo/Documents/Informe-885.doc"; //file://win-9og78e9s45q/Informes/Informe-4801
            
 //echo 'id===='.$_GET["id"];
$file = $ruta;//nombre y ruta completa al archivo z:/micarpeta/mipdf.pdf
if(!file_exists($file)){
    echo ''.$ruta;
    exit;
}
//exit;
$fp = file_get_contents($file);
header('Content-type: application/vnd.ms-word');
//header("Content-type: application/doc");
//$txt= html_entity_decode($reservation->informe); 
echo $fp;
?>