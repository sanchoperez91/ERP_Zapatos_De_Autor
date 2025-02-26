<?php
require_once '../Db/con1Db.php';
require_once '../Models/detalleVentaConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase DetalleVentaDatos
$detalleVentaDatos = new DetalleVentaDatos();

// Obtener los datos desde el modelo
$datos = $detalleVentaDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


