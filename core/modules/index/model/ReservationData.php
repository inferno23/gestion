<?php
class ReservationData {
	public static $tablename = "reservation";


        
        
	public function __construct(){
		$this->title = "";
		$this->tipo = "";
		$this->note = "";
		$this->informe = "";
		$this->fecha_informe = "NOW()";//"NULL";
                $this->tipo_pago = "EFECTIVO"; 
                $this->caja = "Imagenes";
		$this->created_at = "NOW()";
	}

	public function getPacient(){ return PacientData::getById($this->pacient_id); }
	
        public function getMedic(){   return MedicData::getById($this->medic_id); }
        
	public function getStatus(){ return StatusData::getById($this->status_id); }
	public function getPayment(){ return PaymentData::getById($this->payment_id); }
        public function getEstudio(){ return EstudioData::getById($this->estudio_id); }
         public function getOsocial(){ return OsocialData::getById($this->osocial_id); }
          public function getMedic2(){ return MedicData::getById($this->medsoli); }
          
          
           public function getTecnico(){ 
                //cambio medic categoria 20 por la tabla tecnos 07/07;
               return TecnicoData::getById($this->tecnico_id);
               
               
           }
          
    public function getCategory(){ return CategoryData::getById($this->category_id); }
public function getUserInforme(){ return UserData::getById($this->user_informe); }
    

public function getEstudio2(){ return EstudioData::getById($this->estudio2); }
    
public function getEstudio3(){ return EstudioData::getById($this->estudio3); }
      

public function getEstudio4(){ return EstudioData::getById($this->estudio4); }
    

public function getEstudio5(){ return EstudioData::getById($this->estudio5); }
    


	public function add(){
		$sql = "insert into reservation (title,detalle, hora_fin,precio_obra,estudio2,estudio3,estudio4,estudio5,note,caja,tipo,tecnico_id,medic_id,medsoli,date_at,time_at,category_id,estudio_id,osocial_id,pacient_id,user_id,observacion_coseguro,price,status_id,payment_id,sick,symtoms,tipo_pago,medicaments, fecha_atencion,hora_atencion,fecha_informe,informe,   created_at) ";
		$sql .= "value (\"$this->title\",\"$this->detalle\",\"$this->hora_fin\",\"$this->precio_obra\",\"$this->estudio2\",\"$this->estudio3\",\"$this->estudio4\",\"$this->estudio5\",\"$this->note\",\"$this->caja\",\"$this->tipo\",\"$this->tecnico_id\",\"$this->medic_id\",$this->medsoli,\"$this->date_at\",\"$this->time_at\",$this->category_id,$this->estudio_id,
		$this->osocial_id,$this->pacient_id,$this->user_id,\"$this->observacion_coseguro\",\"$this->price\",$this->status_id,$this->payment_id,\"$this->sick\",\"$this->symtoms\",\"$this->tipo_pago\",\"$this->medicaments\",\"$this->fecha_atencion\", \"$this->hora_atencion\", $this->fecha_informe, \"$this->informe\",$this->created_at)";
	 // echo '<br><br>sql  '.$sql;
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

// 
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",hora_fin=\"$this->hora_fin\",estudio2=\"$this->estudio2\",estudio3=\"$this->estudio3\",category_id=\"$this->category_id\",osocial_id=\"$this->osocial_id\",imagen=\"$this->imagen\",imagen2=\"$this->imagen2\",imagen3=\"$this->imagen3\",imagen4=\"$this->imagen4\",imagen5=\"$this->imagen5\",note=\"$this->note\",tipo_pago=\"$this->tipo_pago\",precio_obra=\"$this->precio_obra\",estudio_id=\"$this->estudio_id\",tecnico_id=\"$this->tecnico_id\",user_informe=\"$this->user_informe\",informe='$this->informe',fecha_atencion=\"$this->fecha_atencion\",detalle='$this->detalle',caja=\"$this->caja\",tipo=\"$this->tipo\",pacient_id=\"$this->pacient_id\",medic_id=\"$this->medic_id\",medsoli=\"$this->medsoli\",date_at=\"$this->date_at\",time_at=\"$this->time_at\",note=\"$this->note\",sick=\"$this->sick\",symtoms=\"$this->symtoms\",medicaments=\"$this->medicaments\",status_id=\"$this->status_id\",payment_id=\"$this->payment_id\",price=\"$this->price\",observacion_coseguro=\"$this->observacion_coseguro\" where id=$this->id";
		// echo ' sql update  '.$sql;
                Executor::doit($sql);
	}

	public function cambiarImagen($sql){
		
                Executor::doit($sql);
	}
        

	
        
        ///4 anular  y 3 en paymen es anulado
        public function anular($id){
		$sql = "update ".self::$tablename." set sick=\"ANULADO\", status_id=\"4\",payment_id=\"3\" where id=$id";
		//echo 'sql'.$sql;
                Executor::doit($sql);
	}
        
          ///4 anular  y 3 en paymen es anulado
        public function devolver($id){
		$sql = "update ".self::$tablename." set sick=\"DEVOLVER\"   , status_id=\"4\",payment_id=\"3\" where id=$id";
		//echo 'sql'.$sql;
                Executor::doit($sql);
	}
        
        
	public static function getById($id){
		$sql ='SELECT * FROM '.self::$tablename.' WHERE id='.$id;
              //  echo 'sql - '.$sql;
		$query = Executor::doit($sql);
               // $res = $mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
              //  print_r( $query) ;
		return Model::one($query[0],new ReservationData());
	}

	public static function getRepeated($pacient_id,$estudio_id,$date_at,$time_at){
		$sql = "select * from ".self::$tablename." where payment_id !=3 and pacient_id=$pacient_id and estudio_id=$estudio_id and date_at=\"$date_at\" and time_at=\"$time_at\" ";
		// echo 'sql - '.$sql;
                $query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

        public static function getMedicoOcupado($medic_id,$date_at,$time_at){
            
           //$desde= date("H:i",strtotime($time_at." -1 minute"));/// un mes
                   //echo 'desde'.$desde;
                  //  $hasta= date("H:i",strtotime($time_at." +1 minute"));/// un mes
            // echo 'hasta'.$hasta;
            
		$sql = "select * from ".self::$tablename." where  payment_id !=3  and medic_id=$medic_id and date_at=\"$date_at\" and  time_at=\"$time_at\"       ";
		// echo 'sql - '.$sql;
                $query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getByMail($mail){
		$sql = "select * from ".self::$tablename." where mail=\"$mail\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getEvery(){
		$sql = "select * from ".self::$tablename." where status_id !=4  AND date(date_at)>=date(NOW() - INTERVAL 5 DAY)  order by date_at,STR_TO_DATE(time_at,'%H:%i')";
		//cambiarrr
               // $sql = "select * from ".self::$tablename." where id=4419   order by date_at";
		//echo "sgetEvery".$sql;
                $query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


	public static function getAll(){
           // $sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) order by date_at";
		
		$sql = "select * from ".self::$tablename." where  status_id !=4  order by id desc";
		//echo 'sql  -- '.$sql;
                $query = Executor::doit($sql);
		
                return Model::many($query[0],new ReservationData());
	}

	public static function getAllPendings(){
		$sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


	public static function getAllByPacientId($id){
		$sql = "select * from ".self::$tablename." where pacient_id=$id order by date_at , STR_TO_DATE(time_at,'%H:%i') ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getAllByMedicId($id){
		$sql = "select * from ".self::$tablename." where medic_id=$id order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        public static function getAllByTecnicoId($id){
		$sql = "select * from ".self::$tablename." where tecnico_id=$id order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        
        
        
            public static function getAllByMedic2Id($id){
		$sql = "select * from ".self::$tablename." where medsoli=$id order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        public static function getAllByEstudioId($id){
		$sql = "select * from ".self::$tablename." where estudio_id=$id order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        
        public static function getAllByOsocialId($id){
		$sql = "select * from ".self::$tablename." where osocial_id=$id order by date_at , STR_TO_DATE(time_at,'%H:%i') ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        
	public static function getBySQL($sql){
            
		$query = Executor::doit($sql);
           //     echo '<br> '.$sql;
			//	var_dump($query);
				return Model::many($query[0],new ReservationData());
	}

        
        public static function getAllToday(){
		$sql = "select * from ".self::$tablename." where status_id !=4 AND date(date_at)=date(NOW()) order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


        
        
	public static function getOld(){
		$sql = "select * from ".self::$tablename." where date(date_at)<date(NOW()) order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%'  order by date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

        
        
        
	public static  function cierrecaja($cierre){
		$sql = "update ".self::$tablename." set cierre=\"$cierre\" where cierre is null AND payment_id=2";
		// echo 'sql'.$sql;
                Executor::doit($sql);
	}
        
        
       
         public static function getAllByCierreId($id){ 
		$sql = "select * from ".self::$tablename." where  cierre=$id  order by category_id,date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

        
         public static function getAllImagenByCierreId($id){
		$sql = "select * from ".self::$tablename." where caja ='IMAGENES' and cierre=$id order by category_id,date_at , STR_TO_DATE(time_at,'%H:%i')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        
        
       
        
         public static function anularCierreId($id){
		$sql = "update ".self::$tablename." set cierre='eeee' where id=$id  order by date_at";
		//echo 'sql'.$sql;
     // UPDATE `reservation` SET `cierre` = '1' WHERE `reservation`.`id` = 35;
      //UPDATE `reservation` SET `cierre` = NULL WHERE `reservation`.`id` = 35;
      
		$query = Executor::doit($sql);
		
	}
        
        public static function getByStatusId($id){
		$sql = "select * from ".self::$tablename." where status_id=$id order by date_at , STR_TO_DATE(time_at,'%H:%i')";
               // echo 'sql'.$sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

       public static function getAllByCierreCaja($id ,$caja){
		$sql = "select * from ".self::$tablename." where cierre=$id and caja ='$caja' order by category_id,date_at , STR_TO_DATE(time_at,'%H:%i')";
		// echo 'sql'.$sql;
                $query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
        
        
         public static function getAllsinCierre(){ // modif 15/06/19 AND payment_id =2
		$sql = "select * from ".self::$tablename." where  caja ='IMAGENES' AND payment_id =2  and cierre IS NULL order by category_id,date_at , STR_TO_DATE(time_at,'%H:%i')";
	       //$sql = "select * from ".self::$tablename." where  caja ='IMAGENES'   and cierre IS NULL  and  STR_TO_DATE(`created_at`,'%Y-%m-%d') =CURDATE()  order by category_id,date_at , STR_TO_DATE(time_at,'%H:%i')";
	 
              //  echo 'sql:-- '.$sql;

                $query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

}

?>