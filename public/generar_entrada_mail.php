<?php

require_once(dirname(__FILE__).'/../database.php');
require_once __DIR__ . '/../mpdf/vendor/autoload.php';
require_once(dirname(__FILE__).'/../phpqrcode/qrlib.php');


$dni = $_GET['dni'];

$password="nfdjs789456fdjshfdjsfin&&%%%8uwrjewm";
$dni=openssl_decrypt($dni,"AES-128-ECB",$password);

          if ($dni) {
      
              $consulta = "SELECT  * FROM invitados WHERE dni = $dni";
              $res = mysqli_query($conexion, $consulta);
              if (($res) && (mysqli_num_rows($res) == 1)) {
                  $fila = mysqli_fetch_assoc($res);
      
                  $nombre=$fila['nombre'];
                  $dni= $fila['dni'];
                  $correo=$fila['correo'];
                  

              } else {
                  echo 'No se pudo acceder a los datos del invitado';
                  $error = true;
              }
          }

          


          QRcode::png("$dni","test.png");
          // Create an instance of the class:
          $mpdf = new \Mpdf\Mpdf();
          
          // Write some HTML code:
          $mpdf->WriteHTML('Nombre: '.$nombre.'  DNI: '.$dni.'');
          
          $mpdf->Image('test.png', 10, 50, 20, 20, 'png', '', true, false);
          
          // Output a PDF file directly to the browser
          $mpdf->Output();