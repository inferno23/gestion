<?php
class UserMedicData {
	public static $tablename = "userMedic";
        
        
	public function __construct(){
		$this->idUser = "";
		$this->idMedic = "";
		
		
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (idUser,idMedic) ";
		$sql .= "value (\"$this->idUser\",\"$this->idMedic\");";
		//echo ''.$sql;
                Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}


	public static function delByUserId($id){
		$sql = "delete from ".self::$tablename." where idUser=$id";
		Executor::doit($sql);
	}



	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set idUser=\"$this->idUser\",idMedic=\"$this->idMedic\"";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserMedicData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserMedicData());
	}

	public static function getAllByMedicId($id){
		$sql = "select * from ".self::$tablename." where idMedic=$id order  by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserMedicData());
	}

	public static function getAllByUser($id){
		$sql = "select * from ".self::$tablename." where idUser=$id order  by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserMedicData());
	}

}

?>