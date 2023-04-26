<?php

if (isset($_FILES["imagen"]["tmp_name"])) {
	$datos=$_FILES["imagen"]["tmp_name"];
	
	$nombre=$_POST["nombre"];

	if (preg_match("/\s/", $nombre)) {
		$nombre=preg_replace("/\s/", "", $nombre);
	}

	list($ancho, $alto) = getimagesize($datos);
		
	//if($ancho < 1600 || $alto < 600){

		//echo 0;

	//}

	//else{

		$aleatorio = mt_rand(1, 99999);

		$ruta = "../images/inventario/".$nombre."-".$aleatorio.".jpg";
//		$ruta2 = "../../img_marcas/".$nombre."-".$aleatorio.".jpg";

		

		#imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL

		$origen = imagecreatefromjpeg($datos);

		#imagecrop() — Recorta una imagen usando las coordenadas, el tamaño, x, y, ancho y alto dados

		//$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);

		#imagejpeg() — Exportar la imagen al navegador o a un fichero

		imagejpeg($origen, $ruta);
//		imagejpeg($origen, $ruta2);

		/*GestorSlideModel::subirImagenSlideModel($ruta, "slide");

		$respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta, "slide");

		$enviarDatos = array("ruta"=>$respuesta["ruta"],
			                 "titulo"=>$respuesta["titulo"],
			                 "descripcion"=>$respuesta["descripcion"]);

		echo json_encode($enviarDatos);*/
		//echo $ruta;
	if ($_POST["imagenes"]!="") {
		if (preg_match("/|\b/", $_POST["imagenes"])) {
			$imagenes=$_POST["imagenes"];
			$imagenes=substr($imagenes, 0, -1);
			$imgs=explode("|", $imagenes);
			array_push($imgs, $ruta);
			for ($i=0; $i < count($imgs); $i++) { 
				echo '<li id="'.$i.'" class="bloqueSlide"><button class=" btn btn-danger btn-lg eliminarSlide" ruta="'.$imgs[$i].'"><i class="icon-trash-can"></i></button><img src="'.substr($imgs[$i],3).'" class="handleImg" width="40%"></li>';
			}
			$img=implode("|", $imgs);
			echo "**".$img;
		}else{
			echo '<li id="0" class="bloqueSlide"><button class=" btn btn-danger btn-lg eliminarSlide" ruta="'.$ruta.'"><i class="icon-trash-can"></i></button><img src="'.substr($ruta,3).'" class="handleImg" width="40%"></li>';
			echo "**".$ruta;
		}

	}else{
		echo '<li id="0" class="bloqueSlide"><button class=" btn btn-danger btn-lg eliminarSlide" ruta="'.$ruta.'"><i class="icon-trash-can"></i></button><img src="'.substr($ruta,3).'" class="handleImg" width="40%"></li>';
			echo "**".$ruta;
	}	

		
		
	//}
}

if (isset($_POST["idSlide"])) {
	$id=$_POST["idSlide"];
	$ruta=$_POST["rutaSlide"];
//	$ruta2="../../img_marcas/".substr($ruta, 16);
	$imagenes=$_POST["imagenes"];
	unlink($ruta);
//	unlink($ruta2);

	$images=explode("|", $imagenes);
	unset($images[$id]);
	array_values($images);

	//var_dump($images);

	$resImg=implode("|", $images);

	/*for ($i=0; $i < count($images); $i++) { 
		$resImg= $images[$i];
		$resImg.="|";
	}*/
	echo $resImg;
	//echo substr($resImg, 0, -1);

	//echo json_encode($images);
	
}
