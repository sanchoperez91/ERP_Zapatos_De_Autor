<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del proveedor a eliminar
    $data = json_decode(file_get_contents('php://input'), true);
    $nif_pro = $data['nif'] ?? null;
    $nom_pro = $data['nombre'] ?? null;
    $dir_pro = $data['direccion'] ?? null;
    $tlf_pro = $data['telefono'] ?? null;
    $ema_pro = $data['email'] ?? null;
    $dto_pro = $data['descuento'] ?? null;

    // Validar que los campos necesarios no estén vacíos
    if (!$nif_pro || !$nom_pro || !$dir_pro || !$tlf_pro || !$ema_pro || !$dto_pro) {
        throw new Exception("Todos los campos (NIF, nombre, dirección, teléfono, email, descuento) son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/eliminacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "DELETE FROM proveedores WHERE nif_pro = ? AND nom_pro = ? AND dir_pro = ? AND tlf_pro = ? AND ema_pro = ? AND dto_pro = ?";
    $typeParameters = "ssssss";

    // Llamar al método del modelo para eliminar los datos
    $data1 = $obj1->deleteData($sql1, $typeParameters, $nif_pro, $nom_pro, $dir_pro, $tlf_pro, $ema_pro, $dto_pro);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>