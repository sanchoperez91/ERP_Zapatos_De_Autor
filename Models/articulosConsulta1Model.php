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
                    'ide_art' => $row['ide_art'],
                    'nom_art' => $row['nom_art'],
                    'tip_art' => $row['tip_art'],
                    'imp_art' => $row['imp_art'],
                    'sto_art' => $row['sto_art']
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
