<header class="main-header">
    <a href="#" class="logo"><b>Sistema Comercial</b></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../imagenes/<?php echo $fotoUsuario; ?>" class="user-image" alt="User Image"/>
              <span class="hidden-xs">Gianmarco Crisologo Raya </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <!--<img src="../imagenes/1.png" class="img-circle" alt="User Image" />-->
                <img src="../imagenes/<?php echo $fotoUsuario; ?>" class="img-circle" alt="User Image" />
                <p>
                  Gianmarco Crisologo Raya
                  <br>
                  <small>Administrador</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="col-xs-12 text-center">
                    <a href="#"><i class="fa fa-key text-primary"></i> <span class="text-primary">Cambiar mi contraseña</span></a>
                </div>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Mi Perfil</a>
                </div>
                <div class="pull-right">
                  <!--  <a href="../controlador/sesion.cerrar.controlador.php" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Cerrar Sesión</a> -->
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>