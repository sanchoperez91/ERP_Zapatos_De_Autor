<?php
require_once '../Db/con1Db.php';
require_once '../Models/escandalloConsulta2Model.php';  // Asegúrate de que la ruta sea correcta

// Crear una instancia de la clase ProduccionDatos
$escandalloDatos = new EscandalloDatos();

// Obtener los datos desde el modelo
$datos = $escandalloDatos->getDatosFK();

// Devolver los datos en formato JSON
echo json_encode($datos);
?>


