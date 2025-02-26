<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $ide_alm_original = $_POST['ide_original'] ?? null;
    $nom_alm = $_POST['nombre'] ?? null;
    $ubi_alm = $_POST['ubicacion'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$ide_alm_original || !$nom_alm || !$ubi_alm) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE almacen SET nom_alm = ?, ubi_alm = ? WHERE ide_alm = ?";
    $typeParameters = "ssi";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $nom_alm, $ubi_alm, $ide_alm_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>