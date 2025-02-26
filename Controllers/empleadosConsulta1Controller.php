<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/empleadosConsulta1Model.php';

// Instanciación del objeto
$obj1 = new Datos;

// Obtención de los filtros
$data = json_decode(file_get_contents('php://input'), true);
$filtroNombre = $data['filtroNombre'] ?? '';
$ordenarPor = $data['ordenarPor'] ?? '';
$buscarCampo = $data['buscarCampoEmpleados'] ?? 'todos';
$buscarValor = $data['buscarValorEmpleados'] ?? '';

// Definición de la instrucción
$sql1 = "SELECT dni_emp, nom_emp, dir_emp, tlf_emp, ema_emp, pue_emp FROM empleados WHERE 1=1";

if ($filtroNombre) {
    $sql1 .= " AND nom_emp LIKE '%$filtroNombre%'";
}

if ($buscarValor) {
    if ($buscarCampo === 'todos') {
        $sql1 .= " AND (dni_emp LIKE '%$buscarValor%' OR nom_emp LIKE '%$buscarValor%' OR dir_emp LIKE '%$buscarValor%' OR tlf_emp LIKE '%$buscarValor%' OR ema_emp LIKE '%$buscarValor%' OR pue_emp LIKE '%$buscarValor%')";
    } else {
        $sql1 .= " AND $buscarCampo LIKE '%$buscarValor%'";
    }
}

if ($ordenarPor === 'dni_asc') {
    $sql1 .= " ORDER BY dni_emp ASC";
} elseif ($ordenarPor === 'dni_desc') {
    $sql1 .= " ORDER BY dni_emp DESC";
} elseif ($ordenarPor === 'nombre_asc') {
    $sql1 .= " ORDER BY nom_emp ASC";
} elseif ($ordenarPor === 'nombre_desc') {
    $sql1 .= " ORDER BY nom_emp DESC";
}

// Llamada al método
$data1 = $obj1->getData1($sql1);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>