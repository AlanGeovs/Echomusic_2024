<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['region']) && !empty($_POST['region'])):
  $region = $_POST['region'];
  $region = mysqli_real_escape_string($conn, $region);

  if(isset($_SESSION['selectedCity'])){
    $selectedCity = $_SESSION['selectedCity'];
  }

   $queryCityRegion = mysqli_query($conn, "SELECT * FROM regions_cities LEFT JOIN cities ON regions_cities.id_city=cities.id_city WHERE id_region='$region'");
   $arrayCities = array();
   while($cities = mysqli_fetch_array($queryCityRegion)){
     $arrayCities[] = $cities;
   }
?>

 <!-- Print DATA -->

<? foreach($arrayCities as $cities):?>
  <?=$selected = ($selectedCity == $cities['id_city']) ? "selected" : "" ?>
    <option value="<?=$cities['id_city']?>" <?=$selected?>><?=$cities['name_city']?></option>
    <? unset($selected); ?>
<? endforeach; ?>
<?=$selectedCity?>

<? endif; ?>
