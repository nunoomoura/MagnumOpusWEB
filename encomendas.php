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
            <h1 class="m-0">Encomendas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Encomendas</li>
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
            <table id="tableInv" class="table table-bordered table-hover">
              <thead>
                <tr>
                      <th>Nome do Cliente</th>
                      <th>Preço Total</th>
                      <th>Data</th>
                      <th>Estado</th>
                      <th>Produtos</th>
                    </tr>
              </thead>
              <tbody>
                  <?php foreach(lista_enc() as $us) { ?>

                    <tr>
                      <td><?php echo $us["nome_cliente"]; ?></td>
                      <td><?php echo $us["preco_total"]; ?></td>
                      <td><?php echo $us["data"]; ?></td>
                      <td><?php echo $us["estado"]; ?>
                        &nbsp
                        <button id="<?php echo $us["cod_encomenda"]; ?>" data-id="<?php echo $us["cod_estado"]; ?>" type="button" class="btn btn-dark editStatus" data-toggle="modal" data-target="#modalStatus">
                          Atualizar Estado
                        </button>
                      </td>
                      <td><button data-id="<?php echo $us["cod_encomenda"]; ?>" type="button" class="btn btn-warning viewEncProd" data-toggle="modal" data-target="#modalView">
                            Ver Produtos
                          </button>
                          &nbsp
                          <button data-id="<?php echo $us["cod_encomenda"]; ?>" type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#modalEdit">
                            Editar
                          </button>
                    </td>
                    </tr>
                  <?php } ?>
                  </tbody>
            </table>
          </div>
        </div>
        <a href="./encomendas_add.php" class='btn btn-primary addEnc'>Adicionar</a>

        <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalView" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <input type="hidden" id="verEncProd_id" name="verEncProd_id">
              <table id="tableViewEncProd" class="table table-bordered table-hover">
              <thead>
                <tr>
                      <th>Nome produto</th>
                      <th>Valor total</th>
                      <th>Quantidade</th>
                    </tr>
              </thead>
              <tbody class="tableViewEncProd"></tbody>
            </table>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatus" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="editStatus" method="POST">
                <input type="hidden" id="verEnc_id" name="verEnc_id">
                <input type="hidden" id="verStatus_id" name="verStatus_id">
                <label>Estado:</label>
                <br>
                <select id="cod_estado" name="cod_estado">  
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary block full-width m-b">Atualizar</button>
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
