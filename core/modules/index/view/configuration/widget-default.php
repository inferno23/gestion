<br><br><br><br><div class="row">
	<div class="col-md-3">

	</div>
	<div class="col-md-6">
	<h2>Cambiar Clave de acceso</h2>
<br>	<form class="form-horizontal" id="changepasswd" method="post" action="index.php?view=changepasswd" role="form">
  <div class="form-group">
      
      <input type="hidden" class="form-control" id="id" name="id" placeholder="id Actual">
    <label for="inputEmail1" class="col-lg-4 control-label">Clave Actual</label>
    <div class="col-lg-8">
      <input type="password" class="form-control" id="password" name="password" placeholder="Clave Actual">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword1" class="col-lg-4 control-label">Nueva Clave</label>
    <div class="col-lg-8">
      <input type="password" class="form-control"  id="newpassword" name="newpassword" placeholder="Nueva Clave">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword1" class="col-lg-4 control-label">Confirmar Nueva Clave</label>
    <div class="col-lg-8">
      <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirmar Nueva Clave">
    </div>
  </div>



  <div class="form-group">
    <div class="col-lg-offset-4 col-lg-8">
      <button type="submit" class="btn btn-success ">Cambiar Clave</button>
    </div>
  </div>
</form>

<script>
$("#changepasswd").submit(function(e){
	if($("#password").val()=="" || $("#newpassword").val()=="" || $("#confirmnewpassword").val()==""){
		e.preventDefault();
		alert("No debes dejar espacios vacios.");

	}else{
		if($("#newpassword").val() == $("#confirmnewpassword").val()){
//			alert("Correcto");			
		}else{
			e.preventDefault();
			alert("Las nueva contraseña no coincide con la confirmacion.");
		}
	}
});

</script>
	</div>
</div>
<br><br><br><br><br><br><br><br><br>