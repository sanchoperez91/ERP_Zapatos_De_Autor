<?php
require_once '../Db/con1Db.php';
require_once '../Models/detalleEscandalloConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase DetalleEscandalloDatos
$detalleEscandalloDatos = new DetalleEscandalloDatos();

// Obtener los datos desde el modelo
$datos = $detalleEscandalloDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


