<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Items.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Items($db);

$items->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $items->read();

$search="../";
$replace="https://inventario.automayore.com/";
$searchPipe="|";
$replace=", ";

function RegeneraImagen($array) {
    $fotos = explode("|", $array);
    
    $total = count($fotos) - 1; 
    for($i=0;$i<=$total;$i++){
        $fotosURL[$i] = "https://inventario.automayore.com/".substr($fotos[$i],3);
    }
//    $img = substr($fotos[0], 3);
    return  $fotosURL;
}

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["items"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "car_code" => $car_code,
            "condicion" => $condicion,
			"tipo" => $tipo,
            "marca" => $marca,
            "modelo" => $modelo,            
			"version" => $version,
            "ano" => $ano,			
            "transmision" => $transmision,			
            "combustible" => $combustible,			
            "kilometraje" => $kilometraje,			
            "color_int" => $color_int,			
            "color_ext" => $color_ext,			
            "tam_motor" => $tam_motor,			
            "cilindros" => $cilindros,			
            "precio" => $precio,			
            "imagen" => RegeneraImagen($IMG),			
            "note" => $note,			
        ); 
       array_push($itemRecords["items"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 