<?php
class InformeData {
	public static $tablename = "informe";

	public function __construct(){
		
		$this->	codigo_estudio = "";
		
		$this->codigo_informe = "";
                $this->subcodigo = "";
                $this->descripcion = "";
               $this->	observacion = "";
		
	}
            
        public function getEstudio(){ return EstudioData::getById($this->codigo_estudio); }
 
	public function add(){
		$sql = "insert into informe (codigo_estudio,codigo_informe,subcodigo,descripcion,observacion) ";
		
                $sql .= "value (\"$this->codigo_estudio\",\"$this->codigo_informe\",\"$this->subcodigo\",\"$this->descripcion\",\"$this->observacion\")";
		
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
		$sql = "update ".self::$tablename." set codigo_estudio=\"$this->codigo_estudio\",codigo_informe=\"$this->codigo_informe\",subcodigo=\"$this->subcodigo\",descripcion=\"$this->descripcion\",observacion=\"$this->observacion\"  where id=$this->id";
		//echo $sql;
               
                Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InformeData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename  ." ORDER BY codigo_estudio ASC,codigo_informe ASC,subcodigo ASC ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InformeData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where descripcion like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InformeData());
	}
        
        public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new InformeData());
	}

        
        public static function getByEstudio($q){
		$sql = "select * from ".self::$tablename." where codigo_estudio = $q order by codigo_informe asc , subcodigo  ";
               // echo $sql;
		$query = Executor::doit($sql);
               // print_r($query);
		return Model::many($query[0],new InformeData());
	}
        

}

?>