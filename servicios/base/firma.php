<?php 
    require_once('../coneccion/coneccionPHP.php');

    class Firma{
        public function obtenerFirmas($id_firma_layout){
            //Se reciben el id correspondiente para conocer que firmas devolver segun corresponda al layout
            //Devuelve las imagenes de las firmas

            // Propuesta codigo SQL = "SELECT archivo_firma FROM firmas WHERE id_firma_layout = $id_firma_layout";
        
            return "TEST";
        
        }
    }

?>