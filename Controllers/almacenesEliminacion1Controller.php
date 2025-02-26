<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del almacén a eliminar
    $data = json_decode(file_get_contents('php://input'), true);
    $ide_alm = $data['ide'] ?? null;

    // Validar que el campo necesario no esté vacío
    if (!$ide_alm) {
        throw new Exception("El campo IDE es obligatorio.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/eliminacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "DELETE FROM almacen WHERE ide_alm = ?";
    $typeParameters = "i";

    // Llamar al método del modelo para eliminar los datos
    $data1 = $obj1->deleteData($sql1, $typeParameters, $ide_alm);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>