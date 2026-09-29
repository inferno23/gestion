<?php
$categories = CategoryData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Profesional</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addmedic" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" class="form-control"  id="address" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
    <div class="col-md-6">
      <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefono">
    </div>
  </div>
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label"> Realiza servicios en la institución</label>
    <div class="col-lg-4">
        <select name="is_profesional" id="is_profesional" class="form-control" required>

<option value="0" >- No Realiza servicios</option>
<option value="1" >-Realiza servicios en la institución</option>

   
</select>
    </div>
    
   </div>        
                    
   <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Duracion Atencion*</label>
        <div class="col-md-1">
          <input type="text" name="atencion" class="form-control" required id="atencion" placeholder="atencion">
        </div>
        <label for="inputEmail1" class="col-lg-2 control-label">Duracion en minutos*</label>
       
      </div>

   <div class="form-group">
    <label for="inputEmail1" class="col-md-2 control-label">Lunes</label>
    <input type="hidden" name="lunes" value="lunes">
    <div class="col-md-2">
       <?php 
      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="lunes_hora" step="60"    class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="lunes_hora_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>
 </div>
 <div class="form-group">
 <label for="inputEmail1" class="col-md-2 control-label">Tarde</label>
 <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="lunes_tarde" step="60"  class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="lunes_tarde_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>
    


 <div class="form-group  has-success">
    <label for="inputEmail1" class="col-md-2 control-label">Martes</label>
    <input type="hidden" name="martes" value="martes">
    <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="martes_hora" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="martes_hora_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>
 </div>
 <div class="form-group has-success">
 <label for="inputEmail1" class="col-md-2 control-label">Tarde</label>
 <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="martes_tarde" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="martes_tarde_fin" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>

 <div class="form-group has-warning">
    <label for="inputEmail1" class="col-md-2 control-label">Miercoles</label>
    <input type="hidden" name="miercoles" value="miercoles">
    <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="miercoles_hora" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="miercoles_hora_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>
 </div>
 <div class="form-group has-warning">
 <label for="inputEmail1" class="col-md-2 control-label">Tarde</label>
 <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="miercoles_tarde" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="miercoles_tarde_fin" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>
    


 <div class="form-group">
    <label for="inputEmail1" class="col-md-2 control-label">Jueves</label>
    <input type="hidden" name="jueves" value="jueves">
    <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="jueves_hora" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="jueves_hora_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>
 </div>
 <div class="form-group">
 <label for="inputEmail1" class="col-md-2 control-label">Tarde</label>
 <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="jueves_tarde" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="jueves_tarde_fin" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>
    

 <div class="form-group  alert-info">
    <label for="inputEmail1" class="col-md-2 control-label">Viernes</label>
    <input type="hidden" name="dia" value="viernes">
    <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="viernes_hora" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="viernes_hora_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>
 </div>
 <div class="form-group alert-info">
 <label for="inputEmail1" class="col-md-2 control-label">Tarde</label>
 <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="viernes_tarde" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="viernes_tarde_fin" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>
 
 <div class="form-group has-error">
    <label for="inputEmail1" class="col-md-2 control-label">Sabado</label>
    <input type="hidden" name="sabado" value="sabado">
    <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="sabado_hora" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="sabado_hora_fin" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>
 </div>
 <div class="form-group has-error">
 <label for="inputEmail1" class="col-md-2 control-label">Tarde</label>
 <div class="col-md-2">
       <?php 
 

      $min=date("i");
     // $minutos= date("H:i",strtotime(" - $min min "));
      $minutos= date("H:i"); // cambio 30/08
     
     //cambio  step 300 a 60 para q sea por min
   ?> 
        
      <input type="time" name="sabado_tarde" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="sabado_tarde_fin" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>


  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar profesional</button>
    </div>
  </div>
</form>
	</div>
</div>