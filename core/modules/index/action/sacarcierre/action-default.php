<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

//echo($_POST["date_at"]);
//echo($_POST["paciente"]);
//echo($_POST["medic_id"]);
//echo($_POST["time_at"]);

     $id=$_GET["id"];
     
   $turno= ReservationData::getById($id);
  // print_r($turno->cierre);

$cierre = $turno->cierre;
      ReservationData::anularCierreId($id);
   
Core::redir("./index.php?view=turnos_cierre&estudio_id=&medic_id=&osocial_id=&cierre=$cierre");
//Core::redir("./index.php?view=cierres");
//print "<script>window.location='index.php?view=turnos_cierre&cierre=$cierre';</script>";
?>