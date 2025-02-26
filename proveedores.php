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
    <?php require_once "Views/proveedoresView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?>

    <div class="filtros hidden" id="filtrosProveedores">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseProveedores">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarDNIProveedores">Buscar por:</label>
                    <select id="buscarCampoProveedores" name="buscarCampoProveedores">
                        <option value="todos">Todos</option>
                        <option value="nif_pro">NIF</option>
                        <option value="nom_pro">Nombre</option>
                        <option value="dir_pro">Dirección</option>
                        <option value="tlf_pro">Teléfono</option>
                        <option value="ema_pro">Email</option>
                        <option value="dto_pro">Descuento</option>
                    </select>
                    <input type="text" id="buscarValorProveedores" name="buscarValorProveedores">
                </div>
            </div>

            <div class="filtro-item">
                <!-- Radiobuttons de ordenación -->
                <div class="ordenacion">
                    <label>Ordenar por:</label>
                    <div class="radio-container">
                        <label for="ordenarDNIProveedores">DNI Alfabéticamente</label>
                        <input type="radio" id="ordenarDNIProveedores" name="ordenarProveedores" value="dni_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarNombreProveedores">Nombre Alfabéticamente</label>
                        <input type="radio" id="ordenarNombreProveedores" name="ordenarProveedores" value="nombre_asc">
                    </div>
                </div>
            </div>

            <button id="aplicarBusquedaProveedores" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-proveedores">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleProveedores">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseProveedores').addEventListener('click', () => {
            document.getElementById('filtrosProveedores').classList.add('hidden');
            document.getElementById('filtroToggleProveedores').style.display = 'flex';
        });

        document.getElementById('filtroToggleProveedores').addEventListener('click', () => {
            document.getElementById('filtrosProveedores').classList.remove('hidden');
            document.getElementById('filtroToggleProveedores').style.display = 'none';
        });
    </script>
</body>
</html>