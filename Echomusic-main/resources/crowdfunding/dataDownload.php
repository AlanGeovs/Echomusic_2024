<?php
define('ROOT_PATH', dirname(__DIR__) . '/');
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

// Conectar base de datos
  include (ROOT_PATH.'connect.php');

  $userid = $_SESSION['user'];

//Get project Id with user id
  $queryCheckUser = mysqli_query($conn, "SELECT id_project FROM projects_crowdfunding WHERE id_user='$userid' AND status_project IN ('1','2') ORDER BY id_project DESC LIMIT 1");
  if(mysqli_num_rows($queryCheckUser)>0){
    $checkUserArray = mysqli_fetch_assoc($queryCheckUser);
    $id_project = $checkUserArray['id_project'];
  }else{
    echo "El inicio de sesión no coincide con los datos solicitados.";
    die();
  }

// Filter the excel data
  function filterData(&$str){
      $str = preg_replace("/\t/", "\\t", $str);
      $str = preg_replace("/\r?\n/", "\\n", $str);
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

// Excel file name for download
$fileName = "datos_patrocinadores_" . date('d-m-Y') . ".xls";

// Column names
$fields = array('NOMBRE', 'APELLIDO', 'E-MAIL', 'RECOMPENSA', 'MONTO', 'FECHA');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database
$query = mysqli_query($conn, "SELECT first_name_user, last_name_user, mail_user, tier_slot, backer_amount, backer_added_amount, backer_date FROM project_backers LEFT JOIN users ON project_backers.id_user = users.id_user
                                                                                                                                                                 LEFT JOIN project_tiers ON project_backers.id_tier = project_tiers.id_tier WHERE project_backers.id_project='$id_project' AND status_backer='1'");
if(mysqli_num_rows($query) > 0){
    // Output each row of the data
    while($row = mysqli_fetch_assoc($query)){
        $total_amount = number_format($row['backer_amount']+$row['backer_added_amount'] , 0, ',', '.');
        $lineData = array($row['first_name_user'], $row['last_name_user'], $row['mail_user'], $row['tier_slot'], $total_amount, $row['backer_date']);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
}else{
    $excelData .= 'No se encontraron datos...'. "\n";
}

// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data
echo $excelData;

exit;
?>
