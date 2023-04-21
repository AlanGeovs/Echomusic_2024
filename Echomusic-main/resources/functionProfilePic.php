<?php
error_reporting(0);

class avatarPicChange {

	private $host  = 'localhost';
  private $user  = 'echomusi_admin_1';
  private $password   = "mL=D]OUo_]L0";
  private $database  = "echomusi_db_2";

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

	public function changeProfilePhoto() {
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
			$maxWidth2 = "580";
			$maxWidth = "290";
		}
		else {
			$maxWidth2 = "1000";
			$maxWidth = "500";
		}

		$userId = $_SESSION['user'];
		$path = '../images/tmp';
		$path2 = '../images/tmp2';
		$validFormats = array("jpg", "JPG", "png", "PNG", "jpeg", "JPEG");
		$picName = $_FILES['profileImage']['name'];
		$size = $_FILES['profileImage']['size'];

		if(strlen($picName)) {
			$ext = pathinfo($_FILES["profileImage"]["name"], PATHINFO_EXTENSION);
			// list($txt, $ext) = explode(".", $picName);

			if(in_array($ext,$validFormats)) {
				//if($size<(1024*1024)) {
				if($size<(10240*10240)) {
					$actualImageName = $userId .'.jpg';
					$filePath = $path .'/'.$actualImageName;
					$filePath2 = $path2 .'/'.$actualImageName;
					$tmp = $_FILES['profileImage']['tmp_name'];
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
								$scale2 = $maxHeight2/$height;
							}else{
								$scale = $maxWidth/$width;
								$scale2 = $maxWidth2/$width;
							}
							$uploaded = $this->resizeImage($filePath,$width,$height,$scale, $ext);
							$uploaded2 = $this->resizeImage($filePath2,$width2,$height2,$scale2, $ext);
						} else {

							$scale = $maxHeight/$height;
							$uploaded = $this->resizeImage($filePath,$width,$height,$scale, $ext);
							$scale2 = $maxHeight2/$height;
							$uploaded2 = $this->resizeImage($filePath2,$width2,$height2,$scale2, $ext);
						}
						$filePath = '/images/tmp/'.$actualImageName;
						echo "<img id='photoPResize' file-name='".$actualImageName."' class='' src='".$filePath.'?'.time()."' class='preview'/>";

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
	public function saveProfilePhoto() {
		$post = isset($_POST) ? $_POST: array();
		// $userId = isset($post['id']) ? intval($post['id']) : 0;
		$userId = $_SESSION['user'];
		$path = '../images/tmp2/'.$_POST['imageName'];
		$tmpWidth = 500;
		$tmpHeight = 480;
		if(isset($_POST['t']) and $_POST['t'] == "ajax") {
			extract($_POST);
			$imagePath = '../images/avatars/'.$_POST['imageName'];
			$w1 = $w1*2;
			$h1 = $h1*2;
			$x1 = $x1*2;
			$y1 = $y1*2;
			$ratio = ($tmpWidth/$w1);
			$nw = ceil($w1 * $ratio);
			$nh = ceil($h1 * $ratio);
			$nimg = imagecreatetruecolor($nw,$nh);
			$imgSrc = imagecreatefromjpeg($path);
			imagecopyresampled($nimg,$imgSrc,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
			if(!imagejpeg($nimg,$imagePath,90)){
				echo 'danger';
			}else{
				$queryUpdatePicture = "UPDATE users SET picture_ready='1' WHERE id_user='$userId'";
				mysqli_query($this->dbConnect, $queryUpdatePicture);
				$imagePath = '../images/avatars/'.$_POST['imageName'];
				$saveImagePath = $imagePath.'?'.time();
				echo $saveImagePath;
				exit(0);
			}
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
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
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
}
?>
