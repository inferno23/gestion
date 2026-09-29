<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	
    $osocial_id = $_POST["osocial_id"];
    
     
      $estudios = ValestData::getAllByOsocialId($osocial_id);
   $obras = $_POST["team"];
    //print_r($estudios);
   foreach($obras as $obra_id)
    {
        foreach($estudios as $value)
        {
             ValestData::aumentar_obra($obra_id,$value->codest, $value->coseguro, $value->osocial);
           // print_r($value->codest); //Do your code Here
        }
    }
    
    
  
  
//Core::alert("Actualizado exitosamente!");

Core::redir("./index.php?view=valests&osocial_id=$obra_id&estudio_id=");

}


?>