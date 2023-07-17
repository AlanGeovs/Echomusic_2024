<?php

require_once "conexion.php";

class Consultas  extends Conexion{
	public static function validarLogin($correo,$password){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo=:correo AND confirmPass=:password");
		$stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
		$stmt->bindParam(":password",$password,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function listarClases(){
		$stmt=Conexion::conectar()->prepare("SELECT ID, TAG FROM categorias");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        
        //Listado de Asociados
	public function listarAsociados(){
		$stmt=Conexion::conectar()->prepare("SELECT id, usuario, tipo FROM usuarios WHERE tipo like 'asociado'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        
        //Listado de Combustibles
	public function listarCombustible(){
		$stmt=Conexion::conectar()->prepare("SELECT id, combustible  FROM combustible WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        
        //Listado de Tipo de Autos
	public function listarTipo(){
		$stmt=Conexion::conectar()->prepare("SELECT id, tipo  FROM tipo WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function registrarInventario($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code, id_asociado, condicion, tipo, marca, modelo, version, ano, precio, transmision, combustible, kilometraje, color_int, color_ext, tam_motor, cilindros, note, observaciones, img, id_usuario) VALUES (:car_code, :asociado, :condicion, :tipo, :marca, :modelo, :version, :ano, :precio, :transmision, :combustible, :kilometraje, :color_int, :color_ext, :tam_motor, :cilindros, :note, :observaciones, :img, :idUser)");
//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code, id_asociado, condicion, tipo, marca, modelo) VALUES (:car_code, :asociado, :condicion, :tipo, :marca, :modelo)");
//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code ) VALUES (:car_code )");
		$stmt->bindParam(":car_code",$datosModel[0],PDO::PARAM_STR);
		$stmt->bindParam(":asociado",$datosModel[1],PDO::PARAM_INT);
		$stmt->bindParam(":condicion",$datosModel[2],PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$datosModel[3],PDO::PARAM_STR);
		$stmt->bindParam(":marca",$datosModel[4],PDO::PARAM_STR);
		$stmt->bindParam(":modelo",$datosModel[5],PDO::PARAM_STR);
		$stmt->bindParam(":version",$datosModel[6],PDO::PARAM_STR);
		$stmt->bindParam(":ano",$datosModel[7],PDO::PARAM_STR);
		$stmt->bindParam(":precio",$datosModel[8],PDO::PARAM_INT);
		$stmt->bindParam(":transmision",$datosModel[9],PDO::PARAM_STR);
		$stmt->bindParam(":combustible",$datosModel[10],PDO::PARAM_STR);
		$stmt->bindParam(":kilometraje",$datosModel[11],PDO::PARAM_INT);
		$stmt->bindParam(":color_int",$datosModel[12],PDO::PARAM_STR);
		$stmt->bindParam(":color_ext",$datosModel[13],PDO::PARAM_STR);
		$stmt->bindParam(":tam_motor",$datosModel[14],PDO::PARAM_STR);
		$stmt->bindParam(":cilindros",$datosModel[15],PDO::PARAM_STR);
		$stmt->bindParam(":note",$datosModel[16],PDO::PARAM_STR);
		$stmt->bindParam(":observaciones",$datosModel[17],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datosModel[18],PDO::PARAM_STR);
		$stmt->bindParam(":idUser",$datosModel[19],PDO::PARAM_INT);

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
	}        
        
	public function registrarMarcas($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (DENOM,CLASE,TITULAR,NO_REG,NO_SOL,ULTIMA_CERT_NOTARIAL,VIGENCIA,PAIS_ORI,C_LINK,C_TEL,C_FAX,C_EMAIL,PROD_SERV,AUTORIZADOS,URL_FUENTE,OBS,IMG,ID_USUARIO) VALUES (:denom, :clase, :titular, :no_reg, :no_sol, :ultima_cert, :vigencia, :pais, :link, :tel, :fax, :correo, :servicio, :autorizados, :fuente, :obs, :img, :idUser)");
		$stmt->bindParam(":denom",$datosModel[0],PDO::PARAM_STR);
		$stmt->bindParam(":clase",$datosModel[2],PDO::PARAM_STR);
		$stmt->bindParam(":titular",$datosModel[1],PDO::PARAM_STR);
		$stmt->bindParam(":no_reg",$datosModel[4],PDO::PARAM_INT);
		$stmt->bindParam(":no_sol",$datosModel[5],PDO::PARAM_INT);
		$stmt->bindParam(":ultima_cert",$datosModel[16],PDO::PARAM_INT);
		$stmt->bindParam(":vigencia",$datosModel[6],PDO::PARAM_STR);
		$stmt->bindParam(":pais",$datosModel[3],PDO::PARAM_STR);
		$stmt->bindParam(":link",$datosModel[11],PDO::PARAM_STR);
		$stmt->bindParam(":tel",$datosModel[9],PDO::PARAM_STR);
		$stmt->bindParam(":fax",$datosModel[10],PDO::PARAM_STR);
		$stmt->bindParam(":correo",$datosModel[8],PDO::PARAM_STR);
		$stmt->bindParam(":servicio",$datosModel[13],PDO::PARAM_STR);
		$stmt->bindParam(":autorizados",$datosModel[7],PDO::PARAM_STR);
		$stmt->bindParam(":fuente",$datosModel[12],PDO::PARAM_STR);
		$stmt->bindParam(":obs",$datosModel[14],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datosModel[15],PDO::PARAM_STR);
		$stmt->bindParam(":idUser",$datosModel[17],PDO::PARAM_INT);   

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
	}

	public static function registrarUsuarios($datosModel,$tabla){
//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, correo, password, confirmPass, tipo) VALUES (:usuario, :correo, :password, :confirmPass, :tipo)");
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (nick_user, mail_user, password_user,   id_type_user) VALUES (:usuario, :correo,  :confirmPass, :tipo)");
		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR); 
		$stmt->bindParam(":confirmPass", md5($datosModel[2]), PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[3], PDO::PARAM_STR); 

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
	}
//        Registrar Usuarios Anterior
//	public static function registrarUsuarios($datosModel,$tabla){
//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, correo, password, confirmPass, tipo) VALUES (:usuario, :correo, :password, :confirmPass, :tipo)");
//		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
//		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR);
//		$stmt->bindParam(":password", $datosModel[2], PDO::PARAM_STR);
//		$stmt->bindParam(":confirmPass", md5($datosModel[2]), PDO::PARAM_STR);
//		$stmt->bindParam(":tipo", $datosModel[3], PDO::PARAM_STR); 
//
//		if ($stmt->execute()) {
//			return "ok";
//		}else{
//			return "error";
//		}
//
//		$stmt->close();
//	}

	public static function validarRegistroUsuario($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("SELECT usuario, correo FROM $tabla WHERE usuario = :usuario AND correo = :correo");
		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

        
//        Inventario
	public function listarinventario(){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM inventario ORDER BY id DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        

        
        public function listarInventarioCapturista($id){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM inventario WHERE id_usuario=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        
        // Define total de usaurios Aosciados
        public function listarInventarioAsociados(){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM `usuarios` WHERE `tipo` LIKE 'asociado'");
//		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        public function sumaInventario(){
		$stmt=Conexion::conectar()->prepare("SELECT sum(`precio`) FROM `inventario` WHERE 1 "); 
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        public function cuentaInventario(){
		$stmt=Conexion::conectar()->prepare("SELECT COUNT(*) FROM `inventario` GROUP BY ID"); 
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

        public function detalleInventario($id){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM inventario WHERE id=:id");
		$stmt->bindParam(":id",$id,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
        

	public function modificarInventario($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET DENOM=:denom,CLASE=:clase,TITULAR=:titular,NO_REG=:no_reg,NO_SOL=:no_sol, ULTIMA_CERT_NOTARIAL=:ultima,VIGENCIA=:vigencia,PAIS_ORI=:pais,C_LINK=:link,C_TEL=:tel,C_FAX=:fax,C_EMAIL=:correo,PROD_SERV=:servicio,AUTORIZADOS=:autorizados,URL_FUENTE=:fuente,OBS=:obs,IMG=:img WHERE ID=:id");
		$stmt->bindParam(":denom",$datosModel[0],PDO::PARAM_STR);
		$stmt->bindParam(":clase",$datosModel[2],PDO::PARAM_STR);
		$stmt->bindParam(":titular",$datosModel[1],PDO::PARAM_STR);
		$stmt->bindParam(":no_reg",$datosModel[4],PDO::PARAM_INT);
		$stmt->bindParam(":no_sol",$datosModel[5],PDO::PARAM_INT);
		$stmt->bindParam(":vigencia",$datosModel[6],PDO::PARAM_STR);
		$stmt->bindParam(":pais",$datosModel[3],PDO::PARAM_STR);
		$stmt->bindParam(":link",$datosModel[11],PDO::PARAM_STR);
		$stmt->bindParam(":tel",$datosModel[9],PDO::PARAM_STR);
		$stmt->bindParam(":fax",$datosModel[10],PDO::PARAM_STR);
		$stmt->bindParam(":correo",$datosModel[8],PDO::PARAM_STR);
		$stmt->bindParam(":servicio",$datosModel[13],PDO::PARAM_STR);
		$stmt->bindParam(":autorizados",$datosModel[7],PDO::PARAM_STR);
		$stmt->bindParam(":fuente",$datosModel[12],PDO::PARAM_STR);
		$stmt->bindParam(":obs",$datosModel[14],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datosModel[15],PDO::PARAM_STR);
		$stmt->bindParam(":ultima",$datosModel[16],PDO::PARAM_STR);
		$stmt->bindParam(":id",$datosModel[17],PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
	}

	public static function eliminarInventario($id,$tabla){
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
	}        
        
        //filtrado de Inventario por 
	static public function filtroInventario($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE marca LIKE :marca1 OR modelo LIKE :modelo1 OR version LIKE :version1 OR ano LIKE :ano1 OR car_code LIKE :car_code1 ");
//		$stmt->bindValue(2, '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
                $stmt->bindValue(':marca1', '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
                $stmt->bindValue(':modelo1', '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
                $stmt->bindValue(':version1', '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
                $stmt->bindValue(':ano1', '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
                $stmt->bindValue(':car_code1', '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}        
        
//        Marcas
        public function listarMarcas(){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM marcas");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	} 
	public function listarMarcasCapturista($id){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM marcas WHERE ID_USUARIO=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	

	public static function tagCategorias($clases){
		$stmt=Conexion::conectar()->prepare("SELECT tag FROM categorias WHERE id IN (:clases)");
		$stmt->bindParam(":clases", $clases,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		//return $clases;
		$stmt->close();
	}

	public function detalleMarca($id){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM marcas WHERE id=:id");
		$stmt->bindParam(":id",$id,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	public function modificarMarca($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET DENOM=:denom,CLASE=:clase,TITULAR=:titular,NO_REG=:no_reg,NO_SOL=:no_sol, ULTIMA_CERT_NOTARIAL=:ultima,VIGENCIA=:vigencia,PAIS_ORI=:pais,C_LINK=:link,C_TEL=:tel,C_FAX=:fax,C_EMAIL=:correo,PROD_SERV=:servicio,AUTORIZADOS=:autorizados,URL_FUENTE=:fuente,OBS=:obs,IMG=:img WHERE ID=:id");
		$stmt->bindParam(":denom",$datosModel[0],PDO::PARAM_STR);
		$stmt->bindParam(":clase",$datosModel[2],PDO::PARAM_STR);
		$stmt->bindParam(":titular",$datosModel[1],PDO::PARAM_STR);
		$stmt->bindParam(":no_reg",$datosModel[4],PDO::PARAM_INT);
		$stmt->bindParam(":no_sol",$datosModel[5],PDO::PARAM_INT);
		$stmt->bindParam(":vigencia",$datosModel[6],PDO::PARAM_STR);
		$stmt->bindParam(":pais",$datosModel[3],PDO::PARAM_STR);
		$stmt->bindParam(":link",$datosModel[11],PDO::PARAM_STR);
		$stmt->bindParam(":tel",$datosModel[9],PDO::PARAM_STR);
		$stmt->bindParam(":fax",$datosModel[10],PDO::PARAM_STR);
		$stmt->bindParam(":correo",$datosModel[8],PDO::PARAM_STR);
		$stmt->bindParam(":servicio",$datosModel[13],PDO::PARAM_STR);
		$stmt->bindParam(":autorizados",$datosModel[7],PDO::PARAM_STR);
		$stmt->bindParam(":fuente",$datosModel[12],PDO::PARAM_STR);
		$stmt->bindParam(":obs",$datosModel[14],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datosModel[15],PDO::PARAM_STR);
		$stmt->bindParam(":ultima",$datosModel[16],PDO::PARAM_STR);
		$stmt->bindParam(":id",$datosModel[17],PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
	}

	public static function eliminarMarca($id,$tabla){
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public function listarUsuarios(){
		$stmt=Conexion::conectar()->prepare("SELECT id, usuario, correo, tipo, telefono FROM usuarios");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function detalleUsuario($id,$tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function eliminarUsuario($id,$tabla){
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public function listarCategorias(){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM categorias ORDER BY ID");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

//        Listar TIPO Autos para gráfica
        public function listarTipoAutos(){
		$stmt=Conexion::conectar()->prepare("SELECT `tipo`, COUNT(*) FROM `inventario` GROUP BY `tipo`");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function registrarCategoria($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (CLASE, TIPO, TAG, DESCRIPCION) VALUES (:clase, :tipo, :tag, :descripcion)");
		$stmt->bindParam(":clase",$datosModel[3],PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$datosModel[0],PDO::PARAM_STR);
		$stmt->bindParam(":tag",$datosModel[1],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[2],PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
	}

	public function nuevaCategoria($tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ID DESC LIMIT 1");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function eliminarCategoria($id,$tabla){
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public static function modificarCategoria($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET TIPO=:tipo, TAG=:tag, DESCRIPCION=:descripcion WHERE ID=:id");
		$stmt->bindParam(":tipo", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":tag", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[3], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public function estadisticasPorCategorias(){
		$stmt=Conexion::conectar()->prepare("SELECT b.tag, COUNT(CASE WHEN a.CLASE = b.ID THEN 1 ELSE null END) AS total FROM marcas a INNER JOIN categorias b GROUP BY b.TAG");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function listarMarcasPorCapturistas(){
		$stmt=Conexion::conectar()->prepare("SELECT a.*, b.usuario FROM marcas a INNER JOIN usuarios b WHERE a.ID_USUARIO=b.id AND b.tipo='capturista'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function registrarBitacora($usuario,$tabla,$accion){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, accion) VALUES (:usuario, :accion)");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":accion", $accion, PDO::PARAM_STR); 
		//$stmt->execute()
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public function bitacora($tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function bitacoraFechas($tabla){
		$stmt=Conexion::conectar()->prepare("SELECT DISTINCT(substring(fecha,1,10)) AS fechas FROM $tabla ORDER BY fechas DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function bitacoraPerfil($tabla,$usuario){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario=:usuario ORDER BY fecha DESC");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function filtroMarcas($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE denom LIKE ?");
		$stmt->bindValue(1, '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function datosPerfil($id, $tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	static public function actualizarUsuario($datosModel,$tabla){
		if (count($datosModel)<=2) {
			$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario WHERE id=:id");
			$stmt->bindParam(":id",$datosModel[0], PDO::PARAM_INT);
			$stmt->bindParam("usuario",$datosModel[1], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}
		}else{
			$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario, password=:nuevoPassword, confirmPass=:confirmNuevoPass WHERE id=:id");
			$stmt->bindParam(":id",$datosModel[0], PDO::PARAM_INT);
			$stmt->bindParam(":usuario",$datosModel[1], PDO::PARAM_STR);
			$stmt->bindParam(":nuevoPassword", $datosModel[2], PDO::PARAM_STR);
			$stmt->bindParam("confirmNuevoPass",$datosModel[3], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$stmt->close();
		}
	} 
}