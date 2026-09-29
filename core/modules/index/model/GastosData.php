<?php
class GastosData {
	public static $tablename = "gastos";

//ALTER TABLE `estudio` ADD `preparativos` VARCHAR(250) NULL AFTER `etiqueta`;
	public function __construct(){
		
		$this->des = "";
		$this->monto = 0;
		$this->cierre = "";
                $this->observaciones = "";
		$this->fecha = "NOW()";
	}
 
 
 
	public function add(){
		$sql = "insert into gastos (fecha,des,monto,observaciones,user_id, cierre) ";
		
                $sql .= "value (\"$this->fecha\",\"$this->des\",\"$this->monto\",\"$this->observaciones\",\"$this->user_id\",\"$this->cierre\")";
		
                //echo $sql;
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where row_id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where row_id=$this->row_id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto EstudioData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set des=\"$this->des\",fecha=\"$this->fecha\",observaciones=\"$this->observaciones\",cierre=\"$this->cierre\",monto=\"$this->monto\" where row_id=$this->row_id";
		//  echo $sql;
               
                Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where row_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new GastosData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by row_id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new GastosData());

	}
	
        public static function getAllToday(){
		$sql = "select * from ".self::$tablename." where date(fecha)=date(NOW())  order by row_id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new GastosData());

	}
        
        
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where des like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new GastosData());
	}
        
        public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new GastosData());
	}

        
        
        
	public static  function cierrecaja($cierre){
		$sql = "update ".self::$tablename." set cierre=\"$cierre\" where cierre is null or cierre < 1 ";
              
               
                Executor::doit($sql);
	}
        
        
        public static function getByCierre($q){
		$sql = "select * from ".self::$tablename." where cierre =$q";
		$query = Executor::doit($sql);
		return Model::many($query[0],new GastosData());
	}
        
         public static function getAllsinCierre(){
		$sql = "select * from ".self::$tablename." where cierre IS NULL OR cierre =0  order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
            

}

?>