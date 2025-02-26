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
    <?php require_once "Views/almacenesView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?>

    <div class="filtros hidden" id="filtrosAlmacenes">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseAlmacenes">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarCampoAlmacenes">Buscar por:</label>
                    <select id="buscarCampoAlmacenes" name="buscarCampoAlmacenes">
                        <option value="todos">Todos</option>
                        <option value="ide_alm">ID</option>
                        <option value="nom_alm">Nombre</option>
                        <option value="ubi_alm">Ubicación</option>
                    </select>
                    <input type="text" id="buscarValorAlmacenes" name="buscarValorAlmacenes">
                </div>
            </div>

            <div class="filtro-item">
    <!-- Radiobuttons de ordenación -->
    <div class="ordenacion">
        <label>Ordenar por:</label>
        <div class="radio-container">
            <label for="ordenarIDAscAlmacenes">ID Ascendente&nbsp;&nbsp;</label>
            <input type="radio" id="ordenarIDAscAlmacenes" name="ordenarAlmacenes" value="id_asc">
        </div>
        <div class="radio-container">
            <label for="ordenarIDDescAlmacenes">ID Descendente</label>
            <input type="radio" id="ordenarIDDescAlmacenes" name="ordenarAlmacenes" value="id_desc">
        </div>
        <div class="radio-container">
            <label for="ordenarNombreAscAlmacenes">Nombre Ascendente&nbsp;&nbsp;</label>
            <input type="radio" id="ordenarNombreAscAlmacenes" name="ordenarAlmacenes" value="nombre_asc">
        </div>
        <div class="radio-container">
            <label for="ordenarNombreDescAlmacenes">Nombre Descendente</label>
            <input type="radio" id="ordenarNombreDescAlmacenes" name="ordenarAlmacenes" value="nombre_desc">
        </div>
    </div>
</div>

            <button id="aplicarBusquedaAlmacenes" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-almacenes">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleAlmacenes">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseAlmacenes').addEventListener('click', () => {
            document.getElementById('filtrosAlmacenes').classList.add('hidden');
            document.getElementById('filtroToggleAlmacenes').style.display = 'flex';
        });

        document.getElementById('filtroToggleAlmacenes').addEventListener('click', () => {
            document.getElementById('filtrosAlmacenes').classList.remove('hidden');
            document.getElementById('filtroToggleAlmacenes').style.display = 'none';
        });
    </script>
</body>
</html>