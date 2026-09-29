



<div class="row">
	<div class="col-md-12">

		
                
                 <h1><span class="fa fa-money"></span>Informe de  Cierre de Cajas x fecha</h1>
<br>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="informe_cierres">
        <?php

///$cierres = CierreData::getAll();



 //echo "date_at".$_GET["date_at"];
        ?>

  <div class="form-group">
    
 <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_at" id="date_at" value="<?php 
                  if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){
                      echo $_GET["date_at"]; 
                      
                  }else
                      echo date("Y-m-d");
                      
                  
                //  echo date("Y-m-d",strtotime(" - 3 day"));
                      ?>" class="form-control" placeholder="Palabra clave"    >
		</div>
     </div>
       <div class="col-lg-2">
     <div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_fin" id="date_at" value="<?php 
                  if(isset($_GET["date_fin"]) && $_GET["date_fin"]!=""){
                      echo $_GET["date_fin"]; 
                      
                  }else
                      echo date("Y-m-d");
                      
                  
                //  echo date("Y-m-d",strtotime(" - 3 day"));
                      ?>" class="form-control" placeholder="Palabra clave"    >
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<?php
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if( (isset($_GET["date_at"]) && ( $_GET["date_at"]!=""  )) && (isset($_GET["date_fin"]) && ( $_GET["date_fin"]!=""  ))    ) {
    
    
$sql = "select * from cierre where created_at  between '".$_GET["date_at"]." 00:00:00' and '".$_GET["date_fin"]." 00:00:00' ";
//echo ''.$sql;

	$users = CierreData::getBySQL($sql);
        
        
}else{
		///$users = CierreData::getAll();
                //echo ''.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
                             <th>Numero</th>
			<th>Fecha</th>
                        <th>Observaciones</th>
                        <th>Generado</th>
			<th>Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
                            
                            
				?>
				<tr>
				 <td><?php echo "  ".$user->id; ?></td>
                                    <td><?php 
                                    
                                   // echo " ".$user->fecha;
                                  echo  date("d/m/Y H:i",strtotime("$user->created_at"));
                                    ?></td>
                                <td><?php echo " ".$user->observaciones; ?></td>
                               
				
                                      <td><?php 
                                      
                                      if (!empty($user->id))
                                          $usuario= $user->getUser();
                                      echo $usuario->name." ".$usuario->lastname; ?>
                                      </td> 
                                        
                                      
                                     
                                   </tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>Ingrese una fecha para el informe Cierres</p>";
		}


		?>

<div class="btn-group pull-right">
    
      <a  target="_blank" href="./report/informe-cierre-pdf.php?date_at=<?php echo $_GET["date_at"];?>&date_fin=<?php echo $_GET["date_fin"];?>"   class="btn btn-danger"  title="Descargar  en pdf  de los Registros del informe al Cierre"><i class="fa fa-file-pdf-o"></i>PDF de Registros del Informe de Cierre de caja</a>
     		      
                
                       
</div>
	</div>
</div>