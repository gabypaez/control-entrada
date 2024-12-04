<?php
session_start();

if($_GET['cerrar_sesion'] ?? null){
    unset($_SESSION['user_id']);
    header("Location: /login.php");
    exit();
  }
  require_once(dirname(__FILE__).'/../database.php');
  if (isset($_SESSION['user_id'])) {
    header("Location: /");
  }
  

  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, usuario, password FROM usuarios WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    if (isset($_SESSION['user_id'])) {
      header('Location: /');
    }

    if (count($results) > 0 && ($_POST['password']== $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /");
      exit();
    } else {
      $_SESSION['mensaje']['tipo'] = 'danger';
      $_SESSION['mensaje']['mensaje'] = 'Lo Sentimos, el Usuario y/o contraseña No Existen';
    }
  }

?>







<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Programa de relevamiento anual educativo - @yield('pageTitle')</title>
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
  <style>

    body{
      background-position: center !important;
      background-repeat: no-repeat !important;
      background-size: cover !important;
      background-image:url('ASD') !important;
    }
  </style>

</head>
<body class="hold-transition login-page">
<div id="contenido" class="h-100 d-flex justify-content-center align-items-center">
  <div class="login-box">
    <div class="card">
      <div class="card-header">
        <div class="login-logo">
          <img src="dist/img/logo_ministerio.png" alt="Logo" width="100%">
        </div>
      </div>
      <div class="card-body login-card-body">
        <h4 class="login-box-msg">Bienvenido</h4>
        <p class="login-box-msg">Por favor inicie sesión</p>
  
        <form action="" method="post">
          <?php require_once(dirname(__FILE__).'/../mensajes.php'); ?>
          <div class="input-group mb-3">
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-block btn-primary">Iniciar sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>

<!-- jQuery -->
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>
