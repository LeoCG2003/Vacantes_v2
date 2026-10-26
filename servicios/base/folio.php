<?php 
    require_once('../coneccion/coneccionPHP.php');

    class Folio{
        public function asignarFolio($qna){
            
            $conec = new conexion();
            $db = $conec->conectar();

            $sql = "SELECT id_folio FROM folio WHERE qna_captura = :qna";
            $query = $db->prepare($sql);
            $query->bindParam(':qna', $qna, PDO::PARAM_INT);
            $query->execute();

            $result = $query -> fetch(PDO::FETCH_ASSOC);

            if($result){
                return $result['id_folio'];
            }else{
                return NULL;
            }
        }
    }
?>