<?php
class ValestData {
	public static $tablename = "valest";
        /// valor del estudio 

//ALTER TABLE `valest` ADD `codigo` VARCHAR(20) NULL AFTER `osocial`;
	public function __construct(){
		$this->codest = "";
		$this->codob = "";
		$this->coseguro = "";
		$this->osocial = "";
                $this->codigo = "";
		
	}

	
        public function getEstudio(){ return EstudioData::getById($this->codest); }
         public function getOsocial(){ return OsocialData::getById($this->codob); }
        


	public function add(){
            
            
            
            
		$sql = "insert into ".self::$tablename." (codest,codob,coseguro,osocial,codigo) ";
		$sql .= "value (\"$this->codest\",\"$this->codob\",\"$this->coseguro\",$this->osocial,\"$this->codigo\")";
              //  echo $sql;
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where row_idid=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where row_idid=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ValestData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set codest=\"$this->codest\",codob=\"$this->codob\",coseguro=\"$this->coseguro\",osocial=\"$this->osocial\" ,codigo=\"$this->codigo\" where row_id=$this->row_id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where row_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ValestData());
	}

	public static function getRepeated($codest,$codob_id){
		$sql = "select * from ".self::$tablename." where codest=$codest  and codob=$codob_id   ";
                //echo $sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new ValestData());
	}



	public static function getByEstudio($codest){
		$sql = "select * from ".self::$tablename." where codest=\"$codest\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ValestData());
	}

	public static function getEvery(){
		$sql = "select * from ".self::$tablename." where codest>0 order by row_id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ValestData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where codest>0  and  codob>0 order by row_id DESC ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ValestData());
	}

	
        
        public static function getAllByOsocialId($id){
		$sql = "select * from ".self::$tablename." where codob=$id order by codob";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ValestData());
	}
        
        
	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ValestData());
	}

        
        public static function aumentarcoseguro($osocial, $porcentaje){
            //UPDATE productos SET precio = precio +(precio*2/100) WHERE id_producto =1
		$sql = "update ".self::$tablename." set coseguro=coseguro+(coseguro*$porcentaje/100)  where codob=$osocial";
		//echo $sql;
                
                Executor::doit($sql);
	}
        
        public static function aumentar_obra($obra_id,$estudio, $valor , $osocial){
            //UPDATE productos SET precio = precio +(precio*2/100) WHERE id_producto =1
		$sql = "update ".self::$tablename." set coseguro=$valor, osocial =$osocial  where codob=$obra_id and codest= $estudio ";
		//echo "<br> ".$sql;
                
                Executor::doit($sql);
	}
	

	public static function borrar_x_obra($obra_id){
		$sql = " DELETE FROM valest where codob = ".$obra_id.";";
	//echo "<br> ".$sql;
			
			Executor::doit($sql);
     }



}

?>