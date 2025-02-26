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
    <?php require_once "Views/produccionView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?>

    <div class="filtros hidden" id="filtrosProduccion">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseProduccion">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarCampoProduccion">Buscar por:</label>
                    <select id="buscarCampoProduccion" name="buscarCampoProduccion">
                        <option value="todos">Todos</option>
                        <option value="ide_pdc">ID</option>
                        <option value="fec_pdc">Fecha</option>
                        <option value="can_pdc">Cantidad</option>
                        <option value="ide_alm">ID Almacen</option>
                        <option value="ide_esc">ID Escandallo</option>
                        <option value="dni_emp">DNI Empleado</option>
                    </select>
                    <input type="text" id="buscarValorProduccion" name="buscarValorProduccion">
                </div>
            </div>

            <div class="filtro-item">
                <!-- Radiobuttons de ordenación -->
                <div class="ordenacion">
                    <label>Ordenar por:</label>
                    <div class="radio-container">
                        <label for="ordenarIDAscProduccion">ID Ascendente</label>
                        <input type="radio" id="ordenarIDAscProduccion" name="ordenarProduccion" value="id_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarIDDescProduccion">ID Descendente</label>
                        <input type="radio" id="ordenarIDDescProduccion" name="ordenarProduccion" value="id_desc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarFechaAscProduccion">Fecha Ascendente</label>
                        <input type="radio" id="ordenarFechaAscProduccion" name="ordenarFechaProduccion" value="fecha_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarFechaDescProduccion">Fecha Descendente</label>
                        <input type="radio" id="ordenarFechaDescProduccion" name="ordenarFechaProduccion" value="fecha_desc">
                    </div>
                </div>
            </div>

            <button id="aplicarBusquedaProduccion" class="aplicarbusqueda">Aplicar Filtros</button>
            <button class="eliminar-filtros-produccion">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleProduccion">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseProduccion').addEventListener('click', () => {
            document.getElementById('filtrosProduccion').classList.add('hidden');
            document.getElementById('filtroToggleProduccion').style.display = 'flex';
        });

        document.getElementById('filtroToggleProduccion').addEventListener('click', () => {
            document.getElementById('filtrosProduccion').classList.remove('hidden');
            document.getElementById('filtroToggleProduccion').style.display = 'none';
        });

    </script>
</body>
</html>