<?php
require_once '../Db/con1Db.php';
require_once '../Models/produccionConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase ProduccionDatos
$produccionDatos = new ProduccionDatos();

// Obtener los datos desde el modelo
$datos = $produccionDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


