<?php
class EstudioData {
	public static $tablename = "estudio";
//ALTER TABLE `estudio` ADD `caja` VARCHAR(20) NULL AFTER `category_id`;
//UPDATE `estudio` SET `caja` = 'Imagenes';
//ALTER TABLE `estudio` ADD `preparativos` VARCHAR(250) NULL AFTER `etiqueta`;
        
        //ALTER TABLE `estudio` ADD `informe` TEXT NULL AFTER `preparativos`;
	public function __construct(){
		$this->descripcion = "";
		$this->etiqueta = "";
		$this->standar = "";
		$this->category_id = "";
                $this->preparativos = "";
                $this->espera = "";
                $this->lugar = "";
                $this->caja = "Imagenes";
		
	}
 public function getCategory(){ return CategoryData::getById($this->category_id); }
 
 
	public function add(){
		$sql = "insert into estudio (descripcion,category_id,preparativos,informe,caja, lugar,espera) ";
		
                $sql .= "value (\"$this->descripcion\",\"$this->category_id\",\"$this->preparativos\",\"$this->informe\",\"$this->caja\",\"$this->lugar\",\"$this->espera\")";
		 
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

// partiendo de que ya tenemos creado un objecto EstudioData previamente utilizamos el contexto
	public function update(){
                
		$sql = "update ".self::$tablename." set descripcion=upper(\"$this->descripcion\"),category_id=\"$this->category_id\",preparativos=\"$this->preparativos\",informe=\"$this->informe\",caja=\"$this->caja\" ,lugar=\"$this->lugar\",espera=\"$this->espera\" where id=$this->id";
               // $sql = "update ".self::$tablename." set descripcion= upper(descripcion)  where id=$this->id";
		//echo $sql;
               
                Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstudioData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstudioData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where descripcion like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstudioData());
	}
        
        public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstudioData());
	}

        
        public static function getByCategory($q){
		$sql = "select * from ".self::$tablename." where category_id = $q";
               // echo $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstudioData());
	}
	public static function getAllOrder(){
		
		$sql = "select ".self::$tablename .".* from ".self::$tablename ." left join category on category.id = ".self::$tablename .".category_id order by category.name, ".self::$tablename .".descripcion";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstudioData());

	}
        

}

?>