<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Llamada a la conexión
    require_once '../Db/con1Db.php';
    // Llamada al modelo
    require_once '../Models/produccionConsulta1Model.php';

    // Instanciación del objeto
    $obj1 = new Datos;

    // Obtención de los filtros
    $data = json_decode(file_get_contents('php://input'), true);
    $filtroID = $data['filtroID'] ?? '';
    $filtroFecha = $data['filtroFecha'] ?? '';
    $buscarCampoProduccion = $data['buscarCampoProduccion'] ?? 'todos';
    $buscarValorProduccion = $data['buscarValorProduccion'] ?? '';

    // Definición de la instrucción
    $sql1 = "SELECT ide_pdc, fec_pdc, can_pdc, ide_alm, ide_esc, dni_emp FROM produccion WHERE 1=1";

    if ($buscarValorProduccion) {
        if ($buscarCampoProduccion === 'todos') {
            $sql1 .= " AND (ide_pdc LIKE '%$buscarValorProduccion%' OR fec_pdc LIKE '%$buscarValorProduccion%' OR can_pdc LIKE '%$buscarValorProduccion%' OR ide_alm LIKE '%$buscarValorProduccion%' OR ide_esc LIKE '%$buscarValorProduccion%' OR dni_emp LIKE '%$buscarValorProduccion%')";
        } else {
            $sql1 .= " AND $buscarCampoProduccion LIKE '%$buscarValorProduccion%'";
        }
    }

    if ($filtroID) {
        $sql1 .= " ORDER BY ide_pdc " . ($filtroID === 'id_asc' ? 'ASC' : 'DESC');
    }

    if ($filtroFecha) {
        $sql1 .= ($filtroID ? ", " : " ORDER BY ") . "fec_pdc " . ($filtroFecha === 'fecha_asc' ? 'ASC' : 'DESC');
    }

    // Llamada al método
    $data1 = $obj1->getData1($sql1);

    // Devolución de datos en formato JSON
    echo json_encode($data1, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>