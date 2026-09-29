 <?php
 date_default_timezone_set('America/Argentina/Buenos_Aires');
$reservation = ReservationData::getById($_GET["id"]);

//echo $reservation->id;
                $medic = $reservation->getMedic();
            $pacient = $reservation->getPacient();
            $estudio = $reservation->getEstudio();
             $osocial = $reservation->getOsocial();
             $estudio = $reservation->getEstudio();
             $categoria = $reservation->getCategory();
                         
          //     $user_informe = $reservation->getUserInforme();

?>

<div class="row">
	<div class="col-md-10">
	 <img src="./image/logo.png" alt="Abogado" style="width:60px;height:58px;">
   
  <div class="btn-group pull-right">
                        <div class="btn-group pull-right">
                        <h1><span class="label label-warning">  <a href="index.php?view=pacienthistory&id=<?php echo $pacient->id; ?>" > Ver Historial del Caso</a>
                        </span></h1>
                        </div>

                </div>

   <h1>Atencion Caso Nro:<?php echo $reservation->id; ?> 


 <label ><i class="fa fa-calendar fa-1x"></i><?php echo 
     date("d/m/Y",strtotime($reservation->date_at.""));  ?></label>
         <label > <i class="fa fa-clock-o fa-1x"></i><?php echo $reservation->time_at; ?></label>

    
    </h1>
   <br>
  
    
    
  <div class="form-group ">
    
  
  
<h1><span class="label label-primary">Nuevo Caso  </i>
 <?php echo " - ".$pacient->name." ".$pacient->lastname; ?>
 <?php echo " CUIL - Dni:".$pacient->no." - ".$pacient->phone; ?>
 
 
</span>
 </h1>  
<h1><i class="" aria-hidden="true"></i><span class="label label-primary">  </i>
 
 <?php echo " Fijo:".$pacient->telefono_fijo." - ".$pacient->email; ?>
 
</span>
 </h1>

 <h1><i class="" aria-hidden="true"></i><span class="label label-primary">  </i>
 
 <?php echo " Cp: ".$pacient->codigo_postal." - ".$pacient->address; ?>
 <?php echo " - ".$pacient->localidad." - ".$pacient->provincia; ?>
</span>
 </h1>
  </div>
  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label"><h1><span class="label label-success">Contra parte </span></h1></label>
    
  
  <div class="col-md-10">
    <label for="inputEmail1" > <h1><span class="label label-success"><?php echo $osocial->id." - ".$osocial->nombre." "?></label>
        
        </span></h1>
      
      </div>

      <?php 
     if(!empty($reservation->tipo)){
     
      echo " <h2><span class='label label-warning'>  Demandado: ".$reservation->tipo." - "." </span></h2> ";
    }
  ?>
      
  </div>
  <div class="hidden">
  <label for="inputEmail1" class="col-lg-2 control-label"><h1><span class="label label-info">Profesional </span></h1></label>
    
  
  <div class="col-md-10">
    <label for="inputEmail1" > <h1><span class="label label-info"> <?php echo $medic->id." - ".$medic->name." ".$medic->lastname; ?></label>
        
        </span></h1>
      
      </div>
      
  </div>
    <br>
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"><h1><span class="label label-danger"><i class="fa fa-medkit fa-1x"></i>  Tramite</span></h1></label>
    <div class="col-md-10">
   <label for="inputEmail1" >
   <h1><span class="label label-danger"> 
    <?php
    echo $categoria->id." - ".$categoria->name." - ".$estudio->id." - ".$estudio->descripcion." "; 
    /** 
    if(!empty($reservation->estudio2)){
      $id2= $reservation->estudio2;
     $estudio2 =  EstudioData::getById($id2);;
 
    // print_r($estudio2);
     echo " - Atencion 2: ".$estudio2->id." - ".$estudio2->descripcion." ";
   }
   if(!empty($reservation->estudio3)){
     $estudio3 = $reservation->getEstudio3();
     echo " - Atencion 3: ".$estudio3->id." - ".$estudio3->descripcion." ";
   }
    
   if(!empty($reservation->estudio4)){
     $estudio4 = $reservation->getEstudio4();
     echo " - Atencion 4: ".$estudio4->id." - ".$estudio4->descripcion." ";
   }
   if(!empty($reservation->estudio5)){
     $estudio5 = $reservation->getEstudio5();
     echo " - Atencion 5: ".$estudio5->id." - ".$estudio5->descripcion." ";
   }
    
    */
    
    
    ?>
   
  </label></span></h1>
    </div>
  </div>
    <br>
  
    <?php 
     if(!empty($reservation->medsoli)){
      $solicitante = $reservation->getMedic2();
      //echo " <h2><span class='label label-warning'>  Abogado Agregado: ".$solicitante->id." - ".$solicitante->name." ".$solicitante->lastname." </span></h2> ";
    }
  ?>

    <?php 
     if(!empty($reservation->tecnico_id)){
      $secretaria= $reservation->getTecnico();
      // echo " <h2><span class='label label-success'>  Secretaria : ".$secretaria->id." - ".$secretaria->name." ".$secretaria->lastname." </span></h2> ";
    }
  ?>



   
    
   

      
      
    <?php  
echo " <h2><span class='text-light bg-dark'>  <i class='fa fa-archive fa-1x'></i> SINIESTRO ART: ".$reservation->hora_atencion." </span></h2> ";
   

     if(!empty($reservation->fecha_atencion)){
      
      echo " <h2><span class='label label-warning'>  <i class='fa fa-calendar fa-1x'></i> Fecha Acc_1ra_Manif_1: ".date("d/m/Y",strtotime($reservation->fecha_atencion.""))." </span></h2> ";
    }
  ?>
  
  <?php 

echo " <h2><span class='text-light bg-dark'>  <i class='fa fa-archive fa-1x'></i> Expediente : ".$reservation->informe." </span></h2> ";
 
     if(!empty($reservation->fecha_informe)){
    
    //  echo " <h2><span class='label label-warning'> <i class='fa fa-calendar fa-1x'></i> Fecha Acc_1ra_Manif_2: ".date("d/m/Y",strtotime($reservation->fecha_informe.""))." </span></h2> ";
    }
  ?>
     
    
    
     <br><br>
    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Detalle</label>
    <div class="col-md-7">
           
              <span><?php echo $reservation->detalle;?></span>

           
    </div>
  </div>
     
   
     
     
     
    <div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Coseguro</label>
    <div class="col-md-10">
        
          <span><i class="fa fa-usd"></i><?php echo $reservation->price;?></span>

        
    </div>
  </div>
      
<div class="hidden">
    <label for="inputEmail1" class="col-lg-2 control-label">Observacion Coseguro</label>

    <div class="col-md-10">
      <span><i class="fa fa-usd"><?php echo $reservation->observacion_coseguro;?></i></span>

    </div>
</div>
       
<br>  <br>
  
   
    <?php 
     $target_dir = "./image/".$reservation->id."/";
   
     showFiles( $target_dir);

     function showFiles($path){
      $dir = opendir($path);
      $files = array();
      while ($current = readdir($dir)){
          if( $current != "." && $current != "..") {
              if(is_dir($path.$current)) {
                  showFiles($path.$current.'/');
              }
              else {
                  $files[] = $current;
              }
          }
      }
     // echo '<h2>'.$path.'</h2>';
     echo " <br><br><h1><span class='text-warning'>  <i class='fa fa-file-word-o fa-1x text-info'></i><i class='fa fa-file-excel-o fa-1x text-success'></i><i class='fa fa-file-pdf-o fa-1x text-danger'></i> Archivos del caso:  </span></h1><br> ";
 
     //echo '<h2>Archivos del caso</h2>';
      echo '<ul>';
      for($i=0; $i<count( $files ); $i++){
          echo '<li>'.$files[$i];

          echo '  <a href="'.$path.$files[$i].'" download="'.$files[$i].'">
          Descargar Archivo </a> ';
          echo "</li>";

      }
      echo '</ul>';
  }








  ?>
  
  <?php  
echo " <br><br><h1><span class='text-info'>  <i class='fa fa-image fa-1x'></i> Imagenes:  </span></h1><br> ";
   

   
  ?>
    

<?php  if (!empty($reservation->imagen))  {  ?>
<div class="form-group ">
<label for="inputEmail1" class="col-lg-2 control-label">Imagen 1</label>
    
    <img class="img-responsive" src="<?php echo ($target_dir.$reservation->imagen); ?>" 
    alt="<?php  echo ($reservation->imagen); ?>" >

    <a href="<?php  echo ( $target_dir.$reservation->imagen); ?>" download="<?php echo ($reservation->imagen); ?>">
Descargar Imagen <?php echo ($reservation->imagen); ?>
</a>
<br><br>

<?php  } ?>  

<a class="btn-danger" href="index.php?view=cambiar_imagen&imagen=1&id=<?php echo ($reservation->id); ?>" ><i class="fa fa-image"></i> Click aqui para Cambiar Imagen 1 
</a>
<<br></br>


<?php  if (!empty($reservation->imagen2))  {  ?>
<label for="inputEmail1" class="col-lg-2 control-label">Imagen 2</label>
<img class="img-responsive" src="<?php echo ($target_dir.$reservation->imagen2); ?>" 
    alt="<?php  echo ($reservation->imagen2); ?>">
      
<a href="<?php  echo ( $target_dir.$reservation->imagen2); ?>" download="<?php echo ($reservation->imagen2); ?>">
Descargar Imagen 2<?php echo ($reservation->imagen2); ?>
</a>
<br>
<br>
<?php  } ?> 
<a class="btn-danger" href="index.php?view=cambiar_imagen&imagen=2&id=<?php echo ($reservation->id); ?>" ><i class="fa fa-image"></i> Click aqui para Cambiar Imagen  2
</a>

<br></br>

<?php  if (!empty($reservation->imagen3))  {  ?>
<label for="inputEmail1" class="col-lg-2 control-label">Imagen 3</label>
<img class="img-responsive" src="<?php echo ($target_dir.$reservation->imagen3); ?>" 
    alt="<?php  echo ($reservation->imagen3); ?>">
      
<a href="<?php  echo ( $target_dir.$reservation->imagen3); ?>" download="<?php echo ($reservation->imagen3); ?>">
Descargar Imagen 3<?php echo ($reservation->imagen3); ?>
</a>
<br>
<br>
<?php  } ?> 
<a class="btn-danger" href="index.php?view=cambiar_imagen&imagen=3&id=<?php echo ($reservation->id); ?>" ><i class="fa fa-image"></i> Click aqui para Cambiar Imagen  3
</a>

<br></br>


<?php  if (!empty($reservation->imagen4))  {  ?>
<label for="inputEmail1" class="col-lg-2 control-label">Imagen 4</label>
<img class="img-responsive" src="<?php echo ($target_dir.$reservation->imagen4); ?>" 
    alt="<?php  echo ($reservation->imagen4); ?>">
      
<a href="<?php  echo ( $target_dir.$reservation->imagen4); ?>" download="<?php echo ($reservation->imagen4); ?>">
Descargar Imagen 4<?php echo ($reservation->imagen4); ?>
</a>
<br>
<br>
<?php  } ?> 
<a class="btn-danger" href="index.php?view=cambiar_imagen&imagen=4&id=<?php echo ($reservation->id); ?>" ><i class="fa fa-image"></i> Click aqui para Cambiar Imagen  4
</a>

<br></br>


<?php  if (!empty($reservation->imagen5))  {  ?>
<label for="inputEmail1" class="col-lg-2 control-label">Imagen 5</label>
<img class="img-responsive" src="<?php echo ($target_dir.$reservation->imagen5); ?>" 
    alt="<?php  echo ($reservation->imagen5); ?>">
      
<a href="<?php  echo ( $target_dir.$reservation->imagen5); ?>" download="<?php echo ($reservation->imagen5); ?>">
Descargar Imagen 5 <?php echo ($reservation->imagen5); ?>
</a>
<br>
<br>
<?php  } ?> 
<a class="btn-danger" href="index.php?view=cambiar_imagen&imagen=5&id=<?php echo ($reservation->id); ?>" ><i class="fa fa-image"></i> Click aqui para Cambiar Imagen  5
</a>



<br>
     
       
      <br><br>

       
       
      
   
  <div class="col-md-8"> 
      <!-- a href="./report/turno.php?id=<?php echo $reservation->id;?>" class="btn btn-info btn-block"><i class="glyphicon glyphicon-print fa-2x">- Imprimir</i></a -->
			
      <!--  a target="_blank"  href="./report/turno.php?id=<?php echo $reservation->id;?>" class="btn-group"><i class="fa fa-print fa-3x"><h3>Imprimir Turno</h3></i></a  -->
      	
      
       <!--a href="index.php?view=turnopaciente2&id=<?php echo $reservation->id;?>" class="btn btn-danger btn-xs"><i class="fa fa-medkit fa-3x">- Desea Agregar Turno para otro Atencion</i></a  -->

         
  </div>			
	</div>
</div>