<?php 
    require_once('../coneccion/coneccionPHP.php');

    class TipoLayout{
        public function verDatosLayout($id_tipo_layout){
            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT * FROM TipoLayout WHERE id_tipo_layout=:id";
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id_tipo_layout, PDO::PARAM_INT);
            $query->execute();

            $result = $query -> fetch(PDO::FETCH_ASSOC);

            if($result){
                return json_encode(['datos' => $result]);
            }else{
                return NULL;
            }
        }
    }

?>