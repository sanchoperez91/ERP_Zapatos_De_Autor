<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $data = json_decode(file_get_contents('php://input'), true);
    $fec_pdc = $data['fechaProduccion'] ?? null;
    $can_pdc = $data['cantidadProduccion'] ?? null;
    $ide_esc = $data['ide_esc'] ?? null;
    $dni_emp = $data['empleadoProduccion'] ?? null;
    $ide_alm = $data['almacenProduccion'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$fec_pdc || !$can_pdc || !$ide_esc || !$dni_emp || !$ide_alm) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO produccion (fec_pdc, can_pdc, ide_alm, ide_esc, dni_emp) VALUES (?, ?, ?, ?, ?)";
    $typeParameters = "siiis";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $fec_pdc, (int)$can_pdc, (int)$ide_alm, (int)$ide_esc, $dni_emp);

    // Enviar la respuesta como JSON
    echo json_encode(["status" => "success", "data" => $data1]);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>