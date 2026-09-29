<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if(Session::getUID()=="") {
$user = $_POST['mail'];
$pass = sha1(md5($_POST['password']));

$base = new Database();
$con = $base->connect();
 $sql = "select * from user where (email= \"".$user."\" or username= \"".$user."\") and password= \"".$pass."\" and is_active=1";
//print $sql;
$query = $con->query($sql)or die("Last error: {$con->error}\n");
//$run = $con->query($query) or die("Last error: {$con->error}\n");
$found = false;
$userid = null;
 $dia=date("Y-m-d");

 //print_r($query) ;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
}

if($found==true) {
	if(!isset($_SESSION)) 
            { 
                            //seteo la vida de la session en 7200 segundos    
                ini_set("session.cookie_lifetime","17200");
                //seteo el maximo tiempo de vida de la seession
                ini_set("session.gc_maxlifetime","17200");
                session_start(); 
            } 
	print $userid;
	$_SESSION['user_id']=$userid ;
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user... Espere un momento por Favor";
        
         Core::redir("./index.php?view=reservations&estudio_id=&category_id=&medic_id=&osocial_id=&date_at=$dia");
    
        
	//print "<script>window.location='index.php?view=reservations&estudio_id=&category_id&medic_id&osocial_id=&date_at=';</script>";
}else {
	print "<script>window.location='index.php?view=login';</script>";
}

}else{
      Core::redir("./index.php?view=reservations&estudio_id=&category_id=&medic_id=&osocial_id=&date_at=$dia");
    
	
	
}
?>