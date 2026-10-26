<?php 
    require_once('../coneccion/coneccionPHP.php');

    class FirmasLayout{
        // Plantear Cambio de nombre para la funcion:
        public function listadoFirmasLayout($id_tipo_layout){
            //Recibe el id_tipo_layout
            //Devuelve el id correspondiente a las firmaslayout segun el tipo layout

            // Propuesta codigo SQL = "SELECT id_firma_layout FROM firmasLayout WHERE id_tipo_layout = $id_tipo_layout";

            return "TEST";
        }
    }

?>