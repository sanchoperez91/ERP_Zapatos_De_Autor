<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $fec_pdc= $_POST['fechaProduccion'] ?? null;
    $can_pdc = $_POST['cantidad'] ?? null;
    $ide_alm = $_POST['codigoAlmacen'] ?? null;
    $ide_esc = $_POST['codigoEscandallo'] ?? null;
    $dni_emp = $_POST['dniEmpleado'] ?? null;
    
    

    // Validar que los datos no estén vacíos
    if (!$fec_pdc || !$can_pdc || !$ide_alm || !$ide_esc || !$dni_emp ) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO produccion (fec_pdc, can_pdc, ide_alm, ide_esc, dni_emp) VALUES (?, ?, ?, ?, ?)";
    $typeParameters = "siiis";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $fec_pdc, (int)$can_pdc, (int)$ide_alm, (int)$ide_esc, $dni_emp);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>