<?php
require_once '../Db/con1Db.php';
require_once '../Models/inventarioConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase ProduccionDatos
$inventarioDatos = new InventarioDatos();

// Obtener los datos desde el modelo
$datos = $inventarioDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


