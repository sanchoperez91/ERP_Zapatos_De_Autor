<?php

require_once '../Db/con1Db.php';
require_once '../Models/escandalloConsulta1Model.php';

$obj1 = new Datos;

$data = json_decode(file_get_contents('php://input'), true);
$filtroOrdenar = $data['filtroOrdenar'] ?? '';
$filtroTiempo = $data['filtroTiempo'] ?? '';
$filtroCoste = $data['filtroCoste'] ?? '';
$filtroTipo = $data['filtroTipo'] ?? '';
$buscarCampoEscandallo = $data['buscarCampoEscandallo'] ?? 'todos';
$buscarValorEscandallo = $data['buscarValorEscandallo'] ?? '';

$sql1 = "SELECT e.ide_esc, e.nom_esc, e.tie_esc, e.cos_esc, e.tip_esc, a.nom_art, e.ide_art 
         FROM escandallo e
        JOIN articulos a ON e.ide_art = a.ide_art
        WHERE 1=1";

if ($filtroTiempo) {
    $sql1 .= " AND tie_esc $filtroTiempo";
}

if ($filtroCoste) {
    $sql1 .= " AND cos_esc $filtroCoste";
}

if ($filtroTipo) {
    $sql1 .= " AND tip_esc = '$filtroTipo'";
}

if ($buscarValorEscandallo) {
    if ($buscarCampoEscandallo === 'todos') {
        $sql1 .= " AND (ide_esc LIKE '%$buscarValorEscandallo%' OR nom_esc LIKE '%$buscarValorEscandallo%' OR tie_esc LIKE '%$buscarValorEscandallo%' OR cos_esc LIKE '%$buscarValorEscandallo%' OR tip_esc LIKE '%$buscarValorEscandallo%')";
    } else {
        $sql1 .= " AND $buscarCampoEscandallo LIKE '%$buscarValorEscandallo%'";
    }
}

if ($filtroOrdenar === 'nombre') {
    $sql1 .= " ORDER BY nom_esc ASC";
} elseif ($filtroOrdenar === 'id') {
    $sql1 .= " ORDER BY ide_esc ASC";
}

$data1 = $obj1->getData1($sql1);

header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>