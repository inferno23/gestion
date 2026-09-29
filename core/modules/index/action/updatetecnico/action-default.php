<?php

if(count($_POST)>0){
	$user = tecnicoData::getById($_POST["user_id"]);

	$category_id = "NULL";
	if($_POST["category_id"]!=""){ 
            $category_id = $_POST["category_id"];
            }
	$user->name = $_POST["name"];
	$user->category_id = $category_id;
	$user->lastname = $_POST["lastname"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
        $user->is_profesional = $_POST["is_profesional"];
	$user->is_active = $_POST["is_active"];
        
        
	$user->update();


Core::redir("./index.php?view=tecnicos");


}


?>