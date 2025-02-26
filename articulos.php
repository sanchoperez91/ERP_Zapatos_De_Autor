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
    <link rel="stylesheet" href="Assets/css/styles.css">
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
    <?php require_once "Views/articulosView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?> 

    <div class="filtros hidden" id="filtrosArticulos">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseArticulos">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarCampoArticulos">Buscar por:</label>
                    <select id="buscarCampoArticulos" name="buscarCampoArticulos">
                        <option value="todos">Todos</option>
                        <option value="ide_art">ID</option>
                        <option value="nom_art">Nombre</option>
                        <option value="tip_art">Tipo</option>
                        <option value="imp_art">Precio</option>
                        <option value="sto_art">Stock</option>
                    </select>
                    <input type="text" id="buscarValorArticulos" name="buscarValorArticulos">
                </div>
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Stock</p>
                <div class="radio-container">
                    <label for="stock_20"><&nbsp;20&nbsp;</label>
                    <input type="radio" id="stock_20" name="filtro-stock-articulos" class="filtro-radio" value="<20">
                </div>
                <div class="radio-container">
                    <label for="stock_100"><&nbsp;100</label>
                    <input type="radio" id="stock_100" name="filtro-stock-articulos" class="filtro-radio" value="<100">
                </div>
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Tipo</p>
                <div class="radio-container">
                    <label for="tipo_terminado">Terminado</label>
                    <input type="radio" id="tipo_terminado" name="filtro-tipo-articulos" class="filtro-radio" value="terminado">
                </div>
                <div class="radio-container">
                    <label for="tipo_materia">Materia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="tipo_materia" name="filtro-tipo-articulos" class="filtro-radio" value="materia">
                </div>
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Ordenar por:</p>
                <div class="radio-container">
                    <label for="ordenar_id">Ide&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="ordenar_id" name="filtro-ordenar-articulos" class="filtro-radio" value="id">
                </div>
                <div class="radio-container">
                    <label for="ordenar_precio">Precio</label>
                    <input type="radio" id="ordenar_precio" name="filtro-ordenar-articulos" class="filtro-radio" value="precio">
                </div>
            </div>

            <button id="aplicarBusquedaArticulos" class="aplicarbusqueda">Aplicar Filtros</button>
            <button class="eliminar-filtros-articulos">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleArticulos">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseArticulos').addEventListener('click', () => {
            document.getElementById('filtrosArticulos').classList.add('hidden');
            document.getElementById('filtroToggleArticulos').style.display = 'flex';
        });

        document.getElementById('filtroToggleArticulos').addEventListener('click', () => {
            document.getElementById('filtrosArticulos').classList.remove('hidden');
            document.getElementById('filtroToggleArticulos').style.display = 'none';
        });
    </script>
</body>
</html>