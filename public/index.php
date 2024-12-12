<?php

require_once(dirname(__FILE__)."/../conexion.php");
require_once(dirname(__FILE__)."/../control_inicio_sesion.php");

date_default_timezone_set('America/Argentina/Catamarca');
session_start();

$menu = $_GET['menu'] ?? null;
$usuario = usuario(); //Usuario logueado que se actualiza en cada peticion
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Invitados</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="icon" type="image/png" href="/logo-192x192.png">
  <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <!-- jQuery -->
  <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/dist/js/demo.js"></script>
  <script src="/plugins/select2/js/select2.full.min.js"></script>
  <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  

  <script>
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
  </script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link custom" data-toggle="dropdown" href="#">
            <?=$usuario['usuario']?>
          </a>
          
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <p class="dropdown-item disabled"><?=$usuario['usuario']?></p>
            <div class="dropdown-divider"></div>
            <a href="/index.php?menu=cambiar_contraseña" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Cambiar Contraseña
            </a>
            <div class="dropdown-divider"></div>
            <a href="/login.php?cerrar_sesion=true" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
            </a>
          </div>
        </li>

      </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
           <img src="dist/img/logo.jpg"
           alt="Logo"
           class="brand-text"
           style="opacity: .8; width:77%">

      <br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Operaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/index.php?menu=lista_invitado" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de Invitados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/index.php?menu=registrar_invitado" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar Invitado</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?php
    switch($menu){
      case 'cambiar_contraseña':
        include_once(dirname(__FILE__)."/../cambiar_password.php");
      break;
      case 'lista_usuarios':
        include_once(dirname(__FILE__)."/../lista_usuarios.php");
      break;
      case 'lista_invitado':
        include_once(dirname(__FILE__)."/../lista_invitado.php");
      break;
      case 'borrar_invitado':
        include_once(dirname(__FILE__)."/../borrar_invitado.php");
      break;
      case 'registro_usuario':
        include_once(dirname(__FILE__)."/../registro_usuario.php");
      break;
      case 'grabar_usuario':
        include_once(dirname(__FILE__)."/../grabar_usuario.php");
      break;
      case 'registrar_invitado':
        include_once(dirname(__FILE__)."/../registrar_invitado.php");
      break;
      case 'editar_invitado':
        include_once(dirname(__FILE__)."/../editar_invitado.php");
      break;
      case 'qr_generator':
        include_once(dirname(__FILE__)."/../qr_generator.php");
      break;
      
      default:
  ?>
      <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Bienvenido al sistema</h1>
            </div>
          </div>
        </div>
      </section>


      <section class="content">
        <div class="container-fluid">
          Ingrese en alguna opción para continuar       
        </div>
      </section>

    </div>
  <?php
    }
  ?>


 <!-- <footer class="main-footer">
    <strong>FOOTER</strong>
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<script>
    table = $('#tabla').DataTable({
        "language": {
            "url": "{{asset('plugins/datatables/Spanish.json')}}"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
        ],
        "responsive": true,
    });
</script>


</body>
</html>
