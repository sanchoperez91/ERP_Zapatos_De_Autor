<?php

require_once '../Db/con1Db.php';
require_once '../Models/inventarioConsulta1Model.php';

$obj1 = new Datos;

$data = json_decode(file_get_contents('php://input'), true);
$filtroFecha = $data['filtroFecha'] ?? '';
$filtroCodigo = $data['filtroCodigo'] ?? '';
$buscarCampoInventario = $data['buscarCampoInventario'] ?? 'todos';
$buscarValorInventario = $data['buscarValorInventario'] ?? '';

$sql1 = "SELECT cod_inv, fec_inv, dni_emp, ide_alm FROM inventario WHERE 1=1";

if ($buscarValorInventario) {
    if ($buscarCampoInventario === 'todos') {
        $sql1 .= " AND (cod_inv LIKE '%$buscarValorInventario%' OR fec_inv LIKE '%$buscarValorInventario%' OR dni_emp LIKE '%$buscarValorInventario%' OR ide_alm LIKE '%$buscarValorInventario%')";
    } else {
        $sql1 .= " AND $buscarCampoInventario LIKE '%$buscarValorInventario%'";
    }
}

if ($filtroFecha) {
    $sql1 .= " ORDER BY fec_inv " . ($filtroFecha === 'fecha_asc' ? 'ASC' : 'DESC');
}

if ($filtroCodigo) {
    $sql1 .= ($filtroFecha ? ", " : " ORDER BY ") . "cod_inv " . ($filtroCodigo === 'codigo_asc' ? 'ASC' : 'DESC');
}

$data1 = $obj1->getData1($sql1);

header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>