<?php 
    require_once('../coneccion/coneccionPHP.php');

    class Listas {
        public function listar($tabla, $proceso = null){

            $conec = new conexion();
            $db = $conec->conectar();

            if($proceso != null && $tabla == "cat_tipo_apreciacion"){
                $sql = "SELECT * FROM cat_tipo_apreciacion WHERE proceso = :proceso";
                $query = $db->prepare($sql);
                $query->execute([
                    ':proceso' => $proceso
                ]);
            }else{
                $sql = "SELECT * FROM $tabla";
                $query = $db->prepare($sql);
                $query->execute();
            }

            $result = $query -> fetchAll(PDO::FETCH_ASSOC);

            if($result){
                return json_encode(['datos' => $result]);
            }else{
                return NULL;
            }
        }

        public function mapearLlavesForaneas($lista_datos){
            $conec = new conexion();
            $db = $conec->conectar();

            $datos = json_decode($lista_datos,true);
            $datos = $datos['datos'];

            if (!is_array($datos) || empty($datos)) {
                return json_encode(["datos" => $datos]);
            }

            $llaves = array_keys($datos[0]);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

            if (in_array('folio', $llaves)) {
                $unico = array_unique(array_column($datos, 'folio'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_folio, folio FROM folio WHERE id_folio IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['folio'];
                    if (isset($equivalencias[$idActual])) {
                        $item['folio'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            if (in_array('id_usuario', $llaves)) {
                $unico = array_unique(array_column($datos, 'id_usuario'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_usuario, usuario FROM usuario WHERE id_usuario IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['id_usuario'];
                    if (isset($equivalencias[$idActual])) {
                        $item['id_usuario'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            if (in_array('zona_economica', $llaves)) {
                $unico = array_unique(array_column($datos, 'zona_economica'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_zona_economica, zona_economica FROM cat_zona_economica WHERE id_zona_economica IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['zona_economica'];
                    if (isset($equivalencias[$idActual])) {
                        $item['zona_economica'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            if (in_array('proceso', $llaves)) {
                $unico = array_unique(array_column($datos, 'proceso'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_proceso, proceso FROM cat_proceso WHERE id_proceso IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['proceso'];
                    if (isset($equivalencias[$idActual])) {
                        $item['proceso'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            if (in_array('tipo_apreciacion', $llaves)) {
                $unico = array_unique(array_column($datos, 'tipo_apreciacion'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_tipo_apreciacion, tipo_apreciacion FROM cat_tipo_apreciacion WHERE id_tipo_apreciacion IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['tipo_apreciacion'];
                    if (isset($equivalencias[$idActual])) {
                        $item['tipo_apreciacion'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            if (in_array('tipo_vacante', $llaves)) {
                $unico = array_unique(array_column($datos, 'tipo_vacante'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_tipo_vacante, tipo_vacante FROM cat_tipo_vacante WHERE id_tipo_vacante IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['tipo_vacante'];
                    if (isset($equivalencias[$idActual])) {
                        $item['tipo_vacante'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
                
            }

            if (in_array('tipo_plaza', $llaves)) {
                $unico = array_unique(array_column($datos, 'tipo_plaza'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_tipo_plaza, tipo_plaza FROM cat_tipo_plaza WHERE id_tipo_plaza IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['tipo_plaza'];
                    if (isset($equivalencias[$idActual])) {
                        $item['tipo_plaza'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            if (in_array('tipo_sostenimiento', $llaves)) {
                $unico = array_unique(array_column($datos, 'tipo_sostenimiento'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_tipo_sostenimiento, tipo_sostenimiento FROM cat_tipo_sostenimiento WHERE id_tipo_sostenimiento IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['tipo_sostenimiento'];
                    if (isset($equivalencias[$idActual])) {
                        $item['tipo_sostenimiento'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
                
            }
            if (in_array('turno', $llaves)) {
                $unico = array_unique(array_column($datos, 'turno'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_turno, turno FROM cat_turno WHERE id_turno IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['turno'];
                    if (isset($equivalencias[$idActual])) {
                        $item['turno'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
                
            }
            if (in_array('tipo_licencia', $llaves)) {
                $unico = array_unique(array_column($datos, 'tipo_licencia'));
                $placeholders = implode(',', array_fill(0, count($unico), '?'));

                $stmt = $db->prepare("SELECT id_tipo_licencia, tipo_licencia FROM cat_tipo_licencia WHERE id_tipo_licencia IN ($placeholders)");
                $stmt->execute(array_values($unico));
                
                $equivalencias = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

                foreach ($datos as &$item) {
                    $idActual = $item['tipo_licencia'];
                    if (isset($equivalencias[$idActual])) {
                        $item['tipo_licencia'] = $equivalencias[$idActual];
                    }
                }
                unset($item);
            }

            return json_encode(["datos" => $datos]);
        }
    }
        