<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $num_com = $_POST['num_com'] ?? null;
    $fec_com = $_POST['fec_com'] ?? null;
    $tot_com = $_POST['tot_com'] ?? null;
    $dni_emp = $_POST['dni_emp'] ?? null;
    $nif_pro = $_POST['nif_pro'] ?? null;
    $ide_alm = $_POST['ide_alm'] ?? null;
    $fac_com = $_POST['fac_com'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$num_com || !$fec_com || !$tot_com || !$dni_emp || !$nif_pro || !$ide_alm || !$fac_com) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE factura_compra SET fec_com = ?, tot_com = ?, dni_emp = ?, nif_pro = ?, ide_alm = ?, fac_com = ? WHERE num_com = ?";
    $typeParameters = "ssssssi";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $fec_com, $tot_com, $dni_emp, $nif_pro, $ide_alm, $fac_com, $num_com);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>