<?php 
$user = MedicData::getById($_GET["id"]);
$categories = CategoryData::getAll();

$diasMedico = DiasMedicData::getAllByMedicId($_GET["id"]);
//print_r($diasMedico);
$lunes_hora =   $lunes_hora_fin =  $lunes_tarde = $lunes_tarde_fin = "";
$martes_hora =   $martes_hora_fin =  $martes_tarde = $martes_tarde_fin = "";
$miercoles_hora =   $miercoles_hora_fin =  $miercoles_tarde = $miercoles_tarde_fin = "";

$jueves_hora =   $jueves_hora_fin =  $jueves_tarde = $jueves_tarde_fin = "";
$sabado_hora =   $sabado_hora_fin =  $sabado_tarde = $sabado_tarde_fin = "";

$viernes_hora =   $viernes_hora_fin =  $viernes_tarde = $viernes_tarde_fin = "";
foreach($diasMedico as $dia){
  if($dia->dia=="lunes"){
    $lunes_hora = $dia->matutinoIni ;
    $lunes_hora_fin = $dia->matutinoFin ;
    $lunes_tarde =$dia->vespertinoIni ;
    $lunes_tarde_fin = $dia->vespertinoFin ;
   
  }
  if($dia->dia=="martes"){
    $martes_hora = $dia->matutinoIni ;
    $martes_hora_fin = $dia->matutinoFin ;
    $martes_tarde =$dia->vespertinoIni ;
    $martes_tarde_fin = $dia->vespertinoFin ;
   
  }
  if($dia->dia=="miercoles"){
    $miercoles_hora = $dia->matutinoIni ;
    $miercoles_hora_fin = $dia->matutinoFin ;
    $miercoles_tarde =$dia->vespertinoIni ;
    $miercoles_tarde_fin = $dia->vespertinoFin ;
   
  }
  if($dia->dia=="jueves"){
    $jueves_hora = $dia->matutinoIni ;
    $jueves_hora_fin = $dia->matutinoFin ;
    $jueves_tarde =$dia->vespertinoIni ;
    $jueves_tarde_fin = $dia->vespertinoFin ;
   
  }
  if($dia->dia=="viernes"){
    $viernes_hora = $dia->matutinoIni ;
    $viernes_hora_fin = $dia->matutinoFin ;
    $viernes_tarde =$dia->vespertinoIni ;
    $viernes_tarde_fin = $dia->vespertinoFin ;
   
  }
  if($dia->dia=="sabado"){
    $sabado_hora = $dia->matutinoIni ;
    $sabado_hora_fin = $dia->matutinoFin ;
    $sabado_tarde =$dia->vespertinoIni ;
    $sabado_tarde_fin = $dia->vespertinoFin ;
   
  }

}
?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Profesional</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatemedic" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>" <?php if($user->category_id==$cat->id){ echo "selected"; }?>><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" value="<?php echo $user->address;?>" class="form-control" required id="username" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone"  value="<?php echo $user->phone;?>"  class="form-control" id="inputEmail1" placeholder="Telefono">
    </div>
  </div>
      <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label"> Realiza servicios en la institución<?php echo  $user->is_profesional ?></label>
    <div class="col-lg-4">
        <select name="is_profesional" id="is_profesional" class="form-control" required>

<option value="0" <?php if("0"==$user->is_profesional){ echo "selected"; }?>>- No Realiza servicios</option>
<option value="1" <?php if("1"==$user->is_profesional){ echo "selected"; }?> >-Realiza servicios en la institución</option>
 
</select>
    </div>
    
   </div>        
 



  <div class="form-group">
    <label for="inputEmail1" class="col-md-2 control-label">Lunes</label>
    <input type="hidden" name="lunes" value="lunes">
    <div class="col-md-2">
             
      <input type="time" name="lunes_hora" step="60" value="<?php echo $lunes_hora ?>"  class="form-control success" id="time_at" placeholder="Hora">
          
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php  ?> 
     
   <input type="time" name="lunes_hora_fin" value="<?php echo $lunes_hora_fin ?>" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="lunes_tarde"  value="<?php echo $lunes_tarde ?>"  step="60"  class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="lunes_tarde_fin"  value="<?php echo $lunes_tarde_fin ?>" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="martes_hora"  value="<?php echo $martes_hora ?>"  step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="martes_hora_fin"  value="<?php echo $martes_hora_fin ?>"  step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="martes_tarde"   value="<?php echo  $martes_tarde ?>"  step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="martes_tarde_fin"   value="<?php  echo $martes_tarde_fin ?>" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="miercoles_hora"   value="<?php  echo  $miercoles_hora_fin ?>" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="miercoles_hora_fin"   value="<?php  echo  $miercoles_hora_fin ?>" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="miercoles_tarde"  value="<?php  echo $miercoles_tarde ?>"  step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="miercoles_tarde_fin"   value="<?php  echo $miercoles_tarde_fin ?>"  step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="jueves_hora" value="<?php  echo $jueves_hora ?>"step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="jueves_hora_fin" value="<?php  echo $jueves_hora_fin ?>" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="jueves_tarde" value="<?php  echo $jueves_tarde ?>" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="jueves_tarde_fin" value="<?php  echo $jueves_tarde_fin ?>" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="viernes_hora" value="<?php  echo $viernes_hora ?>" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
    <?php 
  //      $hora_fin = date('H:i', strtotime($reservation->time_at.'+1 hour'.'+30 minutes'));
   $hora_fin = date('H:i', strtotime($minutos.'+30 minutes')); 
  // echo $hora_fin;  ?> 
     
   <input type="time" name="viernes_hora_fin" value="<?php  echo $viernes_hora_fin ?>" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="viernes_tarde" step="60"  value="<?php  echo $viernes_tarde?>"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
   
     
   <input type="time" name="viernes_tarde_fin" value="<?php  echo $viernes_tarde_fin ?>" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="sabado_hora" value="<?php  echo $sabado_hora ?>" step="60"      class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
   
   <input type="time" name="sabado_hora_fin" value="<?php  echo $sabado_hora_fin ?>" step="60"    class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
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
        
      <input type="time" name="sabado_tarde" value="<?php  echo $sabado_tarde ?>" step="60"   class="form-control success" id="time_at" placeholder="Hora">
      
    
    </div>
    <label for="inputEmail1" class="col-md-2 control-label"><i class="fa fa-clock-o fa-2x"></i>Hora Fin</label>
 
 <div class="col-md-2">
       
   <input type="time" name="sabado_tarde_fin" value="<?php  echo $sabado_tarde_fin ?>" step="60"  class="form-control" id="inputEmail1" placeholder="Hora Fin">
   
 
 </div>

 </div>
 


  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Profesional</button>
    </div>
  </div>
</form>
	</div>
</div>