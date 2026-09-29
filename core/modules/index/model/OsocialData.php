<?php
class OsocialData {
	public static $tablename = "osocial";


	public function __construct(){
		$this->nombre = "";
		$this->cod = "";
		$this->telefono = "";
		$this->email = "";
		
	}

	public function add(){
		$sql = "insert into osocial (nombre) ";
		$sql .= "value (\"$this->nombre\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto EstudioData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OsocialData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OsocialData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OsocialData());
	}
         
	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new OsocialData());
	}



}

?>