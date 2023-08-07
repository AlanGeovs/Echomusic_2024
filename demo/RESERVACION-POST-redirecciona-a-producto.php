<?php 
    include './includes/header.php';
 

$fecha_inicial = $_POST['fi'];
$fecha_final   = $_POST['ff'];
$carga   =       $_POST['car'];

//Diferencia de dias
$fechaNueva = $anio."-".$mes."-".$dia;    
$date1 = new DateTime("$fecha_inicial");
$date2 = new DateTime("$fecha_final");
$diff = $date1->diff($date2); 

//echo "Días solicitaros: ".$diff->days . ' dias<br> ';


if($carga == 'ligera'){
//    $url = 'https://lodela.com.mx/product/carga-ligera/';
    $url = 'https://lodela.com.mx/product/carga-ligera-simple/';
    $pago = 2500*$diff->days;
    
}
if ($carga == 'pesada') {    
    $url = 'https://lodela.com.mx/product/carga-pesada/';
    $pago = 3300*$diff->days;
}


//Inicio envío por post

//$fields = array(
//    'quantity' => $diff->days,
//    'var2' => 'valor2'
//);

//Formulario
echo '<form id="myForm" method="post" action="'.$url.'" style="display: none;">
        <input type="number" name="quantity" id="quantity"> 
        <input type="text" name="custom_note" id="custom_note"> 
      </form>';

 echo '<script>
            $(document).ready(function() {
                $("#quantity").val("'.$diff->days.'"); 
                $("#custom_note").val("'.$fecha_inicial.'"); 

                $("#myForm").submit();
            });
      </script>';

 include './includes/footer.php';