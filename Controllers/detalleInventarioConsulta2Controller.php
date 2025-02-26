<?php
require_once '../Db/con1Db.php';
require_once '../Models/detalleInventarioConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase DetalleInventarioDatos
$detalleInventarioDatos = new DetalleInventarioDatos();

// Obtener los datos desde el modelo
$datos = $detalleInventarioDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


