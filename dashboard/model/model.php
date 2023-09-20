<?php

require_once "conexion.php";

class Consultas  extends Conexion
{
	// public static function validarLogin($correo, $password)
	// {
	// 	$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo=:correo AND confirmPass=:password");
	// 	$stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
	// 	$stmt->bindParam(":password", $password, PDO::PARAM_STR);
	// 	$stmt->execute();
	// 	return $stmt->fetch();
	// 	$stmt->close();
	// }

	public static function validarLogin($correo, $password)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo=:correo AND confirmPass=:password");
		$stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->closeCursor();  // Liberar el cursor
		return $result;
	}
	public static function validarLoginUsuario($usuario, $password)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND confirmPass=:password");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->closeCursor();  // Liberar el cursor
		return $result;
	}

	public function listarClases()
	{
		$stmt = Conexion::conectar()->prepare("SELECT ID, TAG FROM categorias");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Listado de Asociados
	public function listarAsociados()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, tipo FROM usuarios WHERE tipo like 'asociado'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Listado de Combustibles
	public function listarCombustible()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, combustible  FROM combustible WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Listado de Tipo de Autos
	public function listarTipo()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, tipo  FROM tipo WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}


	public static function registraEncuesta($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla  ( note,  observaciones, id_usuario, geoloc, encuesta_code,  id_asociado, alc, calle, next,  nint, col, sec,  cred,  gen,  p_1,  p_2, p_2_a, p_2_b, p_2_c,  p_3,  p_4,  p_5,  p_6,       p_6_a,p_6_b,p_6_c,p_6_d,p_6_e,p_6_f,p_6_g,p_6_h,      p_7,  p_7_a, p_7_b, p_7_c, p_7_d, p_7_e, p_7_f, p_7_g, p_7_h, p_7_i, p_7_j,  p_8, p_8_a, p_8_b, p_8_c, p_8_d, p_8_e, p_8_f, p_8_g, p_8_h, p_8_i, p_8_j,  p_9,  p_10, p_11,         p_12,     p_13, p_13_a, p_13_b, p_13_c, p_13_d,  p_14, p_14_a, p_14_b, p_14_c, p_14_d,  p_15, p_15_a, p_15_b, p_15_c, p_15_d,  p_16, p_16_a, p_16_b, p_16_c, p_16_d,   p_17, p_17_a, p_17_b, p_17_c, p_17_d,   p_18, p_18_a, p_18_b, p_18_c, p_18_d,  p_19, p_19_a, p_19_b, p_19_c, p_19_d,  p_20, p_21, p_22, p_23   ) "
			. "                               VALUES (:note, :observaciones,:id_usuario,:geoloc,:encuesta_code, :id_asociado,:alc,:calle,:next, :nint, :col,:sec, :cred, :gen, :p_1, :p_2,  :p_2_a,  :p_2_b,  :p_2_c, :p_3, :p_4, :p_5, :p_6,:p_6_a,:p_6_b,:p_6_c,:p_6_d,:p_6_e,:p_6_f,:p_6_g,:p_6_h,    :p_7,:p_7_a,:p_7_b,:p_7_c,:p_7_d,:p_7_e,:p_7_f,:p_7_g,:p_7_h,:p_7_i,:p_7_j,  :p_8,:p_8_a,:p_8_b,:p_8_c,:p_8_d,:p_8_e,:p_8_f,:p_8_g,:p_8_h,:p_8_i,:p_8_j, :p_9, :p_10, :p_11, :p_12,   :p_13,:p_13_a,:p_13_b,:p_13_c,:p_13_d, :p_14,:p_14_a,:p_14_b,:p_14_c,:p_14_d,  :p_15,:p_15_a,:p_15_b,:p_15_c,:p_15_d, :p_16,:p_16_a,:p_16_b,:p_16_c,:p_16_d,  :p_17,:p_17_a,:p_17_b,:p_17_c,:p_17_d, :p_18,:p_18_a,:p_18_b,:p_18_c,:p_18_d, :p_19,:p_19_a,:p_19_b,:p_19_c,:p_19_d, :p_20, :p_21, :p_22, :p_23   )");
		$stmt->bindParam(":note", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":geoloc", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":encuesta_code", $datosModel[4], PDO::PARAM_STR);
		$stmt->bindParam(":id_asociado", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":alc",  $datosModel[6], PDO::PARAM_INT);
		$stmt->bindParam(":calle", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":next", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":nint", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":col",  $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":sec",  $datosModel[11], PDO::PARAM_INT);
		$stmt->bindParam(":cred", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":gen",  $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":p_1", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":p_2", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":p_2_a", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":p_2_b", $datosModel[17], PDO::PARAM_STR);
		$stmt->bindParam(":p_2_c", $datosModel[18], PDO::PARAM_STR);
		$stmt->bindParam(":p_3", $datosModel[19], PDO::PARAM_STR);
		$stmt->bindParam(":p_4", $datosModel[20], PDO::PARAM_STR);
		$stmt->bindParam(":p_5", $datosModel[21], PDO::PARAM_STR);
		$stmt->bindParam(":p_6", $datosModel[22], PDO::PARAM_STR);
		$stmt->bindParam(":p_6_a", $datosModel[23], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_b", $datosModel[24], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_c", $datosModel[25], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_d", $datosModel[26], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_e", $datosModel[27], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_f", $datosModel[28], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_g", $datosModel[29], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_h", $datosModel[30], PDO::PARAM_INT);
		$stmt->bindParam(":p_7", $datosModel[31], PDO::PARAM_STR);
		$stmt->bindParam(":p_7_a", $datosModel[32], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_b", $datosModel[33], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_c", $datosModel[34], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_d", $datosModel[35], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_e", $datosModel[36], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_f", $datosModel[37], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_g", $datosModel[38], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_h", $datosModel[39], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_i", $datosModel[40], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_j", $datosModel[41], PDO::PARAM_INT);
		$stmt->bindParam(":p_8",  $datosModel[42], PDO::PARAM_STR);
		$stmt->bindParam(":p_8_a", $datosModel[43], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_b", $datosModel[44], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_c", $datosModel[45], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_d", $datosModel[46], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_e", $datosModel[47], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_f", $datosModel[48], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_g", $datosModel[49], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_h", $datosModel[50], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_i", $datosModel[51], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_j", $datosModel[52], PDO::PARAM_INT);
		$stmt->bindParam(":p_9", $datosModel[53], PDO::PARAM_STR);
		$stmt->bindParam(":p_10", $datosModel[54], PDO::PARAM_STR);
		$stmt->bindParam(":p_11", $datosModel[55], PDO::PARAM_STR);
		$stmt->bindParam(":p_12", $datosModel[56], PDO::PARAM_STR);
		$stmt->bindParam(":p_13", $datosModel[57], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_a", $datosModel[58], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_b", $datosModel[59], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_c", $datosModel[60], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_d", $datosModel[61], PDO::PARAM_STR);
		$stmt->bindParam(":p_14", $datosModel[62], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_a", $datosModel[63], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_b", $datosModel[64], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_c", $datosModel[65], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_d", $datosModel[66], PDO::PARAM_STR);
		$stmt->bindParam(":p_15", $datosModel[67], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_a", $datosModel[68], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_b", $datosModel[69], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_c", $datosModel[70], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_d", $datosModel[71], PDO::PARAM_STR);
		$stmt->bindParam(":p_16", $datosModel[72], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_a", $datosModel[73], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_b", $datosModel[74], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_c", $datosModel[75], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_d", $datosModel[76], PDO::PARAM_STR);
		$stmt->bindParam(":p_17", $datosModel[77], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_a", $datosModel[78], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_b", $datosModel[79], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_c", $datosModel[80], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_d", $datosModel[81], PDO::PARAM_STR);
		$stmt->bindParam(":p_18", $datosModel[82], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_a", $datosModel[83], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_b", $datosModel[84], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_c", $datosModel[85], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_d", $datosModel[86], PDO::PARAM_STR);
		$stmt->bindParam(":p_19", $datosModel[87], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_a", $datosModel[88], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_b", $datosModel[89], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_c", $datosModel[90], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_d", $datosModel[91], PDO::PARAM_STR);
		$stmt->bindParam(":p_20", $datosModel[92], PDO::PARAM_STR);
		$stmt->bindParam(":p_21", $datosModel[93], PDO::PARAM_STR);
		$stmt->bindParam(":p_22", $datosModel[94], PDO::PARAM_STR);
		$stmt->bindParam(":p_23", $datosModel[95], PDO::PARAM_STR);;

		// $stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public function registrarInventario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (car_code, id_asociado, condicion, tipo, marca, modelo, version, ano, precio, transmision, combustible, kilometraje, color_int, color_ext, tam_motor, cilindros, note, observaciones, img, id_usuario) VALUES (:car_code, :asociado, :condicion, :tipo, :marca, :modelo, :version, :ano, :precio, :transmision, :combustible, :kilometraje, :color_int, :color_ext, :tam_motor, :cilindros, :note, :observaciones, :img, :idUser)");
		//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code, id_asociado, condicion, tipo, marca, modelo) VALUES (:car_code, :asociado, :condicion, :tipo, :marca, :modelo)");
		//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code ) VALUES (:car_code )");
		$stmt->bindParam(":car_code", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":asociado", $datosModel[1], PDO::PARAM_INT);
		$stmt->bindParam(":condicion", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datosModel[4], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datosModel[5], PDO::PARAM_STR);
		$stmt->bindParam(":version", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":ano", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datosModel[8], PDO::PARAM_INT);
		$stmt->bindParam(":transmision", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":combustible", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":kilometraje", $datosModel[11], PDO::PARAM_INT);
		$stmt->bindParam(":color_int", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":color_ext", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":tam_motor", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":cilindros", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":note", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datosModel[17], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[18], PDO::PARAM_STR);
		$stmt->bindParam(":idUser", $datosModel[19], PDO::PARAM_INT);

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public function registrarMarcas($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (DENOM,CLASE,TITULAR,NO_REG,NO_SOL,ULTIMA_CERT_NOTARIAL,VIGENCIA,PAIS_ORI,C_LINK,C_TEL,C_FAX,C_EMAIL,PROD_SERV,AUTORIZADOS,URL_FUENTE,OBS,IMG,ID_USUARIO) VALUES (:denom, :clase, :titular, :no_reg, :no_sol, :ultima_cert, :vigencia, :pais, :link, :tel, :fax, :correo, :servicio, :autorizados, :fuente, :obs, :img, :idUser)");
		$stmt->bindParam(":denom", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":clase", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":no_reg", $datosModel[4], PDO::PARAM_INT);
		$stmt->bindParam(":no_sol", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":ultima_cert", $datosModel[16], PDO::PARAM_INT);
		$stmt->bindParam(":vigencia", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":link", $datosModel[11], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":fax", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":autorizados", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":fuente", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":idUser", $datosModel[17], PDO::PARAM_INT);

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function registrarUsuarios($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, correo, password, confirmPass, tipo) VALUES (:usuario, :correo, :password, :confirmPass, :tipo)");
		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":confirmPass", md5($datosModel[2]), PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[3], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function validarRegistroUsuario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT usuario, correo FROM $tabla WHERE usuario = :usuario AND correo = :correo");
		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	//        Inventario
	public static function listarEncuesta()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas ORDER BY id DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}



	public static function listarEncuestaCapturista($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas WHERE id_usuario=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	// Define total de usaurios Aosciados
	public static function listarCapturistas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM `usuarios` WHERE `tipo` LIKE 'capturista'");
		//		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public function sumaInventario()
	{
		$stmt = Conexion::conectar()->prepare("SELECT sum(`precio`) FROM `inventario` WHERE 1 ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function encuestaTipoUser()
	{
		$stmt = Conexion::conectar()->prepare("SELECT `id_type_user`, count(*) TOTAL FROM `users` GROUP BY `id_type_user` ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function encuestaP1()
	{
		$stmt = Conexion::conectar()->prepare("SELECT `p_1` P1, count(*) TOTAL FROM `encuestas` GROUP BY `p_1` ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	// Función genérica
	public static function encuestaPreguntas($var)
	{
		$stmt = Conexion::conectar()->prepare("SELECT $var, count(*) TOTAL FROM `encuestas` GROUP BY $var ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function encuestaResultados()
	{
		$stmt = Conexion::conectar()->prepare("SELECT SUM(`p_1`) P2_A, SUM(`p_2_a`) P2_B, SUM(`p_2_b`) P2_C, SUM(`p_2_c`) P2_C FROM `encuestas` ");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	public static function cuentaUsuarios()
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM `users` GROUP BY id_user");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function detalleInventario($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM inventario WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	public function detalleEncuesta($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	public static function listarEncuestasCapturista($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas WHERE id_usuario=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function modificarInventario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET DENOM=:denom,CLASE=:clase,TITULAR=:titular,NO_REG=:no_reg,NO_SOL=:no_sol, ULTIMA_CERT_NOTARIAL=:ultima,VIGENCIA=:vigencia,PAIS_ORI=:pais,C_LINK=:link,C_TEL=:tel,C_FAX=:fax,C_EMAIL=:correo,PROD_SERV=:servicio,AUTORIZADOS=:autorizados,URL_FUENTE=:fuente,OBS=:obs,IMG=:img WHERE ID=:id");
		$stmt->bindParam(":denom", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":clase", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":no_reg", $datosModel[4], PDO::PARAM_INT);
		$stmt->bindParam(":no_sol", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":vigencia", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":link", $datosModel[11], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":fax", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":autorizados", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":fuente", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":ultima", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[17], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function eliminarInventario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function eliminarEncuesta($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	//filtrado de Inventario por 
	static public function filtroInventario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE marca LIKE :marca1 OR modelo LIKE :modelo1 OR version LIKE :version1 OR ano LIKE :ano1 OR car_code LIKE :car_code1 ");
		//		$stmt->bindValue(2, '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
		$stmt->bindValue(':marca1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':modelo1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':version1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':ano1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':car_code1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//        Marcas
	public function listarMarcas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public function listarMarcasCapturista($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE ID_USUARIO=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}


	public static function tagCategorias($clases)
	{
		$stmt = Conexion::conectar()->prepare("SELECT tag FROM categorias WHERE id IN (:clases)");
		$stmt->bindParam(":clases", $clases, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		//return $clases;
		$stmt->close();
	}

	public function detalleMarca($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	public function modificarMarca($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET DENOM=:denom,CLASE=:clase,TITULAR=:titular,NO_REG=:no_reg,NO_SOL=:no_sol, ULTIMA_CERT_NOTARIAL=:ultima,VIGENCIA=:vigencia,PAIS_ORI=:pais,C_LINK=:link,C_TEL=:tel,C_FAX=:fax,C_EMAIL=:correo,PROD_SERV=:servicio,AUTORIZADOS=:autorizados,URL_FUENTE=:fuente,OBS=:obs,IMG=:img WHERE ID=:id");
		$stmt->bindParam(":denom", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":clase", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":no_reg", $datosModel[4], PDO::PARAM_INT);
		$stmt->bindParam(":no_sol", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":vigencia", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":link", $datosModel[11], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":fax", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":autorizados", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":fuente", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":ultima", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[17], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function eliminarMarca($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function listarUsuariosVerificados()
	{
		$stmt = Conexion::conectar()->prepare("SELECT  count(*) usuarios FROM users WHERE verified like 'yes' ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function detalleUsuario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function datosUsuario($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM  usuarios WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function eliminarUsuario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public function listarCategorias()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM categorias ORDER BY ID");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//        Listar TIPO Autos para gráfica
	public function listarTipoAutos()
	{
		$stmt = Conexion::conectar()->prepare("SELECT `tipo`, COUNT(*) FROM `inventario` GROUP BY `tipo`");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function registrarCategoria($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (CLASE, TIPO, TAG, DESCRIPCION) VALUES (:clase, :tipo, :tag, :descripcion)");
		$stmt->bindParam(":clase", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":tag", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[2], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public function nuevaCategoria($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ID DESC LIMIT 1");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function eliminarCategoria($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function modificarCategoria($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET TIPO=:tipo, TAG=:tag, DESCRIPCION=:descripcion WHERE ID=:id");
		$stmt->bindParam(":tipo", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":tag", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[3], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public function estadisticasPorCategorias()
	{
		$stmt = Conexion::conectar()->prepare("SELECT b.tag, COUNT(CASE WHEN a.CLASE = b.ID THEN 1 ELSE null END) AS total FROM marcas a INNER JOIN categorias b GROUP BY b.TAG");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function listarMarcasPorCapturistas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT a.*, b.usuario FROM marcas a INNER JOIN usuarios b WHERE a.ID_USUARIO=b.id AND b.tipo='capturista'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	// public static function registrarBitacora($usuario, $tabla, $accion)
	// {
	// 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, accion) VALUES (:usuario, :accion)");
	// 	$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
	// 	$stmt->bindParam(":accion", $accion, PDO::PARAM_STR);
	// 	//$stmt->execute()
	// 	if ($stmt->execute()) {
	// 		return "ok";
	// 	} else {
	// 		return "error";
	// 	}
	// 	$stmt->close();
	// }

	public static function registrarBitacora($usuario, $tabla, $accion)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, accion) VALUES (:usuario, :accion)");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":accion", $accion, PDO::PARAM_STR);

		$executeResult = $stmt->execute();
		$stmt->closeCursor(); // Liberar el cursor

		if ($executeResult) {
			return "ok";
		} else {
			return "error";
		}
	}

	public static function bitacoraInicio($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC LIMIT 1,10");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function bitacora($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function bitacoraFechas($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(substring(fecha,1,10)) AS fechas FROM $tabla ORDER BY fechas DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function bitacoraPerfil($tabla, $usuario)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario=:usuario ORDER BY fecha DESC");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function filtroMarcas($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE denom LIKE ?");
		$stmt->bindValue(1, '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function datosPerfil($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	static public function actualizarUsuario($datosModel, $tabla)
	{
		if (count($datosModel) <= 2) {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario WHERE id=:id");
			$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
			$stmt->bindParam("usuario", $datosModel[1], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
		} else {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario, password=:nuevoPassword, confirmPass=:confirmNuevoPass WHERE id=:id");
			$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $datosModel[1], PDO::PARAM_STR);
			$stmt->bindParam(":nuevoPassword", $datosModel[2], PDO::PARAM_STR);
			$stmt->bindParam("confirmNuevoPass", $datosModel[3], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
			$stmt->close();
		}
	}
}
