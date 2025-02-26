<?php
    require_once '../Db/con1Db.php';
    class EscandalloDatos {
        // Método para obtener los datos de las tres tablas
        public function getDatosFK() {
            $conexion = Conex1::con1();
            // Consultas con JOIN para obtener tanto IDs como nombres
            $sqlIdeArt = "SELECT ide_art, nom_art FROM articulos WHERE tip_art= 'terminado'";
            $sqlIdeArtMat = "SELECT ide_art, nom_art, imp_art FROM articulos WHERE tip_art= 'materia'";

            $datos = [
                'ide_art' => $this->fetchData($conexion, $sqlIdeArt),
                'ide_art_mat' => $this->fetchData($conexion, $sqlIdeArtMat),
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


