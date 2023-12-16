<?php

include "conexion.php";

class Consultas
{
        public function detallesBusqueda($id)
        {
                //		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE id_event=:id");
                $stmt = Conexion::conectar()->prepare("SELECT a.*, b.* FROM events_public a INNER JOIN users b WHERE a.id_event=:id ORDER BY a.id_user ;");
                //$stmt=Conexion::conectar()->prepare("SELECT a.*,b.tag, b.DESCRIPCION FROM marcas a inner join categorias b WHERE a.id=:id and b.id IN (a.clase)");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
                //return $id;
                $stmt->close();
        }

        public function detallesBusqueda2($id)
        {
                //		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE id_event=:id");
                $stmt = Conexion::conectar()->prepare("SELECT a.*, b.*,c.* FROM events_public a 	INNER JOIN users b  ON a.id_user = b.id_user  INNER JOIN tickets_public c  ON a.id_event = c.id_event WHERE a.id_event=:id ORDER BY a.id_user;");
                //$stmt=Conexion::conectar()->prepare("SELECT a.*,b.tag, b.DESCRIPCION FROM marcas a inner join categorias b WHERE a.id=:id and b.id IN (a.clase)");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //        Buscar VIdeo en Evento
        public function videoEvento($idEvento)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM multimedia_feature_events WHERE id_event=:id;");
                $stmt->bindParam(":id", $idEvento, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
                //return $id;
                $stmt->close();
        }

        //        Buscar Género
        public function buscarGenero($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT gu.*, g.* FROM genre_user gu INNER JOIN genres g ON gu.id_genre = g.id_genre WHERE gu.id_user=:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
                //return $id;
                $stmt->close();
        }


        public function listaBusqueda($palabra)
        {
                $stmt = Conexion::conectar()->prepare("SELECT a.*,b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID AND a.DENOM LIKE ?");
                //$stmt->bindParam(":palabra",$palabra,PDO::PARAM_STR);
                $stmt->bindValue(1, '%' . trim($palabra) . '%', PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        public function listaBusquedaCategoria($categoria)
        {
                $stmt = Conexion::conectar()->prepare("SELECT a.*,b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID AND b.TAG=:categoria");
                $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                //$stmt->bindValue(1, '%'.trim($categoria).'%', PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        public function tagCategorias($clases)
        {
                $stmt = Conexion::conectar()->prepare("SELECT tag FROM categorias WHERE id IN (:clases)");
                $stmt->bindParam(":clases", $clases, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
                //return $clases;
                $stmt->close();
        }

        static public function listarCategorias()
        {
                $stmt = Conexion::conectar()->prepare("SELECT ID,TAG FROM categorias");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        static public function listaBusquedaTitular($titular)
        {
                $stmt = Conexion::conectar()->prepare("SELECT a.*,b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID AND a.TITULAR LIKE ?");
                $stmt->bindValue(1, '%' . trim($titular) . '%', PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        static public function detallesBusquedaNumRegistro($numReg)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE NO_REG=:numReg");
                $stmt->bindParam(":numReg", $numReg, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
                $stmt->close();
        }

        static public function ultimasMarcas()
        {
                $stmt = Conexion::conectar()->prepare("SELECT a.*, b.TAG FROM marcas a INNER JOIN categorias b WHERE a.CLASE=b.ID ORDER BY a.ID DESC LIMIT 3");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        //Home Artistas
        static public function ultimosArtistas()
        {
                $stmt = Conexion::conectar()->prepare("SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre WHERE  picture_ready=1 AND verified like 'yes' AND user_destacado=1 ORDER BY RAND() LIMIT 12;");
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Artista de Búsqueda  ID
        static public function artistaBusqueda($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre WHERE picture_ready=1 AND verified like 'yes'  AND u.`nick_user` LIKE ? ORDER BY RAND() LIMIT 12;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Detalle de Artistas
        static public function detallesArtistas($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre  WHERE u.id_user=:id AND verified like 'yes'  ;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //////////****************************
        // BUSQUEDA DE ARTISTAS GENÉRICA

        static public function busquedaArtistas($sql)
        {
                $stmt = Conexion::conectar()->prepare("$sql");
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //
        //////////****************************
        //
        //
        //Bio de Artistas
        static public function bioArtistas($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `bio_user`  WHERE id_user=:id  ;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        //Desc de Artistas
        static public function descArtistas($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `desc_user`  WHERE id_user=:id  ;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public function tarifas($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `plans` WHERE `id_user` = :id  ;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }


        static public function integrantes($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `band_members` WHERE `id_user` = :id  ;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public  function obtenerInstrumento($id_instrument)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM instruments  WHERE `id_instrument` = :id_instrument; ");
                $stmt->bindParam(":id_instrument", $id_instrument, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        static public function ultimosEventos()
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM events_public WHERE 1 ORDER BY id_event DESC LIMIT 6");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        static public function ultimosEventos2()
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 GROUP BY e.id_user ORDER BY e.date_event DESC  LIMIT 6;");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        static public function ultimosCrowdfunding()
        {
                $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.status_project>0 AND pc.status_project<5 ORDER BY pc.project_date_end DESC;");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }
        static public function crowdFinanciados()
        {
                $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE  pc.status_project=2 ORDER BY pc.project_date_end DESC;");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        static public function ultimosCrowdfundingBusqueda($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.project_title LIKE ? AND pc.status_project=1 ORDER BY pc.project_date_end DESC;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        static public function ultimosCrowdfundingBusquedaRegion($id, $reg)
        {
                $stmt = Conexion::conectar()->prepare("SELECT u.*, pc.* FROM `users` u INNER JOIN `projects_crowdfunding` pc ON pc.id_user = u.id_user WHERE pc.project_title like ? AND u.id_region = ? AND pc.status_project=1 ORDER BY pc.project_date_end DESC;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT); 
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->bindValue(2, $reg, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        static public function ultimosCrowdfundingRegion($reg)
        {
                $stmt = Conexion::conectar()->prepare("SELECT u.*, pc.* FROM `users` u INNER JOIN `projects_crowdfunding` pc ON pc.id_user = u.id_user WHERE   u.id_region = ? AND pc.status_project=1 ORDER BY pc.project_date_end DESC;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);  
                $stmt->bindValue(1, $reg, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //	public function eventosRelacionadosGenero(){
        //		$stmt=Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 GROUP BY e.id_user ORDER BY e.id_event DESC LIMIT 6;");
        //		$stmt->execute();
        //		return $stmt->fetchAll();
        //        $stmt->close();       
        //        }  


        static public function eventosRelacionadosGenero($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.*, gu.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event JOIN genre_user as gu ON e.id_user=gu.id_user WHERE e.active_event=1 AND gu.id_genre=:id GROUP BY e.id_user ORDER BY e.id_event DESC LIMIT 6;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public function eventosRelacionadosRegion($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.*, gu.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event JOIN genre_user as gu ON e.id_user=gu.id_user WHERE e.active_event=1 AND e.id_region=:id GROUP BY e.id_user ORDER BY RAND() LIMIT 6;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Eventos de Büsqeuda por Cartelera
        static public function eventosCarteleraBusqueda($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.name_event LIKE ? GROUP BY e.id_user ORDER BY date_event DESC LIMIT 6;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }



        //Busca Ciudad y Región
        static public function buscaCiudadRegion($idCity, $idReg)
        {
                $stmt = Conexion::conectar()->prepare("SELECT rc.*,c.*,r.* FROM regions_cities rc INNER JOIN regions r ON rc.id_region =r.id_region INNER JOIN cities c ON c.id_city = rc.id_city WHERE rc.id_region =:idReg AND rc.id_city=:idCity;");
                $stmt->bindParam(":idCity", $idCity, PDO::PARAM_INT);
                $stmt->bindParam(":idReg", $idReg, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Solo selecciona la última pla list del artesta 
        static public function playListArtista($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `multimedia_feature` WHERE `id_user`=:id ORDER BY id_multimedia_featured DESC LIMIT 1;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        //        Selecciona todos los videos
        static public function videoArtista($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `multimedia` WHERE `id_user`=:id ORDER BY id_multi DESC;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Próximos eventos por artista
        static public function eventosPorArtista($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `events_public` WHERE `id_user`=:id AND active_event=1 AND `date_event`>= NOW() ORDER BY `date_event` DESC;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }
        // eventos Pasadps por artista
        static public function eventosPasadosArtista($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `events_public` WHERE `id_user`=:id AND active_event=1 AND `date_event`< NOW() ORDER BY `date_event` DESC; ");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }
        //        Crowdfunding Temporalmete dejo `status_project` != 0 para enlistar todos los crowd activos o que pasaron
        //        falta definir qué hacer cada uno de los estados
        static public function crowdfunding($id)
        {
                //                $stmt=Conexion::conectar()->prepare("SELECT * FROM `projects_crowdfunding` WHERE `id_user`=:id AND `status_project` != 0");
                $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.status_project=1 AND pc.id_user=:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public function crowdfunding2($id)
        {
                //                $stmt=Conexion::conectar()->prepare("SELECT * FROM `projects_crowdfunding` WHERE `id_user`=:id AND `status_project` != 0");
                $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.id_user=:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public function recaudadoCrowdfunding($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT sum(`backer_amount`+`backer_added_amount`) FROM `project_backers` WHERE `id_project` =:id AND status_backer=1");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
                //return $id;
                $stmt->close();
        }

        static public function obtenerPorcentaje($cantidad, $total)
        {
                $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
                $porcentaje = round($porcentaje, 1);  // Quitar los decimales
                return $porcentaje;
        }

        //Detalle de CrowdFunding
        static public function detallesCrowdfunding($id)
        {
                //                $stmt=Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.status_project!=0 AND pc.id_project=:id;");		
                $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.*,u.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project INNER JOIN users u ON pc.id_user = u.id_user WHERE pc.status_project!=0 AND pc.id_project=:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        //Multimedia de CrowdFunding
        static public function multimaediaCrowdfunding($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `project_multimedia` WHERE `id_project` =:id ORDER BY `id_project_multimedia` DESC;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Tiers de CrowdFunding
        static public function tierCrowdfunding($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `project_tiers` WHERE `id_project` =:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Tiers de CrowdFunding +id_tier
        static public function tierCrowdfundingIDtier($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `project_tiers` WHERE `id_tier` =:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //         =============
        //         BUSCADOR AVANZADO
        //         =============
        //Eventos de Búsqueda + Fecha Inicial + Fecha Final
        static public function eventosFechas($id, $fi, $ff)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.name_event LIKE ? AND e.date_event BETWEEN ? AND ? GROUP BY e.id_user ORDER BY date_event DESC LIMIT 6;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->bindValue(2, $fi, PDO::PARAM_STR);
                $stmt->bindValue(3, $ff, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        //Eventos de Búsqueda + Fecha Inicial + Fecha Final + Region
        static public function eventosFechasReg($id, $fi, $ff, $reg)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.name_event LIKE ? AND e.date_event BETWEEN ? AND ? AND e.id_region = ? GROUP BY e.id_user ORDER BY date_event DESC LIMIT 6;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->bindValue(2, $fi, PDO::PARAM_STR);
                $stmt->bindValue(3, $ff, PDO::PARAM_STR);
                $stmt->bindParam(4, $reg, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }
        //Eventos de Búsqueda +  Fecha Inicial 
        static public function eventosFechaInicial($id, $fi)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.name_event LIKE ? AND e.date_event BETWEEN ? AND now() GROUP BY e.id_user ORDER BY date_event DESC LIMIT 6;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->bindValue(2, $fi, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Eventos de Búsqueda +  Fecha Inicial 
        static public function eventosFechaFinal($id, $ff)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.name_event LIKE ? AND e.date_event BETWEEN now() AND ? GROUP BY e.id_user ORDER BY date_event DESC LIMIT 6;");
                //                $stmt=Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.id_event =:id GROUP BY e.id_user ORDER BY RAND() LIMIT 3;");
                //        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(1, "%$id%", PDO::PARAM_STR);
                $stmt->bindValue(2, $ff, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public function truncar($numero, $digitos)
        {
                $truncar = 10 ** $digitos;
                return intval($numero * $truncar) / $truncar;
        }
}
