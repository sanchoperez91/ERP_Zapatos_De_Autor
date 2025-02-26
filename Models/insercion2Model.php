<?php

// Incluir el método para la conexión a la base de datos
require_once "../Db/Con1Db.php"; 

class Datos
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = Conex1::con1(); // ✅ Usamos la misma conexión
    }

    public function insertData($sql, $typeParameters, ...$params)
    {
        try {
            $stmt = $this->mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->mysqli->error);
            }

            $stmt->bind_param($typeParameters, ...$params);
            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }

            // ✅ Obtener `insert_id` en la misma conexión
            $lastInsertId = $this->mysqli->insert_id;

            $result = ["status" => "success", "lastInsertId" => $lastInsertId];

        } catch (Exception $e) {
            $result = ["status" => "error", "message" => $e->getMessage()];
        } finally {
            if ($stmt) $stmt->close();
        }

        return $result;
    }

    public function closeConnection()
    {
        $this->mysqli->close();
    }
}
?>
