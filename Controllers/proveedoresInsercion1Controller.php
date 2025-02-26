<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $nif_pro= $_POST['nif'] ?? null;
    $nom_pro = $_POST['nombre'] ?? null;
    $dir_pro = $_POST['direccion'] ?? null;
    $tlf_pro = $_POST['telefono'] ?? null;
    $ema_pro = $_POST['email'] ?? null;
    $dto_pro = $_POST['descuento'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$nif_pro || !$nom_pro || !$dir_pro || !$tlf_pro || !$ema_pro || !$dto_pro) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO proveedores (nif_pro, nom_pro, dir_pro, tlf_pro, ema_pro, dto_pro) VALUES (?, ?, ?, ?, ?, ?)";
    $typeParameters = "sssssi";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $nif_pro, $nom_pro, $dir_pro, $tlf_pro, $ema_pro, (int)$dto_pro);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>