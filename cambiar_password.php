<?php
if( ($_POST['password'] ?? null) && ($_POST['repetir_password'] ?? null) && ($_POST['password_actual'] ?? null) ){

    if($_POST['password'] != $_POST['repetir_password']){
        $_SESSION['mensaje'] = ['mensaje' => 'Las contraseñas ingresadas no coinciden', 'tipo' => 'danger'];
    }else{
        $db = DB::getInstance();

        $sql = "SELECT password FROM usuarios WHERE id = :id";
		$stm = $db->prepare($sql);
		$stm->execute([':id' => $_SESSION['user_id']]);
		$resultado = $stm->fetchAll(PDO::FETCH_ASSOC);

        if($resultado[0]['password'] ?? null){
            if( $_POST['password_actual'] != $resultado[0]['password'] ){
                $_SESSION['mensaje'] = ['mensaje' => 'Las contraseña actual ingresada no es correcta', 'tipo' => 'danger'];
            }else{
                $password = $_POST['password'];
                $sql = "UPDATE `usuarios` SET `password`=:password WHERE id=:id";
                $stm = $db->prepare($sql);
                $stm->execute(array(':password' => $password, ':id' => $_SESSION['user_id']));
        
                $_SESSION['mensaje'] = ['mensaje' => 'La contraseña fue cambiada correctamente', 'tipo' => 'success'];
            }
    
        }
    }
}

?>





<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TITULO</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <?php require_once(dirname(__FILE__).'/mensajes.php'); ?>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="passOld">Contraseña actual</label>
                                <input type="password"class="form-control" id="password_actual" name="password_actual" placeholder="Contraseña actual" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Contraseña nueva</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña nueva" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Repetir Contraseña</label>
                                <input type="password" name="repetir_password" class="form-control" id="repetir_password" placeholder="Repetir contraseña" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block btn-primary">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>       
      </div>
    </section>

  </div>
