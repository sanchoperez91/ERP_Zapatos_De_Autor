<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $nif_pro_original = $_POST['nif_original'] ?? null;
    $nif_pro_nuevo = $_POST['nif'] ?? null;
    $nom_pro = $_POST['nombre'] ?? null;
    $dir_pro = $_POST['direccion'] ?? null;
    $tlf_pro = $_POST['telefono'] ?? null;
    $ema_pro = $_POST['email'] ?? null;
    $dto_pro = $_POST['descuento'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$nif_pro_original || !$nif_pro_nuevo || !$nom_pro || !$dir_pro || !$tlf_pro || !$ema_pro || !$dto_pro) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE proveedores SET nif_pro = ?, nom_pro = ?, dir_pro = ?, tlf_pro = ?, ema_pro = ?, dto_pro = ? WHERE nif_pro = ?";
    $typeParameters = "sssssis";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $nif_pro_nuevo, $nom_pro, $dir_pro, $tlf_pro, $ema_pro, (int)$dto_pro, $nif_pro_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>