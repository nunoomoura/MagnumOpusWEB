<!-- Brand Logo -->
    <div class="brand-link">
      <span class="brand-text font-weight-light">Magnum Opus</span>
</div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">
          <a href="utilizador.php" class="d-block"><?php echo $_SESSION["info"]["nome_func"]; ?> </a>
          <form action="./handle/logout.php" method="POST">
            <button type="submit" class='btn btn-warning'>Sair</button>
          </form>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="inventario.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inventário
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categorias.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categorias
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="encomendas.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Encomendas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="clientes.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          <?php if($_SESSION["info"]["tipo_user"] == "admin") { ?>
          <li class="nav-item">
            <a href="funcionarios.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Funcionários
              </p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->