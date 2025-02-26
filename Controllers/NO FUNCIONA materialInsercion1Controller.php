<?php
header('Content-Type: application/json');

try {
    // Obtener los datos del cuerpo de la solicitud (JSON)
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar que los datos no estén vacíos
    if (empty($data)) {
        throw new Exception("No se recibieron datos.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Recorrer los materiales y guardarlos
    $results = [];
    foreach ($data as $material) {
        $uds_mat = $material['can_mat'] ?? null;
        $ide_art = $material['ideMateria'] ?? null;
        $ide_esc = $material['ide_esc'] ?? null;

        // Validar que los campos no estén vacíos
        if (!$uds_mat || !$ide_art || !$ide_esc) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Definir la instrucción SQL y los tipos de parámetros
        $sql1 = "INSERT INTO material (uds_mat, ide_art, ide_esc) VALUES (?, ?, ?)";
        $typeParameters = "iii"; // Tipos de parámetros: int, int, int

        // Llamar al método del modelo para insertar los datos
        $result = $obj1->insertData($sql1, $typeParameters, (int)$uds_mat, (int)$ide_art, (int)$ide_esc);

        // Almacenar el resultado de la inserción
        $results[] = $result;
    }

    // Enviar la respuesta como JSON
    echo json_encode([
        "status" => "success",
        "message" => "Materiales guardados correctamente.",
        "results" => $results
    ]);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>