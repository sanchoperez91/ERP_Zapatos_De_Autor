<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $fec_ven = $_POST['fechaFacturaVenta'] ?? null;
    $tot_ven = $_POST['tot_ven'] ?? null;
    $dni_emp = $_POST['dniEmpleado'] ?? null;
    $dni_cli = $_POST['dni_cli'] ?? null;
    $ide_alm = $_POST['codigoAlmacen'] ?? null;

    $can_dve= $_POST['can_art'] ?? null;
    $imp_dve = $_POST['imp_art'] ?? null;
    $ide_art = $_POST['ideArticulo'] ?? null;
    
    

    // Validar que los datos no estén vacíos
    if (!$fec_ven || !$tot_ven || !$dni_emp || !$dni_cli || !$ide_alm || empty($can_dve) || empty($imp_dve) || empty($ide_art)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion2Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO factura_venta ( fec_ven, tot_ven, dni_emp, dni_cli, ide_alm) VALUES (?, ?, ?, ?, ?)";
    $typeParameters = "sdssi";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters,  $fec_ven, (double)$tot_ven, $dni_emp, $dni_cli, (int)$ide_alm);

    if ($data1['status'] !== "success" || empty($data1['lastInsertId'])) {
        throw new Exception("Error al insertar en factura_compra: " . $data1['message']);
    }

    // Obtener el num_ven generado
    $num_ven = $data1['lastInsertId'];


    // Insertar el detalle de la factura con el num_ven generado
    $sql2 = "INSERT INTO detalle_venta (can_dve, imp_dve, ide_art, num_ven) VALUES (?, ?, ?, ?)";
    $typeParameters2 = "idis";

    foreach ($can_dve as $index => $cantidad) {
        $importe = $imp_dve[$index];
        $articulo = $ide_art[$index];
        $data2 = $obj1->insertData($sql2, $typeParameters2, (int)$cantidad, (double)$importe, (int)$articulo, (int)$num_ven);

        if ($data2['status'] !== "success") {
            throw new Exception("Error al insertar en detalle_compra: " . $data2['message']);
        }

        // Actualizar el stock del artículo
        $sql3 = "UPDATE articulos SET sto_art = sto_art - ? WHERE ide_art = ?";
        $typeParameters3 = "ii";
        $data3 = $obj1->insertData($sql3, $typeParameters3, (int)$cantidad, (int)$articulo);

        if ($data3['status'] !== "success") {
            throw new Exception("Error al actualizar el stock del artículo: " . $data3['message']);
        }
    }

    // Cerrar conexión
    $obj1->closeConnection();
    // Enviar la respuesta como JSON
    echo json_encode(["status" => "success", "message" => "Inserciones realizadas correctamente."]);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>