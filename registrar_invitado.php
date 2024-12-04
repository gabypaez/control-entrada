<?php

require_once(dirname(__FILE__).'/database.php');


?>



  <div class="content-wrapper">
      <div class="text-center">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-12">
              <div class="col-sm-12">
                <h1>Registrar Invitado </h1>
              </div>
            </div>
          </div>
        </section>
      </div>    
   
      <div class="container d-flex justify-content-center">
        <section class="content col-sm-10">
        <div class="container-fluid">
            <div class="card card-default">
              <div class="card-body">
                  <div class="col-sm-12 flex justify-content-center" >  

                  <form class="form-horizontal" action="" method="POST">
                      <label class='control-label' for="">Nombre Y Apellido</label><br>
                      <input required  class='form-control' name="nombre" type="text" placeholder="Ingrese Nombre">
                      <label class='control-label' for="">DNI</label><br>
                      <input required  class='form-control' name="dni" type="number" placeholder="Ingrese DNI">
                      <label class='control-label' for="">Correo</label><br>
                      <input required  class='form-control' name="correo" type="email" placeholder="Ingrese Email">
                      <label class='control-label' for="">Celular</label>
                      <input required  class='form-control' name="celular" type="number" placeholder="Ingrese Su Celular">
                      <br> <br> <br> <br>
                      <button type="submit" class="btn btn-block btn-primary">Registrar</button>
                    </form>
                  </div>
              </div>
            </div>
          </div>  
        </section>
    </div>
  </div>
<?php



if ( (isset($_POST["nombre"])) && (isset($_POST["dni"])) && (isset($_POST["celular"])) && (isset($_POST["correo"])))
{

    
    $nombre=$_POST["nombre"];
    $dni=$_POST["dni"];
    $celular=$_POST["celular"];
    $correo=$_POST["correo"];

    
    

    
    

    if(!($conexion))
    {
        echo "<b>Error 'conectando' a la base de dato";
        echo "<br> Error message=". mysqli_error();

    }
     else {
         //guardar datos en la base de datos
         $sql='insert into invitados(nombre,dni,correo,celular) values("'.$nombre.'", "'.$dni.'", "'.$correo.'", "'.$celular.'")';
         $result=mysqli_query($conexion, $sql);

         if($result){

        $_SESSION['mensaje']['mensaje'] = '<b>Exelente!</b> El Insumo se Registro Correctamente';
        $_SESSION['mensaje']['tipo'] = 'success';
         }
          else {
            $_SESSION['mensaje']['mensaje'] = '<b>Error!</b> El Insumo no se Resgistro';
            $_SESSION['mensaje']['tipo'] = 'danger';
          }
     }
?>

<script>window.location.href = '/index.php?menu=lista_invitado' </script>

<?php
}
?>
