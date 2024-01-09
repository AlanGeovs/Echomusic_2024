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
		// $stmt = Conexion::conectar()->prepare("SELECT * FROM users WHERE mail_user=:correo AND password_user=:password ");
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
		// $stmt = Conexion::conectar()->prepare("SELECT * FROM users WHERE mail_user=:correo AND password_user=:password ");
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
	public static function registrarImagen($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_user, image) VALUES (:id_user, :image)");

		$stmt->bindParam(":id_user", $datosModel[0], PDO::PARAM_INT);
		$stmt->bindParam(":image",   $datosModel[1], PDO::PARAM_STR);

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
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

	public static function modificarPerfilDatos($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nick_user=:nick_user, mail_user=:mail_user, first_name_user=:first_name_user, last_name_user=:last_name_user, descripcion=:descripcion, id_region=:id_region, id_city=:id_city, id_genero=:id_genero, id_subgenero=:id_subgenero, id_musician=:id_musician WHERE id_user=:id");

		$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
		$stmt->bindParam(":nick_user", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":mail_user", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":first_name_user", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":last_name_user", $datosModel[4], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[5], PDO::PARAM_STR);
		$stmt->bindParam(":id_region", $datosModel[6], PDO::PARAM_INT);
		$stmt->bindParam(":id_city", $datosModel[7], PDO::PARAM_INT);
		$stmt->bindParam(":id_genero", $datosModel[8], PDO::PARAM_INT);
		$stmt->bindParam(":id_subgenero", $datosModel[9], PDO::PARAM_INT);
		$stmt->bindParam(":id_musician", $datosModel[10], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		// No necesitas cerrar explícitamente la conexión aquí
	}



	public static function agregarOEditarPerfilBio($datosModel, $tabla, $accion)
	{
		if ($accion == "Editar") {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET bio_user=:bio_user WHERE id_user=:id");
		}
		if ($accion == "Agregar") {
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( id_user, bio_user) VALUES (:id, :bio_user)");
		}
		$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
		$stmt->bindParam(":bio_user", $datosModel[1], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		// No necesitas cerrar explícitamente la conexión aquí
	}

	public static function agregarOEditarPerfilVideo($datosModel, $tabla, $accion)
	{
		if ($accion == "Editar") {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET embed_multi=:embed_multi WHERE id_user=:id");
		}
		if ($accion == "Agregar") {
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_user, title_multi, service_multi, embed_multi, text_multi, date_multi ) VALUES (:id, :title_multi1, :service_multi, :embed_multi1,'', current_timestamp() )");
		}
		$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
		$stmt->bindParam(":title_multi1", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":service_multi", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":embed_multi1", $datosModel[3], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		// No necesitas cerrar explícitamente la conexión aquí
	}

	public static function listarVideos($id)
	{
		// Preparar la consulta SQL
		$sql = "SELECT id_multi, embed_multi, service_multi, title_multi FROM multimedia WHERE id_user = :id";
		$stmt = self::conectar()->prepare($sql);

		// Vincular el valor de $id al parámetro :id en la consulta SQL
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);

		// Ejecutar la consulta
		$stmt->execute();

		// Recuperar y retornar los resultados
		$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $videos;
	}

	public static function editarVideo($videoId, $videoTitle, $youtubeId)
	{
		// Preparar la consulta SQL
		$sql = "UPDATE multimedia SET title_multi = :videoTitle, embed_multi = :youtubeId WHERE id_multi = :videoId";
		$stmt = self::conectar()->prepare($sql);

		// Vincular los valores a los parámetros de la consulta SQL
		$stmt->bindValue(':videoTitle', $videoTitle, PDO::PARAM_STR);
		$stmt->bindValue(':youtubeId', $youtubeId, PDO::PARAM_STR);
		$stmt->bindValue(':videoId', $videoId, PDO::PARAM_INT);

		// Ejecutar la consulta y retornar el resultado
		$result = $stmt->execute();
		return $result;  // Esto retornará true en caso de éxito, o false en caso de error
	}

	public static function borrarVideo($videoId)
	{
		// Preparar la consulta SQL
		$sql = "DELETE FROM multimedia WHERE id_multi = :videoId";
		$stmt = self::conectar()->prepare($sql);

		// Vincular el valor de $videoId al parámetro :videoId en la consulta SQL
		$stmt->bindValue(':videoId', $videoId, PDO::PARAM_INT);

		// Ejecutar la consulta y retornar el resultado
		$result = $stmt->execute();
		return $result;  // Esto retornará true en caso de éxito, o false en caso de error
	}


	public static function extraerIdVideoYouTube($url)
	{
		parse_str(parse_url($url, PHP_URL_QUERY), $vars);
		return $vars['v'] ?? null;
	}


	public static function agregarFoto($id_user, $nombreImagen)
	{
		$sql = "INSERT INTO photos (id_user, name_photo) VALUES (:id_user, :name_photo)";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->bindParam(':name_photo', $nombreImagen, PDO::PARAM_STR);
		$stmt->execute();
	}


	public static function agregarFotoPortada($id_user, $nombreImagen)
	{
		$sql = "INSERT INTO photos_port (id_user, name_photo) VALUES (:id_user, :name_photo)";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->bindParam(':name_photo', $nombreImagen, PDO::PARAM_STR);
		$stmt->execute();
	}

	public static function obtenerFotosUsuario($id_user)
	{
		$sql = "SELECT name_photo FROM photos WHERE id_user = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function borrarFotoUsuario($nombreFoto)
	{
		$sql = "DELETE FROM photos WHERE name_photo = :name_photo";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindParam(':name_photo', $nombreFoto, PDO::PARAM_STR);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	// integrantes
	public static function guardarIntegrante($id_user, $firstName, $lastName, $instrument, $imgPath)
	{
		$sql = "INSERT INTO band_members (id_user, first_name_member, last_name_member, instrument_member, img_member) VALUES (:id_user, :firstName, :lastName, :instrument, :imgPath)";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
		$stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
		$stmt->bindValue(':instrument', $instrument, PDO::PARAM_STR);
		$stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);

		return $stmt->execute();
	}

	// instrumentos
	public static function obtenerInstrumentos()
	{
		$sql = "SELECT id_instrument, name_instrument FROM instruments";
		$stmt = self::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// obtener integrantes
	public static function obtenerIntegrantesPorUsuario($id_user)
	{
		$sql = "SELECT bm.id_band_member, bm.first_name_member, bm.last_name_member, bm.img_member, i.name_instrument FROM band_members as bm  JOIN instruments as i ON bm.instrument_member = i.id_instrument  WHERE bm.id_user = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	// Editar Integrantes
	public static function obtenerIntegrantePorId($id)
	{
		// Conexión a la base de datos y consulta SQL para obtener los datos del integrante
		$stmt = self::conectar()->prepare("SELECT * FROM band_members WHERE id_member = :id");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	// Borrar Integrantes
	public static function borrarIntegrante($id, $id_user)
	{
		// Conexión a la base de datos y consulta SQL para borrar un integrante
		$stmt = self::conectar()->prepare("DELETE FROM band_members WHERE id_band_member  = :id and id_user = :id_user");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		return $stmt->execute();
	}


	// presskit
	public static function subirPresskit($id_user, $file, $note)
	{
		try {
			// Conexión a la base de datos
			$conexion = self::conectar();

			// Manejo del archivo
			$uploadDir = '../images/presskit/'; // Asegúrate de reemplazar esto con tu directorio de carga
			$fileName = basename($file['name']);
			$uploadFilePath =  $uploadDir . $fileName;
			echo "<br>Upload file: " . $uploadFilePath;

			if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
				// Preparar la consulta para insertar datos en la base de datos
				$sql = "INSERT INTO presskit (id_user, file, note) VALUES (:id_user, :fileN, :note)";
				$stmt = $conexion->prepare($sql);

				$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
				$stmt->bindValue(':fileN', $fileName, PDO::PARAM_STR);
				$stmt->bindValue(':note', $note, PDO::PARAM_STR);

				$stmt->execute();

				// Verificar si la inserción fue exitosa
				if ($stmt->rowCount() > 0) {
					return ['success' => true, 'message' => 'Presskit subido con éxito'];
				} else {
					return ['success' => false, 'message' => 'Error al subir el presskit'];
				}
			} else {
				// Error en la carga del archivo
				return ['success' => false, 'message' => 'Error al cargar el archivo'];
			}
		} catch (PDOException $e) {
			// Manejar el error
			return ['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()];
		}
	}

	// obtener presskit
	public static function obtenerPresskitPorUsuario($id_user)
	{
		$sql = "SELECT note, date, file FROM presskit WHERE id_user = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Método para borrarla POrtada por id_user
	public static function borrarPortadaPorIdUser($id_user)
	{
		try {
			$conexion = Conexion::conectar();
			$sql = "DELETE FROM photos_port WHERE id_user = :id_user";
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true; // Retorna true si la eliminación fue exitosa
			} else {
				return false; // Retorna false si hubo un error en la eliminación
			}
		} catch (PDOException $e) {
			// Manejar el error
			error_log("Error en borrarPortadaPorIdUser: " . $e->getMessage());
			return false; // Retorna false si se captura una excepción
		} finally {
			$stmt = null;
			$conexion = null;
		}
	}

	// Método para borrar el presskit por id_user
	// public static function borrarPresskitPorIdUser($id_user)
	// {
	// 	try {
	// 		$conexion = Conexion::conectar();
	// 		$sql = "DELETE FROM presskit WHERE id_user = :id_user";
	// 		$stmt = $conexion->prepare($sql);
	// 		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

	// 		if ($stmt->execute()) {
	// 			return true; // Retorna true si la eliminación fue exitosa
	// 		} else {
	// 			return false; // Retorna false si hubo un error en la eliminación
	// 		}
	// 	} catch (PDOException $e) {
	// 		// Manejar el error
	// 		error_log("Error en borrarPresskitPorIdUser: " . $e->getMessage());
	// 		return false; // Retorna false si se captura una excepción
	// 	} finally {
	// 		$stmt = null;
	// 		$conexion = null;
	// 	}
	// }

	//TARIFAS
	// public static function guardarPlan($data)
	// {
	// 	$sql = "INSERT INTO plans (id_name_plan, value_plan, slot_plan, duration_hours, duration_minutes, backline, sound_reinforcement, sound_engineer, artists_amount, desc_plan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	// 	// Preparar y ejecutar la consulta
	// 	$stmt = $this->db->prepare($sql);
	// 	$stmt->bind_param(
	// 		"ssssssssss",
	// 		$data['plan_type1'],
	// 		$data['value_plan1'],
	// 		$data['plan_type1'],
	// 		$data['hours_plan1'],
	// 		$data['minutes_plan1'],
	// 		$data['backline_plan1'],
	// 		$data['soundReinforcement_plan1'],
	// 		$data['soundEngineer_plan1'],
	// 		$data['nArtists_plan1'],
	// 		$data['plan_desc1']
	// 	);

	// 	$success = $stmt->execute();

	// 	// Cerrar la consulta y la conexión
	// 	$stmt->close();

	// 	return ['success' => $success];
	// }

	// Método para insertar un plan
	public function insertPlan($data)
	{
		$query = "INSERT INTO plans (id_name_plan, value_plan, slot_plan, duration_hours, duration_minutes, backline, sound_reinforcement, sound_engineer, artists_amount, desc_plan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ssiiiiiisi", $data['plan_type1'], $data['value_plan1'], $data['plan_type1'], $data['hours_plan1'], $data['minutes_plan1'], $data['backline_plan1'], $data['soundReinforcement_plan1'], $data['soundEngineer_plan1'], $data['nArtists_plan1'], $data['plan_desc1']);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}



	public static function guardarPlan($data)
	{
		try {
			$conexion = Conexion::conectar();
			$sql = "INSERT INTO plans (id_user, id_name_plan, value_plan, slot_plan, duration_hours, duration_minutes, backline, sound_reinforcement, sound_engineer, artists_amount, desc_plan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$stmt = $conexion->prepare($sql);
			$stmt->bind_param(
				"sssssssssss",
				$data['id_user'],
				$data['plan_type1'],
				$data['value_plan1'],
				$data['plan_type1'], // Asumo que 'slot_plan' toma el mismo valor que 'plan_type1'
				$data['hours_plan1'],
				$data['minutes_plan1'],
				$data['backline_plan1'],
				$data['soundReinforcement_plan1'],
				$data['soundEngineer_plan1'],
				$data['nArtists_plan1'],
				$data['plan_desc1']
			);

			$resultado = $stmt->execute();

			$stmt->close();
			return $resultado;
		} catch (Exception $e) {
			// Manejar el error
			error_log("Error en guardarPlan: " . $e->getMessage());
			return false;
		}
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

	public static function detalleUsuario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id");
		// $stmt = Conexion::conectar()->prepare("SELECT users.nombre, user_login.fecha_ultimo_acceso FROM $tabla INNER JOIN user_login ON users.id_user = user_login.id_user ");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->closeCursor();

		return $result;
	}
	// public static function biografia($id)
	// {
	// 	$stmt = Conexion::conectar()->prepare("SELECT * FROM bio_user WHERE id_user = :id");
	// 	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	$result = $stmt->fetch();
	// 	$stmt->closeCursor();

	// 	return $result;
	// }

	// Botón Editar
	public static function botonEditar($modal)
	{
		$botonE = ' <div class="card-header bg-white text-right">
				<div class="form-group">
					<div class="col-sm-offset-12 col-sm-12">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modal . '"> Editar </button>
					</div>
				</div>
			</div>';
		return $botonE;
	}
	public static function botonAgregar($modal)
	{
		if ($modal == 'agregaVideo') {
			$botonE = "<div class='text-center'> <a class='btn-fab btn-fab-md shadow btn-primary' data-bs-toggle='modal' data-bs-target='#" . $modal . "' data-target='.bd-example-modal-xl'><i class='icon-plus'></i></a> </div>";
		} else {
			$botonE = "<div class='text-center'> <a class='btn-fab btn-fab-md shadow btn-primary' data-bs-toggle='modal' data-bs-target='#" . $modal . "'><i class='icon-plus'></i></a> </div>";
		}
		return $botonE;
	}

	public static function biografia($id)
	{
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM bio_user WHERE id_user = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetch();
			} else {
				$result = null; // O manejar de otra forma si no se encuentran resultados
			}
		} catch (PDOException $e) {
			error_log("Error en la consulta: " . $e->getMessage());
			$result = null;
		} finally {
			$stmt = null; // Cerrar cursor y conexión
			$conexion = null;
		}

		return $result;
	}

	//Lista de Videos de YouTUbe
	public static function videos($id)
	{
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM multimedia WHERE id_user = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetchAll();
			} else {
				$result = null; // O manejar de otra forma si no se encuentran resultados
			}
		} catch (PDOException $e) {
			error_log("Error en la consulta: " . $e->getMessage());
			$result = null;
		} finally {
			$stmt = null; // Cerrar cursor y conexión
			$conexion = null;
		}

		return $result;
	}


	//Lista de Foto Portada
	public static function fotoPortada($id)
	{
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM photos_port WHERE id_user = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetchAll();
			} else {
				$result = null; // O manejar de otra forma si no se encuentran resultados
			}
		} catch (PDOException $e) {
			error_log("Error en la consulta: " . $e->getMessage());
			$result = null;
		} finally {
			$stmt = null; // Cerrar cursor y conexión
			$conexion = null;
		}

		return $result;
	}


	//Lista de Playlist de Spotufy
	public static function playlista($id)
	{
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM multimedia_feature WHERE id_user = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetchAll();
			} else {
				$result = null; // O manejar de otra forma si no se encuentran resultados
			}
		} catch (PDOException $e) {
			error_log("Error en la consulta: " . $e->getMessage());
			$result = null;
		} finally {
			$stmt = null; // Cerrar cursor y conexión
			$conexion = null;
		}

		return $result;
	}


	public static function agregarPlaylist($id_user, $service_multi, $embed_multi)
	{
		$sql = "INSERT INTO multimedia_feature (id_user, service_multi, embed_multi) VALUES (:id_user, :service_multi, :embed_multi)";
		$stmt = self::conectar()->prepare($sql);

		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->bindValue(':service_multi', $service_multi, PDO::PARAM_STR);
		$stmt->bindValue(':embed_multi', $embed_multi, PDO::PARAM_STR);

		$result = $stmt->execute();
		return $result;  // Esto retornará true en caso de éxito, o false en caso de error
	}

	public static function editarPlaylist($playlist_id, $id_user, $service_multi, $embed_multi)
	{
		$sql = "UPDATE multimedia_feature SET service_multi = :service_multi, embed_multi = :embed_multi WHERE id_multimedia_featured = :id_multimedia_featured";
		$stmt = self::conectar()->prepare($sql);

		$stmt->bindValue(':id_multimedia_featured', $playlist_id, PDO::PARAM_INT);  // Modificar esta línea
		$stmt->bindValue(':service_multi', $service_multi, PDO::PARAM_STR);
		$stmt->bindValue(':embed_multi', $embed_multi, PDO::PARAM_STR);

		$result = $stmt->execute();
		return $result;  // Esto retornará true en caso de éxito, o false en caso de error
	}

	public static function obtenerNombreCiudadRegion($id_city)
	{
		// Prepara la consulta SQL
		$sql = "
            SELECT cities.name_city, regions.name_region
            FROM cities
            JOIN regions_cities ON cities.id_city = regions_cities.id_city
            JOIN regions ON regions_cities.id_region = regions.id_region
            WHERE cities.id_city = :id_city
        ";
		$stmt = self::conectar()->prepare($sql);

		// Vincula el valor de $id_city al parámetro :id_city en la consulta SQL
		$stmt->bindValue(':id_city', $id_city, PDO::PARAM_INT);

		// Ejecuta la consulta y obtén los resultados
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		// Verifica si se obtuvieron resultados
		if ($result) {
			return $result;  // Retorna los nombres de la ciudad y la región
		} else {
			return null;  // O retorna null si no se encontró ninguna coincidencia
		}
	}
	// Para el combo select dependiente
	public static function obtenerCiudadesPorRegion($id_region)
	{
		$sql = "
            SELECT cities.id_city, cities.name_city
            FROM cities
            JOIN regions_cities ON cities.id_city = regions_cities.id_city
            WHERE regions_cities.id_region = :id_region
        ";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_region', $id_region, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function obtenerCiudadesPorRegionDos($id_region)
	{
		$sql = "SELECT c.id_city, c.name_city FROM cities c 
				INNER JOIN regions_cities rc ON c.id_city = rc.id_city 
				WHERE rc.id_region = :id_region";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_region', $id_region, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function tipoMusico($id)
	{
		$tiposDeMusico = array(
			1 => 'Cantante',
			2 => 'Banda',
			3 => 'Solista',
			4 => 'Músico Instrumentista',
			5 => 'Tributo',
			6 => 'DJ',
			7 => 'Músico Home Studio'
		);

		if (array_key_exists($id, $tiposDeMusico)) {
			return $tiposDeMusico[$id];
		} else {
			return 'Tipo de músico no encontrado';
		}
	}

	public static function buscaGenero($genero)
	{
		$resultado = null;
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM genres WHERE id_genre = :id");
			$stmt->bindParam(":id", $genero, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$resultado = $stmt->fetch();
			}
		} catch (PDOException $e) {
			// Aquí puedes manejar el error, por ejemplo, registrarlo en un archivo de logs
			error_log("Error en buscaGenero: " . $e->getMessage());
		} finally {
			$stmt = null;
			$conexion = null;
		}

		return $resultado;
	}
	public static function buscaSubGenero($subgenero)
	{
		$resultado = null;
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM sub_genres WHERE id_subGenre = :id");
			$stmt->bindParam(":id", $subgenero, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$resultado = $stmt->fetch();
			}
		} catch (PDOException $e) {
			// Aquí puedes manejar el error, por ejemplo, registrarlo en un archivo de logs
			error_log("Error en buscaGenero: " . $e->getMessage());
		} finally {
			$stmt = null;
			$conexion = null;
		}

		return $resultado;
	}

	public static function obtenerSubGenerosPorGenero($id_genero)
	{
		$sql = "
            SELECT sub_genres.id_subGenre, sub_genres.name_subGenre
            FROM sub_genres
            JOIN genres_subs ON sub_genres.id_subGenre = genres_subs.id_subGenre
            WHERE genres_subs.id_genre = :id_genero
        ";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_genero', $id_genero, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public static function listarVariable($variable)
	{
		try {
			$conexion = Conexion::conectar();
			$stmt = $conexion->prepare("SELECT * FROM $variable");
			$stmt->execute();
			$resultado = $stmt->fetchAll();
		} catch (PDOException $e) {
			// Manejar error
			error_log("Error en listarVariable: " . $e->getMessage());
			$resultado = null;
		} finally {
			$stmt = null;
			$conexion = null;
		}

		return $resultado;
	}


	// Crear EVentos
	public static function crearEventos($data)
	{
		$sql = "INSERT INTO events_public (id_type_event, id_user, id_region, id_city, date_event, name_event, name_location, location, organizer, desc_event, audience_event, value_OLD, value_commission_OLD, value_plan_OLD, payment_event, img, id_multimedia_featured, verifier_event, active_event) 
				VALUES (:id_type_event, :id_user, :id_region, :id_city, :date_event, :name_event, :name_location, :location, :organizer, :desc_event, :audience_event, '0', '0', '0', '0', '', NULL, '', 1)";

		$stmt = self::conectar()->prepare($sql);

		$stmt->bindValue(':id_type_event', $data['id_type_event'], PDO::PARAM_INT);
		$stmt->bindValue(':id_user', $data['id_user'], PDO::PARAM_INT);
		$stmt->bindValue(':id_region', $data['id_region'], PDO::PARAM_INT);
		$stmt->bindValue(':id_city', $data['id_city'], PDO::PARAM_INT);
		$stmt->bindValue(':date_event', $data['date_event'], PDO::PARAM_STR);
		$stmt->bindValue(':name_event', $data['name_event'], PDO::PARAM_STR);
		$stmt->bindValue(':name_location', $data['name_location'], PDO::PARAM_STR);
		$stmt->bindValue(':location', $data['location'], PDO::PARAM_STR);
		$stmt->bindValue(':organizer', $data['organizer'], PDO::PARAM_STR);
		$stmt->bindValue(':desc_event', $data['desc_event'], PDO::PARAM_STR);
		$stmt->bindValue(':audience_event', $data['audience_event'], PDO::PARAM_INT);

		try {
			$result = $stmt->execute();
			return ['success' => $result];
		} catch (Exception $e) {
			return ['success' => false, 'error' => $e->getMessage()];
		}
	}

	// Crear tICKETS
	public static function crearTickets($ticket)
	{
		$sql = "INSERT INTO tickets_public (ticket_name, ticket_value, ticket_audience, ticket_dateStart, ticket_dateEnd) 
				VALUES (:ticket_name, :ticket_value, :ticket_audience, :ticket_dateStart, :ticket_dateEnd)";

		$stmt = self::conectar()->prepare($sql);

		$stmt->bindValue(':ticket_name', $ticket['ticket_name'], PDO::PARAM_INT);
		$stmt->bindValue(':ticket_value', $ticket['ticket_value'], PDO::PARAM_INT);
		$stmt->bindValue(':ticket_audience', $ticket['ticket_audience'], PDO::PARAM_INT);
		$stmt->bindValue(':ticket_dateStart', $ticket['ticket_dateStart'], PDO::PARAM_STR);
		$stmt->bindValue(':ticket_dateEnd', $ticket['ticket_dateEnd'], PDO::PARAM_STR);
		try {
			$result = $stmt->execute();
			return ['success' => $result];
		} catch (Exception $e) {
			return ['success' => false, 'error' => $e->getMessage()];
		}
	}

	// Mostrar eventos 
	public static function obtenerEventosPorUsuario($id_usuario)
	{
		$sql = "SELECT * FROM events_public WHERE id_user = :id_user ORDER BY date_event DESC";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
