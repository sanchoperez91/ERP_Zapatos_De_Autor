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
    <?php require_once "Views/inventarioView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?>

    <div class="filtros hidden" id="filtrosInventario">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseInventario">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarCampoInventario">Buscar por:</label>
                    <select id="buscarCampoInventario" name="buscarCampoInventario">
                        <option value="todos">Todos</option>
                        <option value="cod_inv">Código Inventario</option>
                        <option value="ide_alm">ID Almacen</option>
                        <option value="dni_emp">DNI Empleado</option>
                    </select>
                    <input type="text" id="buscarValorInventario" name="buscarValorInventario">
                </div>
            </div>

            <div class="filtro-item">
                <!-- Radiobuttons de ordenación -->
                <div class="ordenacion">
                    <label>Ordenar por:</label>
                    <div class="radio-container">
                        <label for="ordenarCodigoAscInventario">Código Ascendente&nbsp;&nbsp;</label>
                        <input type="radio" id="ordenarCodigoAscInventario" name="ordenarInventario" value="codigo_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarCodigoDescInventario">Código Descendente</label>
                        <input type="radio" id="ordenarCodigoDescInventario" name="ordenarInventario" value="codigo_desc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarFechaAscInventario">Fecha Ascendente&nbsp;&nbsp;</label>
                        <input type="radio" id="ordenarFechaAscInventario" name="ordenarInventario" value="fecha_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarFechaDescInventario">Fecha Descendente</label>
                        <input type="radio" id="ordenarFechaDescInventario" name="ordenarInventario" value="fecha_desc">
                    </div>

                </div>
            </div>

            <button id="aplicarBusquedaInventario" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-inventario">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleInventario">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseInventario').addEventListener('click', () => {
            document.getElementById('filtrosInventario').classList.add('hidden');
            document.getElementById('filtroToggleInventario').style.display = 'flex';
        });

        document.getElementById('filtroToggleInventario').addEventListener('click', () => {
            document.getElementById('filtrosInventario').classList.remove('hidden');
            document.getElementById('filtroToggleInventario').style.display = 'none';
        });
    </script>
</body>
</html>