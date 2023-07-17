<?php
class coverPicChange {
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
	public function changeCoverPhoto() {
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
		$picName = $_FILES['coverImage']['name'];
		$size = $_FILES['coverImage']['size'];
		if(strlen($picName)) {
			$ext = pathinfo($_FILES["coverImage"]["name"], PATHINFO_EXTENSION);
			// list($txt, $ext) = explode(".", $picName);
			if(in_array($ext,$validFormats)) {
				if($size<(10240*10240)) {

					$queryProjectId = "SELECT id_project FROM projects_crowdfunding WHERE id_user='$userId' AND status_project IN ('0', '1') ORDER BY id_project DESC LIMIT 1";
					$result = mysqli_query($this->dbConnect, $queryProjectId);
					$arrayProjectId = $result->fetch_assoc();
					$imgRename = $arrayProjectId['id_project'];

					$actualImageName = $imgRename .'.jpg';
					$filePath = $path .'/'.$actualImageName;
					$filePath2 = $path2 .'/'.$actualImageName;
					$tmp = $_FILES['coverImage']['tmp_name'];

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
								$scale2 = ($maxHeight2/$height);
							}else{
								$scale = $maxWidth/$width;
								$scale2 = ($maxWidth2/$width);
							}
							$uploaded = $this->resizeImage($filePath,$width,$height,$scale, $ext);
							$uploaded2 = $this->resizeImage($filePath2,$width2,$height2,$scale2, $ext);
							// $this->image_fix_orientation($uploaded, $filePath);
						} else {

							$scale = $maxHeight/$height;
							$uploaded = $this->resizeImage($filePath,$width,$height,$scale, $ext);
							$scale2 = $maxHeight2/$height;
							$uploaded2 = $this->resizeImage($filePath2,$width2,$height2,$scale2, $ext);
							// $this->image_fix_orientation($uploaded, $filePath);
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
	public function saveCoverPhoto() {
		$post = isset($_POST) ? $_POST: array();
		// $userId = isset($post['id']) ? intval($post['id']) : 0;
		$userId = $_SESSION['user'];

		$queryProjectId = "SELECT id_project FROM projects_crowdfunding WHERE id_user='$userId' AND status_project IN ('0', '1') ORDER BY id_project DESC LIMIT 1";
		$result = mysqli_query($this->dbConnect, $queryProjectId);
		$arrayProjectId = $result->fetch_assoc();
		$prId = $arrayProjectId['id_project'];

		$path = '../images/tmp2/'.$_POST['imageName'];
		$tmpWidth = 1920;
		$tmpHeight = 1080;
		if(isset($_POST['t']) and $_POST['t'] == "ajax") {
			extract($_POST);
			$imagePath = '../images/crowdfunding/pr_'.$prId.'/'.$_POST['imageName'];
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
			imagejpeg($nimg,$imagePath,90);
		}
		// $updateQuery = "
		// 	UPDATE ".$this->userTable."
		// 	SET photo = '".$_POST['imageName']."'
		// 	WHERE id = '$userId'";
		// mysqli_query($this->dbConnect, $updateQuery);
		$imagePath = '../images/crowdfunding/pr_'.$prId.'/'.$_POST['imageName'];
		$dynamicPath = 'images/crowdfunding/pr_'.$prId.'/'.$_POST['imageName'];
		$saveImagePath = $imagePath.'?'.time();
		// echo $saveImagePath;
		// echo '"background-image", "linear-gradient(to top, rgba(50, 50, 50, 0.8), rgba(0, 1, 13, 0.5)), url("../'.$saveImagePath.'.jpg")"';
		// echo '"linear-gradient(to top, rgba(50, 50, 50, 0.8), rgba(0, 1, 13, 0.5)), url("../'.$saveImagePath.'.jpg")"';
		echo 'linear-gradient(to top, rgba(50, 50, 50, 0.8), rgba(0, 1, 13, 0.5))& ';
		echo 'url("../'.$saveImagePath.'.jpg")&';
		echo $dynamicPath.'?'.time();

		// exit(0);
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
