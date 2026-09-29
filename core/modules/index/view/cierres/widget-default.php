



<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
    
      <a  target="_blank" href="./report/previa-cierre-pdf.php"  class="btn btn-danger"  title="Descargar  en pdf  de los Registros Previo al Cierre"><i class="fa fa-file-pdf-o"></i>PDF de Registros del Proximo Nuevo Cierre de caja</a>
			     
                
       <a  href="index.php?view=turnos_sincierre&category_id=&estudio_id=&medic_id=&osocial_id=&cierre=" class="btn btn-primary" title="Ver registros del cierre"  ><i class="fa fa-file-text-o"></i>Ver Registros del Proximo Nuevo Cierre de caja</a>
                          
	<a href="index.php?view=cierrecaja" class="btn btn-success"  title="Registrar  Nuevo Cierrre de Caja"     onclick="return confirm(' \n \n Estás seguro que desea realizar el cierre de caja? \n Al confirmar no se permitira modificar ningun cambio en los registros contables  \n');" ><i class='fa fa-money'></i> + Registrar  Nuevo Cierrre de Caja</a>
                           
</div>
		
                
                 <h1><span class="fa fa-money"></span> Cierre de Cajas</h1>
<br>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="cierres">
        <?php

$cierres = CierreData::getAll();



 //echo "date_at".$_GET["date_at"];
        ?>

  <div class="form-group">
    
 <div class="col-lg-3">
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

    <div class="col-lg-3">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<?php
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if((     isset($_GET["date_at"]) && ( $_GET["date_at"]!=""  ))) {
    
    
$sql = "select * from cierre where created_at  like '%".$_GET["date_at"]."%'";

//echo ''.$sql;

	$users = CierreData::getBySQL($sql);
}else{
		$users = CierreData::getAll();
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
                                      echo $usuario->name." ".$usuario->lastname; ?></td> 
                                        
                                      
                                      <td>
                                           <a  href="index.php?view=turnos_cierre&estudio_id=&medic_id=&osocial_id=&cierre=<?php echo $user->id;?>" class="btn btn-primary btn-xs" title="Ver registros del cierre"  ><i class="fa fa-file-text-o"></i></a>
                                            <a href="./report/cierre-xls.php?id=<?php echo $user->id;?>"  class="btn btn-success btn-xs"  title="Descargar  xls  de los Registros del Cierre"><i class="fa fa-file-excel-o"></i></a>
			       <a  target="_blank" href="./report/cierre-pdf.php?id=<?php echo $user->id;?>"  class="btn btn-danger btn-xs"  title="Descargar  en pdf  de los Registros del Cierre"><i class="fa fa-file-pdf-o"></i></a>
			         <a  target="_blank" href="./report/cierre-pdf_imagenes.php?id=<?php echo $user->id;?>&caja=IMAGENES"  class="btn btn-danger btn-xs"  title="Descargar  en pdf  de los Registros del Cierre caja IMAGENES"><i class="fa fa-file-pdf-o"></i></a>
			     
                               <a href="./report/cierre-imagenes-xls.php?id=<?php echo $user->id;?>&caja=IMAGENES"  class="btn btn-warning btn-xs"  title="Descargar  xls  de los Registros del Cierre Imagenes"><i class="fa fa-file-excel-o"></i></a>
			  <a href="./report/cierre-imagenes-xls.php?id=<?php echo $user->id;?>&caja=LABORATORIO"    title="Descargar  xls  de los Registros del Cierre LABORATORIO" style="color:blue;"><i class="fa fa-file-excel-o"></i></a>
			  <a href="./report/cierre-imagenes-xls.php?id=<?php echo $user->id;?>&caja=CONSULTORIOS"    title="Descargar  xls  de los Registros del Cierre CONSULTORIOS" style="color:violet;"><i class="fa fa-file-excel-o" style="color:violet;"></i></a>
			
                                    </td>  
                                   </tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Cierres</p>";
		}


		?>


	</div>
</div>