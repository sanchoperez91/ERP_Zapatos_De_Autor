<?php
class Datos
{
    // Devuelve datos (SELECT)
    public function getData1($sql, $numero)
    {
        // Conexión
        $mysqli = Conex1::con1();

        // Preparar la sentencia
        $statement = $mysqli->prepare($sql);

        // Enlazar el parámetro
        $statement->bind_param('i', $numero); // 'i' indica que es un entero

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado
        $result = $statement->get_result();

        // Almacenar los datos
        $data = [];
        if ($result->num_rows >= 1) {
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

        // Liberar el conjunto de resultados
        $result->free();
        // Cerrar la declaración
        $statement->close();
        // Cerrar la conexión
        $mysqli->close();

        // Devolver los datos
        return $data;
    }
}
?>

