<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario para la factura
    $fac_com = $_POST['fac_com'] ?? null;
    $fec_com = $_POST['fechaFacturaCompra'] ?? null;
    $tot_com = $_POST['tot_com'] ?? null;
    $dni_emp = $_POST['dniEmpleado'] ?? null;
    $nif_pro = $_POST['nifProveedor'] ?? null;
    $ide_alm = $_POST['codigoAlmacen'] ?? null;

    // Obtener los datos del formulario para el detalle de la factura
    $can_dco = $_POST['can_art'] ?? [];
    $imp_dco = $_POST['imp_art'] ?? [];
    $ide_art = $_POST['ideArticulo'] ?? [];

    // Validar que los datos no estén vacíos
    if (!$fac_com || !$fec_com || !$tot_com || !$dni_emp || !$nif_pro || !$ide_alm || empty($can_dco) || empty($imp_dco) || empty($ide_art)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion2Model.php";
    $obj1 = new Datos();

    // Insertar la factura y obtener el num_com generado
    $sql1 = "INSERT INTO factura_compra (fac_com, fec_com, tot_com, dni_emp, nif_pro, ide_alm) VALUES (?, ?, ?, ?, ?, ?)";
    $typeParameters1 = "ssdssi";
    $data1 = $obj1->insertData($sql1, $typeParameters1, $fac_com, $fec_com, (double)$tot_com, $dni_emp, $nif_pro, (int)$ide_alm);

    if ($data1['status'] !== "success" || empty($data1['lastInsertId'])) {
        throw new Exception("Error al insertar en factura_compra: " . $data1['message']);
    }

    // Obtener el num_com generado
    $num_com = $data1['lastInsertId'];


    // Insertar el detalle de la factura con el num_com generado
    $sql2 = "INSERT INTO detalle_compra (can_dco, imp_dco, ide_art, num_com) VALUES (?, ?, ?, ?)";
    $typeParameters2 = "idis";

    foreach ($can_dco as $index => $cantidad) {
        $importe = $imp_dco[$index];
        $articulo = $ide_art[$index];
        $data2 = $obj1->insertData($sql2, $typeParameters2, (int)$cantidad, (double)$importe, (int)$articulo, (int)$num_com);

        if ($data2['status'] !== "success") {
            throw new Exception("Error al insertar en detalle_compra: " . $data2['message']);
        }

        // Actualizar el stock del artículo
        $sql3 = "UPDATE articulos SET sto_art = sto_art + ? WHERE ide_art = ?";
        $typeParameters3 = "ii";
        $data3 = $obj1->insertData($sql3, $typeParameters3, (int)$cantidad, (int)$articulo);

        if ($data3['status'] !== "success") {
            throw new Exception("Error al actualizar el stock del artículo: " . $data3['message']);
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