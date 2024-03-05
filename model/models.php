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

        // public function detallesBusqueda2($id)
        // {
        //         //		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE id_event=:id");
        //         $stmt = Conexion::conectar()->prepare("SELECT a.*, b.*,c.* FROM events_public a 	INNER JOIN users b  ON a.id_user = b.id_user  INNER JOIN tickets_public c  ON a.id_event = c.id_event WHERE a.id_event=:id ORDER BY a.id_user;");
        //         //$stmt=Conexion::conectar()->prepare("SELECT a.*,b.tag, b.DESCRIPCION FROM marcas a inner join categorias b WHERE a.id=:id and b.id IN (a.clase)");
        //         $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        //         $stmt->execute();
        //         return $stmt->fetchAll();
        //         //return $id;
        //         $stmt->close();
        // }

        public function detallesBusqueda2($id)
        {
                $db = Conexion::conectar();
                $query = "SELECT a.*, b.*, c.* 
                                FROM events_public a 
                                INNER JOIN users b ON a.id_user = b.id_user 
                                INNER JOIN tickets_public c ON a.id_event = c.id_event 
                                WHERE a.id_event = :id 
                                ORDER BY a.id_user";
                $stmt = $db->prepare($query);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
        }

        public function detallesBusquedaGratuitos($id)
        {
                //		$stmt=Conexion::conectar()->prepare("SELECT * FROM events_public WHERE id_event=:id");
                $stmt = Conexion::conectar()->prepare("SELECT a.*, b.* FROM events_public a INNER JOIN users b ON a.id_user = b.id_user WHERE a.id_event=:id ORDER BY a.id_user;");
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
        public static function buscarGenero($id)
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
                // Primera consulta que intenta obtener los detalles junto con el género
                $stmt = Conexion::conectar()->prepare("SELECT u.*, gu.*, g.* FROM users u LEFT JOIN genre_user gu ON u.id_user=gu.id_user LEFT JOIN genres g ON gu.id_genre = g.id_genre WHERE u.id_user=:id AND u.verified like 'yes'");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $resultados = $stmt->fetchAll();

                // Si la primera consulta devuelve un conjunto de resultados vacío o sin géneros asociados
                if (empty($resultados) || (count($resultados) === 1 && $resultados[0]['id_genre'] === null)) {
                        // Realiza la segunda consulta que solo obtiene los detalles del usuario sin el género
                        $stmt = Conexion::conectar()->prepare("SELECT * FROM users WHERE id_user=:id AND verified like 'yes'");
                        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                        $stmt->execute();
                        $resultados = $stmt->fetchAll();
                }

                return $resultados;
                // Nota: No es necesario el $stmt->close(); en PDO, es un método que no existe. 
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

        // Contar artistas con base en el query generado del filtro/búsqeuda
        public static function contarArtistas($condiciones)
        {
                // Conectar a la base de datos usando Conexion::conectar
                $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre WHERE picture_ready=1 AND verified like 'yes'" . $condiciones);

                // Ejecutar la consulta
                $stmt->execute();

                // Obtener el resultado
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retornar el conteo total de artistas
                return $resultado['total'];
        }

        //CONTACTO  Método para insertar una nueva solicitud de contacto
        public static function insertarSolicitud($data)
        {
                // Preparar la consulta SQL para insertar los datos de la solicitud
                $sql = "INSERT INTO `requests` (`fname_request`, `lname_request`, `subject_request`, `company_request`, `email_request`, `phone_request`, `message_request`) VALUES (:fname_request, :lname_request, :subject_request, :company_request, :email_request, :phone_request, :message_request)";

                // Conectar a la base de datos
                $stmt = Conexion::conectar()->prepare($sql);

                // Vincular los parámetros a la consulta
                $stmt->bindParam(':fname_request', $data['fname_request'], PDO::PARAM_STR);
                $stmt->bindParam(':lname_request', $data['lname_request'], PDO::PARAM_STR);
                $stmt->bindParam(':subject_request', $data['subject_request'], PDO::PARAM_STR);
                $stmt->bindParam(':company_request', $data['company_request'], PDO::PARAM_STR);
                $stmt->bindParam(':email_request', $data['email_request'], PDO::PARAM_STR);
                $stmt->bindParam(':phone_request', $data['phone_request'], PDO::PARAM_STR);
                $stmt->bindParam(':message_request', $data['message_request'], PDO::PARAM_STR);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                        return true; // Devolver true si la inserción fue exitosa
                } else {
                        return false; // Devolver false en caso de error
                }
        }

        // public static function insertarSolicitud($data)
        // {
        //         $db = self::conectar();
        //         $stmt = $db->prepare("INSERT INTO `requests` (`fname_request`, `lname_request`, `subject_request`, `company_request`, `email_request`, `phone_request`, `message_request`) VALUES (?, ?, ?, ?, ?, ?, ?)");

        //         return $stmt->execute([
        //                 $data['fname_request'],
        //                 $data['lname_request'],
        //                 $data['subject_request'],
        //                 $data['company_request'],
        //                 $data['email_request'],
        //                 $data['phone_request'],
        //                 $data['message_request']
        //         ]);
        // }

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
        //PRESSKIT de Artistas
        static public function bioPresskit($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `presskit`  WHERE id_user=:id  ;");
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
        static public function tarifasPorId($id, $id_name_plan)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `plans` WHERE `id_user` = :id AND `id_name_plan`=:id_name_plan ;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":id_name_plan", $id_name_plan, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        public static function registrarSolicitudContratacion($data)
        {
                $conexion = Conexion::conectar();
                $stmt = $conexion->prepare("INSERT INTO events_private (id_plan, id_user_buy, id_user_sell, value_plan_event, id_name_plan, name_event, location, id_region, id_city, date_event, phone_event, desc_event) 
                                            VALUES (:id_plan, 1,1, :value_plan, :id_name_plan, :name_event, :location, :id_region, :id_city, :date_event, :phone_event, :desc_event)");

                // Vincula los parámetros a la consulta SQL
                $stmt->bindValue(':id_plan', $data['id_plan']);
                $stmt->bindValue(':value_plan', $data['value_plan']);
                $stmt->bindValue(':id_name_plan', $data['id_name_plan']);
                $stmt->bindValue(':name_event', $data['name_event']);
                $stmt->bindValue(':location', $data['location']);
                $stmt->bindValue(':id_region', $data['id_region']);
                $stmt->bindValue(':id_city', $data['id_city']);
                $stmt->bindValue(':date_event', $data['date_event']);
                $stmt->bindValue(':phone_event', $data['phone_event']);
                $stmt->bindValue(':desc_event', $data['desc_event']);

                // Ejecuta la consulta y devuelve el resultado
                return $stmt->execute();
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


        // Newsletter
        public static function emailYaExiste($email)
        {
                $conexion = Conexion::conectar();
                $stmt = $conexion->prepare("SELECT COUNT(*) FROM newsletter WHERE email = :email");
                $stmt->execute([':email' => $email]);
                return $stmt->fetchColumn() > 0;
        }
        // Validar EMail Newsletter
        public static function registrarNewsletter($email)
        {
                $conexion = Conexion::conectar();
                $stmt = $conexion->prepare("INSERT INTO newsletter (email) VALUES (:email)");
                return $stmt->execute([':email' => $email]);
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
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 AND e.date_event >= CURDATE() GROUP BY e.id_user ORDER BY e.date_event ASC LIMIT 6;");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }

        static public function ultimosEventos2()
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 AND e.date_event >= CURDATE() GROUP BY e.id_user ORDER BY e.date_event ASC LIMIT 6;");
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
        static public function ultimosCrowdfundingPaginaInicio()
        {
                // $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.*
                //                                 FROM `projects_crowdfunding` pc
                //                                 INNER JOIN project_desc pd ON pd.id_project = pc.id_project
                //                                 WHERE pc.status_project > 0 AND pc.status_project < 5
                //                                 AND pc.project_date_end > CURDATE()
                //                                 ORDER BY RAND() LIMIT 6;
                // ;");
                // Nueva consulta que une la consulta de los 3 proyectos más recients activos y los 4 últimos financiados
                $stmt = Conexion::conectar()->prepare("(SELECT pc.*, pd.*
                                                FROM `projects_crowdfunding` pc
                                                INNER JOIN project_desc pd ON pd.id_project = pc.id_project
                                                WHERE pc.status_project > 0 AND pc.status_project < 5
                                                AND pc.project_date_end > CURDATE()
                                                ORDER BY RAND() LIMIT 3)
                                                UNION ALL
                                                (SELECT pc.*, pd.*
                                                FROM `projects_crowdfunding` pc 
                                                INNER JOIN project_desc pd ON pd.id_project = pc.id_project 
                                                WHERE pc.status_project = 2
                                                ORDER BY pc.project_date_end DESC LIMIT 4); 
                ");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt->close();
        }
        static public function crowdFinanciados()
        {
                // $stmt = Conexion::conectar()->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE  pc.status_project=2 ORDER BY pc.project_date_end DESC;");
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


        public static function insertarPreguntaCrowdfunding($id_project, $id_user, $question_desc)
        {
                try {
                        $db = Conexion::conectar();
                        $stmt = $db->prepare("INSERT INTO project_questions (id_project, id_user, question_desc) VALUES (:id_project, :id_user, :question_desc)");
                        $stmt->bindParam(':id_project', $id_project, PDO::PARAM_INT);
                        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                        $stmt->bindParam(':question_desc', $question_desc, PDO::PARAM_STR);
                        return $stmt->execute();
                } catch (PDOException $e) {
                        // Manejo del error
                        return false;
                }
        }

        // Denunciak
        public static function insertarDenuncia($id_project, $id_user, $question_desc, $report_category)
        {
                try {
                        $db = Conexion::conectar();
                        $stmt = $db->prepare("INSERT INTO project_reports (id_project, id_user, report_desc, report_category) VALUES (:id_project, :id_user, :report_desc, :report_category)");
                        $stmt->bindParam(':id_project', $id_project);
                        $stmt->bindParam(':id_user', $id_user);
                        $stmt->bindParam(':report_desc', $question_desc);
                        $stmt->bindParam(':report_category', $report_category);
                        return $stmt->execute();
                } catch (PDOException $e) {
                        // Manejo del error
                        return false;
                }
        }

        static public function eventosRelacionadosGenero($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.*, gu.* FROM events_public as e JOIN tickets_public as t 
                        ON e.id_event = t.id_event JOIN genre_user as gu ON e.id_user=gu.id_user 
                        WHERE e.active_event=1 AND gu.id_genre=:id AND e.date_event >= CURDATE()
                        GROUP BY e.id_user ORDER BY e.id_event DESC LIMIT 6;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        static public function eventosRelacionadosRegion($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.*, gu.* FROM events_public as e JOIN tickets_public as t 
                        ON e.id_event = t.id_event JOIN genre_user as gu ON e.id_user=gu.id_user 
                        WHERE e.active_event=1 AND e.id_region=:id AND e.date_event >= CURDATE()
                        GROUP BY e.id_user ORDER BY RAND() LIMIT 6;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        // Nueva consulta para ejecutar Eventos 
        public static function ejecutarEventos($query)
        {
                $stmt = Conexion::conectar()->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        // public static function contarEventosFiltrados($condiciones)
        // {
        //         $query = "SELECT COUNT(DISTINCT e.id_event) FROM events_public AS e JOIN tickets_public AS t ON e.id_event = t.id_event " . $condiciones;
        //         $stmt = Conexion::conectar()->prepare($query);
        //         $stmt->execute();
        //         return $stmt->fetchColumn();
        // }
        public static function contarEventosFiltrados($condiciones)
        {
                $query = "SELECT COUNT(DISTINCT e.id_event) FROM events_public AS e JOIN tickets_public AS t ON e.id_event = t.id_event " . $condiciones;
                $stmt = Conexion::conectar()->prepare($query);
                $stmt->execute();
                return $stmt->fetchColumn();
        }



        static public function eventosRelacionadosRandom()
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.*  FROM events_public as e 
                                        JOIN tickets_public as t ON e.id_event = t.id_event  
                                        WHERE e.active_event=1  AND e.date_event >= CURDATE()
                                        GROUP BY e.id_user ORDER BY RAND() LIMIT 6;");
                $stmt->execute();
                return $stmt->fetchAll();
                //return $id;
                $stmt->close();
        }

        //Eventos de Büsqeuda por Cartelera
        static public function eventosCarteleraBusqueda($id)
        {
                $stmt = Conexion::conectar()->prepare("SELECT e.*, t.* FROM events_public as e JOIN tickets_public as t ON e.id_event = t.id_event WHERE e.active_event=1 AND e.date_event >= CURDATE() GROUP BY e.id_user ORDER BY e.date_event ASC LIMIT 6;");
                // $stmt = Conexion::conectar()->prepare("SELECT e.* FROM events_public as e WHERE e.active_event=1 AND e.name_event LIKE ? GROUP BY e.id_user ORDER BY date_event DESC LIMIT 9;");
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
        //Busca Tipo de Artista
        static public function buscaTipoArtista($id_musician)
        {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `type_musician` WHERE `id_musician` = :id_musician;");
                $stmt->bindParam(":id_musician", $id_musician, PDO::PARAM_INT);
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
                // Conectar a la base de datos
                $conexion = Conexion::conectar();

                // Primera consulta con status_project = 1
                $stmt = $conexion->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.status_project=1 AND pc.id_user=:id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $resultados = $stmt->fetchAll();

                // Verificar si la primera consulta no devuelve resultados
                if (empty($resultados)) {
                        // Segunda consulta con status_project = 2 si la primera no devuelve resultados
                        // $stmt = $conexion->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE pc.status_project=2 AND pc.id_user=:id;");
                        $stmt = $conexion->prepare("SELECT pc.*, pd.* FROM `projects_crowdfunding` pc INNER JOIN project_desc pd ON pd.id_project = pc.id_project WHERE  pc.status_project=2 ORDER BY pc.project_date_end DESC;");
                        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                        $stmt->execute();
                        $resultados = $stmt->fetchAll();
                }

                return $resultados;
                // La llamada a $stmt->close(); no es necesaria en PDO, así que se puede omitir
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
                // $stmt = Conexion::conectar()->prepare("SELECT sum(`backer_amount`+`backer_added_amount`) FROM `project_backers` WHERE `id_project` =:id AND status_backer=1");
                $stmt = Conexion::conectar()->prepare("SELECT sum(`backer_amount`+`backer_added_amount`) FROM `project_backers` WHERE `id_project` =:id ");
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
