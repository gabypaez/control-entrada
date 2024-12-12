<?php


  require_once(dirname(__FILE__).'/database.php');

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, usuario, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }


  date_default_timezone_set('America/Catamarca');
  $fecha_actual=date("Y-m-d H:i:s");

?>



<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de Invitados </h1>
          </div>
        </div>
      </div>
    </section>
    
    <?php require_once(dirname(__FILE__).'/mensajes.php'); ?>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
          <table id="tabla1" class="table table-striped table-bordered" style="width:100%" >
                  <thead>
                    <tr>
                        <th >#ID</th> 
                        <th>DNI</th> 
                        <th>Nombre y Apellido</th> 
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Generar Entrada</th>
                        <th>Operaciones</th>             
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                 if ($conexion) {
                  $consulta = "SELECT * FROM  invitados";

        
                   $resultados = mysqli_query($conexion,$consulta);

                      if ($resultados) {

                        mysqli_close($conexion);

                        while($user = mysqli_fetch_assoc($resultados)) {
                          extract($user);
                    ?>
                          <tr class='active'>
                          </td>
                            <td><?=$id?></td>
                            <td><?=$dni?></td> 
                            <td><?=$nombre?></td>
                            <td><?=$correo?></td>
                            <td><a class='btn btn-success'  target="_blank" href='https://wa.me/549<?=$celular?>'><i class="bi bi-whatsapp">  <?=$celular?></i></a></td>
                            <td><a class='btn btn-warning' target="_blank" href='/generar_entrada.php?dni=<?=$dni?>'> <i class="bi bi-ticket"></i> Entrada</a></td>
                            <td><a class='btn btn-info' href='/index.php?menu=editar_invitado&id=<?=$id?>'> <i class="bi bi-pencil-square"></i> Editar</a> <a class='btn btn-danger' onclick='return confirm(`¿Está seguro que desea eliminar el problema?`)' href='/index.php?menu=borrar_invitado&id=<?=$id?>'> <i class="bi bi-trash-fill"></i>Eliminar</a></td>
                            </tr>
                    <?php
                        }
                      }
                    }
                      
                      
                      ?> 
                  </tbody>
                </table>
          </div>
        </div>
      </div>
    </section>

</div>        


<script>
    table = $('#tabla1').DataTable({
        "language": {
          "url": "/plugins/datatables/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4,  ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, ]
                }
            },
        ],
        "responsive": true,
    });
</script>