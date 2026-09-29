<?php
class CierreData {
	public static $tablename = "cierre";


	public function __construct(){
		
		$this->observaciones = "";
		$this->user_id = "";
		
		$this->created_at = "NOW()";
	}

        public function getUser(){
            return UserData::getById($this->user_id); 
            
        }
        
	public function add(){
		$sql = "insert into ".self::$tablename." (observaciones,user_id,created_at) ";
		$sql .= "value (\"$this->observaciones\",$this->user_id,$this->created_at)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// 

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CierreData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc limit 50";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CierreData());
	}


	

        public static function ultimocierre(){
		$sql = "select MAX(id) as ultimo from ".self::$tablename." ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CierreData());
	}

        
        
        public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new CierreData());
	}
}

?>