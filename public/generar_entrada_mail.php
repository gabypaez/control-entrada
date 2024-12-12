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
                  $id=$fila['id'];
                  

              } else {
                  echo 'No se pudo acceder a los datos del invitado';
                  $error = true;
              }
          }

          

          QRcode::png("$dni","test.png");
          // Create an instance of the class:
          //$mpdf = new \Mpdf\Mpdf();
          
          // Write some HTML code:
          //$mpdf->WriteHTML('Nombre: '.$nombre.'  DNI: '.$dni.'');
          
         
          
          //$mpdf->Image('test.png', 10, 50, 20, 20, 'png', '', true, false);
          
          // Output a PDF file directly to the browser
          //$mpdf->Output();

          $pdf = new \Mpdf\Mpdf();
          $pdf->SetMargins(4,10,4);
          $pdf->AddPage();
    
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->Image('logo1.svg', 60, 10, 90, 30, 'svg', '', true, false);
    
    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);
    
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Ministerio de Ciencias e Inovacion Tecnologica")),0,'C',false);
    $pdf->SetFont('Arial','',9);
    //$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","RUC: 0000000000"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","CAPE, Pabellon 26"),0,'C',false);
   // $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Email: mincienciaeinovacion@gmail.com"),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date("d/m/Y", strtotime("13-09-2022"))." ".date("h:s A")),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Lugar: Escuela Industrial"),0,'C',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Ticket Nro: $id")),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Invitado: $nombre"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Documento: $dni"),0,'C',false);
    //$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,'C',false);
    //$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Dirección: San Salvador, El Salvador, Centro America"),0,'C',false);

   

   // $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por Particiar"),'',0,'C');

    $pdf->Ln(9);

   /* # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),"COD000001V0001",70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);
    
    # Nombre del archivo PDF #*/

    $pdf->Image('test.png', 90, 110, 30, 30, 'png', '', true, false);
    $pdf->Output("Ticket.pdf","I");