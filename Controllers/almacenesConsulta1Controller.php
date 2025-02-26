<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Llamada a la conexión
    require_once '../Db/con1Db.php';
    // Llamada al modelo
    require_once '../Models/almacenesConsulta1Model.php';

    // Instanciación del objeto
    $obj1 = new Datos;

    // Obtención de los filtros
    $data = json_decode(file_get_contents('php://input'), true);
    $buscarCampoAlmacenes = $data['buscarCampoAlmacenes'] ?? 'todos';
    $buscarValorAlmacenes = $data['buscarValorAlmacenes'] ?? '';
    $filtroID = $data['filtroID'] ?? '';
    $filtroNombre = $data['filtroNombre'] ?? '';

    // Definición de la instrucción
    $sql1 = "SELECT ide_alm, nom_alm, ubi_alm FROM almacen WHERE 1=1";

    if ($buscarValorAlmacenes) {
        if ($buscarCampoAlmacenes === 'todos') {
            $sql1 .= " AND (ide_alm LIKE '%$buscarValorAlmacenes%' OR nom_alm LIKE '%$buscarValorAlmacenes%' OR ubi_alm LIKE '%$buscarValorAlmacenes%')";
        } else {
            $sql1 .= " AND $buscarCampoAlmacenes LIKE '%$buscarValorAlmacenes%'";
        }
    }

    if ($filtroID) {
        $sql1 .= " ORDER BY ide_alm " . ($filtroID === 'id_asc' ? 'ASC' : 'DESC');
    }

    if ($filtroNombre) {
        $sql1 .= ($filtroID ? ", " : " ORDER BY ") . "nom_alm " . ($filtroNombre === 'nombre_asc' ? 'ASC' : 'DESC');
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