<?php
    date_default_timezone_set("America/Lima");
    require_once 'sesion.php';
    
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Transacciones</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../util/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../util/lte/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../util/lte/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- DATA TABLES -->
    <link href="../util/lte/plugins/datatables/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>
    
    <!-- Extilos extras-->
    <link href="../util/lte/css/extras.css" rel="stylesheet" type="text/css" />
    
    <!-- Ionicons -->
    <link href="../util/lte/css/ionicons.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="../util/lte/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../util/swa/sweetalert.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <?php
        include 'cabecera.php';
      ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php
            include 'menu.php';
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

    <!-- INICIO: Contenido de la página -->
        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Registro de Pagos
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
            <li><a href="#">Transacciones</a></li>
            <li class="active">Pagos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-body">
                    <form class="form-inline">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="rbtipo" id="rbtipo" value="1" checked="" >
                                      Solo Hoy
                                    </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="radio">
                                    <label>
                                      <input type="radio" name="rbtipo" id="rbtipo" value="2">
                                      Rango de Fechas
                                    </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="radio">
                                    <label>
                                      <input type="radio" name="rbtipo" id="rbtipo" value="3">
                                      Todas las Fechas
                                    </label>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <label>Desde:&nbsp;</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                          <span class="text-blue"><i class="fa fa-calendar"></i></span>
                                      </div>
                                      <input type="date" id="txtfecha1" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>"/>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                &nbsp;&nbsp;
                                <div class="input-group">
                                    <label>Hasta:&nbsp;</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <span class="text-blue"><i class="fa fa-calendar"></i></span>
                                      </div>
                                      <input type="date" id="txtfecha2" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>"/>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                
                                &nbsp;
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btnfiltrar">Filtrar Datos</button>
                                
                                &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar">Agregar Nuevo Pago</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-header -->
                
              </div><!-- /.box -->
              
              <div class="box">
                <div class="box-body">
                    <div id="listado">
                        
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <!-- FIN: Contenido de la página -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Sistema Comercial</a>.</strong> Todos los derechos reservados.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    
    <!-- DATA TABLE -->
    <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <!-- SlimScroll -->
    <script src="../util/lte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../util/lte/js/app.js" type="text/javascript"></script>
    <!-- Temas -->
    <!--<script src="../util/lte/js/demo.js" type="text/javascript"></script>-->
    
    <!-- Aqui llamar a los JS de listado de compras -->
    <script src="js/pagos-listar.js" type="text/javascript" ></script>
    <script src="../util/swa/sweetalert-dev.js"></script>
    
  </body>
</html>