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

    // Obtener el ID del artículo correspondiente al escandallo
    $stmt = $mysqli->prepare("SELECT ide_art FROM escandallo WHERE ide_esc = ?");
    $stmt->bind_param('i', $ideEsc);
    $stmt->execute();
    $result = $stmt->get_result();
    $escandallo = $result->fetch_assoc();
    $ideArt = $escandallo['ide_art'];

    // Actualizar el stock del artículo terminado
    $stmt = $mysqli->prepare("UPDATE articulos SET sto_art = sto_art + ? WHERE ide_art = ?");
    $stmt->bind_param('ii', $cantidadProduccion, $ideArt);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>