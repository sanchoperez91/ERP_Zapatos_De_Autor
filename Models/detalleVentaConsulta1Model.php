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
                    'ide_dve' => $row['ide_dve'],
                    'num_ven' => $row['num_ven'],
                    'ide_art' => $row['ide_art'],
                    'nom_art' => $row['nom_art'],
                    'imp_dve' => $row['imp_dve'],
                    'can_dve' => $row['can_dve']
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