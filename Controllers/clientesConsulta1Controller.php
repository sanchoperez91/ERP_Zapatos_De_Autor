<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/clientesConsulta1Model.php';

// Instanciación del objeto
$obj1 = new Datos;

// Obtención de los filtros
$data = json_decode(file_get_contents('php://input'), true);
$filtroNombre = $data['filtroNombre'] ?? '';
$ordenarPor = $data['ordenarPor'] ?? '';
$buscarCampo = $data['buscarCampoClientes'] ?? 'todos';
$buscarValor = $data['buscarValorClientes'] ?? '';

// Definición de la instrucción
$sql1 = "SELECT dni_cli, nom_cli, dir_cli, tlf_cli, ema_cli, dto_cli FROM clientes WHERE 1=1";

if ($filtroNombre) {
    $sql1 .= " AND nom_cli LIKE '%$filtroNombre%'";
}

if ($buscarValor) {
    if ($buscarCampo === 'todos') {
        $sql1 .= " AND (dni_cli LIKE '%$buscarValor%' OR nom_cli LIKE '%$buscarValor%' OR dir_cli LIKE '%$buscarValor%' OR tlf_cli LIKE '%$buscarValor%' OR ema_cli LIKE '%$buscarValor%' OR dto_cli LIKE '%$buscarValor%')";
    } else {
        $sql1 .= " AND $buscarCampo LIKE '%$buscarValor%'";
    }
}

if ($ordenarPor === 'dni_asc') {
    $sql1 .= " ORDER BY dni_cli ASC";
} elseif ($ordenarPor === 'dni_desc') {
    $sql1 .= " ORDER BY dni_cli DESC";
} elseif ($ordenarPor === 'nombre_asc') {
    $sql1 .= " ORDER BY nom_cli ASC";
} elseif ($ordenarPor === 'nombre_desc') {
    $sql1 .= " ORDER BY nom_cli DESC";
}

// Llamada al método
$data1 = $obj1->getData1($sql1);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>