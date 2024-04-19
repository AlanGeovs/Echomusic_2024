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

	// CLase nueva 2024
	public static function registrarUsuario($data)
	{
		// Conexión a la base de datos
		$db = self::conectar();

		// Preparar consulta SQL
		$stmt = $db->prepare("INSERT INTO users (id_type_user, first_name_user, last_name_user, nick_user, mail_user, password_user, first_login, user_destacado, tipo, id_genero, id_subgenero, descripcion, space, type_agent) VALUES (:id_type_user, :first_name_user, :last_name_user, :nick_user, :mail_user, :password_user, 'no', 0, '',0,0,'', :space, :type_agent)");

		// Vincular parámetros
		$stmt->bindValue(':id_type_user', $data['id_type_user']);
		$stmt->bindValue(':first_name_user', $data['first_name_user']);
		$stmt->bindValue(':last_name_user', $data['last_name_user']);
		$stmt->bindValue(':nick_user', $data['nick_user']);
		$stmt->bindValue(':mail_user', $data['mail_user']);
		$stmt->bindValue(':password_user',  hash('sha256', $data['password_user']));
		$stmt->bindValue(':space',  $data['space']);
		$stmt->bindValue(':type_agent',  $data['type_agent']);

		// Ejecutar y retornar resultado
		return $stmt->execute();
	}

	// Registro con Google -  buscará en la base de datos si existe un usuario con el correo electrónico dado
	public static function checkUserExists($email)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE mail_user = :email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchColumn() > 0;
		} catch (PDOException $e) {
			// Manejar el error o registrar
			return false;
		}
	}

	// Registro Google - registra un nuevo usuario en la base de datos con los datos obtenidos de Google. 
	public static function registrarUsuarioGoogle($email, $name, $type_user)
	{
		try {
			$db = Conexion::conectar();
			//$stmt = $db->prepare("INSERT INTO users (mail_user, first_name_user, method_login) VALUES (:email, :name, 2)");
			$stmt = $db->prepare("INSERT INTO users (id_type_user, first_name_user, last_name_user, nick_user, mail_user, password_user, first_login, user_destacado, tipo, id_genero, id_subgenero, descripcion, space, type_agent, method_login)  
								             VALUES (:type_user, :name, '', '', :email, 'NULL', 'no', 0, '',0,0,'', 'NULL', 0, 2)");
			$stmt->bindParam(":type_user", $type_user, PDO::PARAM_INT);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			return $stmt->execute();
		} catch (PDOException $e) {
			// Manejar el error o registrar
			return false;
		}
	}

	// Inicio de sesión Google - busca un usuario en la base de datos por su email y retorna sus datos de sesión
	public static function loginUsuarioGoogle($email)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT * FROM users WHERE mail_user = :email AND method_login = 2 LIMIT 1");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$userData = $stmt->fetch(PDO::FETCH_ASSOC);
				return $userData;
			} else {
				// No se encontró el usuario
				return false;
			}
		} catch (PDOException $e) {
			// Manejar el error o registrar
			return false;
		}
	}


	public static function registrarGoogle($email, $name)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("INSERT INTO google (mail_user, first_name_user, method_login) VALUES (:email, :name, 2)");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			return $stmt->execute();
		} catch (PDOException $e) {
			// Manejar el error o registrar
			return false;
		}
	}

	// Verificación de Email
	public static function verificarEmailExistente($email)
	{
		$db = self::conectar();
		$stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE mail_user = :mail_user");
		$stmt->bindValue(':mail_user', $email);
		$stmt->execute();

		return $stmt->fetchColumn() > 0; // Retorna true si encuentra el email, false si no lo encuentra
	}

	// Verificación de Nick_User
	public static function verificarNickUserExistente($nick)
	{
		$db = self::conectar();
		$stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE nick_user = :nick_user");
		$stmt->bindValue(':nick_user', $nick);
		$stmt->execute();

		return $stmt->fetchColumn() > 0; // Retorna true si encuentra el email, false si no lo encuentra
	}
	// Verificación de space
	public static function verificarSpaceExistente($space)
	{
		$db = self::conectar();
		$stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE space = :space");
		$stmt->bindValue(':space', $space);
		$stmt->execute();

		return $stmt->fetchColumn() > 0; // Retorna true si encuentra el email, false si no lo encuentra
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

	// Cambia el valor de picture_ready = 1 cuando se sube o actualzia foto de portada

	public static function actualizarPictureReady($idUser)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE users SET picture_ready = 1 WHERE id_user = :id_user");
			$stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true; // Retornar verdadero si la actualización fue exitosa
			} else {
				return false; // Retornar falso si la actualización falló
			}
		} catch (PDOException $e) {
			// Manejar la excepción o error aquí
			error_log("Error al actualizar picture_ready: " . $e->getMessage());
			return false; // Retornar falso en caso de error
		}
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
			$db = Conexion::conectar();
			$query = "INSERT INTO plans (id_plan, id_user, id_name_plan, value_plan, commission_plan, desc_plan, active, duration_hours, duration_minutes, backline, sound_engineer, artists_amount, sound_reinforcement) VALUES (:id_plan, :id_user, :id_name_plan, :value_plan, :commission_plan, :desc_plan, :active, :duration_hours, :duration_minutes, :backline, :sound_engineer, :artists_amount, :sound_reinforcement)";

			$stmt = $db->prepare($query);

			// bindValue para cada parámetro
			$stmt->bindValue(':id_plan', 123, PDO::PARAM_INT);
			$stmt->bindValue(':id_user', $data['id_user'], PDO::PARAM_INT);
			$stmt->bindValue(':id_name_plan', $data['id_name_plan'], PDO::PARAM_INT);
			$stmt->bindValue(':value_plan', $data['value_plan'], PDO::PARAM_INT); // o PDO::PARAM_INT si es un valor numérico sin decimales
			$stmt->bindValue(':commission_plan', $data['commission_plan'], PDO::PARAM_INT); // o PDO::PARAM_INT dependiendo del tipo de dato
			$stmt->bindValue(':desc_plan', $data['desc_plan'], PDO::PARAM_STR);
			$stmt->bindValue(':active', $data['active'], PDO::PARAM_STR);
			$stmt->bindValue(':duration_hours', $data['duration_hours'], PDO::PARAM_INT);
			$stmt->bindValue(':duration_minutes', $data['duration_minutes'], PDO::PARAM_INT);
			$stmt->bindValue(':backline', $data['backline'], PDO::PARAM_INT);
			$stmt->bindValue(':sound_engineer', $data['sound_engineer'], PDO::PARAM_INT);
			$stmt->bindValue(':artists_amount', $data['artists_amount'], PDO::PARAM_INT);
			$stmt->bindValue(':sound_reinforcement', $data['sound_reinforcement'], PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true; // O puedes retornar $db->lastInsertId(); si necesitas el ID del plan insertado
			} else {
				return false;
			}
		} catch (PDOException $e) {
			// Aquí deberías manejar o registrar el error de alguna manera
			return false;
		}
	}

	//Tarifas actuales por usuario
	public static function obtenerTarifasPorUsuario($idUsuario)
	{
		$conexion = Conexion::conectar();
		$stmt = $conexion->prepare("SELECT * FROM plans WHERE id_user = :idUsuario");
		$stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//Tarifas actuales por is_plan_key
	public static function obtenerTarifasPorIDPlanKey($idPlanKey)
	{
		$conexion = Conexion::conectar();
		$stmt = $conexion->prepare("SELECT * FROM plans WHERE id_plan_key = :idPlanKey");
		$stmt->bindParam(':idPlanKey', $idPlanKey, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//Actualizar Tarifa actualizarTarifa
	public static function actualizarTarifa($data)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE plans SET id_name_plan = :id_name_plan, 
									value_plan = :value_plan, 
									commission_plan = :commission_plan,
									duration_hours = :duration_hours, 
									duration_minutes = :duration_minutes, 
									backline = :backline, 
									sound_reinforcement = :sound_reinforcement, 
									sound_engineer = :sound_engineer, 
									artists_amount = :artists_amount, 
									desc_plan = :desc_plan 
								  WHERE id_plan_key = :id_plan_key");

			// Vinculación de parámetros
			$stmt->bindParam(':id_plan_key', $data['id_plan_key']);
			$stmt->bindParam(':id_name_plan', $data['id_name_plan']);
			$stmt->bindParam(':value_plan', $data['value_plan']);
			$stmt->bindParam(':commission_plan', $data['commission_plan']);
			$stmt->bindParam(':duration_hours', $data['duration_hours']);
			$stmt->bindParam(':duration_minutes', $data['duration_minutes']);
			$stmt->bindParam(':backline', $data['backline']);
			$stmt->bindParam(':sound_reinforcement', $data['sound_reinforcement']);
			$stmt->bindParam(':sound_engineer', $data['sound_engineer']);
			$stmt->bindParam(':artists_amount', $data['artists_amount']);
			$stmt->bindParam(':desc_plan', $data['desc_plan']);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Manejo del error
			error_log('Error en Consultas::actualizarTarifa - ' . $e->getMessage());
			return false;
		}
	}


	//Borrrar tarifas
	public static function borrarTarifa($idTarifa)
	{
		$conexion = Conexion::conectar();
		$stmt = $conexion->prepare("DELETE FROM plans WHERE id_plan_key = :id_plan");
		$stmt->bindParam(":id_plan", $idTarifa, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true; // Éxito al borrar la tarifa
		} else {
			return false; // Falló al intentar borrar la tarifa
		}
	}



	// ------------------------------

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

	public static function obtenerCiudadPorRegion($id_region)
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
				VALUES (:id_type_event, :id_user, :id_region, :id_city, :date_event, :name_event, :name_location, :location, :organizer, :desc_event, :audience_event, '0', '0', '0', '0', :img, NULL, '', 1)";

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
		$stmt->bindValue(':img', $data['img'], PDO::PARAM_INT);

		try {
			$result = $stmt->execute();
			return ['success' => $result];
		} catch (Exception $e) {
			return ['success' => false, 'error' => $e->getMessage()];
		}
	}

	//buscar id_Event  
	public static function obtenerIdEventPorImagen($nombreImagen)
	{
		try {
			// Obtener conexión a la base de datos
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT id_event FROM events_public WHERE img like :nombreImagen LIMIT 1");
			$stmt->bindParam(':nombreImagen', $nombreImagen, PDO::PARAM_STR);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if ($resultado) {
				return $resultado['id_event']; // Retornar el id_event encontrado
			} else {
				return false; // No se encontró un evento con esa imagen
			}
		} catch (PDOException $e) {
			// En caso de error, retornar false o manejar el error como prefieras
			return false;
		}
	}
	// buscar número de tickets
	public static function contarTicketsPorEvento($idEvento)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT COUNT(*) AS total_tickets FROM tickets_public WHERE id_event = :id_event");
			//$stmt = $db->prepare("SELECT count(*) FROM `tickets_public` WHERE `id_event` = :id_event");
			$stmt->bindParam(":id_event", $idEvento, PDO::PARAM_INT);
			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			return $resultado['total_tickets'];
		} catch (PDOException $e) {
			// Manejar el error o registrar
			return false;
		}
	}

	// Crear tICKETS
	public static function crearTickets($ticket, $idEvento)
	{
		$sql = "INSERT INTO tickets_public (ticket_name, ticket_value, ticket_commission, ticket_audience, ticket_dateStart, ticket_dateEnd, id_event) 
				VALUES (:ticket_name, :ticket_value, 0, :ticket_audience, :ticket_dateStart, :ticket_dateEnd, :id_event)";

		$stmt = self::conectar()->prepare($sql);

		$stmt->bindValue(':ticket_name', $ticket['ticket_name'], PDO::PARAM_STR);
		$stmt->bindValue(':ticket_value', $ticket['ticket_value'], PDO::PARAM_INT);
		$stmt->bindValue(':ticket_audience', $ticket['ticket_audience'], PDO::PARAM_INT);
		$stmt->bindValue(':ticket_dateStart', $ticket['ticket_dateStart'], PDO::PARAM_STR);
		$stmt->bindValue(':ticket_dateEnd', $ticket['ticket_dateStart'], PDO::PARAM_STR);
		$stmt->bindValue(':id_event', $idEvento, PDO::PARAM_INT);
		try {
			$result = $stmt->execute();
			return ['success' => $result];
		} catch (Exception $e) {
			return ['success' => false, 'error' => $e->getMessage()];
		}
	}

	// Mostrar eventos 
	// public static function obtenerEventosPorUsuario($id_usuario)
	// {
	// 	$sql = "SELECT * FROM events_public WHERE id_user = :id_user ORDER BY date_event DESC";
	// 	$stmt = self::conectar()->prepare($sql);
	// 	$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

	// Mostrar eventos con paginador
	public static function obtenerEventosPorUsuario($id_usuario, $offset, $numPorPagina)
	{
		$sql = "SELECT * FROM events_public WHERE id_user = :id_user ORDER BY date_event DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function totalEventos($id_usuario)
	{
		$sql = "SELECT COUNT(id_event) FROM events_public WHERE id_user = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	// Total de Reservas
	public static function totalReservas($id_usuario)
	{
		$sql = "SELECT COUNT(id_event) FROM `events_private` ep JOIN `plans` p ON ep.`id_plan` = p.`id_plan` AND ep.`id_plan_key` = p.`id_plan_key` WHERE p.`id_user` = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	// Eventos por ID de evento
	public static function obtenerEventoPorId($idEvento)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT * FROM events_public WHERE id_event = :idEvento");
			$stmt->bindParam(":idEvento", $idEvento, PDO::PARAM_INT);
			$stmt->execute();
			$evento = $stmt->fetch(PDO::FETCH_ASSOC);
			return $evento; // Devuelve los datos del evento o null si no se encontró
		} catch (PDOException $e) {
			// Manejo de error
			return null;
		}
	}

	// Proyectos por ID de evento
	public static function obtenerProyectoPorId($idProyecto)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT * FROM projects_crowdfunding WHERE id_project = :idProyecto");
			$stmt->bindParam(":idProyecto", $idProyecto, PDO::PARAM_INT);
			$stmt->execute();
			$evento = $stmt->fetch(PDO::FETCH_ASSOC);
			return $evento; // Devuelve los datos del evento o null si no se encontró
		} catch (PDOException $e) {
			// Manejo de error
			return null;
		}
	}

	//función recupera todas las entradas (tickets) asociadas a un evento específico,
	public static function obtenerEntradasPorEvento($idEvento)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT * FROM tickets_public WHERE id_event = :idEvento ORDER BY id_ticket ASC");
			$stmt->bindParam(":idEvento", $idEvento, PDO::PARAM_INT);
			$stmt->execute();
			$entradas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $entradas; // Devuelve un array de entradas o un array vacío si no hay entradas
		} catch (PDOException $e) {
			// Manejo de error
			return [];
		}
	}

	//Actualizar Evento
	public static function actualizarEvento($idEvento, $dataEvento)
	{
		try {
			$db = Conexion::conectar();
			// Preparar la consulta SQL para actualizar el evento
			$sql = "UPDATE events_public SET
					id_type_event = :id_type_event,
					id_user = :id_user,
					id_region = :id_region,
					id_city = :id_city,
					date_event = :date_event,
					name_event = :name_event,
					name_location = :name_location,
					location = :location,
					organizer = :organizer,
					desc_event = :desc_event,
					audience_event = :audience_event";

			// Si se actualiza la imagen, agregar la columna correspondiente al SQL
			if (!empty($dataEvento['img'])) {
				$sql .= ", img = :img";
			}

			$sql .= " WHERE id_event = :id_event";

			$stmt = $db->prepare($sql);

			// Vincular los valores a la consulta preparada
			$stmt->bindParam(':id_type_event', $dataEvento['id_type_event'], PDO::PARAM_INT);
			$stmt->bindParam(':id_user', $dataEvento['id_user'], PDO::PARAM_INT);
			$stmt->bindParam(':id_region', $dataEvento['id_region'], PDO::PARAM_INT);
			$stmt->bindParam(':id_city', $dataEvento['id_city'], PDO::PARAM_INT);
			$stmt->bindParam(':date_event', $dataEvento['date_event'], PDO::PARAM_STR);
			$stmt->bindParam(':name_event', $dataEvento['name_event'], PDO::PARAM_STR);
			$stmt->bindParam(':name_location', $dataEvento['name_location'], PDO::PARAM_STR);
			$stmt->bindParam(':location', $dataEvento['location'], PDO::PARAM_STR);
			$stmt->bindParam(':organizer', $dataEvento['organizer'], PDO::PARAM_STR);
			$stmt->bindParam(':desc_event', $dataEvento['desc_event'], PDO::PARAM_STR);
			$stmt->bindParam(':audience_event', $dataEvento['audience_event'], PDO::PARAM_INT);
			$stmt->bindParam(':id_event', $idEvento, PDO::PARAM_INT);

			// Si se actualiza la imagen, vincular este valor también
			if (!empty($dataEvento['img'])) {
				$stmt->bindParam(':img', $dataEvento['img'], PDO::PARAM_STR);
			}

			$stmt->execute();

			return true; // Retornar verdadero si la actualización fue exitosa
		} catch (PDOException $e) {
			// En caso de error, puedes manejarlo aquí. Por ejemplo, registrando el error en un archivo log.
			return false; // Retornar falso si hubo un error al actualizar
		}
	}

	//función se encargará de actualizar cada ticket individualmente en la base de datos:
	public static function actualizarEntradaEvento($dataTicket)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("UPDATE tickets_public SET ticket_name = :ticket_name, ticket_value = :ticket_value, ticket_audience = :ticket_audience, ticket_dateStart = :ticket_dateStart, ticket_dateEnd = :ticket_dateEnd WHERE id_ticket = :id_ticket");
			$stmt->bindParam(":ticket_name", $dataTicket['ticket_name'], PDO::PARAM_STR);
			$stmt->bindParam(":ticket_value", $dataTicket['ticket_value'], PDO::PARAM_INT);
			$stmt->bindParam(":ticket_audience", $dataTicket['ticket_audience'], PDO::PARAM_INT);
			$stmt->bindParam(":ticket_dateStart", $dataTicket['ticket_dateStart'], PDO::PARAM_STR);
			$stmt->bindParam(":ticket_dateEnd", $dataTicket['ticket_dateEnd'], PDO::PARAM_STR);
			$stmt->bindParam(":id_ticket", $dataTicket['id_ticket'], PDO::PARAM_INT);
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			// Manejar el error
			return false;
		}
	}

	// se encargaría específicamente de manejar la lógica para actualizar o crear el ticket gratuito asociado al evento
	public static function actualizarEntradaEventoGratis($idEvento, $dataTicket)
	{
		try {
			$db = Conexion::conectar();
			// Verificar si ya existe un ticket gratuito para este evento
			$stmt = $db->prepare("SELECT * FROM tickets_public WHERE id_event = :idEvento AND ticket_value = 0");
			$stmt->bindParam(":idEvento", $idEvento, PDO::PARAM_INT);
			$stmt->execute();
			$ticketExistente = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($ticketExistente) {
				// Actualizar el ticket gratuito existente
				$stmt = $db->prepare("UPDATE tickets_public SET ticket_audience = :ticket_audience, ticket_dateStart = :ticket_dateStart, ticket_dateEnd = :ticket_dateEnd WHERE id_ticket = :id_ticket");
				$stmt->bindParam(":ticket_audience", $dataTicket['ticket_audience'], PDO::PARAM_INT);
				$stmt->bindParam(":ticket_dateStart", $dataTicket['ticket_dateStart'], PDO::PARAM_STR);
				$stmt->bindParam(":ticket_dateEnd", $dataTicket['ticket_dateEnd'], PDO::PARAM_STR);
				$stmt->bindParam(":id_ticket", $ticketExistente['id_ticket'], PDO::PARAM_INT);
				$stmt->execute();
			} else {
				// Crear un nuevo ticket gratuito
				$stmt = $db->prepare("INSERT INTO tickets_public (ticket_name, ticket_value, ticket_audience, ticket_dateStart, ticket_dateEnd, id_event) VALUES (:ticket_name, :ticket_value, :ticket_audience, :ticket_dateStart, :ticket_dateEnd, :id_event)");
				$stmt->bindParam(":ticket_name", $dataTicket['ticket_name'], PDO::PARAM_STR);
				$stmt->bindParam(":ticket_value", $dataTicket['ticket_value'], PDO::PARAM_INT);
				$stmt->bindParam(":ticket_audience", $dataTicket['ticket_audience'], PDO::PARAM_INT);
				$stmt->bindParam(":ticket_dateStart", $dataTicket['ticket_dateStart'], PDO::PARAM_STR);
				$stmt->bindParam(":ticket_dateEnd", $dataTicket['ticket_dateEnd'], PDO::PARAM_STR);
				$stmt->bindParam(":id_event", $idEvento, PDO::PARAM_INT);
				$stmt->execute();
			}
			return true;
		} catch (PDOException $e) {
			// Manejo de error
			return false;
		}
	}



	//borrar eventos y tickets
	public static function borrarEventoYTickets($idEvent)
	{
		try {
			$db = self::conectar();
			// Inicia transacción
			$db->beginTransaction();

			// Borrar tickets asociados
			$stmt = $db->prepare("DELETE FROM tickets_public WHERE id_event = :idEvent");
			$stmt->execute([':idEvent' => $idEvent]);

			// Borrar evento
			$stmt = $db->prepare("DELETE FROM events_public WHERE id_event = :idEvent");
			$stmt->execute([':idEvent' => $idEvent]);

			// Confirma los cambios
			$db->commit();

			return true;
		} catch (Exception $e) {
			// En caso de error, revierte los cambios
			$db->rollback();
			return false;
		}
	}



	//borrar reserva
	public static function borrarReserva($idEvent)
	{
		try {
			$db = self::conectar();
			// Inicia transacción
			$db->beginTransaction();

			// Borrar reserva
			$stmt = $db->prepare("DELETE FROM `events_private` WHERE `events_private`.`id_event` = :idEvent");
			$stmt->execute([':idEvent' => $idEvent]);

			// Confirma los cambios
			$db->commit();

			return true;
		} catch (Exception $e) {
			// En caso de error, revierte los cambios
			$db->rollback();
			return false;
		}
	}

	// agrega las funciones duplicarEvento y duplicarTicketsDelEvento 
	public static function duplicarEvento($idEventoOriginal)
	{
		try {
			$db = Conexion::conectar();
			// Primero, obtenemos los datos del evento original
			$stmt = $db->prepare("SELECT * FROM events_public WHERE id_event = :idEventoOriginal");
			$stmt->bindParam(":idEventoOriginal", $idEventoOriginal, PDO::PARAM_INT);
			$stmt->execute();
			$eventoOriginal = $stmt->fetch(PDO::FETCH_ASSOC);
			$nombreEventoDuplicado = $eventoOriginal['name_event'] . ' (Evento duplicado)';
			$eventoOriginal['active_event'] = 0;

			if ($eventoOriginal) {
				$stmt = $db->prepare("INSERT INTO events_public (id_type_event, id_user, id_region, id_city, id_plan, date_event, name_event, name_location, location, organizer, value_OLD, value_commission_OLD, value_plan_OLD, desc_event, audience_event, payment_event, img, id_multimedia_featured, verifier_event, active_event) VALUES (:id_type_event, :id_user, :id_region, :id_city, :id_plan, :date_event, :name_event, :name_location, :location, :organizer, :value_OLD, :value_commission_OLD, :value_plan_OLD, :desc_event, :audience_event, :payment_event, :img, :id_multimedia_featured, :verifier_event, :active_event)");
				// Vincular parámetros. Asegúrate de vincular todos los necesarios.
				$stmt->bindParam(":id_type_event", $eventoOriginal['id_type_event']);
				$stmt->bindParam(":id_user", $eventoOriginal['id_user']);
				$stmt->bindParam(":id_region", $eventoOriginal['id_region']);
				$stmt->bindParam(":id_city", $eventoOriginal['id_city']);
				$stmt->bindParam(":id_plan", $eventoOriginal['id_plan']);
				$stmt->bindParam(":date_event", $eventoOriginal['date_event']);
				$stmt->bindParam(":name_event", $nombreEventoDuplicado, PDO::PARAM_STR);
				$stmt->bindParam(":name_location", $eventoOriginal['name_location']);
				$stmt->bindParam(":location", $eventoOriginal['location']);
				$stmt->bindParam(":organizer", $eventoOriginal['organizer']);
				$stmt->bindParam(":value_OLD", $eventoOriginal['value_OLD']);
				$stmt->bindParam(":value_commission_OLD", $eventoOriginal['value_commission_OLD']);
				$stmt->bindParam(":value_plan_OLD", $eventoOriginal['value_plan_OLD']);
				$stmt->bindParam(":desc_event", $eventoOriginal['desc_event']);
				$stmt->bindParam(":audience_event", $eventoOriginal['audience_event']);
				$stmt->bindParam(":payment_event", $eventoOriginal['payment_event']);
				$stmt->bindParam(":img", $eventoOriginal['img']);
				$stmt->bindParam(":id_multimedia_featured", $eventoOriginal['id_multimedia_featured']);
				$stmt->bindParam(":verifier_event", $eventoOriginal['verifier_event']);
				$stmt->bindParam(":active_event", $eventoOriginal['active_event']);

				if ($stmt->execute()) {
					// Obtener el ID del nuevo evento creado
					$idNuevoEvento = $db->lastInsertId();
					return ['success' => true, 'id_event' => $idNuevoEvento];
				}
			}
			return ['success' => false];
		} catch (PDOException $e) {
			return ['success' => false, 'error' => $e->getMessage()];
		}
	}

	public static function duplicarTicketsDelEvento($idEventoOriginal, $idNuevoEvento)
	{
		try {
			$db = Conexion::conectar();
			// Obtener los tickets del evento original
			$stmt = $db->prepare("SELECT * FROM tickets_public WHERE id_event = :idEventoOriginal");
			$stmt->bindParam(":idEventoOriginal", $idEventoOriginal, PDO::PARAM_INT);
			$stmt->execute();
			$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if ($tickets) {
				foreach ($tickets as $ticket) {
					// Insertamos cada ticket en el nuevo evento
					$stmt = $db->prepare("INSERT INTO tickets_public (id_event, ticket_name, ticket_value, ticket_commission, ticket_audience, ticket_dateStart, ticket_dateEnd) VALUES (:id_event, :ticket_name, :ticket_value, :ticket_commission, :ticket_audience, :ticket_dateStart, :ticket_dateEnd)");
					$stmt->bindParam(":id_event", $idNuevoEvento);
					$stmt->bindParam(":ticket_name", $ticket['ticket_name']);
					$stmt->bindParam(":ticket_value", $ticket['ticket_value']);
					$stmt->bindParam(":ticket_commission", $ticket['ticket_commission']);
					$stmt->bindParam(":ticket_audience", $ticket['ticket_audience']);
					$stmt->bindParam(":ticket_dateStart", $ticket['ticket_dateStart']);
					$stmt->bindParam(":ticket_dateEnd", $ticket['ticket_dateEnd']);
					$stmt->execute();
					// Considera manejar errores específicos o confirmación para cada ticket
				}
				return ['success' => true];
			}
			return ['success' => false, 'message' => 'No se encontraron tickets para duplicar.'];
		} catch (PDOException $e) {
			return ['success' => false, 'error' => $e->getMessage()];
		}
	}

	// Función en el modelo para cambiar el estado del evento 
	public static function cambiarEstadoEvento($idEvento, $activeEvent)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE events_public SET active_event = :active_event WHERE id_event = :id_event");
			$stmt->bindParam(':active_event', $activeEvent, PDO::PARAM_INT);
			$stmt->bindParam(':id_event', $idEvento, PDO::PARAM_INT);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Log o manejo del error
			return false;
		}
	}

	// Función en el modelo para cambiar el estado del Reserva
	public static function cambiarEstadoReserva($idEvento, $activeEvent)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE events_private  SET status_event = :status_event WHERE id_event = :id_event");
			$stmt->bindParam(':status_event', $activeEvent, PDO::PARAM_STR);
			$stmt->bindParam(':id_event', $idEvento, PDO::PARAM_INT);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Log o manejo del error
			return false;
		}
	}


	// Mostrar reservar con paginador
	// public static function obtenerReservasPorUsuario($id_usuario, $offset, $numPorPagina)
	// {
	// 	$sql = "SELECT ep.*, p.* FROM events_private ep JOIN plans p ON ep.id_plan = p.id_plan AND ep.id_plan_key = p.id_plan_key WHERE p.id_user = :id_user ORDER BY ep.id_plan_key DESC LIMIT :offset, :numPorPagina";
	// 	$stmt = self::conectar()->prepare($sql);
	// 	$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
	// 	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	// 	$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

	// Mostrar reservar con paginador y agrego JOIN de nombre de Ciudades y Regiones
	public static function obtenerReservasPorUsuario($id_usuario, $offset, $numPorPagina, $type_user)
	{
		$sql = "SELECT ep.*, p.*, c.name_city, r.name_region 
				FROM events_private ep 
				JOIN plans p ON ep.id_plan = p.id_plan AND ep.id_plan_key = p.id_plan_key 
				JOIN cities c ON ep.id_city = c.id_city 
				JOIN regions_cities rc ON c.id_city = rc.id_city 
				JOIN regions r ON rc.id_region = r.id_region 
				-- WHERE p.id_user = :id_user 
				WHERE ep.$type_user = :id_user 
				ORDER BY ep.id_event DESC 
				LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		//$stmt->bindValue(':type_user', $type_user, PDO::PARAM_STR);
		// El bindValue para LIMIT debe ser específico para manejar correctamente los valores enteros
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindParam(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Obtiene los detalles de una reserva específica de la tabla events_private.
	 * 
	 * @param int $idReserva El ID de la reserva a buscar.
	 * @return array Los detalles de la reserva o un mensaje de error.
	 */
	public static function obtenerDetalleReserva($idReserva)
	{
		try {
			$sql = "SELECT * FROM events_private WHERE id_event = :id_event";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(':id_event', $idReserva, PDO::PARAM_INT);

			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($resultado) {
				return $resultado;
			} else {
				return ['error' => 'No se encontró la reserva con el ID especificado'];
			}
		} catch (PDOException $e) {
			return ['error' => 'Error al obtener los detalles de la reserva: ' . $e->getMessage()];
		}
	}


	// Actualiza los detalles de la reserva
	public static function actualizarDetalleReserva($idReserva, $nameEvent, $location, $idRegion, $idCity, $dateEvent, $phoneEvent, $descEvent)
	{
		$sql = "UPDATE events_private SET name_event = :nameEvent, location = :location, id_region = :idRegion, id_city = :idCity, date_event = :dateEvent, phone_event = :phoneEvent, desc_event = :descEvent 
				WHERE id_event = :idReserva";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindParam(':nameEvent', $nameEvent);
		$stmt->bindParam(':location', $location);
		$stmt->bindParam(':idRegion', $idRegion);
		$stmt->bindParam(':idCity', $idCity);
		$stmt->bindParam(':dateEvent', $dateEvent);
		$stmt->bindParam(':phoneEvent', $phoneEvent);
		$stmt->bindParam(':descEvent', $descEvent);
		$stmt->bindParam(':idReserva', $idReserva);

		return $stmt->execute();
	}


	// Mostrar Notificación de reservas nuevas
	public static function obtenerNotificacionDeReservasPorUsuario($id_usuario, $id_type_user, $statusEvent)
	{
		try {
			$db = Conexion::conectar();
			$stmt = $db->prepare("SELECT count(*) AS total_reservas FROM events_private ep WHERE ep.status_event like '$statusEvent' AND ep.$id_type_user = :id_user");
			$stmt->bindParam(":id_user", $id_usuario, PDO::PARAM_INT);
			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			return $resultado['total_reservas'];
		} catch (PDOException $e) {
			// Manejar el error o registrar
			return false;
		}
	}

	// Mostrar Proeyctos Crowdfounding
	public static function obtenerProyectosPorUsuario($id_usuario, $offset, $numPorPagina)
	{
		// $sql = "SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.id_user = :id_user ORDER BY pc.id_project DESC LIMIT :offset, :numPorPagina";
		$sql = "SELECT pc.*, pd.*, pm.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project INNER JOIN project_multimedia pm ON pc.id_project = pm.id_project WHERE pc.id_user = :id_user AND pm.project_multimedia_type=1 ORDER BY pc.id_project DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Mostrar poryecto por ID
	public static function obtenerProyectosPorId($id_project)
	{
		// $sql = "SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.id_user = :id_user ORDER BY pc.id_project DESC LIMIT :offset, :numPorPagina";
		$sql = "SELECT pc.*, pd.*, pm.*, pca.*  FROM `projects_crowdfunding` pc 
		INNER JOIN project_desc pd ON pd.id_project = pc.id_project 
		INNER JOIN project_multimedia pm ON pc.id_project = pm.id_project 
		INNER JOIN project_categories pca ON pc.id_project = pca.id_project  
		WHERE pc.id_project = :id_project  AND pm.project_multimedia_type=1  ORDER BY pc.id_project ";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_project', $id_project, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public static function obtenerMontosPorId($id_project)
	{
		$sql = "SELECT pc.*, pti.* FROM projects_crowdfunding pc
				INNER JOIN project_times pti ON pc.id_project = pti.id_project 
				WHERE pc.id_project = :id_project  ";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_project', $id_project, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public static function obtenerRecompensasPorId($idProjectActual)
	{
		// Consulta para obtener las recompensas por ID de proyecto y filtrar por slots de tier del 1 al 5
		$sql = "SELECT * FROM `project_tiers` 
            WHERE id_project = :id_project 
            AND tier_slot BETWEEN 1 AND 5
            ORDER BY tier_slot ASC";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_project', $idProjectActual, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function obtenerMultimediaPorId($idProjectActual)
	{
		// Consulta para obtener las recompensas por ID de proyecto y filtrar por slots de tier del 1 al 5
		$sql = "SELECT * FROM `project_multimedia` 
            WHERE id_project = :id_project 
            AND project_multimedia_type BETWEEN 1 AND 2
            ORDER BY project_multimedia_type ASC";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_project', $idProjectActual, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Validar poryectos en curso


	// Función para verificar si el usuario tiene proyectos en curso
	public static function proyectosEnCurso($id)
	{
		try {
			$db = self::conectar(); // Asume que tienes un método conectar() que retorna la conexión a la base de datos
			$stmt = $db->prepare("SELECT * FROM projects_crowdfunding WHERE id_user = :id_user AND status_project = 0");
			$stmt->bindValue(':id_user', $id, PDO::PARAM_INT);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($resultado) {
				// Hay proyectos en curso, retorna el array con la información
				return $resultado;
			} else {
				// No hay proyectos en curso
				return null;
			}
		} catch (PDOException $e) {
			// Manejo del error
			error_log("Error al verificar proyectos en curso: " . $e->getMessage());
			return null;
		}
	}

	public static function proyectosEnCursoEditar($id, $idProject)
	{
		try {
			$db = self::conectar(); // Asume que tienes un método conectar() que retorna la conexión a la base de datos
			$stmt = $db->prepare("SELECT * FROM projects_crowdfunding WHERE id_project = :idProject ORDER BY id_project DESC");
			$stmt->bindValue(':idProject', $idProject, PDO::PARAM_INT);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($resultado) {
				// Hay proyectos en curso, retorna el array con la información
				return $resultado;
			} else {
				// No hay proyectos en curso
				return null;
			}
		} catch (PDOException $e) {
			// Manejo del error
			error_log("Error al verificar proyectos en curso: " . $e->getMessage());
			return null;
		}
	}

	// Crear los montos y plazos de Crowdfunding
	public static function crearMontos($idProject, $projectAmount)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE projects_crowdfunding 
							SET project_amount = :project_amount
							WHERE id_project = :id_project");
			$stmt->bindValue(':id_project', $idProject);
			$stmt->bindValue(':project_amount', $projectAmount);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Manejar error
			error_log('PDOException - ' . $e->getMessage(), 0);
			return false;
		}
	}


	// Crear los  plazos de Crowdfunding
	public static function crearPlazos($idProject, $duration, $execution)
	{
		try {
			$db = self::conectar();
			// Preparar la consulta para actualizar los plazos en project_times
			$stmt = $db->prepare("UPDATE project_times SET rec_time = :duration, exec_time = :execution WHERE id_project = :id_project");
			$db->beginTransaction();

			// Vincular los parámetros
			$stmt->bindParam(':id_project', $idProject, PDO::PARAM_INT);
			$stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
			$stmt->bindParam(':execution', $execution, PDO::PARAM_INT);

			// Ejecutar la actualización
			$stmt->execute();

			// Si se afectaron filas, entonces el UPDATE fue exitoso
			if ($stmt->rowCount() > 0) {
				$db->commit();
				return true; // Devuelve true si los plazos se actualizaron con éxito
			} else {
				// No se encontró el proyecto o los valores eran los mismos, no se actualizó nada
				$db->rollBack();
				return false; // Puede que no necesites retornar false aquí dependiendo de tu lógica de negocio
			}
		} catch (PDOException $e) {
			// En caso de error, revertir la transacción
			$db->rollBack();
			error_log("Error al actualizar plazos en project_times: " . $e->getMessage());
			return false; // Devuelve false en caso de error
		}
	}


	//  Función para editar Plazos
	public static function editarPlazos($idProject, $recTime, $execTime)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE project_times SET rec_time = :recTime, exec_time = :execTime WHERE id_project = :idProject");
			$stmt->bindParam(':recTime', $recTime);
			$stmt->bindParam(':execTime', $execTime);
			$stmt->bindParam(':idProject', $idProject);
			$stmt->execute();
			return $stmt->rowCount() > 0;
		} catch (PDOException $e) {
			// Manejo de error
			return false;
		}
	}
	// Función para edutar Montos
	public static function editarMontos($idProject, $projectAmount)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE projects_crowdfunding SET project_amount = :projectAmount WHERE id_project = :idProject");
			$stmt->bindParam(':projectAmount', $projectAmount);
			$stmt->bindParam(':idProject', $idProject);
			$stmt->execute();
			return $stmt->rowCount() > 0;
		} catch (PDOException $e) {
			// Manejo de error
			return false;
		}
	}




	// Actualiza las recompensas
	public static function crearActualizarRecompensa($idProyecto, $tierSlot, $tierTitle, $tierAmount, $tierDesc, $rewards, $statusTier)
	{
		try {
			$db = self::conectar();

			// Prepara la consulta UPDATE
			$stmt = $db->prepare("UPDATE project_tiers SET
				tier_title = :tier_title,
				tier_amount = :tier_amount,
				tier_desc = :tier_desc,
				t_reward_01 = :t_reward_01,
				t_reward_02 = :t_reward_02,
				t_reward_03 = :t_reward_03, 
				t_reward_04 = :t_reward_04,
				status_tier = :status_tier
				WHERE id_project = :id_project AND tier_slot = :tier_slot");

			// Vincula los parámetros a la consulta
			$stmt->bindParam(':id_project', $idProyecto, PDO::PARAM_INT);
			$stmt->bindParam(':tier_slot', $tierSlot, PDO::PARAM_INT);
			$stmt->bindParam(':tier_title', $tierTitle);
			$stmt->bindParam(':tier_amount', $tierAmount, PDO::PARAM_INT);
			$stmt->bindParam(':tier_desc', $tierDesc);

			// Se asume que $rewards tiene hasta 4 elementos. Si no, los faltantes se envían como NULL
			for ($i = 0; $i < 4; $i++) {
				$rewardParam = ":t_reward_" . sprintf("%02d", $i + 1);
				$stmt->bindValue($rewardParam, $rewards[$i] ?? null);
			}

			$stmt->bindParam(':status_tier', $statusTier, PDO::PARAM_INT);

			// Ejecuta la consulta
			return $stmt->execute();
		} catch (PDOException $e) {
			error_log("Error al actualizar recompensa: " . $e->getMessage());
			return false;
		}
	}


	// Crear las 5 recompensas 
	public static function crearRegistrosTiers($id_project)
	{
		try {
			$db = self::conectar();
			// Preparar la consulta para insertar los cinco registros
			$stmt = $db->prepare("INSERT INTO project_tiers (id_project, tier_slot, status_tier) VALUES (:id_project, :tier_slot, 0)");

			// Iniciar una transacción para asegurar que todos los registros se inserten juntos
			$db->beginTransaction();

			// Insertar los cinco registros con un bucle
			for ($tierSlot = 1; $tierSlot <= 5; $tierSlot++) {
				$stmt->bindParam(':id_project', $id_project, PDO::PARAM_INT);
				$stmt->bindParam(':tier_slot', $tierSlot, PDO::PARAM_INT);
				$stmt->execute();
			}

			// Comprometer (commit) la transacción
			$db->commit();

			return true; // Devuelve true si los registros se insertaron con éxito
		} catch (PDOException $e) {
			// En caso de error, revertir la transacción
			$db->rollBack();
			error_log("Error al insertar registros en project_tiers: " . $e->getMessage());
			return false; // Devuelve false en caso de error
		}
	}

	// Crea los 2 registros multimedia de proyectos
	public static function crearRegistrosMultimedia($id_project)
	{
		try {
			$db = self::conectar();
			// Preparar la consulta para insertar los cinco registros
			$stmt = $db->prepare("INSERT INTO project_multimedia (id_project, project_multimedia_type, project_multimedia_name  ) VALUES (:id_project, :project_multimedia_type,'' )");

			// Iniciar una transacción para asegurar que todos los registros se inserten juntos
			$db->beginTransaction();

			// Insertar los cinco registros con un bucle
			for ($multSlot = 1; $multSlot <= 2; $multSlot++) {
				$stmt->bindParam(':id_project', $id_project, PDO::PARAM_INT);
				$stmt->bindParam(':project_multimedia_type', $multSlot, PDO::PARAM_INT);
				$stmt->execute();
			}

			// Comprometer (commit) la transacción
			$db->commit();

			return true; // Devuelve true si los registros se insertaron con éxito
		} catch (PDOException $e) {
			// En caso de error, revertir la transacción
			$db->rollBack();
			error_log("Error al insertar registros en project_multimedia: " . $e->getMessage());
			return false; // Devuelve false en caso de error
		}
	}

	// Crea registros de times en tabla 
	public static function crearRegistrosTimes($id_project)
	{
		try {
			$db = self::conectar();
			// Preparar la consulta para insertar el registro 
			$stmt = $db->prepare("INSERT INTO project_times (id_project, rec_time, exec_time) VALUES (:id_project, null, null)");

			// Iniciar una transacción para asegurar la integridad
			$db->beginTransaction();

			// Vincular parámetros y ejecutar
			$stmt->bindParam(':id_project', $id_project, PDO::PARAM_INT);
			$stmt->execute();

			$db->commit();

			return true; // Devuelve true si el registro se insertó con éxito
		} catch (PDOException $e) {
			// En caso de error, revertir la transacción
			$db->rollBack();
			error_log("Error al insertar registro en project_times: " . $e->getMessage());
			return false; // Devuelve false en caso de error
		}
	}


	// Guardar los datos multimedia
	public static function guardarMultimediaProyecto($projectId, $mediaType, $mediaName, $mediaService)
	{
		try {
			$db = self::conectar(); // Asume que tienes un método para conectar a la base de datos

			// Inserta o actualiza el registro multimedia del proyecto
			$sql = "UPDATE project_multimedia SET project_multimedia_name = :project_multimedia_name, project_multimedia_service = :project_multimedia_service 
			        WHERE id_project = :id_project AND project_multimedia_type = :project_multimedia_type";
			// $sql = "INSERT INTO project_multimedia (id_project, project_multimedia_type, project_multimedia_name, project_multimedia_service) 
			// VALUES (:id_project, :project_multimedia_type, :project_multimedia_name, :project_multimedia_service) 
			// ON DUPLICATE KEY UPDATE project_multimedia_name = :project_multimedia_name, project_multimedia_service = :project_multimedia_service";

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id_project', $projectId, PDO::PARAM_INT);
			$stmt->bindParam(':project_multimedia_type', $mediaType, PDO::PARAM_INT);
			$stmt->bindParam(':project_multimedia_name', $mediaName, PDO::PARAM_STR);
			$stmt->bindParam(':project_multimedia_service', $mediaService, PDO::PARAM_STR);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Manejo de error
			error_log("Error al guardar multimedia del proyecto: " . $e->getMessage());
			return false;
		}
	}

	// Verificar datos multimedia
	public static function verificarDatosMultimedia($idProject)
	{
		try {
			$db = self::conectar();
			// La consulta verifica si existen entradas para el proyecto dado con multimedia_name no nulo/vacío
			$sql = "SELECT COUNT(*) AS cnt FROM project_multimedia 
					WHERE id_project = :id_project 
					AND project_multimedia_name IS NOT NULL 
					AND project_multimedia_name <> '' 
					AND (project_multimedia_type = 1 OR project_multimedia_type = 2)";

			$stmt = $db->prepare($sql);
			$stmt->bindValue(':id_project', $idProject, PDO::PARAM_INT);
			$stmt->execute();

			// Obtiene el resultado de la consulta
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			// Si cnt es mayor que 0, entonces hay datos capturados
			if ($result && $result['cnt'] > 0) {
				return 1; // Existen datos capturados
			} else {
				return 0; // No existen datos capturados
			}
		} catch (PDOException $e) {
			// Manejo del error
			error_log("Error al verificar datos multimedia: " . $e->getMessage());
			return false; // Indica error
		}
	}

	// Verifica datos recompensas
	public static function verificarDatosRecompensa($idProject)
	{
		try {
			$db = self::conectar();
			// La consulta verifica si existe una entrada para el proyecto y tier_slot con un tier_title no nulo/vacío
			$sql = "SELECT COUNT(*) AS cnt FROM project_tiers 
                WHERE id_project = :id_project 
                AND tier_slot = 1 
                AND tier_title IS NOT NULL 
                AND tier_title <> ''";

			$stmt = $db->prepare($sql);
			$stmt->bindValue(':id_project', $idProject, PDO::PARAM_INT);
			$stmt->execute();

			// Obtiene el resultado de la consulta
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			// Si cnt es mayor que 0, entonces hay un tier_title capturado para tier_slot = 1
			if ($result && $result['cnt'] > 0) {
				return 1; // Existe un tier_title capturado
			} else {
				return 0; // No existe un tier_title capturado
			}
		} catch (PDOException $e) {
			// Manejo del error
			error_log("Error al verificar datos de recompensa: " . $e->getMessage());
			return false; // Indica error
		}
	}

	// Verifica montos

	public static function verificarMontoProyecto($idProject)
	{
		try {
			$db = self::conectar(); // Asume que tienes un método para conectar a la base de datos

			// La consulta verifica si existe una entrada para el proyecto con un project_amount no nulo/vacío
			$sql = "SELECT COUNT(*) AS cnt FROM projects_crowdfunding 
                WHERE id_project = :id_project 
                AND project_amount IS NOT NULL 
                AND project_amount <> ''";

			$stmt = $db->prepare($sql);
			$stmt->bindValue(':id_project', $idProject, PDO::PARAM_INT);
			$stmt->execute();

			// Obtiene el resultado de la consulta
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			// Si cnt es mayor que 0, entonces hay un project_amount capturado
			if ($result && $result['cnt'] > 0) {
				return 1; // Existe un project_amount capturado
			} else {
				return 0; // No existe un project_amount capturado
			}
		} catch (PDOException $e) {
			// Manejo del error
			error_log("Error al verificar monto del proyecto: " . $e->getMessage());
			return false; // Indica error
		}
	}

	// Publicar proyecto y activar el estado  de status_rpject ademas de actualziar las fechas de inicio, duración y ejecución 
	public static function publicarProyecto($idProject, $projectDateStart, $projectDateEnd, $projectDateExecution)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE projects_crowdfunding SET status_project = 1, project_date_start = :project_date_start, project_date_end = :project_date_end, project_date_execution = :project_date_execution WHERE id_project = :id_project");

			$stmt->bindParam(':id_project', $idProject, PDO::PARAM_INT);
			$stmt->bindParam(':project_date_start', $projectDateStart);
			$stmt->bindParam(':project_date_end', $projectDateEnd);
			$stmt->bindParam(':project_date_execution', $projectDateExecution);

			return $stmt->execute();
		} catch (PDOException $e) {
			error_log("Error al publicar proyecto: " . $e->getMessage());
			return false;
		}
	}


	// Obtener los tiempos de fechas de duración y ejecución
	public static function obtenerTiemposProyecto($idProject)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("SELECT rec_time, exec_time FROM project_times WHERE id_project = :id_project");
			$stmt->bindParam(':id_project', $idProject, PDO::PARAM_INT);
			$stmt->execute();

			// Suponiendo que cada proyecto tiene una única fila en project_times
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row;
			} else {
				return false; // No se encontraron tiempos para el proyecto
			}
		} catch (PDOException $e) {
			error_log("Error al obtener tiempos del proyecto: " . $e->getMessage());
			return false;
		}
	}





	public static function totalProyectos($id_usuario)
	{
		$sql = "SELECT COUNT(id_event) FROM events_public WHERE id_user = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	// Total recaudado
	static public function recaudadoCrowdfunding($idProject)
	{
		$conexion = Conexion::conectar();
		$stmt = $conexion->prepare("SELECT SUM(backer_amount + backer_added_amount) AS total_recaudado FROM project_backers WHERE id_project = :id");
		$stmt->bindParam(":id", $idProject, PDO::PARAM_INT);
		$stmt->execute();

		// Fetch  
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		if ($resultado && $resultado['total_recaudado'] !== null) {
			return $resultado['total_recaudado'];
		} else {
			// Regresa  0 si no hay nada recaudado
			return 0;
		}
	}



	// ----------------
	// Funciones de Administración
	// Mostrar Usaurios con paginador
	// public static function obtenerUsuarios($offset, $numPorPagina)
	// {
	// 	$sql = "SELECT * FROM users  ORDER BY id_user DESC LIMIT :offset, :numPorPagina";
	// 	$stmt = self::conectar()->prepare($sql);
	// 	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	// 	$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

	// Obtener Usuarios con filtro de búsqueda
	public static function obtenerUsuarios($offset, $numPorPagina, $filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Asegúrate de usar placeholders únicos para cada condición
			$filtroSQL = "WHERE id_user LIKE :filtro1 OR mail_user LIKE :filtro2 OR last_name_user LIKE :filtro3 OR first_name_user LIKE :filtro4 OR nick_user LIKE :filtro5";
		}

		$sql = "SELECT * FROM users $filtroSQL ORDER BY id_user DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro5', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



	// public static function totalUsuarios()
	// {
	// 	$sql = "SELECT COUNT(id_user) FROM users  ";
	// 	$stmt = self::conectar()->prepare($sql);
	// 	$stmt->bindValue(':id_user', $id_usuario, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchColumn();
	// }

	public static function totalUsuarios($filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Utiliza placeholders únicos para cada condición en la consulta SQL
			$filtroSQL = "WHERE id_user LIKE :filtro1 OR mail_user LIKE :filtro2 OR last_name_user LIKE :filtro3 OR first_name_user LIKE :filtro4 OR nick_user LIKE :filtro5";
		}

		$sql = "SELECT COUNT(id_user) FROM users $filtroSQL";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro5', $filtro, PDO::PARAM_STR);
		}
		$stmt->execute();
		return $stmt->fetchColumn();
	}


	// Nombres de Ciudades y Regiones
	public static function obtenerNombresCiudadYRegion($id_city)
	{
		$sql = "SELECT CONCAT (c.name_city ,', <br>', r.name_region) nombre_ciudadyregion
				FROM cities c JOIN regions_cities rc ON c.id_city = rc.id_city 
				              JOIN regions r ON rc.id_region = r.id_region 
				WHERE c.id_city = :id_city";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_city', $id_city, PDO::PARAM_INT);
		$stmt->execute();
		//return $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Fetch  
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		if ($resultado && $resultado['nombre_ciudadyregion'] !== null) {
			return $resultado['nombre_ciudadyregion'];
		} else {
			// Regresa  0 si no hay nada recaudado
			return 0;
		}
	}


	// Borrar usuario
	public static function borrarUsuario($idUser)
	{
		try {
			$db = self::conectar();
			// Inicia transacción
			$db->beginTransaction();

			$stmt = $db->prepare("DELETE FROM users WHERE id_user = :idUser");
			$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
			$stmt->execute();

			// Confirma los cambios
			$db->commit();
			$stmt = null; // Opcional, cerrar el objeto de sentencia

			return true;
		} catch (PDOException $e) { // Captura una excepción específica si es posible
			// En caso de error, revierte los cambios
			$db->rollback();
			// Opcional, registra el mensaje de error
			error_log("Error al borrar usuario: " . $e->getMessage());
			return false;
		}
	}

	// Función para cambiar el estado de verificación del Usuario
	public static function cambiarEstadoVerificacionUsuario($idUsuario, $verified)
	{
		try {
			$db = self::conectar();
			// Asegúrate de que la tabla y columna sean correctas
			$stmt = $db->prepare("UPDATE users SET verified = :verified WHERE id_user = :id_user"); // Cambia 'events_public' por 'users' o la tabla correcta
			$stmt->bindParam(':verified', $verified, PDO::PARAM_STR);
			$stmt->bindParam(':id_user', $idUsuario, PDO::PARAM_INT);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Log o manejo del error
			return false;
		}
	}

	// Obtener datos del usuario para editar Datos desde Admin Usuarios
	public static function obtenerDatosUsuarioPorId($id)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("SELECT * FROM users WHERE id_user = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($resultado) {
				return $resultado;
			} else {
				return null; // O maneja este caso según necesites
			}
		} catch (PDOException $e) {
			// Maneja el error, por ejemplo, registrando en un log
			return null;
		}
	}

	// Modificar los datos de usuario
	// En tu función actualizarDatosUsuario
	// public static function actualizarDatosUsuario($datosModel)
	// {
	// 	$stmt = Conexion::conectar()->prepare("UPDATE users 
	// 		SET nick_user=:nick_user, id_type_user=:id_type_user, mail_user=:mail_user, first_name_user=:first_name_user, 
	// 		last_name_user=:last_name_user, id_region=:id_region, id_city=:id_city, id_genero=:id_genero, id_subgenero=:id_subgenero, id_musician=:id_musician 
	// 		WHERE id_user=:id");

	// 	foreach ($datosModel as $key => $value) {
	// 		$stmt->bindValue(":$key", $value);
	// 	}

	// 	return $stmt->execute() ? "ok" : "error";
	// }

	// Nueva función para actualizar datos donde incluye solo acatualizar los datos que se hayan modificando, incluyendo dejar vacions los campos que no se hayan editado 
	public static function actualizarDatosUsuario($datosModel)
	{
		$campos = [];
		$parametros = [];

		foreach ($datosModel as $campo => $valor) {
			// Si el campo no está vacío, añádelo a la consulta
			if ($campo != 'id' && $valor !== '') {
				$campos[] = "$campo=:$campo";
				$parametros[":$campo"] = $valor;
			}
		}

		// Si no hay campos para actualizar, retorna un error o una notificación adecuada
		if (empty($campos)) {
			return 'No hay datos para actualizar.';
		}

		$sql = "UPDATE users SET " . implode(', ', $campos) . " WHERE id_user=:id";
		$stmt = Conexion::conectar()->prepare($sql);

		// Añade el ID al array de parámetros
		$parametros[':id'] = $datosModel['id'];

		foreach ($parametros as $param => $val) {
			$stmt->bindValue($param, $val);
		}

		return $stmt->execute() ? "ok" : "error";
	}


	//ADMIN EVENTOS ********************* 
	// Obtener Eventos con filtro de búsqueda
	public static function obtenerEventos($offset, $numPorPagina, $filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Asegúrate de usar placeholders únicos para cada condición
			$filtroSQL = "WHERE id_event LIKE :filtro1 OR id_user LIKE :filtro2 OR name_event LIKE :filtro3 OR name_location LIKE :filtro4 OR location LIKE :filtro5 OR organizer LIKE :filtro6";
		}

		$sql = "SELECT * FROM events_public $filtroSQL ORDER BY id_event DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro5', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro6', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function totalEventosAdmin($filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Utiliza placeholders únicos para cada condición en la consulta SQL			
			$filtroSQL = "WHERE id_event LIKE :filtro1 OR id_user LIKE :filtro2 OR name_event LIKE :filtro3 OR name_location LIKE :filtro4 OR location LIKE :filtro5 OR organizer LIKE :filtro6";
		}

		$sql = "SELECT COUNT(id_event) FROM events_public $filtroSQL";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro5', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro6', $filtro, PDO::PARAM_STR);
		}
		$stmt->execute();
		return $stmt->fetchColumn();
	}


	// Nombres de usuarios
	// public static function obtenerNombresUsuario($id_user)
	// {
	// 	$sql = "SELECT nick_user,first_name_user,last_name_user FROM users WHERE id_user= :id_user";
	// 	$stmt = self::conectar()->prepare($sql);
	// 	$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	//return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 	// Fetch  
	// 	$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
	// 	$stmt = null;
	// 	if ($resultado && $resultado['nombre_ciudadyregion'] !== null) {
	// 		return $resultado['nick_user'];
	// 	} else {
	// 		// Regresa  0 si no hay nada recaudado
	// 		return 0;
	// 	}
	// }

	public static function obtenerNombresUsuario($id_user)
	{
		$sql = "SELECT nick_user, first_name_user, last_name_user, mail_user FROM users WHERE id_user= :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		if ($resultado) {
			return $resultado; // Retorna el array con nick_user, first_name_user, y last_name_user
		} else {
			// Regresa un array vacío o con valores predeterminados si no hay resultados
			return ['nick_user' => '', 'first_name_user' => '', 'last_name_user' => ''];
		}
	}


	// Entradas
	// Obtener Tickets por  Eventos con filtro de búsqueda	
	public static function obtenerTicketsPorEventos($evento, $offset, $numPorPagina, $filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Asegúrate de usar placeholders únicos para cada condición
			$filtroSQL = " AND id_ticket LIKE :filtro1 OR subscribe_fname LIKE :filtro2 OR subscribe_lname LIKE :filtro3 OR subscribe_email LIKE :filtro4";
		}
		//SELECT s.*, t.* FROM subscribes_public s JOIN transactions_public t ON s.order_transaction = t.order_transaction WHERE s.id_event_public = 279
		// $sql = "SELECT * FROM events_public WHERE id_event_public = id_event $filtroSQL ORDER BY id_event DESC LIMIT :offset, :numPorPagina";

		$sql = "SELECT s.*, t.* FROM subscribes_public s JOIN transactions_public t ON s.order_transaction = t.order_transaction WHERE s.id_event_public = :id_event $filtroSQL ORDER BY id_subscribe_public DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);

		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindParam(':id_event', $evento, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindParam(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Proyectos
	public static function obtenerAportacionesPorProyecto($id_project, $offset, $numPorPagina, $filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Asegúrate de usar placeholders únicos para cada condición
			$filtroSQL = " AND id_project_backer LIKE :filtro1 OR id_user LIKE :filtro2 OR order_transaction LIKE :filtro3 OR id_project LIKE :filtro4";
		}

		$sql = "SELECT * FROM project_backers WHERE id_project = :id_project $filtroSQL ORDER BY id_project_backer DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);

		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindParam(':id_project', $id_project, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindParam(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function totalAportacionesporProyectoAdmin($filtro = '', $idProyecto)
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Utiliza placeholders únicos para cada condición en la consulta SQL			
			$filtroSQL = " AND id_project_backer LIKE :filtro1 OR id_user LIKE :filtro2 OR order_transaction LIKE :filtro3 OR id_project LIKE :filtro4";
		}

		$sql = "SELECT COUNT(id_project_backer) FROM project_backers WHERE id_project= :idProyecto $filtroSQL";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindParam(':idProyecto', $idProyecto, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}





	public static function totalTicketsporEventosAdmin($filtro = '', $idEvento)
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Utiliza placeholders únicos para cada condición en la consulta SQL			
			$filtroSQL = " AND id_ticket LIKE :filtro1 OR subscribe_fname LIKE :filtro2 OR subscribe_lname LIKE :filtro3 OR subscribe_email LIKE :filtro4";
		}

		$sql = "SELECT COUNT(id_subscribe_public) FROM subscribes_public WHERE id_event_public= :idEvento $filtroSQL";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro4', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	// Función en el modelo para cambiar el estado del evento 
	public static function cambiarEstadoEntradas($idEntrada, $subscribeStatus)
	{
		try {
			$db = self::conectar();
			//UPDATE `subscribes_public` SET `subscribe_status` = '0' WHERE `subscribes_public`.`id_subscribe_public` = 18901;
			$stmt = $db->prepare("UPDATE subscribes_public SET 	subscribe_status = :subscribe_status WHERE id_subscribe_public = :id_subscribe_public");
			$stmt->bindParam(':subscribe_status', $subscribeStatus, PDO::PARAM_INT);
			$stmt->bindParam(':id_subscribe_public', $idEntrada, PDO::PARAM_INT);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Log o manejo del error
			return false;
		}
	}

	// Aportaciones de poryectos
	public static function cambiarEstadoAportaciones($idAportacion, $subscribeStatus)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE project_backers SET status_backer = :status_backer WHERE id_project_backer = :id_project_backer");
			$stmt->bindParam(':status_backer', $subscribeStatus, PDO::PARAM_INT);
			$stmt->bindParam(':id_project_backer', $idAportacion, PDO::PARAM_INT);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Log o manejo del error
			return false;
		}
	}

	//borrar Entradas
	public static function borrarEntradas($idEntrada)
	{
		try {
			$db = self::conectar();
			// Inicia transacción
			$db->beginTransaction();

			// Borrar reserva
			$stmt = $db->prepare("DELETE FROM `subscribes_public` WHERE  `id_subscribe_public` =  :idEntrada");
			$stmt->execute([':idEntrada' => $idEntrada]);

			// Confirma los cambios
			$db->commit();

			return true;
		} catch (Exception $e) {
			// En caso de error, revierte los cambios
			$db->rollback();
			return false;
		}
	}


	// PROYECTOS
	// Muestra proyectos
	public static function obtenerProyectos($offset, $numPorPagina, $filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Asegúrate de usar placeholders únicos para cada condición
			$filtroSQL = "WHERE id_project LIKE :filtro1 OR id_user LIKE :filtro2 OR project_title LIKE :filtro3";
		}

		$sql = "SELECT * FROM projects_crowdfunding $filtroSQL ORDER BY id_project DESC LIMIT :offset, :numPorPagina";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
		}
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindValue(':numPorPagina', $numPorPagina, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Muestra el TOTAL de proyectos
	public static function totalProyectosAdmin($filtro = '')
	{
		$filtroSQL = '';
		if (!empty($filtro)) {
			$filtro = "%$filtro%";
			// Utiliza placeholders únicos para cada condición en la consulta SQL			
			$filtroSQL = "WHERE id_project LIKE :filtro1 OR id_user LIKE :filtro2 OR project_title LIKE :filtro3";
		}

		$sql = "SELECT COUNT(id_project) FROM projects_crowdfunding $filtroSQL";
		$stmt = self::conectar()->prepare($sql);
		if (!empty($filtro)) {
			// Vincula cada filtro a su respectivo placeholder
			$stmt->bindParam(':filtro1', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro2', $filtro, PDO::PARAM_STR);
			$stmt->bindParam(':filtro3', $filtro, PDO::PARAM_STR);
		}
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	// Nombres de Regiones
	public static function obtenerNombresRegion($id_region)
	{
		$sql = "SELECT name_region FROM regions WHERE id_region = :id_region ";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_region', $id_region, PDO::PARAM_INT);
		$stmt->execute();
		//return $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Fetch  
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		if ($resultado && $resultado['name_region'] !== null) {
			return $resultado['name_region'];
		} else {
			// Regresa  0 si no hay nada recaudado
			return 0;
		}
	}

	// Listar todas las regiones
	public static function listarRegionesConNombre()
	{
		$sql = "SELECT id_region, name_region FROM regions ORDER BY name_region ASC";
		$stmt = self::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	// Función en el modelo para cambiar el estado del Proyecto 
	public static function cambiarEstadoProyecto($idProyecto, $activeEvent)
	{
		try {
			$db = self::conectar();
			$stmt = $db->prepare("UPDATE projects_crowdfunding SET status_project = :status_project WHERE id_project = :id_project");
			$stmt->bindParam(':status_project', $activeEvent, PDO::PARAM_INT);
			$stmt->bindParam(':id_project', $idProyecto, PDO::PARAM_INT);

			return $stmt->execute();
		} catch (PDOException $e) {
			// Log o manejo del error
			return false;
		}
	}

	// Enlista las recoempensas por id_project
	// public static function obtenerRecompensasProyecto($id_project)
	// {
	// 	$sql = "SELECT id_tier, tier_slot, tier_title, tier_amount, tier_desc, t_reward_01, t_reward_02, t_reward_03, t_reward_04 
	// 			FROM project_tiers WHERE id_project= :id_project AND  status_tier = 1";
	// 	$stmt = self::conectar()->prepare($sql);
	// 	$stmt->bindValue(':id_project', $id_project, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
	// 	$stmt = null;
	// 	if ($resultado) {
	// 		return $resultado; // Retorna el array con nick_user, first_name_user, y last_name_user
	// 	} else {
	// 		// Regresa un array vacío o con valores predeterminados si no hay resultados
	// 		return [
	// 			'id_tier' => '', 'tier_slot' => '', 'tier_title' => '',
	// 			'tier_amount' => '',
	// 			'tier_desc' => '',
	// 			't_reward_01' => '',
	// 			't_reward_02' => '',
	// 			't_reward_03' => '',
	// 			't_reward_04' => ''
	// 		];
	// 	}
	// }
	// Enlista las recompensas por id_project
	public static function obtenerRecompensasProyecto($id_project)
	{
		$sql = "SELECT id_tier, tier_slot, tier_title, tier_amount, tier_desc, t_reward_01, t_reward_02, t_reward_03, t_reward_04 
            FROM project_tiers WHERE id_project= :id_project AND status_tier = 1";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_project', $id_project, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio aquí
		$stmt = null;
		return $resultado; // Retorna el array de recompensas
	}


	// Borrar aportacion
	public static function borrarAportaciones($idAporte)
	{
		try {
			$db = self::conectar();
			// Inicia transacción
			$db->beginTransaction();

			// Borrar reserva
			$stmt = $db->prepare("DELETE FROM `project_backers` WHERE  `id_project_backer` =  :idAporte");
			$stmt->execute([':idAporte' => $idAporte]);

			// Confirma los cambios
			$db->commit();

			return true;
		} catch (Exception $e) {
			// En caso de error, revierte los cambios
			$db->rollback();
			return false;
		}
	}


	// Crear Proyectos de Crowdfunding    
	public static function crearProyecto($id_user, $project_title, $project_region)
	{
		$db = self::conectar();
		$stmt = $db->prepare("INSERT INTO projects_crowdfunding (id_user, project_title, project_region, status_project) VALUES (?, ?, ?, 0)");
		if ($stmt->execute([$id_user, $project_title, $project_region])) {
			return $db->lastInsertId(); // Retorna el ID del proyecto creado
		} else {
			return false;
		}
	}

	public static function crearDescProyecto($id_project, $project_desc)
	{
		$db = self::conectar();
		$stmt = $db->prepare("INSERT INTO project_desc (id_project, project_desc) VALUES (?, ?)");
		return $stmt->execute([$id_project, $project_desc]);
	}

	public static function crearCategoriaProyecto($id_project, $id_category)
	{
		$db = self::conectar();
		$stmt = $db->prepare("INSERT INTO project_categories (id_project, id_category) VALUES (?, ?)");
		return $stmt->execute([$id_project, $id_category]);
	}


	// Función para actualizar el proyecto de Crowdfunding
	public static function actualizarProyecto($project_id, $id_user, $project_title, $project_region, $project_desc, $id_category)
	{
		try {
			$db = self::conectar();
			// Preparar la consulta de actualización
			$stmt = $db->prepare("UPDATE projects_crowdfunding 
                              SET id_user = :id_user, 
                                  project_title = :project_title, 
                                  project_region = :project_region
                              WHERE id_project = :id_project");

			// Vincular parámetros
			$stmt->bindParam(':id_user', $id_user);
			$stmt->bindParam(':project_title', $project_title);
			$stmt->bindParam(':project_region', $project_region);
			$stmt->bindParam(':id_project', $project_id);

			// Ejecutar la consulta
			$stmt->execute();

			// Actualizar la descripción del proyecto
			$stmt_desc = $db->prepare("UPDATE project_desc 
                                   SET project_desc = :project_desc 
                                   WHERE id_project = :id_project");
			$stmt_desc->bindParam(':project_desc', $project_desc);
			$stmt_desc->bindParam(':id_project', $project_id);
			$stmt_desc->execute();

			// Actualizar la categoría del proyecto
			$stmt_cat = $db->prepare("UPDATE project_categories 
                                  SET id_category = :id_category 
                                  WHERE id_project = :id_project");
			$stmt_cat->bindParam(':id_category', $id_category);
			$stmt_cat->bindParam(':id_project', $project_id);
			$stmt_cat->execute();

			return true;
		} catch (PDOException $e) {
			// Manejo de errores
			error_log("Error al actualizar el proyecto: " . $e->getMessage());
			return false;
		}
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
