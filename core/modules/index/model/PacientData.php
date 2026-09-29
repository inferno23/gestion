<?php
class PacientData {
	public static $tablename = "pacient";
	public function __construct(){
		$this->title = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->is_public = "0";
		$this->codigo_postal = "4500";
		$this->localidad = "SAN PEDRO DE JUJUY";
		$this->provincia = "JUJUY";
		$this->created_at = "NOW()";
	}

         public function getOsocial(){ return OsocialData::getById($this->osocial_id); }
        
        
	public function add(){
		$sql = "insert into ".self::$tablename." (name,lastname,no,numero_afiliado,numero_afiliado2,gender,osocial_id,osocial_id2,osocial_id3,day_of_birth,address,phone,email,sick,medicaments,alergy,codigo_postal,localidad,provincia,telefono_fijo,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->no\",\"$this->numero_afiliado\",\"$this->numero_afiliado2\",\"$this->gender\",null,null,null,\"$this->day_of_birth\",\"$this->address\",\"$this->phone\",\"$this->email\",\"$this->sick\",\"$this->medicaments\",\"$this->alergy\",\"$this->codigo_postal\",\"$this->localidad\",\"$this->provincia\",\"$this->telefono_fijo\",  $this->created_at)";
		
		//echo "<br> .".$sql;
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

// partiendo de que ya tenemos creado un objecto PacientData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}


	public function update(){
		
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",numero_afiliado2=\"$this->numero_afiliado2\",numero_afiliado=\"$this->numero_afiliado\",no=\"$this->no\",image=\"$this->image\",address=\"$this->address\",phone=\"$this->phone\",email=\"$this->email\",gender=\"$this->gender\",day_of_birth=\"$this->day_of_birth\",sick=\"$this->sick\",medicaments=\"$this->medicaments\",alergy=\"$this->alergy\",telefono_fijo=\"$this->telefono_fijo\",provincia=\"$this->provincia\",localidad=\"$this->localidad\",codigo_postal=\"$this->codigo_postal\" where id=$this->id";
	//	echo "<br> update<br> ".$sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PacientData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id Desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}

	public static function getAllActive(){
		$sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}

	public static function getAllUnActive(){
		$sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}


	//public function getUnreads(){ return MessageData::getUnreadsByClientId($this->id); }


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where lastname like '%$q%' or name like '%$q%'  or no like '%$q%' order by id Desc";
		//echo $sql;
                $query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}
        
        public static function getLike2($palabra1, $palabra2, $palabra3){
		$sql = "select * from ".self::$tablename." where (lastname like '%$palabra1%' or name like '%$palabra1%'  or no like '%$palabra1%') and (lastname like '%$palabra2%' or name like '%$palabra2%'  or no like '%$palabra2%')and (lastname like '%$palabra3%' or name like '%$palabra3%'  or no like '%$palabra3%')order by lastname,name";
		//echo $sql;
                $query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}
        
        
        
           public static function getAllByOsocialId($id){
		$sql = "select * from ".self::$tablename." where osocial_id=$id order by id Desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}
        
        public static function getBySQL($sql){
		$query = Executor::doit($sql);


		//echo "<br> getBySQL<br> ".$sql;
		return Model::many($query[0],new PacientData());
	}



	static function getLastInserted(){
        $sql = "SELECT MAX(id) FROM pacient";
        $last_id =Executor::doit($sql);
	//	print_r($last_id);
        return $last_id;
    }
       
}

?>