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
    <script src="Assets/js/registro.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body> 
    <?php require_once 'bienvenida.php';?>
    <?php require_once "Views/Shared/headerBotonesView.php"; ?>
    <?php require_once "Views/clientesView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?>

    <div class="filtros hidden" id="filtrosClientes">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseClientes">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarDNIClientes">Buscar por:</label>
                    <select id="buscarCampoClientes" name="buscarCampoClientes">
                        <option value="todos">Todos</option>
                        <option value="dni_cli">DNI</option>
                        <option value="nom_cli">Nombre</option>
                        <option value="dir_cli">Dirección</option>
                        <option value="tlf_cli">Teléfono</option>
                        <option value="ema_cli">Email</option>
                        <option value="dto_cli">Descuento</option>
                    </select>
                    <input type="text" id="buscarValorClientes" name="buscarValorClientes">
                </div>
            </div>

            <div class="filtro-item">
                <!-- Radiobuttons de ordenación -->
                <div class="ordenacion">
                    <label>Ordenar por:</label>
                    <div class="radio-container">
                        <label for="ordenarDNIClientes">DNI Alfabéticamente</label>
                        <input type="radio" id="ordenarDNIClientes" name="ordenarClientes" value="dni_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarNombreClientes">Nombre Alfabéticamente</label>
                        <input type="radio" id="ordenarNombreClientes" name="ordenarClientes" value="nombre_asc">
                    </div>
                </div>
            </div>

            <button id="aplicarBusquedaClientes" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-clientes">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleClientes">
        <span>>></span>
    </div>
    <script>
        document.getElementById('filtroCloseClientes').addEventListener('click', () => {
            document.getElementById('filtrosClientes').classList.add('hidden');
            document.getElementById('filtroToggleClientes').style.display = 'flex';
        });

        document.getElementById('filtroToggleClientes').addEventListener('click', () => {
            document.getElementById('filtrosClientes').classList.remove('hidden');
            document.getElementById('filtroToggleClientes').style.display = 'none';
        });
    </script>
</body>
</html>