<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/articulosConsulta1Model.php';

// Instanciación del objeto
$obj1 = new Datos;

// Obtención de los filtros
$data = json_decode(file_get_contents('php://input'), true);
$filtroStockArticulos = $data['filtroStockArticulos'] ?? '';
$filtroTipoArticulos = $data['filtroTipoArticulos'] ?? '';
$ordenarPorArticulos = $data['ordenarPorArticulos'] ?? '';
$buscarCampoArticulos = $data['buscarCampoArticulos'] ?? 'todos';
$buscarValorArticulos = $data['buscarValorArticulos'] ?? '';

// Definición de la instrucción
$sql1 = "SELECT ide_art, nom_art, tip_art, imp_art, sto_art FROM articulos WHERE 1=1";

if ($filtroStockArticulos) {
    if ($filtroStockArticulos === '<20') {
        $sql1 .= " AND sto_art < 20";
    } elseif ($filtroStockArticulos === '<100') {
        $sql1 .= " AND sto_art < 100";
    }
}

if ($filtroTipoArticulos) {
    $sql1 .= " AND tip_art = '$filtroTipoArticulos'";
}

if ($buscarValorArticulos) {
    if ($buscarCampoArticulos === 'todos') {
        $sql1 .= " AND (ide_art LIKE '%$buscarValorArticulos%' OR nom_art LIKE '%$buscarValorArticulos%' OR tip_art LIKE '%$buscarValorArticulos%' OR imp_art LIKE '%$buscarValorArticulos%' OR sto_art LIKE '%$buscarValorArticulos%')";
    } else {
        $sql1 .= " AND $buscarCampoArticulos LIKE '%$buscarValorArticulos%'";
    }
}

if ($ordenarPorArticulos === 'id') {
    $sql1 .= " ORDER BY ide_art ASC";
} elseif ($ordenarPorArticulos === 'precio') {
    $sql1 .= " ORDER BY imp_art ASC";
}

// Llamada al método
$data1 = $obj1->getData1($sql1);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>