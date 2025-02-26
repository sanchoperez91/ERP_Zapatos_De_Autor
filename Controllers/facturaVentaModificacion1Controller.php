<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $num_ven = $_POST['num_ven'] ?? null;
    $fec_ven = $_POST['fec_ven'] ?? null;
    $tot_ven = $_POST['tot_ven'] ?? null;
    $dni_emp = $_POST['dni_emp'] ?? null;
    $dni_cli = $_POST['dni_cli'] ?? null;
    $ide_alm = $_POST['ide_alm'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$num_ven || !$fec_ven || !$tot_ven || !$dni_emp || !$dni_cli || !$ide_alm) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE factura_venta SET fec_ven = ?, tot_ven = ?, dni_emp = ?, dni_cli = ?, ide_alm = ? WHERE num_ven = ?";
    $typeParameters = "sssssi";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $fec_ven, $tot_ven, $dni_emp, $dni_cli, $ide_alm, $num_ven);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>