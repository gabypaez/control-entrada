<?php require_once(dirname(__FILE__).'/database.php');
 ?>



<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Invitado </h1>
          </div>
        </div>
      </div>
    </section>
    
    

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
          
          <?php
          error_reporting(0);

          $error = false;

          $id = $_GET['id'];
          if ($id) {
      
              $consulta = "SELECT  * FROM invitados WHERE id = $id";
              $res = mysqli_query($conexion, $consulta);
              if (($res) && (mysqli_num_rows($res) == 1)) {
                  $fila = mysqli_fetch_assoc($res);
      
                  $nombre= $fila['nombre'];
                  $dni= $fila['dni'];
                  $correo= $fila['correo'];
                  $celular= $fila['celular'];

              } else {
                  echo 'No se pudo acceder a los datos del invitado';
                  $error = true;
              }
          }

    if (!$error) {
        ?>
            <div class='col-md-offset-1 col-md-10'>
            <form action="" method="POST" enctype="multipart/form-data">
                
            <label class='control-label' for="id">ID</label><br>
            <input class='form-control' type="text" name="id" id="id" value="<?=$_GET['id']?>" readonly><br><br>
            
            <label class='control-label' for="">Nombre del Invitado</label><br>
      <input required  class='form-control' name="nombre" type="text" value="<?=$nombre?>">
      <label class='control-label' for="">DNI</label><br>
      <input required  class='form-control' name="dni" type="text" value="<?=$dni?>">
      <label class='control-label' for="">correo</label><br>
      <input required  class='form-control' name="correo" type="text" value="<?=$correo?>">
      <label class='control-label' for="precio">Celular</label><br>
                <input class='form-control' type="text" name="celular" id="descripcion" value="<?=$celular?>"><br><br> 
                <br>
                <button type="submit" class="btn btn-block btn-primary">Registrar</button>
            </form>

              <?php 
            }
            else {
            echo 'No se pudo acceder a los datos';
            $error = true;
                }

                ?>

        </div>
      </div>
    </section>

</div>        


<?php
require_once(dirname(__FILE__).'/database.php');

extract($_POST);

if ( ((isset($_POST["nombre"])) && (isset($_POST["dni"])) && (isset($_POST["correo"])) && (isset($_POST["celular"]))) != null)
{
  $id=$_POST["id"];
  $nombre_insumo= $_POST["nombre_insumo"];
  $codigo=$_POST["codigo"];
  $descripcion=$_POST["descripcion"];
  $tipo=$_POST["tipo"];
  $laboratorio=$_POST["laboratorio"];
  

  if ($conexion) {

    
    $consulta = "UPDATE invitados SET nombre ='$nombre', dni = '$dni', correo = '$correo', celular = '$celular'  WHERE id = '$id'";

        $resultados = mysqli_query($conexion,$consulta);
        
        if ($resultados) {
            
          $_SESSION['mensaje']['mensaje'] = '<b>Exelente!</b> El Invitado se Modifico Correctamente';
          $_SESSION['mensaje']['tipo'] = 'success';

            

            
        }
        else {
            // error
            $_SESSION['mensaje']['mensaje'] = '<b>Error!</b>';
            $_SESSION['mensaje']['tipo'] = 'danger';
        }
    }

?>

<script>window.location.href = '/index.php?menu=lista_invitado' </script>

<?php
}
?>

