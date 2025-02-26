<?php
header('Content-Type: application/json');

require_once '../Db/con1Db.php';
$mysqli = Conex1::con1();

$result = $mysqli->query("SELECT ide_alm, nom_alm FROM almacen");
$almacenes = $result->fetch_all(MYSQLI_ASSOC);

$result = $mysqli->query("SELECT dni_emp, nom_emp FROM empleados");
$empleados = $result->fetch_all(MYSQLI_ASSOC);

$mysqli->close();

echo json_encode(['almacenes' => $almacenes, 'empleados' => $empleados]);
?>