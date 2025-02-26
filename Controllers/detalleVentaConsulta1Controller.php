<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/detalleVentaConsulta1Model.php';  
// Verificar si el parámetro 'idNumCom' está presente en la URL
if (isset($_GET['idNumVen'])) {
    $numero = intval($_GET['idNumVen']); // Convertir a entero
} else {
    $numero = 0; // Valor predeterminado si no está presente
}  

// Instanciación del objeto
$obj1 = new Datos;
// Definición de la instrucción
$sql1 = "SELECT 
                dv.ide_dve, 
                dv.num_ven, 
                dv.ide_art, 
                dv.imp_dve, 
                dv.can_dve, 
                a.nom_art 
            FROM 
                detalle_venta dv 
            JOIN 
                articulos a ON dv.ide_art = a.ide_art
            WHERE 
                dv.num_ven = ?";
// Llamada al método
$data1 = $obj1->getData1($sql1, $numero);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>
