<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $dni_cli_original = $_POST['dni_original'] ?? null;
    $nom_cli = $_POST['nombre'] ?? null;
    $dir_cli = $_POST['direccion'] ?? null;
    $tlf_cli = $_POST['telefono'] ?? null;
    $ema_cli = $_POST['email'] ?? null;
    $dto_cli = $_POST['descuento'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$dni_cli_original || !$nom_cli || !$dir_cli || !$tlf_cli || !$ema_cli || !$dto_cli) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE clientes SET nom_cli = ?, dir_cli = ?, tlf_cli = ?, ema_cli = ?, dto_cli = ? WHERE dni_cli = ?";
    $typeParameters = "ssssis";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $nom_cli, $dir_cli, $tlf_cli, $ema_cli, (int)$dto_cli, $dni_cli_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
