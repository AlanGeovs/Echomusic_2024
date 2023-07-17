<?php

// Variables string
  $randStrURL = random_str(32);
  $randQRName = random_str(8);
  $rutaQR = 'https://echomusic.cl/images/qr-temps/'.$randQRName.'.png';

// Generar QR con identificador único de entrada
QRcode::png('https://echomusic.cl/services/ticket_verify.php?ticket='.$randStrURL.'', '/home2/echomusi/public_html/images/qr-temps/'.$randQRName.'.png'); // creates file


?>
