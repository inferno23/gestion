<?php
class TecnicoData {
	public static $tablename = "tecnicos";
	public function __construct(){
		$this->title = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getCategory(){ return CategoryData::getById($this->category_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (category_id,name,lastname,address,phone,email,is_profesional,created_at) ";
		$sql .= "value ($this->category_id,\"$this->name\",\"$this->lastname\",\"$this->address\",\"$this->phone\",\"$this->email\",\"$this->is_profesional\",$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto MedicData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",address=\"$this->address\",phone=\"$this->phone\",email=\"$this->email\",is_active=\"$this->is_active\",is_profesional=\"$this->is_profesional\",category_id=$this->category_id where id=$this->id";
		//echo $sql;
                Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
              //  echo $sql;
		$query = Executor::doit($sql);
              //  print_r($query);
		return Model::one($query[0],new TecnicoData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where  lastname!='' order by lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TecnicoData());
	}

	public static function getAllActive(){
		$sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TecnicoData());
	}

	public static function getAllUnActive(){
		$sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TecnicoData());
	}


	//public function getUnreads(){ return MessageData::getUnreadsByClientId($this->id); }


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where lastname like '%$q%' or name like '%$q%' order by lastname asc";
		//echo $sql;
                $query = Executor::doit($sql);
		return Model::many($query[0],new TecnicoData());
	}

        
        public static function getProfesionales(){
		$sql = "select * from ".self::$tablename." where is_profesional=1 order by lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TecnicoData());
	}
        
        public static function getProfesionalesByArea($q){
		$sql = "select * from ".self::$tablename." where is_profesional=1  and category_id like '%$q%' order by lastname asc";
		$query = Executor::doit($sql);
                // echo($query);
		return Model::many($query[0],new TecnicoData());
	}
  
        
        //// los tecniocos eran los de categoria 20 
       
}

?>