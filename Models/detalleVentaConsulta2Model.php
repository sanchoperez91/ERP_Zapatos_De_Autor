<?php
    require_once '../Db/con1Db.php';
    class DetalleVentaDatos {
        // Método para obtener los datos de las tres tablas
        public function getDatosFK() {
            $conexion = Conex1::con1();
            // Consultas con JOIN para obtener tanto IDs como nombres
            $sqlNumVen = "SELECT num_ven FROM factura_venta";
            $sqlIdeArt = "SELECT ide_art, nom_art, imp_art FROM articulos WHERE tip_art='terminado'";


            $datos = [
                'num_ven' => $this->fetchData($conexion, $sqlNumVen),
                'ide_art' => $this->fetchData($conexion, $sqlIdeArt),
            ];
            return $datos;
        }

        // Método auxiliar para ejecutar consultas y obtener resultados
        private function fetchData($conexion, $sql) {
            $result = $conexion->query($sql);
            $data = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }
    }

?>


