<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $id_original = $_POST['id_original'] ?? null;
    $id_nuevo = $_POST['id'] ?? null;
    $fecha = $_POST['fecha'] ?? null;
    $cantidad = $_POST['cantidad'] ?? null;
    $almacen = $_POST['almacen'] ?? null;
    $escandallo = $_POST['escandallo'] ?? null;
    $empleado = $_POST['empleado'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$id_original || !$id_nuevo || !$fecha || !$cantidad || !$almacen || !$escandallo || !$empleado) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE produccion SET ide_pdc = ?, fec_pdc = ?, can_pdc = ?, ide_alm = ?, ide_esc = ?, dni_emp = ? WHERE ide_pdc = ?";
    $typeParameters = "isssssi";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $id_nuevo, $fecha, $cantidad, $almacen, $escandallo, $empleado, $id_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>