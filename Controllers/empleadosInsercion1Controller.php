<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $dni_emp = $_POST['dni'] ?? null;
    $nom_emp = $_POST['nombre'] ?? null;
    $con_emp = $_POST['con_emp'] ?? null;
    $dir_emp = $_POST['direccion'] ?? null;
    $tlf_emp = $_POST['telefono'] ?? null;
    $ema_emp = $_POST['email'] ?? null;
    $pue_emp = $_POST['puesto'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$dni_emp || !$nom_emp || !$con_emp || !$dir_emp || !$tlf_emp || !$ema_emp || !$pue_emp) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Cifrar la contraseña
    $con_emp_cifrada = password_hash($con_emp, PASSWORD_DEFAULT);

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO empleados (dni_emp, nom_emp, con_emp, dir_emp, tlf_emp, ema_emp, pue_emp) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $typeParameters = "sssssss";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $dni_emp, $nom_emp, $con_emp_cifrada, $dir_emp, $tlf_emp, $ema_emp, $pue_emp);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>