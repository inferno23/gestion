
<script src='res/jquery.min.js'></script>
<script type="text/javascript">
             

              
$(document).ready(function(){
   $("#estudio_id").change(function () {
      // alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });          
           </script>   


<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newinforme" class="btn btn-default"><i class='fa fa-th-list'></i> Nuevo items para informe</a>
</div>
		
                
                 <h1><span class="fa fa-medkit"></span> Items para informes </h1>
<br>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="informes">
        <?php

$estudios = EstudioData::getAll();


 //echo "date_at".$_GET["date_at"];
        ?>

  <div class="form-group">
     <div class="col-lg-3">
		<div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
<select name="estudio_id" id="estudio_id"  class="form-control" >
<option value="">-- Atencion-</option>
  <?php foreach($estudios as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->descripcion." - ".$p->id; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    </div>  
   

    <div class="col-lg-3">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>

<?php
$users= array();
//if((    isset($_GET["medic_id"]) && isset($_GET["date_at"])&& isset($_GET["estudio_id"]))
if((     isset($_GET["estudio_id"]) && ( $_GET["estudio_id"]!=""  ))) {
    
    
$sql = "select * from informe where codigo_estudio =".$_GET["estudio_id"]." ORDER BY codigo_informe ASC,subcodigo ASC ";
//echo ''.$sql;
	$users = InformeData::getBySQL($sql);
}else{
		$users = InformeData::getAll();
              //  echo ''.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Atencion</th>
                        <th>codigo</th>
                        <th>subcodigo</th>
                         <th>descripcion</th>
                          <th>observacion</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
                            
                            
				?>
				<tr>
				
                                   <td><?php  
                                        if (empty($user->codigo_estudio) ) {
                                          echo $user->codigo_estudio;
                                       }else{
                                            $category = $user->getEstudio();
                                                      echo $category->id ."- ".$category->descripcion;
                                       }
                                           ?></td>
                                   <td><?php echo " ".$user->codigo_informe; ?></td>
                                   <td><?php echo " ".$user->subcodigo; ?></td>
                                  <td><?php echo " ".$user->descripcion; ?></td>
                                <td><?php echo " ".$user->observacion; ?></td>
                                <td style="width:130px;"><a href="index.php?view=editinforme&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delinforme&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Estudios</p>";
		}


		?>


	</div>
</div>