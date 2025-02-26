<?php
class Datos
{
    // Devuelve Datos (select)
    public function getData1($sql)
    {
        // Conexión
        $mysqli = Conex1::con1();
        
        // Sentencia
        $statement = $mysqli->prepare($sql);
        // Parámetros (ejemplo: si = string integer)
        $statement->execute();
        // Obtención del resultado
        $result = $statement->get_result();
        // Obtención del numero de registros devueltos
        $data = [];

        if($result->num_rows >= 1) {
            // Obtención de los datos
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'ide_pdc' => $row['ide_pdc'],
                    'fec_pdc' => $row['fec_pdc'],
                    'can_pdc' => $row['can_pdc'],
                    'ide_alm' => $row['ide_alm'],
                    'ide_esc' => $row['ide_esc'],
                    'dni_emp' => $row['dni_emp']
                ];
            }
        }

        // Liberación del conjunto de resultados
        $result->free();
        // Cierre de la declaración
        $statement->close();
        // Cierre de la conexión
        $mysqli->close();

        // Devolución del resultado
        return $data;
    }
}
?>