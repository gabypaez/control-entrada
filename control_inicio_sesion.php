<?php
function usuario(){
	$usuario = $_SESSION['user_id'] ?? null;
	if($usuario){
		$db = DB::getInstance();
		$sql = "SELECT * FROM usuarios WHERE id = :id ";

		$stm = $db->prepare($sql);
		$stm->execute([':id' => $usuario]);

		$resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
		if( $resultado[0]['id'] ?? null ){
			return [
				'id' => $resultado[0]['id'], 
                'usuario' => $resultado[0]['usuario'], 
			];
		}
	}
	 //Si no se encuentra el usuario, pedimos que inicie sesión nuevamente
	 unset($_SESSION['user_id']);
	 header("Location: /login.php");
	 exit();
}

?>