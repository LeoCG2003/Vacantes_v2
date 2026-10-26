<?php 
    require_once('../coneccion/coneccionPHP.php');

    class Rechazo{
        public function verDetallesRechazo($id_validacion){
            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT nota_rechazo FROM Rechazo WHERE id_validacion = :id";

            $query = $db->prepare($sql);

            $query->bindParam(':id', $id_validacion, PDO::PARAM_INT);
            $query->execute();

            $result = $query -> fetch(PDO::FETCH_ASSOC);

            if($result){
                return json_encode(['datos'=>$result]);
            }else{
                return json_encode(['datos'=>NULL]);
            }
        }

        public function motivoRechazo($id_validacion, $nota){
            //Se reciben el id de la validacion rechazada y la nota con los motivos
            //Devuelve true o false segun corresponda
            // Propuesta codigo $SQL = "INSERT INTO Rechazo(id_validacion, nota_rechazo) VALUES ($id_validacion, $nota)";

            return "TEST";
        }
    }

?>