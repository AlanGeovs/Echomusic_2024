<?php
class Product {
	private $host  = 'localhost';
    private $user  = 'echomusicnet_db';
    private $password   = "W4dR9+L/Mi8";
    private $database  = "echomusicnet_db";   
	private $productTable = 'product_details';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error al conectar con MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error en la consulta: '. mysqli_error($conn));
		}
		$data= array();
		
		/*while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {*/
			while ($row = mysqli_fetch_assoc($result)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error en la consulta: '. mysqli_error($conn));
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}		
	public function getBrand(){
		$sqlQuery = "
			SELECT DISTINCT(brand)
			FROM ".$this->productTable." 
			WHERE status = '1' ORDER BY id DESC";
        return  $this->getData($sqlQuery);
	}
	public function getStorage(){
		$sqlQuery = "
			SELECT DISTINCT(storage)
			FROM ".$this->productTable." 
			WHERE status = '1' ORDER BY storage DESC";
        return  $this->getData($sqlQuery);
	}
	public function getRam(){
		$sqlQuery = "
			SELECT DISTINCT(ram)
			FROM ".$this->productTable." 
			WHERE status = '1' ORDER BY ram ASC";
        return  $this->getData($sqlQuery);
	}
	public function searchProducts(){
		$sqlQuery = "SELECT * FROM ".$this->productTable." WHERE status = '1'";
		if(isset($_POST["minPrice"], $_POST["maxPrice"]) && !empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
			$sqlQuery .= "
			AND price BETWEEN '".$_POST["minPrice"]."' AND '".$_POST["maxPrice"]."'";
		}
		if(isset($_POST["brand"])) {
			$brandFilterData = implode("','", $_POST["brand"]);
			$sqlQuery .= "
			AND brand IN('".$brandFilterData."')";
		}
		if(isset($_POST["ram"])){
			$ramFilterData = implode("','", $_POST["ram"]);
			$sqlQuery .= "
			AND ram IN('".$ramFilterData."')";
		}
		if(isset($_POST["storage"])) {
			$storageFilterData = implode("','", $_POST["storage"]);
			$sqlQuery .= "
			AND storage IN('".$storageFilterData."')";
		}
		$sqlQuery .= " ORDER By price";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$totalResult = mysqli_num_rows($result);
		$searchResultHTML = '';
		if($totalResult > 0) {
			/*while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {*/
			while ($row = mysqli_fetch_assoc($result)) {
				$searchResultHTML .= '
				<div class="col-sm-4 col-lg-3 col-md-3">
				<div class="product">
				<img src="images/'. $row['image'] .'"  alt="" class="img-responsive" >
				<p align="center"><strong><a href="#">'. $row['name'] .'</a></strong></p>
				<h4 style="text-align:center;" class="text-danger" >'. $row['price'] .'</h4>
				<p>Camera : '. $row['camera'].' MP<br />
				Brand : '. $row['brand'] .' <br />
				RAM : '. $row['ram'] .' GB<br />
				Storage : '. $row['storage'] .' GB </p>
				</div>
				</div>';
			}
		} else {
			$searchResultHTML = '<h3>No se ha encontrado ningún producto..</h3>';
		}
		return $searchResultHTML;	
	}	
}
?>