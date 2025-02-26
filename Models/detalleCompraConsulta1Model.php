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
                    'ide_dco' => $row['ide_dco'],
                    'num_com' => $row['num_com'],
                    'ide_art' => $row['ide_art'],
                    'nom_art' => $row['nom_art'],
                    'imp_dco' => $row['imp_dco'],
                    'can_dco' => $row['can_dco']
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

