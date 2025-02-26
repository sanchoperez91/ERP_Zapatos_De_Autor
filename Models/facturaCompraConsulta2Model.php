<?php
    require_once '../Db/con1Db.php';
    class FacturaCompraDatos {
        // Método para obtener los datos de las tres tablas
        public function getDatosFK() {
            $conexion = Conex1::con1();
            // Consultas con JOIN para obtener tanto IDs como nombres
            $sqlDniEmp = "SELECT dni_emp, nom_emp FROM empleados";
            $sqlIdeAlm = "SELECT ide_alm, nom_alm FROM almacen";
            $sqlIdeArtMat = "SELECT ide_art, nom_art, imp_art FROM articulos WHERE tip_art= 'materia'";
            $sqlNifPro = "SELECT nif_pro, nom_pro FROM proveedores";

            $datos = [
                'dni_emp' => $this->fetchData($conexion, $sqlDniEmp),
                'ide_alm' => $this->fetchData($conexion, $sqlIdeAlm),
                'ide_art' => $this->fetchData($conexion, $sqlIdeArtMat),
                'nif_pro' => $this->fetchData($conexion, $sqlNifPro),
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


