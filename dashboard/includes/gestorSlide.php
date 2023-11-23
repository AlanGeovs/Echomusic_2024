<?php

if (isset($_FILES["imagen"]["tmp_name"])) {
	$datos = $_FILES["imagen"]["tmp_name"];
	$nombre = $_POST["nombre"];

	if (preg_match("/\s/", $nombre)) {
		$nombre = preg_replace("/\s/", "", $nombre);
	}

	list($ancho, $alto) = getimagesize($datos);

	//if($ancho < 1600 || $alto < 600){

	//echo 0;

	//}

	//else{

	$aleatorio = mt_rand(1, 99999);

	$ruta = "../images/usuarios/" . $nombre . "-" . $aleatorio . ".jpg";
	// $ruta2 = "../../img_marcas/" . $nombre . "-" . $aleatorio . ".jpg";

	#imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL

	$origen = imagecreatefromjpeg($datos);

	#imagecrop() — Recorta una imagen usando las coordenadas, el tamaño, x, y, ancho y alto dados

	//$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);

	#imagejpeg() — Exportar la imagen al navegador o a un fichero

	imagejpeg($origen, $ruta);
	// imagejpeg($origen, $ruta2);

	/*GestorSlideModel::subirImagenSlideModel($ruta, "slide");

		$respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta, "slide");

		$enviarDatos = array("ruta"=>$respuesta["ruta"],
			                 "titulo"=>$respuesta["titulo"],
			                 "descripcion"=>$respuesta["descripcion"]);

		echo json_encode($enviarDatos);*/
	echo $ruta;
	//}
}
