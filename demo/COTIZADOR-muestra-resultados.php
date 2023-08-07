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

//descuentos
if($diff->days < 6) {
    $multiploConDescuento = 1;    
}elseif($diff->days >5 && $diff->days < 15 ) {    
    $multiploConDescuento = 0.75;
}elseif($diff->days >16 ) {  
    $multiploConDescuento = 0.65;
}

if($carga == 'ligera'){
    $url = 'https://lodela.com.mx/product/carga-ligera/';
    $pagoDesc = $multiploConDescuento*2500*$diff->days;
    $pago = 2500*$diff->days;  
}
if ($carga == 'pesada') {    
    $url = 'https://lodela.com.mx/product/carga-pesada/';
    $pagoDesc = $multiploConDescuento*3300*$diff->days;
    $pago = 3300*$diff->days;
}

if(!empty($diff->days)){  
    
    //Boostrap List
    echo '<div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <i class="bi bi-calendar2-week"  style="font-size: 2rem; color: var(--global-color-naranja);"></i>
                <div class="d-flex gap-2 w-100 justify-content-between">
                  <div>
                    <h6 class="mb-0">Entrega y devolución</h6>
                    <p class="mb-0 opacity-75">  '.$fecha_inicial.' - '.$fecha_final.'</p>
                  </div>
                  <small class="opacity-50 text-nowrap">'.$diff->days.' días</small>
                </div>
              </a>
              <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <i class="bi bi-truck"  style="font-size: 2rem; color: var(--global-color-naranja);"></i>
                <div class="d-flex gap-2 w-100 justify-content-between">
                  <div>
                    <h6 class="mb-0"> Carga '.$carga.'</h6>
                    <p class="mb-0 opacity-75">Tipo de servicio seleccionado.</p>
                  </div>
                  <small class="opacity-50 text-nowrap"></small>
                </div>
              </a>
              <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <i class="bi bi-cash-coin"  style="font-size: 2rem; color: var(--global-color-naranja);"></i>
                <div class="d-flex gap-2 w-100 justify-content-between">
                  <div>';
    if($multiploConDescuento == 1){
            echo '
                    <h5 class="mb-0">$'. number_format($pagoDesc,0).' <small>MXN</small></h5>
                    <p class="mb-0 opacity-75">Precio por '.$diff->days.' días, para la renta de servicio carga '.$carga.'.</p>
                  </div>
                  <small class="opacity-50 text-nowrap"> </small>';        
    }else{
            echo '
                    <h6 class="mb-0"><del>$'.number_format($pago,0).' </del></h6> <h5>$'. number_format($pagoDesc,0).' <small>MXN</small></h5>
                    <p class="mb-0 opacity-75">Precio por '.$diff->days.' días, para la renta de servicio carga '.$carga.'.</p>
                  </div>
                  <small class="opacity-50 text-nowrap">'.((1-$multiploConDescuento)*100).'% de<br>descuento</small>';        
    }    
    
    echo '                      
                </div>
              </a>
            </div>
          </div>';

}else{
    echo '<div class="container text-center  ">'
    . 'No hay disponibilidad para '.$diff->days." días"
    . "</div>";
}




include './includes/footer.php';
        
