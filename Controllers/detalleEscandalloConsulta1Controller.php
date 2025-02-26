<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/detalleEscandalloConsulta1Model.php';  
// Verificar si el parámetro 'idNumCom' está presente en la URL
if (isset($_GET['ide_esc'])) {
    $numero = intval($_GET['ide_esc']); // Convertir a entero
} else {
    $numero = 0; // Valor predeterminado si no está presente
}  

// Instanciación del objeto
$obj1 = new Datos;
// Definición de la instrucción
$sql1 = "SELECT 
            detalle_escandallo.ide_des,  
            detalle_escandallo.ide_art,  
            articulos.nom_art,  
            detalle_escandallo.uds_des,  
            detalle_escandallo.ide_esc  
        FROM detalle_escandallo  
        JOIN articulos ON detalle_escandallo.ide_art = articulos.ide_art
        WHERE detalle_escandallo.ide_esc = ?";
// Llamada al método
$data1 = $obj1->getData1($sql1, $numero);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>
