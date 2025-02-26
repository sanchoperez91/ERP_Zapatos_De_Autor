<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $nom_esc = $_POST['nombreEscandallo'] ?? null;
    $tie_esc = $_POST['cantidad'] ?? null;
    $cos_esc = $_POST['tot_esc'] ?? null;
    $tip_esc = $_POST['tipoEscandallo'] ?? null;
    $ide_art = $_POST['ideArticulo'] ?? null;


    $uds_des = $_POST['can_mat'] ?? [];
    $ide_mat = $_POST['ideMateria'] ?? [];

    // Validar que los datos no estén vacíos
    if (!$nom_esc || !$tie_esc || !$cos_esc || !$tip_esc || !$ide_art || empty($uds_des) || empty($ide_mat)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion2Model.php";
    $obj1 = new Datos();

    // Insertar en `escandallo`
    $sql1 = "INSERT INTO escandallo (nom_esc, tie_esc, cos_esc, tip_esc, ide_art) VALUES (?, ?, ?, ?, ?)";
    $typeParameters1 = "sidsi";
    $data1 = $obj1->insertData($sql1, $typeParameters1, $nom_esc, (float)$tie_esc, (float)$cos_esc, $tip_esc, (int)$ide_art);

    if ($data1['status'] !== "success" || empty($data1['lastInsertId'])) {
        throw new Exception("Error al insertar en escandallo o no se obtuvo el ID.");
    }

    // Obtener `ide_esc`
    $ide_esc = $data1['lastInsertId'];

    // Insertar en `detalle_escandallo`
    $sql2 = "INSERT INTO detalle_escandallo (uds_des, ide_art, ide_esc) VALUES (?, ?, ?)";
    $typeParameters2 = "iii";

    foreach ($uds_des as $index => $uds_des_item) {
        $ide_mat_item = $ide_mat[$index];
        $data2 = $obj1->insertData($sql2, $typeParameters2, (int)$uds_des_item, (int)$ide_mat_item, (int)$ide_esc);

        if ($data2['status'] !== "success") {
            throw new Exception("Error al insertar en detalle_escandallo.");
        }
    }

    // Cerrar conexión
    $obj1->closeConnection();

    echo json_encode(["status" => "success", "message" => "Inserciones realizadas correctamente."]);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>