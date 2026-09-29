<?php
class DiasMedicData {
	public static $tablename = "diasmedic";

	public function __construct(){
		$this->idMedic = "";
		$this->dia = "";
		$this->matutinoIni = "";
		$this->matutinoFin = "";
		$this->vespertinoIni = "";
		$this->vespertinoFin = "";
		$this->atiende = "";
	}


// dias y horario que trabajo tanto a la tarde como a la mañana
public static function getMedicoTrabaja($idMedic,$date_at,$time_at){
      
  $dias = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");

  //echo date("l", strtotime( $date_at ));
  //echo "Buenos días, hoy es ".$dias[date("w",strtotime( $date_at ))];
		$dia_seleccionado=$dias[date("w",strtotime( $date_at ))];
		//if(strtotime("21:00") > strtotime("4:00"))
	 
 $sql = "select * from ".self::$tablename." where   idMedic=$idMedic and dia=\"$dia_seleccionado\" 
 AND ( (matutinoIni <=\"$time_at\"  AND   matutinoFin >=\"$time_at\") OR  (vespertinoIni <=\"$time_at\"  AND   vespertinoFin >=\"$time_at\") )    ";
 
 //echo 'sql - '.$sql;

 //select * from diasmedic where idMedic=3 and dia="lunes" AND ( (matutinoIni <="11:08" AND matutinoFin >="11:08") OR (vespertinoIni <="11:08" AND vespertinoFin >="11:08") )
		 $query = Executor::doit($sql);
        return Model::one($query[0],new ReservationData());
}




	public function add(){
		$sql = "insert into ".self::$tablename." (idMedic,dia,matutinoIni,matutinoFin,vespertinoIni,vespertinoFin,atiende) ";
		$sql .= "value ($this->idMedic,\"$this->dia\",\"$this->matutinoIni\",\"$this->matutinoFin\",\"$this->vespertinoIni\",\"$this->vespertinoFin\",\"$this->atiende\")";
		//echo $sql;
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


public static function getAllByMedicId($id){
		$sql = "select * from ".self::$tablename." where idMedic=$id order  by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new DiasMedicData());
	}


	public static function delMedicId($id){
		$sql = "delete from ".self::$tablename." where idMedic=$id";
		Executor::doit($sql);
	}
	
	


	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",address=\"$this->address\",phone=\"$this->phone\",email=\"$this->email\",is_active=\"$this->is_active\",is_profesional=\"$this->is_profesional\",category_id=$this->category_id where id=$this->id";
		//echo $sql;
                Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
              //  print_r($query);
		return Model::one($query[0],new DiasMedicData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where  lastname!='' order by lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new DiasMedicData());
	}

	


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where lastname like '%$q%' or name like '%$q%' order by lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}

    
        
     
	public static function getBySQL($sql){
            
		$query = Executor::doit($sql);
           //     echo '<br> '.$sql;
			//	var_dump($query);
				return Model::many($query[0],new MedicData());
	}

}

?>