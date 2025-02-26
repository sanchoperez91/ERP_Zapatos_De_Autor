<?php
require_once '../Db/con1Db.php';
require_once '../Models/facturaCompraConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase FacturaCompraDatos
$facturaCompraDatos = new FacturaCompraDatos();

// Obtener los datos desde el modelo
$datos = $facturaCompraDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


