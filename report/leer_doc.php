<?php 

//http://www.phpcentral.com/pregunta/250/convertir-un-archivo-docx-a-pdf-con-php
$lineas = file('file:///C:/Users/Lenovo/Documents/SEGURIDAD/Informe-187.doc');
/**  $prueba= '';
     
      foreach ($lineas as $linea_num => $linea) {
         $prueba.= htmlspecialchars($linea);
    }
      */
    require_once('../doc2txt.php');
    
$objetoDocumento = new Doc2Txt('C:/Users/Lenovo/Documents/SEGURIDAD/Informe-187.doc');
$textoString = $objetoDocumento->convertToText();
//imprimo en pantalla el resultado (indicando al HTML que el contenido esta preformateado)
echo '<pre>';
echo $textoString;
echo '</pre>';
?>
    


?>
