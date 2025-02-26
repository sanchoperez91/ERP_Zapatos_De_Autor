<?php
    require_once '../Db/con1Db.php';
    class DetalleEscandalloDatos {
        // Método para obtener los datos de las tres tablas
        public function getDatosFK() {
            $conexion = Conex1::con1();
            // Consultas con JOIN para obtener tanto IDs como nombres
            $sqlIdeArt = "SELECT ide_art, nom_art FROM articulos WHERE tip_art='materia'";


            $datos = [
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


