<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	$user = new ValestData();
	$codest=$user->codest = $_POST["codest"];
	$codob_id=$user->codob = $_POST["codob"];

	$user->coseguro = $_POST["coseguro"];
	$user->osocial = $_POST["osocial"];
	$user->codigo = $_POST["codigo"];
	
	$hay =$user->getRepeated($codest, $codob_id);
        if (count($hay)>0){
            Core::alert("Ya existe un coseguro con obra social  $codob_id y  estudio $codest !");
          //  print_r($hay);
            $id=$hay->row_id;
          
            print "<script>window.location='index.php?view=editvalest&id=$id';</script>";
            
        }
            
         else {
            $user->add();///  $user->update();
            print "<script>window.location='index.php?view=valests';</script>";
         }
             
         
        //print_r($hay);

//print "<script>window.location='index.php?view=valests';</script>";


}


?>