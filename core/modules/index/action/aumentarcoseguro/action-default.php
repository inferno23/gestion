<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	
    $osocial_id = $_POST["osocial_id"];
    
   
    
    $porcentaje = $_POST["porcentaje"];
    
    ValestData::aumentarcoseguro($osocial_id, $porcentaje);
        
        
	

//update cliente 

//print "<script>window.location='index.php?view=reservations';</script>";
Core::redir("./index.php?view=valests&osocial_id=$osocial_id&estudio_id=");

}


?>