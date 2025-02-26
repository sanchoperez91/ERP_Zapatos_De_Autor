<?php
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $cantidadProduccion = $data['cantidadProduccion'] ?? null;
    $almacenProduccion = $data['almacenProduccion'] ?? null;
    $empleadoProduccion = $data['empleadoProduccion'] ?? null;
    $ideEsc = $data['ide_esc'] ?? null;

    if (!$cantidadProduccion || !$almacenProduccion || !$empleadoProduccion || !$ideEsc) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    require_once '../Db/con1Db.php';
    $mysqli = Conex1::con1();

    // Insertar una nueva fila en la tabla de producción
    $stmt = $mysqli->prepare("INSERT INTO produccion (fec_pdc, can_pdc, ide_alm, ide_esc, dni_emp) VALUES (CURDATE(), ?, ?, ?, ?)");
    $stmt->bind_param('iiis', $cantidadProduccion, $almacenProduccion, $ideEsc, $empleadoProduccion);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>