<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	$user = new PacientData();
      //  print_r('xvvxcvcxz') ;
	
//primera letra en mayuscula y las demas en miniscula al guardarse los datos
       $user->name= ucwords(strtolower($_POST["name"])); // Hello World!
        $user->lastname= ucwords(strtolower($_POST["lastname"])); // Hello World!
	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	$user->no = $_POST["no"];
	$user->sick = $_POST["sick"];
	$user->medicaments = $_POST["medicaments"];
	$user->alergy = $_POST["alergy"];
       $dni =  $_POST["no"];
        $sql = " select * from pacient where no='$dni' order by id DESC ";
//SELECT REPLACE(no, '.', '') from pacient;
//echo '<BR><BR>';
		$users = PacientData::getBySQL($sql);
       if (count($users)>0){
           //echo '<BR><BR>'.$sql;
                    Core::alert("Error al ingresar DNI, Paciente Repetido -- Redirecionando turno  al paciente con el DNI ingresado! ");
                    $paciente=$users[0];
                   // print_r($user);
                    Core::redir("index.php?view=turnopaciente&id=$paciente->id");
        }  else {
            
       
	
        $user->osocial_id = $_POST["osocial_id"];
        $user->osocial_id2 = $_POST["osocial_id2"];
        $user->osocial_id3 = $_POST["osocial_id3"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
        $user->numero_afiliado2 = $_POST["numero_afiliado2"];
         $user->numero_afiliado = $_POST["numero_afiliado"];
        
	$user->add();
       // print_r($user);
$no=$_POST["no"];
$name=$_POST["name"];
$lastname=$_POST["lastname"];
        $sql = " select * from pacient where no='$no' and  name='$name' and lastname='$lastname' order by id DESC ";

//echo '<BR><BR>';
		$users = PacientData::getBySQL($sql);
        
        $fechaturno= $_POST["fechaturno"];
        $horaturno= $_POST["horaturno"];
        $categoria= $_POST["categoria"];
        $estudio_id= $_POST["estudio_id"];
         $paciente=$users[0];
         
       //  echo($fechaturno.$horaturno.$categoria.$estudio_id);
        //  print_r($paciente);
        // echo($paciente->id);
      //  http://localhost/sima/index.php?view=turnopaciente&id=41500
          print "<script>window.location='index.php?view=turnopaciente&id=$paciente->id&date_at=$fechaturno&horaturno=$horaturno&category_id=$categoria&estudio_id=';</script>";
     } 

 
        }
        


?>