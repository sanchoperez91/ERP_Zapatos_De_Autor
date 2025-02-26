<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $nom_art = $_POST['nombre'] ?? null;
    $tip_art = $_POST['tipo'] ?? null;
    $imp_art = $_POST['importe'] ?? null;
    $sto_art = $_POST['stock'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$nom_art || !$tip_art || !$imp_art || !$sto_art) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO articulos ( nom_art, tip_art, imp_art, sto_art) VALUES (?, ?, ?, ?)";
    $typeParameters = "ssdi";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $nom_art, $tip_art, (float)$imp_art, (int)$sto_art);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
