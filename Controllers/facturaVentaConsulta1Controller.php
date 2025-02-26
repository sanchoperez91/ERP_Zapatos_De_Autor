<?php

require_once '../Db/con1Db.php';
require_once '../Models/facturaVentaConsulta1Model.php';

$obj1 = new Datos;

$data = json_decode(file_get_contents('php://input'), true);
$filtroImporte = $data['filtroImporte'] ?? '';
$filtroFecha = $data['filtroFecha'] ?? '';
$filtroOrdenar = $data['filtroOrdenar'] ?? '';
$buscarCampoVenta = $data['buscarCampoVenta'] ?? 'todos';
$buscarValorVenta = $data['buscarValorVenta'] ?? '';

$sql1 = "SELECT num_ven, fec_ven, tot_ven, dni_emp, dni_cli, ide_alm FROM factura_venta WHERE 1=1";

if ($filtroImporte) {
    $sql1 .= " AND tot_ven $filtroImporte";
}

if ($filtroFecha) {
    $sql1 .= " AND YEAR(fec_ven) $filtroFecha";
}

if ($buscarValorVenta) {
    if ($buscarCampoVenta === 'todos') {
        $sql1 .= " AND (num_ven LIKE '%$buscarValorVenta%' OR fec_ven LIKE '%$buscarValorVenta%' OR tot_ven LIKE '%$buscarValorVenta%' OR dni_emp LIKE '%$buscarValorVenta%' OR dni_cli LIKE '%$buscarValorVenta%' OR ide_alm LIKE '%$buscarValorVenta%')";
    } else {
        $sql1 .= " AND $buscarCampoVenta LIKE '%$buscarValorVenta%'";
    }
}

if ($filtroOrdenar === 'numero') {
    $sql1 .= " ORDER BY num_ven ASC";
} elseif ($filtroOrdenar === 'cliente') {
    $sql1 .= " ORDER BY dni_cli ASC";
}

$data1 = $obj1->getData1($sql1);

header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>