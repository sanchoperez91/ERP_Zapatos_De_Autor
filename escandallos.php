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
    <?php require_once "Views/escandallosView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?> 

    <div class="filtros hidden" id="filtrosEscandallo">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseEscandallo">X</span>
        </div>
        <div class="contenidofiltros">
            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarDNIClientes">Buscar por:</label>
                    <select id="buscarCampoEscandallo" name="buscarCampoEscandallo">
                        <option value="todos">Todos</option>
                        <option value="ide_esc">ID Escandallo</option>
                        <option value="nom_esc">Nombre Escandallo</option>
                        <option value="tie_esc">Tiempo</option>
                        <option value="cos_esc">Coste</option>
                        <option value="tip_esc">Tipo</option>
                    </select>
                    <input type="text" id="buscarValorEscandallo" name="buscarValorEscandallo">
                </div>
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Ordenar por:</p>
                <div class="radio-container">
                    <label for="ordenar_nombre">Nombre</label>
                    <input type="radio" id="ordenar_nombre" name="filtro-ordenar" class="filtro-radio" value="nombre">
                </div>
                <div class="radio-container">
                    <label for="ordenar_id">ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="ordenar_id" name="filtro-ordenar" class="filtro-radio" value="id">
                </div>
            </div>
            <div class="filtro-item">
                <p class="filtro-titulo">Tiempo</p>
                <div class="radio-container">
                    <label for="tiempo_100">< 100</label>
                    <input type="radio" id="tiempo_100" name="filtro-tiempo" class="filtro-radio" value="<100">
                </div>
                <div class="radio-container">
                    <label for="tiempo_50">< 50</label>
                    <input type="radio" id="tiempo_50" name="filtro-tiempo" class="filtro-radio" value="<50">
                </div>
            </div>
            <div class="filtro-item">
                <p class="filtro-titulo">Coste</p>
                <div class="radio-container">
                    <label for="coste_600">< 600</label>
                    <input type="radio" id="coste_600" name="filtro-coste" class="filtro-radio" value="<600">
                </div>
                <div class="radio-container">
                    <label for="coste_200">< 200</label>
                    <input type="radio" id="coste_200" name="filtro-coste" class="filtro-radio" value="<200">
                </div>
            </div>
            <div class="filtro-item">
                <p class="filtro-titulo">Tipo</p>
                <div class="radio-container">
                    <label for="tipo_comun">Común&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="tipo_comun" name="filtro-tipo" class="filtro-radio" value="comun">
                </div>
                <div class="radio-container">
                    <label for="tipo_personalizado">Personalizado</label>
                    <input type="radio" id="tipo_personalizado" name="filtro-tipo" class="filtro-radio" value="personalizado">
                </div>
            </div>
            <button id="aplicarBusquedaEscandallo" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-escandallo">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleEscandallo">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseEscandallo').addEventListener('click', () => {
            document.getElementById('filtrosEscandallo').classList.add('hidden');
            document.getElementById('filtroToggleEscandallo').style.display = 'flex';
        });

        document.getElementById('filtroToggleEscandallo').addEventListener('click', () => {
            document.getElementById('filtrosEscandallo').classList.remove('hidden');
            document.getElementById('filtroToggleEscandallo').style.display = 'none';
        });
    </script>
</body>
</html>