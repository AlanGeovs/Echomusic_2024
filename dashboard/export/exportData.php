<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 



 
// Fetch records from database 
$query = $db->query("SELECT * FROM inventario ORDER BY id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
//    $filename = "am_inventario_" . date('Y-m-d') . ".csv"; 
    $filename = "am_inventario.csv"; 
    
    
        function RegeneraImagen($array) {
           $fotos = explode("|", $array);

           $total = count($fotos) - 1; 
           for($i=0;$i<=$total;$i++){
               $fotosURL[$i] = "https://inventario.automayore.com/".substr($fotos[$i],3);
           }
       //    $img = substr($fotos[0], 3);
           return  $fotosURL;
       }


//RegeneraImagen($IMG)
    // Create a file pointer 
//    $f = fopen('php://memory', 'w'); 
    $f = fopen('am_inventario.csv', 'w'); 
     
    // Set column headers 
    $fields = array('id', 'car_code', 'condicion', 'tipo', 'marca', 'modelo', 'version', 'ano', 'precio','transmision','combustible','kilometraje','color_int','color_ext','tam_motor','cilindros', 'IMG'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['id'], $row['car_code'], $row['condicion'], $row['tipo'], $row['marca'], $row['modelo'], $row['version'], $status, $row['precio'], $row['transmision'], $row['combustible'], $row['kilometraje'], $row['color_int'], $row['color_ext'], $row['tam_motor'], $row['cilindros'],  RegeneraImagen($row['IMG'])[0] ); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>