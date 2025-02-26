<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $ide_art_original = $_POST['ide_original'] ?? null;
    $nom_art = $_POST['nombre'] ?? null;
    $tip_art = $_POST['tipo'] ?? null;
    $imp_art = $_POST['importe'] ?? null;
    $sto_art = $_POST['stock'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$ide_art_original || !$nom_art || !$tip_art || !$imp_art || !$sto_art) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/modificacion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "UPDATE articulos SET nom_art = ?, tip_art = ?, imp_art = ?, sto_art = ? WHERE ide_art = ?";
    $typeParameters = "ssdii";

    // Llamar al método del modelo para actualizar los datos
    $data1 = $obj1->updateData($sql1, $typeParameters, $nom_art, $tip_art, (float)$imp_art, (int)$sto_art, (int)$ide_art_original);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>