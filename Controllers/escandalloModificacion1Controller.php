<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $ide_esc_original = $_POST['ide_esc_original'] ?? null;
    $ide_esc_nuevo = $_POST['ide_esc'] ?? null;
    $nom_esc = $_POST['nom_esc'] ?? null;
    $tie_esc = $_POST['tie_esc'] ?? null;
    $cos_esc = $_POST['cos_esc'] ?? null;
    $tip_esc = $_POST['tip_esc'] ?? null;

    // Validar que los datos no estén vacíos
    if (empty($ide_esc_original) || empty($ide_esc_nuevo) || empty($nom_esc) || empty($tie_esc) || empty($cos_esc) || empty($tip_esc)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo de modificación y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE escandallo SET ide_esc = ?, nom_esc = ?, tie_esc = ?, cos_esc = ?, tip_esc = ? WHERE ide_esc = ?";
    $typeParameters = "sssssi";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $ide_esc_nuevo, $nom_esc, $tie_esc, $cos_esc, $tip_esc, $ide_esc_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>