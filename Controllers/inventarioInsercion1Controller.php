<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $fec_inv = $_POST['fechaInventario'] ?? null;
    $dni_emp = $_POST['dniEmpleado'] ?? null;
    $ide_articulos = $_POST['ideArticulo'] ?? [];
    $ide_alm = $_POST['codigoAlmacen'] ?? null;
    $cantidades = $_POST['can_art'] ?? [];

    // Validar que los datos no estén vacíos
    if (!$fec_inv || !$dni_emp || !$ide_alm || empty($ide_articulos) || empty($cantidades)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion2Model.php";
    $obj1 = new Datos();

    // Insertar en `inventario`
    $sql1 = "INSERT INTO inventario (fec_inv, dni_emp, ide_alm) VALUES (?, ?, ?)";
    $typeParameters1 = "ssi";
    $data1 = $obj1->insertData($sql1, $typeParameters1, $fec_inv, $dni_emp, (int)$ide_alm);

    if ($data1['status'] !== "success" || empty($data1['lastInsertId'])) {
        throw new Exception("Error al insertar en inventario o no se obtuvo el ID.");
    }

    // Obtener `cod_inv`
    $cod_inv = $data1['lastInsertId'];

    // Insertar en `detalle_inventario`
    $sql2 = "INSERT INTO detalle_inventario (can_din, ide_art, cod_inv) VALUES (?, ?, ?)";
    $typeParameters2 = "iii";

    foreach ($ide_articulos as $index => $ide_art) {
        $can_din = $cantidades[$index];
        $data2 = $obj1->insertData($sql2, $typeParameters2, (int)$can_din, (int)$ide_art, (int)$cod_inv);

        if ($data2['status'] !== "success") {
            throw new Exception("Error al insertar en detalle_inventario.");
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