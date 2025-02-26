<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos de la factura de compra a eliminar
    $data = json_decode(file_get_contents('php://input'), true);
    $num_com = $data['num_com'] ?? null;

    // Validar que el campo necesario no esté vacío
    if (!$num_com) {
        throw new Exception("El campo número de factura es obligatorio.");
    }

    // Incluir el archivo de conexión a la base de datos
    require_once "../Db/con1Db.php";
    $mysqli = Conex1::con1();

    // Iniciar una transacción
    $mysqli->begin_transaction();

    try {
        // Obtener los detalles de la compra antes de eliminarla
        $sqlDetalles = "SELECT ide_art, can_dco FROM detalle_compra WHERE num_com = ?";
        $stmtDetalles = $mysqli->prepare($sqlDetalles);
        $stmtDetalles->bind_param('i', $num_com);
        $stmtDetalles->execute();
        $resultDetalles = $stmtDetalles->get_result();
        $detalles = $resultDetalles->fetch_all(MYSQLI_ASSOC);
        $stmtDetalles->close();

        // Verificar si se obtuvieron detalles
        if (empty($detalles)) {
            throw new Exception("No se encontraron detalles para la factura de compra especificada.");
        }

        // Actualizar el stock de los artículos
        foreach ($detalles as $detalle) {
            $sqlActualizarStock = "UPDATE articulos SET sto_art = sto_art - ? WHERE ide_art = ?";
            $stmtActualizarStock = $mysqli->prepare($sqlActualizarStock);
            $stmtActualizarStock->bind_param('ii', $detalle['can_dco'], $detalle['ide_art']);
            $stmtActualizarStock->execute();
            $stmtActualizarStock->close();
        }

        // Eliminar los detalles de la compra
        $sqlEliminarDetalles = "DELETE FROM detalle_compra WHERE num_com = ?";
        $stmtEliminarDetalles = $mysqli->prepare($sqlEliminarDetalles);
        $stmtEliminarDetalles->bind_param('i', $num_com);
        $stmtEliminarDetalles->execute();
        $stmtEliminarDetalles->close();

        // Eliminar la factura de compra
        $sqlEliminarFactura = "DELETE FROM factura_compra WHERE num_com = ?";
        $stmtEliminarFactura = $mysqli->prepare($sqlEliminarFactura);
        $stmtEliminarFactura->bind_param('i', $num_com);
        $stmtEliminarFactura->execute();
        $stmtEliminarFactura->close();

        // Confirmar la transacción
        $mysqli->commit();

        // Enviar la respuesta como JSON
        echo json_encode(["status" => "success", "message" => "Factura de compra y detalles eliminados, stock actualizado."]);

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $mysqli->rollback();
        throw $e;
    } finally {
        // Cerrar la conexión
        $mysqli->close();
    }

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>