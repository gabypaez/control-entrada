<?php
    require_once(dirname(__FILE__).'/database.php');
    $conexion = mysqli_connect('localhost', 'root', '', 'registro');

    
    // Preguntamos si la conexion se realizo correctamente
    if ($conexion){
        $id = $_GET['id'];

        

            $consulta = "delete from invitados where id = $id";
    
            $result = mysqli_query($conexion,$consulta);
    
            if ($result) {
                $_SESSION['mensaje']['mensaje'] = '<b>Exelente!</b> La operacion se realizo exitosamente!';
                $_SESSION['mensaje']['tipo'] = 'success';
    
                
            } else {
                $_SESSION['mensaje']['mensaje'] = '<b>Error!</b>';
                $_SESSION['mensaje']['tipo'] = 'danger';
            }

        


    
    ?>
<script>window.location.href = '/index.php?menu=lista_invitado' </script>

<?php
    }
    ?>