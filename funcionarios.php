<?php require ("config.php"); 

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <?php include(INCLUDE_DIR . "head.php"); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include(INCLUDE_DIR . "sidebar.php"); ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Funcionários</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Funcionários</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <table id="tableCat" class="table table-bordered table-hover">
              <thead>
                <tr>
                      <th>Nome do Funcionário</th>
                      <th>Username</th>
                      <th></th>
                    </tr>
              </thead>
              <tbody>
                  <?php
                   foreach(lista_funcs() as $us) { 
                    ?>
                    <tr>
                      <td><?php echo $us["nome_func"]; ?></td>
                      <td><?php echo $us["username"]; ?></td>
                      <th>
                      <button data-id="<?php echo $us["id"]; ?>"type="button" class="btn btn-secondary editUser" data-toggle="modal" data-target="#modalEdit">
                        Editar
                      </button>
                      &nbsp
                      <button data-id="<?php echo $us["id"]; ?>" class='btn btn-sm btn-danger eliminarUser'> <i class='fa fa-trash'></i> </button>
                      </th>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <button class='btn btn-primary addUser' data-toggle="modal" data-target="#modalAdd">Adicionar</button>
        

        <!-- Modal -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Editar utilizador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="editUser" method="POST">
                  <input type="hidden" id="editUser_id" name="editUser_id">
                  <label> Nome: </label>
                  <br>
                  <input type="text" id="nome_func" name="nome_func" size="25" 
                  placeholder="Nome">
                  <br>
                  <label> User: </label>
                  <br>
                  <input type="text" id="username" name="username" size="25" 
                  placeholder="Username">
                  <br>
                  <label> Password Nova </label>
                  <br>
                  <input type="password" id="new_password" name="new_password" size="25" placeholder="Password Nova">
                  <br>
                  <label> Confirmar Password </label>
                  <br>
                  <input type="password" id="con_password" name="con_password" size="25" placeholder="Confirmar Password">
                  <br><br>
                  <button type="submit" class="btn btn-primary block full-width m-b">Editar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Adicionar utilizador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="addUser" method="POST">
                  <label> Nome: </label>
                  <br>
                  <input type="text" id="new_nome_func" name="new_nome_func" size="25" 
                  placeholder="Nome">
                  <br>
                  <label> User: </label>
                  <br>
                  <input type="text" id="new_username" name="new_username" size="25" 
                  placeholder="Username">
                  <br>
                  <label> Password </label>
                  <br>
                  <input type="password" id="password" name="password" size="25" placeholder="Password">
                  <br>
                  <label> Confirmar Password </label>
                  <br>
                  <input type="password" id="conf_password" name="conf_password" size="25" placeholder="Confirmar Password">
                  <br><br>
                  <button type="submit" class="btn btn-primary block full-width m-b">Adicionar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

  <?php include(INCLUDE_DIR . "scripts.php"); ?>
</body>
</html>
