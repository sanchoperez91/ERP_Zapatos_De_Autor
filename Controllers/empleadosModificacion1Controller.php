<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $dni_emp_original = $_POST['dni_original'] ?? null;
    $dni_emp_nuevo = $_POST['dni'] ?? null;
    $nom_emp = $_POST['nombre'] ?? null;
    $dir_emp = $_POST['direccion'] ?? null;
    $tlf_emp = $_POST['telefono'] ?? null;
    $ema_emp = $_POST['email'] ?? null;
    $pue_emp = $_POST['puesto'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$dni_emp_original || !$dni_emp_nuevo || !$nom_emp || !$dir_emp || !$tlf_emp || !$ema_emp || !$pue_emp) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE empleados SET dni_emp = ?, nom_emp = ?, dir_emp = ?, tlf_emp = ?, ema_emp = ?, pue_emp = ? WHERE dni_emp = ?";
    $typeParameters = "sssssss";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $dni_emp_nuevo, $nom_emp, $dir_emp, $tlf_emp, $ema_emp, $pue_emp, $dni_emp_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>