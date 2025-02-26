<?php

require_once '../Db/con1Db.php';
require_once '../Models/facturaCompraConsulta1Model.php';

$obj1 = new Datos;

$data = json_decode(file_get_contents('php://input'), true);
$filtroImporte = $data['filtroImporte'] ?? '';
$filtroFecha = $data['filtroFecha'] ?? '';
$filtroOrdenar = $data['filtroOrdenar'] ?? '';
$buscarCampoCompra = $data['buscarCampoCompra'] ?? 'todos';
$buscarValorCompra = $data['buscarValorCompra'] ?? '';

$sql1 = "SELECT num_com, fac_com, fec_com, tot_com, dni_emp, nif_pro, ide_alm FROM factura_compra WHERE 1=1";

if ($filtroImporte) {
    $sql1 .= " AND tot_com $filtroImporte";
}

if ($filtroFecha) {
    $sql1 .= " AND YEAR(fec_com) $filtroFecha";
}

if ($buscarValorCompra) {
    if ($buscarCampoCompra === 'todos') {
        $sql1 .= " AND (num_com LIKE '%$buscarValorCompra%' OR fac_com LIKE '%$buscarValorCompra%' OR fec_com LIKE '%$buscarValorCompra%' OR tot_com LIKE '%$buscarValorCompra%' OR dni_emp LIKE '%$buscarValorCompra%' OR nif_pro LIKE '%$buscarValorCompra%' OR ide_alm LIKE '%$buscarValorCompra%')";
    } else {
        $sql1 .= " AND $buscarCampoCompra LIKE '%$buscarValorCompra%'";
    }
}

if ($filtroOrdenar === 'numero') {
    $sql1 .= " ORDER BY num_com ASC";
} elseif ($filtroOrdenar === 'proveedor') {
    $sql1 .= " ORDER BY nif_pro ASC";
}

$data1 = $obj1->getData1($sql1);

header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>