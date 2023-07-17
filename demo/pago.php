<?php 
    include './includes/header.php';
 
$nombre = $_GET['n'];
$correo = $_GET['c'];
$fecha_inicial = $_GET['fi'];
$fecha_final   = $_GET['ff'];
$carga   = $_GET['car'];

//Diferencia de dias
$fechaNueva = $anio."-".$mes."-".$dia;    
$date1 = new DateTime("$fecha_inicial");
$date2 = new DateTime("$fecha_final");
$diff = $date1->diff($date2); 

//echo "Días solocitaros: ".$diff->days . ' dias<br> ';


if($carga == 'ligera'){
    switch ($diff->days) {
        case 1: 
            $pago="2500";
            $cargaID="fe63dbc648a74c92951b11f6d3dd44bb";            
            break;
        case 2:
            $pago="5000";
            $cargaID="1f431de5450548f7920292443d9441e9";
            break;
        case 3:
            $pago="7500";
            $cargaID="036ece4f38c3465995fac75620fa8b9f";
            break;
        case 4:
            $pago="10000";
            $cargaID="1c5defbe25e94ec98e05f9313ae070da"; 
            break;
        case 5:
            $pago="12500";
            $cargaID="19d8217bd53748cf8984ea69ea8e7b4c"; 
            break;
        default:
            $cargaID = ""; 
            break;
    } 
}

if ($carga == 'pesada') {
    switch ($diff->days) {
        case 1:
            $pago = "3300";
            $cargaID = "4c9d4bef046848448749597b1d7f57d8";
            break;
        case 2:
            $pago = "6600";
            $cargaID = "0464061095f24bd7b2264cb9832d328d";
            break;
        case 3:
            $pago = "9900";
            $cargaID = "df0c18dbd5eb4e80a38503689c5f2321";
            break;
        case 4:
            $pago = "13200";
            $cargaID = "5c67c989e31247ea9d27465195386bce";
            break;
        case 5:
            $pago = "16500";
            $cargaID = "79f79f89b5254136b9765bf1d8ffe084";
            break;
        default:
            $cargaID = ""; 
            break;
    }
}

if(!empty($cargaID)){
    $botonPago =
    '<script src="https://pay.conekta.com/v1.0/js/components.js"></script>
    <conekta-button 
        locale="es"
        size="medium" 
        border="rounded" 
        color="snowberry" 
        logoConekta="show" 
        checkoutId="'.$cargaID.'">
    </conekta-button>';

        
echo  
'<div class="container text-center  ">
  <div class="row justify-content-md-center">
    <div class="col-lg-8 col-md-8">
        <div class="content">
            <div class="row">
                <div class="col-lg-6 col-sm-6 ">
                    Nombre
                </div>
                <div class="col-lg-6 col-sm-6">
                    '.$nombre.'
                </div>
                <div class="col-lg-6 col-sm-6">
                    Correo
                </div>
                <div class="col-lg-6 col-sm-6">
                    '.$correo.'
                </div>
                <div class="col-lg-6 col-sm-6">
                    Fecha de entrega
                </div>
                <div class="col-lg-6 col-sm-6">
                    '.$fecha_inicial.'
                </div>
                <div class="col-lg-6 col-sm-6">
                    Fecha de devolución
                </div>
                <div class="col-lg-6 col-sm-6">
                    '.$fecha_final.'
                </div>
                <div class="col-lg-6 col-sm-6">
                    Carga
                </div>
                <div class="col-lg-6 col-sm-6">
                    '.$carga.'
                </div>
                <div class="col-lg-6 col-sm-6">
                    Precio
                </div>
                <div class="col-lg-6 col-sm-6">
                    $'. number_format($pago,0).' MXN
                </div>
                <div class="col-lg-12 col-sm-12">
                    '.$botonPago.'
                </div>
            </div>
        </div>
    </div> 
  </div>
</div>';

}else{
    echo '<div class="container text-center  ">'
    . 'No hay disponibilidad para '.$diff->days." días"
    . "</div>";
}


include './includes/footer.php';
        
