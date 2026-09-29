<?php

if(count($_POST)>0){
	
	$is_active=0;
	if(isset($_POST["is_active"])){$is_active=1;}
	$user = UserData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
        $user->modulo = $_POST["modulo"];
	$user->email = $_POST["email"];
	$user->is_admin=$_POST["is_admin"];
	$user->is_active=$is_active;
	$user->update();

	if($_POST["password"]!=""){
		$user->password = sha1(md5($_POST["password"]));
		$user->update_passwd();
print "<script>alert('Se ha actualizado el password');</script>";

	}

	$medicos = $_POST["medic_id"];

	$hh=UserMedicData::delByUserId($user->id);

	foreach($medicos as $medic)
    {
		$userMedic = new UserMedicData();
        $userMedic->idMedic=$medic;
		
		$userMedic->idUser=$user->id;
	     $userMedic->add();
		// print_r($userMedic);

	
    }


print "<script>window.location='index.php?view=users';</script>";


}


?>