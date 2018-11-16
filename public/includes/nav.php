
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="inicio"><img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/I/41Y4fyn7HAL.png" width="35" height="35" style="margin-right: 5px" alt="">Factusys</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <span class="nav-link" style="color: white; cursor: default;"><i style="margin: 0 5px;" class="fas fa-crown"></i><?php echo $_SESSION['user_data']->name; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="facturas"><i class="far fa-file-alt"></i>Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos"><i class="fas fa-box"></i>Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes"><i class="far fa-address-card"></i>Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="configuracion"><i class="fas fa-wrench"></i>Configuracion</a>
          </li>

          <li class="nav-item">
            <a class="nav-link btn btn-sm btn-danger " href="logout"><i class="fas fa-sign-out-alt"></i>Salir</a>
          </li>

        </ul>
        
      </div>
    </nav>