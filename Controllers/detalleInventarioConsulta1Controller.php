<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/detalleInventarioConsulta1Model.php';    

if (isset($_GET['cod_inv'])) {
    $numero = intval($_GET['cod_inv']); // Convertir a entero
} else {
    $numero = 0; // Valor predeterminado si no está presente
} 
// Instanciación del objeto
$obj1 = new Datos;
// Definición de la instrucción
$sql1 = "SELECT 
        di.ide_din, 
        di.can_din, 
        di.ide_art, 
        a.nom_art, 
        di.cod_inv 
    FROM 
        detalle_inventario di
    JOIN 
        articulos a ON di.ide_art = a.ide_art
    WHERE di.cod_inv = ?";
    
// Llamada al método
$data1 = $obj1->getData1($sql1, $numero);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>
