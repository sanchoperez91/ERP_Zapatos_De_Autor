<?php
    // Llamada a la conexión
    require_once '../Db/con1Db.php';
    // Llamada al modelo
    require_once '../Models/detalleCompraConsultaPadreModel.php';

    // Verificar si el parámetro 'idNumCom' está presente en la URL
    if (isset($_GET['idNumCom'])) {
        $numero = intval($_GET['idNumCom']); // Convertir a entero
    } else {
        $numero = 0; // Valor predeterminado si no está presente
    }

    // Instanciación del objeto
    $obj1 = new Datos;

    // Definición de la instrucción SQL con un marcador de posición
    $sql1 = "SELECT num_com, fac_com, fec_com, tot_com, dni_emp, nif_pro, ide_alm FROM factura_compra WHERE num_com = ?";

    // Llamar al método con la consulta y el parámetro
    $data1 = $obj1->getData1($sql1, $numero);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1, JSON_UNESCAPED_UNICODE);
?>

    