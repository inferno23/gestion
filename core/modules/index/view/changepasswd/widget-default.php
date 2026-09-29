<?php
/**
* Turno Medico
* @author Marco Farfan 3888-15568587
* @url https://www.linkedin.com/in/marcofarfan
**/

if(count($_POST)>0){
	
	if(Session::getUID()!=""){
              $user = UserData::getById(Session::getUID());
		if($_POST["newpassword"]!=""){
		$user->password = sha1(md5($_POST["newpassword"]));
		$user->update();
                print "<script>alert('Se ha actualizado el password');</script>";
                print "<script>window.location='index.php?view=login';</script>";
             }
        }


}
  print "<script>window.location='http://localhost/sima/index.php';</script>";

?>