<?php
class bandPicChange {
	private $host  = 'localhost';
  private $user  = 'echomusi_admin_1';
  private $password   = "mL=D]OUo_]L0";
  private $database  = "echomusi_db_1";

	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	public function getUser() {
		$sqlQuery = "
			SELECT id, name, email, phone, photo, skills, website, designation, city, country
			FROM ".$this->userTable."
			WHERE id = 1";		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$data= mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $data;
	}

	public function changeBandPhoto() {
		$post = isset($_POST) ? $_POST: array();
		$maxWidth = "500";
		$maxWidth2 = "1920";
		$maxHeight = "480";
		$maxHeight2 = "1080";

		function isMobileDevice() {
		    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
		|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
		, $_SERVER["HTTP_USER_AGENT"]);
		}
		if(isMobileDevice()){
			$maxWidth = "290";
			$maxWidth2 = "580";

		}
		else {
			$maxWidth2 = "1000";
			$maxWidth = "500";
		}

		$userId = $_SESSION['user'];
		$path = '../images/tmp';
		$path2 = '../images/tmp2';
		$validFormats = array("jpg", "JPG", "png", "PNG", "jpeg", "JPEG");
		$picName = $_FILES['bandImage']['name'];
		$size = $_FILES['bandImage']['size'];
		if(strlen($picName)) {
			$ext = pathinfo($_FILES["bandImage"]["name"], PATHINFO_EXTENSION);
			// list($txt, $ext) = explode(".", $picName);
			if(in_array($ext,$validFormats)) {
				if($size<(10240*10240)) {
					$imgRename = str_replace(".", "_", uniqid(mt_rand(), true));
					$actualImageName = $imgRename .'.jpg';
					$filePath = $path .'/'.$actualImageName;
					$filePath2 = $path2 .'/'.$actualImageName;
					$tmp = $_FILES['bandImage']['tmp_name'];
					if(move_uploaded_file($tmp, $filePath)) {
						$width = $this->getWidth($filePath);
						$height = $this->getHeight($filePath);

						 if(copy($filePath, $filePath2)) {
							$width2 = $this->getWidth($filePath2);
							$height2 = $this->getHeight($filePath2);
						}

						if ($width > $maxWidth){

							if($height>$width){
								$scale = $maxHeight/$height;
								$scale2 = $maxHeight2/$height2;
							}else{
								$scale = $maxWidth/$width;
								$scale2 = $maxWidth2/$width2;
							}
							$uploaded = $this->resizeImage($filePath,$width,$height,$scale, $ext);
							$uploaded = $this->resizeImage($filePath2,$width2,$height2,$scale2, $ext);

						} else {

							$scale = $maxHeight/$height;
							$uploaded = $this->resizeImage($filePath,$width,$height,$scale, $ext);
							$scale2 = $maxHeight2/$height;
							$uploaded = $this->resizeImage($filePath2,$width2,$height2,$scale2, $ext);
						}
						$filePath = '/images/tmp/'.$actualImageName;
						echo "<img id='photoPResize' file-name='".$actualImageName."' class='' src='".$filePath.'?'.time()."' class='preview'/>";
						// echo '"background-image", "linear-gradient(to top, rgba(50, 50, 50, 0.8), rgba(0, 1, 13, 0.5)), url("../'.$filePath.'?'.time().'".jpg"';
					}
					else
					echo "Ha sucedido un error, por favor inténtalo de nuevo";
				}
				else
				echo "La imagen excede el peso de 5MB";
			}
			else
			echo "Por favor, elige una imagen de formato JPG o PNG";
		}
		else
		echo "Por favor, elige una imagen para subir";
		exit;
	}
	public function saveBandPhoto() {
		$post = isset($_POST) ? $_POST: array();
		// $userId = isset($post['id']) ? intval($post['id']) : 0;
		// SANITIZAR
		$userId = $_SESSION['user'];
		$path = '../images/tmp2/'.$_POST['imageName'];
		$tmpWidth = 500;
		$tmpHeight = 500;
		if(isset($_POST['t']) and $_POST['t'] == "ajax") {
			extract($_POST);
			$imagePath = '../images/band_members/'.$_POST['imageName'];
			$w1 = $w1*2;
			$h1 = $h1*2;
			$x1 = $x1*2;
			$y1 = $y1*2;
			$ratio = ($tmpWidth/$w1);
			$nw = ceil($w1 * $ratio);
			$nh = ceil($h1 * $ratio);
			// echo 'console.log("\n <br> --: '.$w1." - ".$h1." - ".$x1." - ".$y1.'");';
			$nimg = imagecreatetruecolor($nw,$nh);
			$imgSrc = imagecreatefromjpeg($path);
			imagecopyresampled($nimg,$imgSrc,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
			imagejpeg($nimg,$imagePath,90);
		}
		// $updateQuery = "
		// 	UPDATE ".$this->userTable."
		// 	SET photo = '".$_POST['imageName']."'
		// 	WHERE id = '$userId'";
		// mysqli_query($this->dbConnect, $updateQuery);
		$imagePath = '../images/band_members/'.$_POST['imageName'];

		$saveImagePath = $imagePath.'?'.time();

		// exit(0);
	}

	public function saveBandInfo(){
// SANITIZAR
		$userid = $_SESSION['user'];
		$imgRename = str_replace('.jpg', '', $_POST['imageName']);

		$fname_member = trim($_POST['fname']);
	  $fname_member = strip_tags($fname_member);
	  $fname_member = htmlspecialchars($fname_member);
	  $fname_member = mysqli_real_escape_string($this->dbConnect, $fname_member);

	  $lname_member = trim($_POST['lname']);
	  $lname_member = strip_tags($lname_member);
	  $lname_member = htmlspecialchars($lname_member);
	  $lname_member = mysqli_real_escape_string($this->dbConnect, $lname_member);

	  $instrument_member = FILTER_INPUT(INPUT_POST, 'instrument', FILTER_VALIDATE_INT, 1);
	  $instrument_member = strip_tags($instrument_member);
	  $instrument_member = htmlspecialchars($instrument_member);
	  $instrument_member = mysqli_real_escape_string($this->dbConnect, $instrument_member);

		if(!filter_var($instrument_member, FILTER_VALIDATE_INT, 1 )){
	    $error = true;
	    $instrument_memberError = "Instrumento inválido.";
	  }

	  if (strlen($fname_member) < 3) {
	   $error = true;
	   $fname_memberError = "El nombre debe tener más de 3 caracteres.";
	 }else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$fname_member)) {
	   $error = true;
	   $fname_memberError = "El nombre solo puede contener letras";
	  }

	  if (strlen($lname_member) < 3) {
	   $error = true;
	   $lname_memberError = "El apellido debe tener más de 3 caracteres.";
	 }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$lname_member)) {
	   $error = true;
	   $lname_memberError = "El apellido solo puede contener letras";
	  }

		if( !$error ) {
	      $queryBandMember = "INSERT INTO band_members(id_user, first_name_member, last_name_member, instrument_member, img_member) VALUES ('$userid', '$fname_member', '$lname_member', '$instrument_member', '$imgRename')";
	      if (mysqli_query($this->dbConnect, $queryBandMember)) {
	         $errTyp = "success";
	         $errMSG = "Información agregada con éxito, redirigiendo a tu perfil...";
	         echo "success";
	         // header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
	         exit();
	      }else {
	       $errTyp = "danger";
	       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
	       echo "danger";
	      }

	   }else{
	     $errTyp = "danger";
	     $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo";
	     echo "danger";
	   }

	}

	public function resizeImage($image,$width,$height,$scale, $ext) {
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch ($ext) {
			case 'jpg':
			case 'jpeg':
			case 'JPG':
			case 'JPEG':
				$source = imagecreatefromjpeg($image);
				break;
			case 'gif':
				$source = imagecreatefromgif($image);
				break;
			case 'png':
			case 'PNG':
				$source = imagecreatefrompng($image);
				break;
			default:
				$source = false;
				break;
		}

		if($this->image_fix_orientation($source, $image)==true){
			$width_2 = $height;
			$height_2 = $width;
			$newImageWidth = ceil($width_2 * $scale);
			$newImageHeight = ceil($height_2 * $scale);
			$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
			imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width_2,$height_2);
		}else{
			imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		}

		imagejpeg($newImage,$image,90);
		chmod($image, 0777);
		return $image;
	}
	public function getHeight($image) {
		$sizes = getimagesize($image);
		$height = $sizes[1];
		return $height;
	}
	public function getWidth($image) {

		$sizes = getimagesize($image);
		$width = $sizes[0];
		return $width;
	}

	public function image_fix_orientation(&$image, $filename) {
    $exif = @exif_read_data($filename);

    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
								return true;
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
								return true;
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
								return true;
                break;
        }
    }
	}

}
?>
