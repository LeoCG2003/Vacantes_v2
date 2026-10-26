<?php 
    require_once('../coneccion/coneccionPHP.php');

    class Validacion{
        public function verVacantesRechazadas($id_estado_vacante){

            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT id_validacion, id_vacante, id_usuario, fecha_validacion FROM validacion WHERE estado_vacante = :id";
        
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

        public function rechazarVacante($id_vacante, $id_usuario, $id_estado_vacante){
            //Se reciben los datos de la vacante y el usuario que la rechaza, ademas en automatico se coloca el estado de validacion como rechazado
            //Devuelve true o false segun corresponda, en caso de ser true tambien devuelve el id de la validacion

            // Propuesta SQL = "INSERT INTO validaciones(id_vacante, id_usuario, id_estado_vacante) VALUES ($id_vacante, $id_usuario, $id_estado_vacante)";
            // id = "SELECT LAST_INSERT_ID() AS id_validacion"

            return "TEST";
        }

        public function autorizarVacante($id_vacante, $id_usuario, $id_estado_vacante){
            //Se reciben los datos de la vacante y el usuario que la autoriza
            //Devuelve true o false segun corresponda

            return "TEST";
        }
    }


?>