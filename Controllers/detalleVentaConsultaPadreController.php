<?php
    // Llamada a la conexión
    require_once '../Db/con1Db.php';
    // Llamada al modelo
    require_once '../Models/detalleVentaConsultaPadreModel.php';

    // Verificar si el parámetro 'idNumCom' está presente en la URL
    if (isset($_GET['idNumVen'])) {
        $numero = intval($_GET['idNumVen']); // Convertir a entero
    } else {
        $numero = 0; // Valor predeterminado si no está presente
    }

    // Instanciación del objeto
    $obj1 = new Datos;

    // Definición de la instrucción SQL con un marcador de posición
    $sql1 = "SELECT num_ven, fec_ven, tot_ven, dni_emp, dni_cli, ide_alm FROM factura_venta WHERE num_ven = ?";

    // Llamar al método con la consulta y el parámetro
    $data1 = $obj1->getData1($sql1, $numero);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1, JSON_UNESCAPED_UNICODE);
?>

    