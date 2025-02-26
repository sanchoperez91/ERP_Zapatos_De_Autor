<?php
require_once '../Db/con1Db.php';
require_once '../Models/facturaVentaConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase FacturaVentaDatos
$facturaVentaDatos = new FacturaVentaDatos();

// Obtener los datos desde el modelo
$datos = $facturaVentaDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


