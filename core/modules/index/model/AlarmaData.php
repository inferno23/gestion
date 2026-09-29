<?php
class AlarmaData {
	public static $tablename = "alarma";


	public function __construct(){
		$this->detalle = "";
		$this->activa = 1;
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into alarma (reservation_id,fecha, hora,detalle,titulo) ";
		$sql .= "value (\"$this->reservation_id\",\"$this->fecha\",\"$this->hora\",\"$this->detalle\",\"$this->titulo\")";

		//echo $sql;
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

	public function update(){
		$sql = "update ".self::$tablename." set detalle=\"$this->detalle\",  fecha=\"$this->fecha\" ,hora=\"$this->hora\",activa=\"$this->activa\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AlarmaData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where activa=1";
		echo '<br> '.$sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlarmaData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where detalle like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlarmaData());
	}
	     
	public static function getBySQL($sql){
            
		$query = Executor::doit($sql);
              // echo '<br> '.$sql;
			//	var_dump($query);
				return Model::many($query[0],new AlarmaData());
	}

        
  

}

?>