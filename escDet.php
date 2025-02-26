<?php
require_once 'verificar_sesion.php'; // Verificar sesión antes de mostrar el contenido
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenidos</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Assets/css/stylesDetalles.css">
    <script src="Assets/js/motor.js"></script>
    <script src="Assets/js/crud.js"></script>
    <script src="Assets/js/delete.js"></script>
    <script src="Assets/js/update.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body> 
    <?php require_once 'bienvenida.php';?>
    <?php require_once "Views/Shared/headerBotonesView.php"; ?>
    <?php require_once "Views/productos_escandalloDIFERENTES.php"; ?>
    <?php require_once "Views/detalleEscandalloView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?> 

  
</body>
</html>