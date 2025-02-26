<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $cod_inv_original = $_POST['cod_inv_original'] ?? null;
    $cod_inv_nuevo = $_POST['cod_inv'] ?? null;
    $fec_inv = $_POST['fec_inv'] ?? null;
    $dni_emp = $_POST['dni_emp'] ?? null;
    $ide_alm = $_POST['ide_alm'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$cod_inv_original || !$cod_inv_nuevo || !$fec_inv || !$dni_emp || !$ide_alm) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo de modificación y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE inventario SET cod_inv = ?, fec_inv = ?, dni_emp = ?, ide_alm = ? WHERE cod_inv = ?";
    $typeParameters = "ssssi";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $cod_inv_nuevo, $fec_inv, $dni_emp, $ide_alm, $cod_inv_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>