<?php
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $cantidadProduccion = $data['cantidadProduccion'] ?? null;
    $ideEsc = $data['ide_esc'] ?? null;

    if (!$cantidadProduccion || !$ideEsc) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    require_once '../Db/con1Db.php';
    $mysqli = Conex1::con1();

    // Obtener los artículos materia correspondientes al escandallo
    $stmt = $mysqli->prepare("SELECT ide_art, uds_des FROM detalle_escandallo WHERE ide_esc = ?");
    $stmt->bind_param('i', $ideEsc);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($detalleEscandallo = $result->fetch_assoc()) {
        $ideArt = $detalleEscandallo['ide_art'];
        $udsDes = $detalleEscandallo['uds_des'] * $cantidadProduccion;

        // Actualizar el stock del artículo materia
        $stmtUpdate = $mysqli->prepare("UPDATE articulos SET sto_art = sto_art - ? WHERE ide_art = ?");
        $stmtUpdate->bind_param('ii', $udsDes, $ideArt);
        $stmtUpdate->execute();
    }

    $stmt->close();
    $mysqli->close();

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>