<?php
function fecha($fecha){
	$meses=array("01"=>"enero","02"=>"febrero","03"=>"marzo","04"=>"abril","05"=>"mayo","06"=>"junio","07"=>"julio","08"=>"agosto","09"=>"septiembre","10"=>"octubre","11"=>"noviembre","12"=>"diciembre");
    $fecha=preg_replace('/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/', "\\3/\\2/\\1", $fecha);
    $mes=substr($fecha, 3,2);
    $fecha=substr($fecha, 0,3).$meses[$mes].substr($fecha, 5,5);
    return $fecha;
}

function fechaHora($fecha){
	$meses=array("01"=>"enero","02"=>"febrero","03"=>"marzo","04"=>"abril","05"=>"mayo","06"=>"junio","07"=>"julio","08"=>"agosto","09"=>"septiembre","10"=>"octubre","11"=>"noviembre","12"=>"diciembre");
    $fecha=preg_replace('/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/', "\\3/\\2/\\1", $fecha);
    $mes=substr($fecha, 3,2);
    $fecha=substr($fecha, 0,3).$meses[$mes].substr($fecha, 5);
    return $fecha;
}

function obtener_estructura_directorios($ruta){
    $carpeta=array();
    // Se comprueba que realmente sea la ruta de un directorio
    if (is_dir($ruta)){
        // Abre un gestor de directorios para la ruta indicada
        $gestor = opendir($ruta);
        
        // Recorre todos los elementos del directorio
        while (($archivo = readdir($gestor)) !== false)  {
            
            $ruta_completa = $ruta . "/" . $archivo;

            // Se muestran todos los archivos y carpetas excepto "." y ".."
            if ($archivo != "." && $archivo != "..") {
                // Si es un directorio se recorre recursivamente
                #if(!(preg_match('/\.[A-Za-z0-9]+$/',$archivo))){
                    #$carpeta = array($archivo);
                    array_push($carpeta, $archivo);
                #}
            }
        }
        // Cierra el gestor de directorios
        closedir($gestor);
    } else {
        echo "No es una ruta de directorio valida<br/>";
    }
    sort($carpeta);
    return $carpeta;
}