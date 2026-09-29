<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/GastosData.php";
include "../core/modules/index/model/EstudioData.php";
include "../core/modules/index/model/OsocialData.php";
include "../core/modules/index/model/CierreData.php";
include "../core/modules/index/model/CategoryData.php";
include "../core/modules/index/model/UserData.php";
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$reservation = ReservationData::getById($_GET["id"]);
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             $solicitante = $reservation->getMedic2();
  $tituloReporte = "Informe-".$reservation->id."";       
/**
 * interlineado
 &lt;p style=&quot;line-height:11px;&quot;&gt;hols&amp;nbsp;&lt;br /&gt;
valdez&amp;nbsp;&lt;br /&gt;
2222222222222222&lt;br /&gt;
3333333333&lt;br /&gt;
&lt;br /&gt;
&lt;span style=&quot;font-size:16px;&quot;&gt;csacdsftamano16&lt;/span&gt;&lt;/p&gt;
 * 
 */
?>
<html>
<?php
 header('Content-type: application/vnd.ms-word');
 header("Content-Disposition: attachment; filename=$tituloReporte.doc");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>

    <body>
        
        <?php
        /// actual line-height:11px =0.8   13px=1.0  13px=1.0  15px=1.15  18px=1.5  20px=20.0
        $prueba="
&lt;p style=&quot;line-height:13px;&quot;&gt;&lt;span style=&quot;font-family:Times New Roman,Times,serif&quot;&gt;&lt;span style=&quot;font-size:12px&quot;&gt;Plexos coroideos sim&amp;eacute;tricos de contornos regulares.&lt;br /&gt;
N&amp;uacute;cleos de la base de caracter&amp;iacute;sticas ecogr&amp;aacute;ficas normales, sin presencia de calcificaciones.&lt;br /&gt;
Cuerpo calloso presente.&lt;br /&gt;
Tentorio y cerebelo de configuraci&amp;oacute;n habitual.&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;

&lt;p style=&quot;line-height:20px;&quot;&gt;&amp;nbsp;&lt;/p&gt;

";
      $prueba= $reservation->informe;
        //actual line-height:11px =0.8   13px=1.0  13px=1.0  15px=1.15  18px=1.5  20px=20.0
        $prueba = str_replace("line-height:11px", "line-height:1.0", $prueba);
        $prueba = str_replace("line-height:13px", "line-height:1.2", $prueba);
        $prueba = str_replace("line-height:15px", "line-height:1.5", $prueba);
        $prueba = str_replace("line-height:18px", "line-height:1.8", $prueba);
        $prueba = str_replace("line-height:20px", "line-height:2.0", $prueba);
        $prueba = str_replace("line-height:30px", "line-height:3.0", $prueba);

        
$txt= html_entity_decode($prueba); 
              //  $txt= html_entity_decode($reservation->informe); 
echo $txt;
?>

 </body>
</html>