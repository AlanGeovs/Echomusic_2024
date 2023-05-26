<?php

include "conexion.php";

class Consultas{
	public function detallesBusqueda($id){
//		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE id_event=:id");
                $stmt=Conexion::conectar()->prepare("SELECT a.*, b.* FROM events_public a INNER JOIN users b WHERE a.id_event=:id ORDER BY a.id_user ;");
		//$stmt=Conexion::conectar()->prepare("SELECT a.*,b.tag, b.DESCRIPCION FROM marcas a inner join categorias b WHERE a.id=:id and b.id IN (a.clase)");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        //return $id;
        $stmt->close();
	}
        
	public function detallesBusqueda2($id){
//		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE id_event=:id");
                $stmt=Conexion::conectar()->prepare("SELECT a.*, b.*,c.* FROM events_public a 	INNER JOIN users b  ON a.id_user = b.id_user  INNER JOIN tickets_public c  ON a.id_event = c.id_event WHERE a.id_event=:id ORDER BY a.id_user;");
		//$stmt=Conexion::conectar()->prepare("SELECT a.*,b.tag, b.DESCRIPCION FROM marcas a inner join categorias b WHERE a.id=:id and b.id IN (a.clase)");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll();
        //return $id;
        $stmt->close();
	}
       
//        Buscar VIdeo en Evento
	public function videoEvento($idEvento){ 
                $stmt=Conexion::conectar()->prepare("SELECT * FROM multimedia_feature_events WHERE id_event=:id;"); 
        $stmt->bindParam(":id",$idEvento,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        //return $id;
        $stmt->close();
	}        
       
//        Buscar Género
	public function buscarGenero($id){ 
                $stmt=Conexion::conectar()->prepare("SELECT gu.*, g.* FROM genre_user gu INNER JOIN genres g ON gu.id_genre = g.id_genre WHERE gu.id_user=:id;"); 
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        //return $id;
        $stmt->close();
	}        
        

	public function listaBusqueda($palabra){
		$stmt=Conexion::conectar()->prepare("SELECT a.*,b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID AND a.DENOM LIKE ?");
		//$stmt->bindParam(":palabra",$palabra,PDO::PARAM_STR);
		$stmt->bindValue(1, '%'.trim($palabra).'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function listaBusquedaCategoria($categoria){
		$stmt=Conexion::conectar()->prepare("SELECT a.*,b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID AND b.TAG=:categoria");
		$stmt->bindParam(":categoria",$categoria,PDO::PARAM_STR);
		//$stmt->bindValue(1, '%'.trim($categoria).'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function tagCategorias($clases){
		$stmt=Conexion::conectar()->prepare("SELECT tag FROM categorias WHERE id IN (:clases)");
		$stmt->bindParam(":clases", $clases,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		//return $clases;
		$stmt->close();
	}

	static public function listarCategorias(){
		$stmt=Conexion::conectar()->prepare("SELECT ID,TAG FROM categorias");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function listaBusquedaTitular($titular){
		$stmt=Conexion::conectar()->prepare("SELECT a.*,b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID AND a.TITULAR LIKE ?");
		$stmt->bindValue(1, '%'.trim($titular).'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function detallesBusquedaNumRegistro($numReg){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM marcas WHERE NO_REG=:numReg");
		$stmt->bindParam(":numReg",$numReg, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	static public function ultimasMarcas(){
		$stmt=Conexion::conectar()->prepare("SELECT a.*, b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID ORDER BY a.ID DESC LIMIT 3");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
        
        //Home Artistas
        static public function ultimosArtistas(){ 
                $stmt=Conexion::conectar()->prepare("SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre WHERE  picture_ready=1 AND verified like 'yes' AND user_destacado=1 ORDER BY RAND() LIMIT 6;");              
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
        $stmt->close();
	} 
        
        //Detalle de Artistas
	static public function detallesArtistas($id){
                $stmt=Conexion::conectar()->prepare("SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre  WHERE u.id_user=:id AND verified like 'yes'  ;");		
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        //return $id;
        $stmt->close();
	}        
        //Bio de Artistas
	static public function bioArtistas($id){
                $stmt=Conexion::conectar()->prepare("SELECT * FROM `bio_user`  WHERE id_user=:id  ;");		
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        //return $id;
        $stmt->close();
	}        
	       
        
	static public function ultimosEventos(){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE 1 ORDER BY id_event DESC LIMIT 6");
		$stmt->execute();
		return $stmt->fetchAll();
        $stmt->close();       
        }
        
	static public function ultimosEventos2(){
		$stmt=Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 GROUP BY e.id_user ORDER BY e.id_event DESC LIMIT 6;");
		$stmt->execute();
		return $stmt->fetchAll();
        $stmt->close();       
        }  
        
//	public function eventosRelacionadosGenero(){
//		$stmt=Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 GROUP BY e.id_user ORDER BY e.id_event DESC LIMIT 6;");
//		$stmt->execute();
//		return $stmt->fetchAll();
//        $stmt->close();       
//        }  
                 
        
        static public function eventosRelacionadosGenero($id){ 
                $stmt=Conexion::conectar()->prepare("SELECT e.*, t.*, gu.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event JOIN genre_user as gu ON e.id_user=gu.id_user WHERE e.active_event=1 AND gu.id_genre=:id GROUP BY e.id_user ORDER BY e.id_event DESC LIMIT 6;");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        //return $id;
        $stmt->close();
	}
        
        static public function eventosRelacionadosSINGenero(){ 
                $stmt=Conexion::conectar()->prepare("SELECT e.*, t.*, gu.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event JOIN genre_user as gu ON e.id_user=gu.id_user WHERE e.active_event=1  GROUP BY e.id_user ORDER BY RAND() LIMIT 6;");
//        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        //return $id;
        $stmt->close();
	}
        
        //Busca Ciudad y Región
        static public function buscaCiudadRegion($idCity, $idReg){
                $stmt=Conexion::conectar()->prepare("SELECT rc.*,c.*,r.* FROM regions_cities rc INNER JOIN regions r ON rc.id_region =r.id_region INNER JOIN cities c ON c.id_city = rc.id_city WHERE rc.id_region =:idReg AND rc.id_city=:idCity;");		
        $stmt->bindParam(":idCity",$idCity,PDO::PARAM_INT);
        $stmt->bindParam(":idReg",$idReg,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        //return $id;
        $stmt->close();
	} 
      
}