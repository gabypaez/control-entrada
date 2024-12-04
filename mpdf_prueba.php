<?php

require_once("phpqrcode/qrlib.php");

QRcode::png("Hola","test.png");

// Require composer autoload
require_once __DIR__ . '/mpdf/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
//$mpdf->WriteHTML('Hello World');

$mpdf->Image('test.png', 10, 10, 20, 20, 'png', '', true, false);

// Output a PDF file directly to the browser
$mpdf->Output();