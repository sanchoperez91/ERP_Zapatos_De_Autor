<?php
require_once '../Db/con1Db.php';
require_once '../Models/detalleCompraConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase DetalleCompraDatos
$detalleCompraDatos = new DetalleCompraDatos();

// Obtener los datos desde el modelo
$datos = $detalleCompraDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


