<?php
class Datos
{

    // Devuelve Datos (select)
    public function getData1($sql, $numero)
    {
        // Conexión
        $mysqli = Conex1::con1();
        
        // Sentencia
        $statement = $mysqli->prepare($sql);

        $statement->bind_param('i', $numero); // 'i' indica que es un entero
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
                    'ide_esc' => $row['ide_esc'],
                    'nom_esc' => $row['nom_esc'],
                    'tie_esc' => $row['tie_esc'],
                    'cos_esc' => $row['cos_esc'],
                    'tip_esc' => $row['tip_esc']
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