<!DOCTYPE html>
<html >
  <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="marco farfan 3888-15568587">
    <title>Estetica Odontologica</title>

    <!-- Bootstrap core CSS case5289ZARG  -->
    <link href="res/bootstrap3/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="icon" type="image/png" href="image/logo.png">
    
    
<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='res/fullcalendar.min.css' rel='stylesheet' />
<link href='res/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='res/js/moment.min.js'></script>
<script src='res/fullcalendar.min.js'></script>
<?php endif; ?>
           
            <!--  -->



<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/samples/js/sample.js"></script>


  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <img src="./image/logo.png" alt="Clinica Odontologica" style="width:50px;height:48px;">
       
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
<?php 

//ini_set("session.cookie_lifetime","17200");
                //seteo el maximo tiempo de vida de la seession
                //ini_set("session.gc_maxlifetime","17200");
//print_r(ini_get_all("session"));
$u=null;
$categoria_id="";


if(Session::getUID()!=""):
  $u = UserData::getById(Session::getUID());
  if ($u->modulo >6){
       $categoria_id = $u->modulo;
//echo $categoria_id;
   //  $categoria_id=8;////////sacarrrrrrrrrrrrrrrrrrrrrrrrr
     $_GET["category_id"]=$categoria_id;
   }
   // $categoria_id=8;////////sacarrrrrrrrrrrrrrrrrrrr//rrrrr
//echo "modulo".$u->modulo ."-category_id".$categoria_id;
?>
         <ul class="nav navbar-nav">
          <li><a href="index.php?view=newreservation&estudio_id=&category_id=<?php echo $categoria_id;?>"><i class="fa fa-asterisk"></i> Nuevo Turno</a></li>
           
        
          </ul> 
          <ul class="nav navbar-nav side-nav">
         
           
             <li><a href="index.php?view=agenda&category_id=<?php echo $categoria_id;?>&estudio_id=&medic_id&osocial_id=&date_at=<?php echo date("Y-m-d");?>"><i class="fa fa-calendar"></i> agenda</a></li>
       
          <li><a href="index.php?view=reservations&category_id=<?php echo $categoria_id;?>&estudio_id=&medic_id&tecnico_id=&osocial_id=&date_at=<?php echo date("Y-m-d");?>"><i class="fa fa-calendar"></i> Turnos</a></li>
          <li><a href="index.php?view=pacients"><i class="fa fa-male"></i> Pacientes</a></li>
         
         
          <li><a href="index.php?view=medics"><i class="fa fa-user-md"></i> Profesional</a></li>
            <?php if($u->is_admin==2 || $u->is_admin==10):?>
              <li><a href="index.php?view=categories"><i class="fa fa-th-list"></i> A. Odontológicas</a></li>
        
              <li><a href="index.php?view=cierres"><i class="fa fa-filter"></i> Cierre de Caja</a></li>
          
          <li><a href="index.php?view=gastos&date_at=<?php echo date("Y-m-d");?>"><i class="fa fa-money" ></i> Gastos</a></li>
          <li><a href="index.php?view=feriados"><i class="fa fa-calendar"></i> Feriados</a></li>
       
           <?php endif;?>
          
           <?php if($u->is_admin==3 ||$u->is_admin==10 ):?>
               
                   <li class="dropdown user-dropdown">
        <a href="index.php?view=reporte_caja&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>" class="dropdown-toggle" data-toggle="dropdown">
       <i class="fa fa-bar-chart"></i> <?php echo "Reportes"; ?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="index.php?view=reporte_caja&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>"><i class="fa fa-bar-chart"></i> Obra Social</a>
          <li><a href="index.php?view=reporte_atenciones_informadas&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>">Atenciones</a>
      
          </ul>
          </li>
                
            
           <?php 
           
          /***
           * 
            <li><a href="index.php?view=reporte_atenciones_informadas&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>">Informadas</a>
        <li><a href="index.php?view=reporte_atenciones_solicitadas&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>"> Solicitadas</a>
      <li><a href="index.php?view=reporte_atenciones_obra&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>"> Informadas x Obras</a>
       <li><a href="index.php?view=reporte_atenciones_tecnicos&mes=<?php  $month=date("m"); echo $month-1;?>&periodo=<?php echo date("Y");?>"> Realizadas x Tecnico</a>
     
           * 
           * 
           */
          endif;
           
           
           
           ?>
            
            <?php if($u->is_admin==4 ||$u->is_admin==10 ):?>
            <li><a href="index.php?view=turnos_atendidos&category_id=<?php echo $categoria_id;?>&estudio_id=&medic_id&tecnico_id=&osocial_id=&date_at=<?php echo date("Y-m-d");?>"><i class="fa fa-calendar"></i> Informe de Atencion</a></li>
           
           
           
           <?php endif;?>
            
            
         
             
          <?php if($u->is_admin==10):?>
            <li>
           <a href="index.php?view=informe_cierres"><i class="fa fa-bar-chart"></i> Informe de cierres</a>
          </li>
             <li><a href="index.php?view=estudios"><i class="fa fa-medkit"></i> Atenciones</a></li>
             
            
          <li><a href="index.php?view=valests&estudio_id=&osocial_id=2"><i class="fa fa-filter"  style='font-size:20px;color:green'></i> $ Valor de Atenciones</a></li>
          
           
          <li><a href="index.php?view=users"><i class="fa fa-users"></i> Usuarios </a></li>
            <li><a href="index.php?view=osocials"><i class="fa fa-area-chart"></i> Obra Social</a></li>
        <?php endif;?>
          </ul>




<?php endif;?>


          <ul class="nav navbar-nav navbar-right navbar-user">
         
<?php if(Session::getUID()!=""):?>
<?php 
$u=null;
if(Session::getUID()!=""){
  $u = UserData::getById(Session::getUID());
  $user = $u->name." ".$u->lastname;
  
  $avatar= '';
  if($u->is_admin==5 ||$u->is_admin==10 ):
    $avatar= ' <i class="fa fa-user-md fa-lg  text-primary"> </i> ';
  endif;

  }?>
 



            <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php echo $avatar.' '.$user; ?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="index.php?view=configuration">Cambiar Clave</a></li>
          <li><a href="logout.php">Salir</a></li>
          </ul>
          </li>
<?php else:?>
<?php endif; ?>
</ul>



        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

<?php 
  // puedo cargar otras funciones iniciales
  // dentro de la funcion donde cargo la vista actual
  // como por ejemplo cargar el corte actual
  View::load("login");

?>



      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->

<script src="res/bootstrap3/js/bootstrap.min.js"></script>

  </body>
</html>