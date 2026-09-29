<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
**/

//echo($_POST["date_at"]);
//echo($_POST["paciente"]);
//echo($_POST["medic_id"]);
//echo($_POST["time_at"]);
if(empty($_POST["medic_id"])) 
{Core::alert("Medico NO Selecionado . Por Favor seleccione uno por favor! ");
       
        print "<script> history.back();</script>";  //history.go(-1)
}


//elimino restriccion de quitar la restriccion de dni repetido
$rx=null;

//$rx = ReservationData::getRepeated($_POST["pacient_id"],$_POST["estudio_id"],$_POST["date_at"],$_POST["time_at"]);
if($rx==null){
     //echo($_POST["title"]);
     
    $rx = ReservationData::getMedicoOcupado($_POST["medic_id"],$_POST["date_at"],$_POST["time_at"]);
    if($rx==null){
    

    $r = new ReservationData();

    $paciente = PacientData::getById($_POST["pacient_id"]);

    $r->title =  $paciente->lastname." ".$paciente->name;
    
     //echo($_POST["title"]);
    $r->note =  $paciente->lastname." ".$paciente->name;
    $r->pacient_id = $_POST["pacient_id"];
     $r->tipo_pago = $_POST["tipo_pago"];
    $r->medic_id = $_POST["medic_id"];
    $r->estudio_id = $_POST["estudio_id"];
    $estudio = EstudioData::getById($_POST["estudio_id"]);

    $r->estudio2 = $_POST["estudio2"];
    $r->estudio3 = $_POST["estudio3"];
    $r->estudio4 = $_POST["estudio4"];
    $r->estudio5 = $_POST["estudio5"];

    $volver = $_POST["volver"];
    if(empty($volver) || $volver=="")
    $volver = "agenda";
    
    $r->category_id = $estudio->category_id;
    $r->osocial_id = $_POST["osocial_id"];
    if (!empty($_POST["medsoli"]))
    
    $r->medsoli = $_POST["medsoli"];
    
    else
        $r->medsoli = 0;
    
    $r->date_at = $_POST["date_at"];
    $r->time_at = $_POST["time_at"];
    $r->user_id = $_SESSION["user_id"];
    $r->tipo = $_POST["tipo"];
    $r->status_id = $_POST["status_id"];
    $r->payment_id = $_POST["payment_id"];
   // $r->price = $_POST["price"];
    $r->observacion_coseguro = $_POST["observacion_coseguro"];
    $precio =$precio2 =  $precio3 =  $precio4 = $precio5 = 0;
    
    
    if(empty($_POST["observacion_coseguro"]))
        $r->observacion_coseguro = 0;
    /// al usar obra partucular tomo valor del coseguro x q va pagar como si no tuvieran obrasu obra 0
    $valor=ValestData::getRepeated( $r->estudio_id,$r->osocial_id);
    if(empty($valor))
        $precio = 0;
    else
    $precio = $valor->coseguro;

     
    if (!empty($_POST["estudio2"])){
      $valor2=ValestData::getRepeated( $r->estudio2,$r->osocial_id);
      if(!empty($valor2)){
        $precio2 = $valor2->coseguro;
       }
      // print_r($valor2);

     }
     if (!empty($_POST["estudio3"])){
      $valor3=ValestData::getRepeated( $r->estudio3,$r->osocial_id);
      if(!empty($valor3)){
        $precio3 = $valor3->coseguro;
       }
      // print_r($valor3);
     }
     if (!empty($_POST["estudio4"])){
      $valor4=ValestData::getRepeated( $r->estudio4,$r->osocial_id);
      if(!empty($valor4)){
        $precio4 = $valor4->coseguro;
       }
     }
     if (!empty($_POST["estudio5"])){
      $valor5=ValestData::getRepeated( $r->estudio5,$r->osocial_id);
      if(!empty($valor5)){
        $precio5 = $valor5->coseguro;
       }
     }
    // echo("precio".$precio.$precio2."title3".$precio3.$precio4." title5".$precio5);

     $r->price = $precio +$precio2 +$precio3 +$precio4+$precio5  ;
     $r->precio_obra = 0 ; // todos particular 

    $r->sick = $_POST["sick"];
    $r->symtoms = $_POST["symtoms"];
    $r->medicaments = $_POST["medicaments"];
     $r->tecnico_id = $_POST["tecnico_id"];
      $r->caja = $estudio->caja;
    
    
   // print_r($r);

     $turno =$r->add();

    //Core::alert("Turno Agregado exitosamente!");
    }// if ocupadoelse{
    else{Core::alert("Medico Ocupado en ese hora . Por Favor seleccione otro otra hora o fecha! ");
    $id=$_POST['pacient_id'];
    Core::redir("index.php?view=turnopaciente&id=$id");
    print "<script> history.back();</script>";  //history.go(-1)
    }
}else{
Core::alert("Error al agregar, Turno Repetido al paciente! ");
$id=$_POST['pacient_id'];
Core::redir("index.php?view=turnopaciente&id=$id");
print "<script> history.back();</script>";
}

//print_r($turno);

//print_r($turno[1]);
$paciente=PacientData::getById($_POST['pacient_id']);
if (!empty($paciente->email)){
    $nombre= $paciente-> name." ".$paciente->lastname;
    $fecha =$_POST["date_at"];
   // echo '$fecha'.$fecha;
    $mensaje =$estudio->descripcion."- Hora:". $_POST["time_at"]."-".$estudio->preparativos;
  //  Core::redir("./?action=send_email&email=$paciente->email&mensaje=$mensaje&nombre=$nombre&fecha=$fecha&id=$turno[1]");
}
//http://localhost/sima/?action=send_email&email=marcko_23@hotmail.com&mensaje=%20ECOGRAFIA%20GINECOLOGICA-%20Hora:02:00-1-traer%20estudios%20previos.2-Ayuno%20de%208%20horas.%203-Tomar%20un%20litro%20y%20medio%20agua.%204-Traer%20Toalla%20de%20Mano.&nombre=mrkoantonio&fecha=2017-01-10
 
///sacar comentarios
 print "<script>window.open('./report/turno-pdf.php?id=$turno[1]', '_blank');</script>";
       
// Core::redir("./index.php?view=view_reservation&id=$turno[1]");

 //volver a la agenda en la fecha del registrado
 Core::redir("./index.php?view=$volver&category_id=&estudio_id=&medic_id&osocial_id=&date_at=".$_POST["date_at"]);

 

?>