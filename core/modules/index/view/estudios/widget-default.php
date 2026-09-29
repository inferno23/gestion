<script src='res/jquery.min.js'></script>
<script type="text/javascript">
             

              
$(document).ready(function(){
   $("#category_id").change(function () {
      // alert ($(this).val()); 
        $('#order_form').submit(); //.trigger('submit');
         
        });
 });          
           </script>      



<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newestudio" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Atencion</a>
</div>
		
                
                 <h1><span class="fa fa-medkit"></span> Atenciones</h1>
<br>
<br>
<form id="order_form" class="form-horizontal" role="form">
<input type="hidden" name="view" value="estudios">
        <?php

$estudios = EstudioData::getAll();

$categorias = CategoryData::getAll();

 //echo "date_at".$_GET["date_at"];
        ?>

  <div class="form-group">
     <div class="col-lg-3">
		<div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
<select name="category_id" id="category_id"  class="form-control" >
<option value="">-- Categoria de atenciones-</option>
  <?php foreach($categorias as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name." - ".$p->id; ?></option>
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
if((     isset($_GET["category_id"]) && ( $_GET["category_id"]!=""  ))) {
    
    
$sql = "select * from estudio where category_id =".$_GET["category_id"];
	$users = EstudioData::getBySQL($sql);
}else{
		$users = EstudioData::getAll();
                //echo ''.$sql;
}
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre</th>
                        <th>Categoria</th>
                        <th>lugar</th>
                       
                        <th>Preparativos</th>
			<th></th>
                        <th>Imprimir Informe</th>
			</thead>
			<?php
			foreach($users as $user){
                            
                            
				?>
				<tr>
				<td><?php echo $user->id." ".$user->descripcion; ?></td>
                                   <td><?php  
                                        if (empty($user->category_id) ) {
                                          echo $user->category_id;
                                       }else{
                                            $category = $user->getCategory();
                                                      echo  $category->name;
                                       }
                                           ?></td>
                                
                                   <td><?php echo " ".$user->lugar; ?></td>
                               
                                <td><?php echo " ".$user->preparativos; ?></td>
				<td style="width:130px;"><a href="index.php?view=editestudio&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delestudio&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				<td style="width:130px;">  
                                    <a href="./report/informePatron-pdf.php?id=<?php echo $user->id;?>" target="_blank"  class="btn btn-primary btn-xs"  title="Imprimir Informe de Atencion"><i class="glyphicon glyphicon-print "></i></a>
			     </td>
                                
                                </tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Estudios</p>";
		}


		?>


	</div>
</div>