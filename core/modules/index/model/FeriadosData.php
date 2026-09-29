<?php
class FeriadosData {
	public static $tablename = "feriados";

	public function __construct(){
		
		$this->des = "";
		
                $this->observaciones = "";
		$this->fecha = "NOW()";
		$this->created_at = "NOW()";
	}
 
 
 
	public function add(){
		$sql = "insert into feriados (fecha,des,user_id) ";
		
                $sql .= "value (\"$this->fecha\",\"$this->des\",\"$this->user_id\")";
		
               // echo $sql;
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
		$sql = "update ".self::$tablename." set des=\"$this->des\",fecha=\"$this->fecha\" where id=$this->id";
		echo "<br> get id ".$sql;
               
                Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		echo "<br> get id ".$sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new FeriadosData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id DESC";

		$query = Executor::doit($sql);
		return Model::many($query[0],new FeriadosData());

	}
	
        public static function getAllToday(){
		$sql = "select * from ".self::$tablename." where date(fecha)=date(NOW())  order by id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new FeriadosData());

	}
        
        
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where des like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new FeriadosData());
	}
        
        public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new FeriadosData());
	}

        
        
        
	

}

?>