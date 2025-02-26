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
    <?php require_once "Views/empleadosView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?>

    <div class="filtros hidden" id="filtrosEmpleados">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseEmpleados">X</span>
        </div>
        <div class="contenidofiltros">

            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarDNIEmpleados">Buscar por:</label>
                    <select id="buscarCampoEmpleados" name="buscarCampoEmpleados">
                        <option value="todos">Todos</option>
                        <option value="dni_emp">DNI</option>
                        <option value="nom_emp">Nombre</option>
                        <option value="dir_emp">Dirección</option>
                        <option value="tlf_emp">Teléfono</option>
                        <option value="ema_emp">Email</option>
                        <option value="pue_emp">Puesto</option>
                    </select>
                    <input type="text" id="buscarValorEmpleados" name="buscarValorEmpleados">
                </div>
            </div>

            <div class="filtro-item">
                <!-- Radiobuttons de ordenación -->
                <div class="ordenacion">
                    <label>Ordenar por:</label>
                    <div style="display: flex; align-items: center;">
                        <label for="ordenarDNIEmpleados">DNI Alfabéticamente</label>
                        <input type="radio" id="ordenarDNIEmpleados" name="ordenarEmpleados" value="dni_asc" style="margin-left: 10px;">
                    </div>
                    <div style="display: flex; align-items: center;">
                        <label for="ordenarNombreEmpleados">Nombre Alfabéticamente</label>
                        <input type="radio" id="ordenarNombreEmpleados" name="ordenarEmpleados" value="nombre_asc" style="margin-left: 10px;">
                    </div>
                </div>
            </div>

            <button id="aplicarBusquedaEmpleados" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-empleados">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleEmpleados">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseEmpleados').addEventListener('click', () => {
            document.getElementById('filtrosEmpleados').classList.add('hidden');
            document.getElementById('filtroToggleEmpleados').style.display = 'flex';
        });

        document.getElementById('filtroToggleEmpleados').addEventListener('click', () => {
            document.getElementById('filtrosEmpleados').classList.remove('hidden');
            document.getElementById('filtroToggleEmpleados').style.display = 'none';
        });
    </script>
</body>
</html>