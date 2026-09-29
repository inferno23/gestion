<?php
class UserData {
	public static $tablename = "user";
        
///ALTER TABLE `user` CHANGE `is_admin` `is_admin` INT(1) NOT NULL DEFAULT '0';
        
	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->password = "";
		$this->is_active = "0";
                $this->modulo = 1;
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,lastname,username,password,email,is_active,is_admin,created_at,modulo) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->username\",\"$this->password\",\"$this->email\",$this->is_active,$this->is_admin,$this->created_at,$this->modulo)";
		//echo ''.$sql;
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

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",username=\"$this->username\",password=\"$this->password\",email=\"$this->email\",is_active=$this->is_active,is_admin=$this->is_admin,modulo=$this->modulo where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getByUsernameEmail($id, $email){
		$sql = "select * from ".self::$tablename." where username='$id' and email='$email'";
		//	echo ''.$sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


	static function getLastInserted(){
        $sql = "SELECT MAX(id) FROM user";
        $last_id =Executor::doit($sql);
		print_r($last_id);
        return $last_id;
    }
        
        public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getSecretarias(){
		$sql = "select * from ".self::$tablename." where is_admin=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}
	
	public static function getProfesionales(){
		$sql = "select * from ".self::$tablename." where is_admin=5 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}

	public static function getAdmins(){
		$sql = "select * from ".self::$tablename." where is_admin=10 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}

}

?>