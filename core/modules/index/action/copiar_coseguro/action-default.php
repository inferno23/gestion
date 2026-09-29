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

        ValestData::borrar_x_obra($obra_id);
    

        foreach($estudios as $value)
        {
            
            $user = new ValestData();
            $codest=$user->codest = $value->codest;
            $codob_id=$user->codob = $obra_id;
            $user->coseguro = $value->coseguro;
            $user->osocial = $value->osocial;
        
          if (!empty($codest) &&  $codest >0  &&!empty($obra_id) &&  $obra_id >0 ){
         
            $user->add();
           }
        
    
        }
    
      }
  
//Core::alert("Actualizado exitosamente!");

Core::redir("./index.php?view=valests&osocial_id=$obra_id&estudio_id=");

}


?>