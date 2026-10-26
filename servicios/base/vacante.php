<?php 
    require_once('../coneccion/coneccionPHP.php');

    class Vacante{
        public function capturarVacante($id_usuario, $id_folio, $tipo_layout, $fecha_captura, $entidad, $municipio, $institucion, $region, $zona_economica, $proceso, $tipo_apreciacion, $tipo_vacante, $tipo_plaza, $numero_horas, $tipo_sostenimiento, $fecha_inicio_vacancia, $fecha_fin_vacancia, $clv_categoria, $paquete_de_plaza, $clave_plaza, $cctPlazaDondeCobra, $cctPlazaDondeTrabaja, $turno, $tipo_de_licencia, $codigo_licencia, $inicio_de_licencia, $observaciones, $inicio_ocupacion, $fin_ocupacion, $ordenamiento, $curp, $nombre_docente, $codigo){
            $estado_vacante = 1;

            $conec = new conexion();
            $db = $conec->conectar();

            $tipo_de_licencia = ($tipo_de_licencia === "") ? null : $tipo_de_licencia;
            

            try {
                $sql = "INSERT INTO Vacante (id_usuario, folio, tipo_layout, fecha_captura, estado_vacante, entidad, municipio, institucion, region, zona_economica, proceso, tipo_apreciacion, tipo_vacante, tipo_plaza, numero_horas, tipo_sostenimiento, fecha_inicio_vacancia, fecha_fin_vacancia, clv_categoria, paquete_plaza, clave_plaza, cctPlazaDondeCobra, cctPlazaDondeTrabaja, turno, tipo_licencia, tipo_licencia_2, codigo_licencia, inicio_de_licencia, observaciones, inicio_ocupacion, fin_ocupacion, ordenamiento, curp, nombre_docente, codigo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $query = $db->prepare($sql);

                $query->execute([
                    $id_usuario,
                    $id_folio,
                    $tipo_layout,
                    $fecha_captura,
                    $estado_vacante,
                    $entidad,
                    $municipio,
                    $institucion,
                    $region,
                    $zona_economica,
                    $proceso,
                    $tipo_apreciacion,
                    $tipo_vacante,
                    $tipo_plaza,
                    $numero_horas,
                    $tipo_sostenimiento,
                    $fecha_inicio_vacancia,
                    $fecha_fin_vacancia,
                    $clv_categoria,
                    $paquete_de_plaza,
                    $clave_plaza,
                    $cctPlazaDondeCobra,
                    $cctPlazaDondeTrabaja,
                    $turno,
                    $tipo_de_licencia,
                    $tipo_de_licencia,
                    $codigo_licencia,
                    $inicio_de_licencia,
                    $observaciones,
                    $inicio_ocupacion,
                    $fin_ocupacion,
                    $ordenamiento,
                    $curp,
                    $nombre_docente,
                    $codigo
                ]);

                return json_encode(['success' => true, 'msg' => 'Fila agregada correctamente']);
            } catch (PDOException $e) {

                return json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }

        public function verVacante($id_vacante){
            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT * FROM Vacante WHERE id_vacante = :id";
        
            $query = $db->prepare($sql);

            $query->bindParam(':id', $id_vacante);
            $query->execute();

            $result = $query -> fetchAll(PDO::FETCH_ASSOC);

            if($result){
                return json_encode(['datos'=>$result]);
            }else{
                return json_encode(['datos'=>NULL]);
            }
        }

        public function cambiarEstado($id_vacante, $nuevo_estado){
            //Se reciben el id de la vacante y el nuevo estado al que se desea cambiar
            //Devuelve true o false segun corresponda

            // Propuesta codigo SQL = "UPDATE vacantes SET id_estado_vacante = $nuevo_estado WHERE id_vacante = $id_vacante";

            return "TEST";
        }

        public function cargarVacantesImpresionQna($qna){
            //Se recibe la quincena para cargar las vacantes que se deben imprimir
            //Devuelve un arreglo con los datos de las vacantes correspondientes

            // Propuesta codigo SQL = "SELECT * FROM vacantes WHERE qna_captura = $qna";

            return "TEST";
        }

        public function cargarVacanteImpresion($id_vacante){
            //Se recibe el id de la vacante para cargar los datos que se deben imprimir
            //Devuelve un arreglo con los datos de la vacante correspondiente

            // Propuesta codigo SQL = "SELECT * FROM vacantes WHERE id_vacante = $id_vacante";

            return "TEST";
        }

        public function corregirCaptura($id_vacante, $entidad, $municipio, $institucion, $region, $zona_economica, $proceso, $tipo_apreciacion, $tipo_vacante, $tipo_plaza, $numero_horas, $tipo_sostenimiento, $fecha_inicio_vacancia, $fecha_fin_vacancia, $clv_categoria, $paquete_de_plaza, $clave_plaza, $cctPlazaDondeCobra, $cctPlazaDondeTrabaja, $turno, $tipo_de_licencia, $codigo_licencia, $inicio_de_licencia, $observaciones, $inicio_ocupacion, $fin_ocupacion, $ordenamiento, $curp, $nombre_docente, $codigo){
            $estado_vacante = 0;

            $conec = new conexion();
            $db = $conec->conectar();

            try {
                $sql = "UPDATE Vacante 
                        SET estado_vacante = ?, 
                            entidad = ?, 
                            municipio = ?, 
                            institucion = ?, 
                            region = ?, 
                            zona_economica = ?, 
                            proceso = ?, 
                            tipo_apreciacion = ?, 
                            tipo_vacante = ?, 
                            tipo_plaza = ?, 
                            numero_horas = ?, 
                            tipo_sostenimiento = ?, 
                            fecha_inicio_vacancia = ?, 
                            fecha_fin_vacancia = ?, 
                            clv_categoria = ?, 
                            paquete_plaza = ?, 
                            clave_plaza = ?, 
                            cctPlazaDondeCobra = ?, 
                            cctPlazaDondeTrabaja = ?, 
                            turno = ?, 
                            tipo_licencia = ?, 
                            tipo_licencia_2 = ?, 
                            codigo_licencia = ?, 
                            inicio_de_licencia = ?, 
                            observaciones = ?, 
                            inicio_ocupacion = ?, 
                            fin_ocupacion = ?, 
                            ordenamiento = ?, 
                            curp = ?, 
                            nombre_docente = ?, 
                            codigo = ?
                        WHERE id_vacante = ?";

                $query = $db->prepare($sql);

                $query->execute([
                    $estado_vacante,
                    $entidad,
                    $municipio,
                    $institucion,
                    $region,
                    $zona_economica,
                    $proceso,
                    $tipo_apreciacion,
                    $tipo_vacante,
                    $tipo_plaza,
                    $numero_horas,
                    $tipo_sostenimiento,
                    $fecha_inicio_vacancia,
                    $fecha_fin_vacancia,
                    $clv_categoria,
                    $paquete_de_plaza,
                    $clave_plaza,
                    $cctPlazaDondeCobra,
                    $cctPlazaDondeTrabaja,
                    $turno,
                    $tipo_de_licencia,
                    $tipo_de_licencia,
                    $codigo_licencia,
                    $inicio_de_licencia,
                    $observaciones,
                    $inicio_ocupacion,
                    $fin_ocupacion,
                    $ordenamiento,
                    $curp,
                    $nombre_docente,
                    $codigo,
                    $id_vacante
                ]);

                return json_encode(['success' => true, 'msg' => 'Captura Corregida']);
            } catch (PDOException $e) {

                return json_encode([
                    'success' => false,
                    'msg' => $e->getMessage()
                ]);
            }
        }

        public function verVacantesPorNivel($id_estado_vacante){

            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT id_vacante, folio, fecha_captura, proceso, tipo_plaza, tipo_sostenimiento, clave_plaza FROM vacante WHERE estado_vacante = :id";
        
            $query = $db->prepare($sql);

            $query->bindParam(':id', $id_estado_vacante);
            $query->execute();

            $result = $query -> fetchALL(PDO::FETCH_ASSOC);

            if($result){
                return json_encode(['datos'=>$result]);
            }else{
                return json_encode(['datos'=>NULL]);
            }
        }

        public function verDatosVacantesRechazadas($lista_id){

            $lista = json_decode($lista_id, true);
            $lista = $lista['datos'];
            $lista_unico = array_values(array_unique(array_column($lista, 'id_vacante')));
            $placeholders = implode(',', array_fill(0, count($lista_unico), '?'));

            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT id_vacante, folio, fecha_captura, proceso, clave_plaza FROM vacante WHERE id_vacante IN ($placeholders)";
        
            $query = $db->prepare($sql);

            $query->execute($lista_unico);

            $result = $query -> fetchALL(PDO::FETCH_ASSOC);

            if($result){
                $bd_indexada = [];
                foreach ($result as $fila) {
                    $id_bd = (int)$fila['id_vacante'];
                    $bd_indexada[$id_bd] = $fila;
                }

                foreach ($lista as $key => $item) {
                    $id = (int)$item['id_vacante'];
            
                    if (isset($bd_indexada[$id])) {
                        $lista[$key] = array_merge($item, $bd_indexada[$id]);
                    }
                }
                return json_encode(['datos' => $lista]);
            }else{
                return json_encode(['datos'=>NULL]);
            }
        }
    }

?>