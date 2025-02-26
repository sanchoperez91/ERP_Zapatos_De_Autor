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
                    'num_com' => $row['num_com'],
                    'fac_com' => $row['fac_com'],
                    'fec_com' => $row['fec_com'],
                    'tot_com' => $row['tot_com'],
                    'dni_emp' => $row['dni_emp'],
                    'nif_pro' => $row['nif_pro'],
                    'ide_alm' => $row['ide_alm']
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