<?php

require_once(dirname(__FILE__).'/database.php');
require_once __DIR__ . '/mpdf/vendor/autoload.php';
require_once(dirname(__FILE__).'/phpqrcode/qrlib.php');


$id = $_GET['id'];
          if ($id) {
      
              $consulta = "SELECT  * FROM invitados WHERE id = $id";
              $res = mysqli_query($conexion, $consulta);
              if (($res) && (mysqli_num_rows($res) == 1)) {
                  $fila = mysqli_fetch_assoc($res);
      
                  
                  $dni= $fila['dni'];
                  

              } else {
                  echo 'No se pudo acceder a los datos del invitado';
                  $error = true;
              }
          }




          //QRcode::png("Hola","test.png");
          // Create an instance of the class:
          $mpdf = new \Mpdf\Mpdf();
          
          // Write some HTML code:
          $mpdf->WriteHTML('Hello World');
          
          //$mpdf->Image('test.png', 10, 10, 20, 20, 'png', '', true, false);
          
          // Output a PDF file directly to the browser
          $mpdf->Output();