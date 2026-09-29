<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	
	$user = new UserData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
	$user->email = $_POST["email"];
        $user->modulo = $_POST["modulo"];
        $user->is_active=1;
	$user->is_admin=$_POST["is_admin"];
	$user->password = sha1(md5($_POST["password"]));
	$medicos = $_POST["medic_id"];
	$user->add();
//print_r($user);
$ultimo =UserData::getByUsernameEmail($_POST["username"],$_POST["email"]);
//print_r($ultimo);
//$userMedic = new UserMedicData();
//$userMedic->idUser=$ultimo->id;
	foreach($medicos as $medic)
    {
		$userMedic = new UserMedicData();
        $userMedic->idMedic=$medic;
		
		$userMedic->idUser=$ultimo->id;
	     $userMedic->add();
		// print_r($userMedic);

	
    }
	

print "<script>window.location='index.php?view=users';</script>";


}


?>