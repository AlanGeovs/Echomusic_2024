<?php
class Database{
	
    private $user = 'am_inventariov2';
    private $password = "Y)])HDIHRo&p";
    private $database = "am_inventariov2";
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>