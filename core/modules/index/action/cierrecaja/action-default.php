<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/
    

    $r = new CierreData();
   
  
    $r->user_id = $_SESSION["user_id"];
   
    $r->observaciones = $_POST["observaciones"];
   
   // print_r($r);

     $r->add();

     $ultimo = CierreData::ultimocierre();
     
   print_r($ultimo["0"]->ultimo);
   if($ultimo["0"]){
       $id_ultimo=$ultimo["0"]->ultimo;
       $ultimo = ReservationData::cierrecaja($id_ultimo);
         $ultimo2 =GastosData::cierrecaja($id_ultimo);
         
         
   }
      

Core::redir("./index.php?view=cierres");
?>