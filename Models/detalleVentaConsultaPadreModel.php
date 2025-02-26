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
                    'num_ven' => $row['num_ven'],
                    'fec_ven' => $row['fec_ven'],
                    'tot_ven' => $row['tot_ven'],
                    'dni_emp' => $row['dni_emp'],
                    'dni_cli' => $row['dni_cli'],
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

