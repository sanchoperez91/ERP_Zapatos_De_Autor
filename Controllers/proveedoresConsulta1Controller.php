<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/proovedoresConsulta1Model.php';

// Instanciación del objeto
$obj1 = new Datos;

// Obtención de los filtros
$data = json_decode(file_get_contents('php://input'), true);
$filtroNombre = $data['filtroNombre'] ?? '';
$ordenarPor = $data['ordenarPor'] ?? '';
$buscarCampo = $data['buscarCampoProveedores'] ?? 'todos';
$buscarValor = $data['buscarValorProveedores'] ?? '';

// Definición de la instrucción
$sql1 = "SELECT nif_pro, nom_pro, dir_pro, tlf_pro, ema_pro, dto_pro FROM proveedores WHERE 1=1";

if ($filtroNombre) {
    $sql1 .= " AND nom_pro LIKE '%$filtroNombre%'";
}

if ($buscarValor) {
    if ($buscarCampo === 'todos') {
        $sql1 .= " AND (nif_pro LIKE '%$buscarValor%' OR nom_pro LIKE '%$buscarValor%' OR dir_pro LIKE '%$buscarValor%' OR tlf_pro LIKE '%$buscarValor%' OR ema_pro LIKE '%$buscarValor%' OR dto_pro LIKE '%$buscarValor%')";
    } else {
        $sql1 .= " AND $buscarCampo LIKE '%$buscarValor%'";
    }
}

if ($ordenarPor === 'dni_asc') {
    $sql1 .= " ORDER BY nif_pro ASC";
} elseif ($ordenarPor === 'dni_desc') {
    $sql1 .= " ORDER BY nif_pro DESC";
} elseif ($ordenarPor === 'nombre_asc') {
    $sql1 .= " ORDER BY nom_pro ASC";
} elseif ($ordenarPor === 'nombre_desc') {
    $sql1 .= " ORDER BY nom_pro DESC";
}

// Llamada al método
$data1 = $obj1->getData1($sql1);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>