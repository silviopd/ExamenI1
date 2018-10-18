
<?php
    date_default_timezone_set("America/Lima");
    
    require_once 'sesion.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registro de Pagos</title>
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
    
    <!-- AutoCompletar-->
    <link href="../util/jquery/jquery.ui.css" rel="stylesheet">
   
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
        <!-- INICIO del formulario -->
        
        <form id="frmgrabar">
            
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      Registro de Pagos
                    </h1>
                    <ol class="breadcrumb">
                        <button type="submit" class="btn btn-danger btn-sm">Registrar el Pago</button>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                    <div class="box box-default">
                          <div class="box-body">                              
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>DNI del Cliente</label>
                                       <input type="text" class="form-control input-sm" id="txtdni" name="txtdni" required="">                                        
                                      </div>
                                  </div>
                                  
                              </div>
                              <div class="row">
                                  <div class="col-xs-5">
                                      <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" class="form-control input-sm" id="lblnombrecliente" readonly="" name="lblnombrecliente" >
                                      </div>
                                  </div>
                                  <div class="col-xs-7">
                                      <div class="form-group">
                                        <label>Dirección:</label>
                                        <input type="text" class="form-control input-sm" id="lbldireccioncliente" readonly="" name="lbldireccioncliente">
                                      </div>
                                  </div>
                                  
                              </div>
                          <!-- /row -->
                          </div><!-- /.box-header -->
                    </div><!-- /.box -->

                    <div class="box box-default">
                          <div class="box-body">
                              <div class="row">
                                   <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Fecha de Pago</label>
                                        <input type="date" class="form-control input-sm" id="txtfec" name="txtfec" required="" value="<?php echo date('Y-m-d'); ?>"/>
                                      </div>
                                  </div>
                                  
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                        <label>Seleccione el número de linea telefónica de la cual desea pagar</label>
                                        <select class="form-control" autofocus="" name="cbovehiculo" id="cbovehiculo">                  
                                               
                                        </select>
                                      </div>
                                  </div>
                                
                                 
                              </div>
                              <label>Recibos pendientes de Pago</label>
                              <div class="box box-default">
                                    <div class="box-body">
                                      <div>
                                          <div id="listadocuotas">

                                          </div>
                                      </div>
                                  </div><!-- /.box -->
                              </div>
                          </div>
                    </div>
                    <div class="box box-danger">
                          <div class="box-body">
                              <div class="row">
                                
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">TOTAL A PAGAR:</span>
                                        <input type="text" class="form-control text-right text-bold text-blue" id="txtimporteneto" name="txtimporteneto" readonly="" style="width: 100px;"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </section><!-- /.content -->
                
                
                
          </div><!-- /.content-wrapper -->
        </form>
        <!-- FIN del formulario -->
        
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
    
    <!-- AutoCompletar -->
    <script src="../util/jquery/jquery.ui.autocomplete.js"></script>
    <script src="../util/jquery/jquery.ui.js"></script>
    
    <!-- Aqui llamar a los JS de compras -->
    
    
    <script src="js/pagos.js"></script>
    
    
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
    <script src="../util/lte/js/demo.js" type="text/javascript"></script>
    <script src="../util/swa/sweetalert-dev.js"></script>
    
    <script>
        function disableselect(e){
            return false;
        }
        function reEnable(){
            return true;
        }
        document.onselectstart=new Function ("return false")
        if (window.sidebar){
            document.onmousedown=disableselect
            document.onclick=reEnable
        }
    </script>
    
  </body>
</html>