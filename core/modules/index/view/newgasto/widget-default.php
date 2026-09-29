<?php 


?>

<div class="row">
	<div class="col-md-12">
	
        
         <h1><span class="fa fa-money"></span> Nuevo Gasto <i class="fa fa-plus-square"></i></h1>
	
	<br>
		<form class="form-horizontal" method="post" id="addgasto" action="index.php?view=addgasto" role="form">

                    
         <div class="form-group">         
             <label for="inputEmail1" class="col-lg-2 control-label">Fecha</label>
           <div class="col-lg-3">
                
		<div class="input-group">
                   
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="fecha" id="fecha" value="<?php 
                 
                      echo date("Y-m-d");
                      
                  
                 $min= date("Y-m-d",strtotime(" - 3 day"));
                      ?>" class="form-control" placeholder="Palabra clave"  min="<?php echo $min;  ?>"  >
		</div>
    </div>          
                    
    
   
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-4">
      <input type="text" name="des" required class="form-control" id="des" placeholder="Descripcion">
    </div>
  </div>

       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Monto</label>
    <div class="col-lg-3">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="monto" id="monto" placeholder="Monto">
</div>
    </div>
  </div>               
                 
  
                    
                    
                    <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
     
      <button type="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Agregar Gasto</button>
   
    </div>
  </div>
</form>
	</div>
</div>