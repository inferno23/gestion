<div class="row">
	<div class="col-md-12">
	<a href="index.php?view=newuser" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Nuevo Usuario</a>
		<h1>Lista de Usuarios</h1>
<br>
		<?php
		
		?>
		<?php

		$users = UserData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>usuario</th>
			<th>Email</th>
			<th>Activo</th>
			<th>Rol</th>
              
			<th>Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->username; ?></td>
                                <td><?php echo $user->email; ?></td>
				
				<td>
					<?php if($user->is_active):?>
						<i class="glyphicon glyphicon-ok"></i>
					<?php endif; ?>
				</td>
				<td>
					<?php 
                                        $rol="Consultas" ;
										if($user->is_admin <1|| empty($user->is_admin)) 
										$rol="Consultas" ;
                                       if($user->is_admin==1) 
                                         $rol="Turnero" ;
                                       if($user->is_admin==2) 
                                         $rol="Turnero-Caja" ;
                                       if($user->is_admin==3) 
                                         $rol="Facturacion" ;
                                       if($user->is_admin==4) 
                                         $rol="Informes" ;
										 if($user->is_admin==5) 
                                         $rol="Odontologo" ;
                                       if($user->is_admin==10) 
                                         $rol="Administrador" ;
                                       
                                           
                                        ?>
						<i class="glyphicon glyphicon-ok"><?php  echo $rol ?> </i>
					<?php ?>
				</td>
                             
                                
				<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a></td>
				</tr>
				<?php

			}



		}else{
			// no hay usuarios
		}


		?>


	</div>
</div>