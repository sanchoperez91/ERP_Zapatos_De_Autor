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
    <?php require_once "Views/compraDIFERENTES.php"; ?>
    <?php require_once "Views/facturaComprasView.php"; ?>
    <?php require_once "Views/Shared/contenedoresView.php"; ?> 

    <div class="filtros hidden" id="filtrosCompra">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseCompra">X</span>
        </div>
        <div class="contenidofiltros">
            <div class="filtro-item">
                <p class="filtro-titulo">Buscar en:</p>
                <select id="buscarCampoCompra" name="buscarCampoCompra">
                    <option value="todos">Todos</option>
                    <option value="num_com">Nº Fact Propio</option>
                    <option value="fac_com">Nº Fact Proveedor</option>
                    <option value="fec_com">Fecha</option>
                    <option value="tot_com">Importe Total</option>
                    <option value="dni_emp">DNI Empleado</option>
                    <option value="nif_pro">NIF Proveedor</option>
                    <option value="ide_alm">ID Almacen</option>
                </select>
                <input type="text" class="filtro-texto" id="buscarValorCompra" placeholder="Valor a buscar">
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Total Importe</p>
                <div class="radio-container">
                    <label for="importe_200"><&nbsp;200</label>
                    <input type="radio" id="importe_200" name="filtro-importe" class="filtro-radio" value="<200">
                </div>
                <div class="radio-container">
                    <label for="importe_600"><&nbsp;600</label>
                    <input type="radio" id="importe_600" name="filtro-importe" class="filtro-radio" value="<600">
                </div>
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Fecha</p>
                <div class="radio-container">
                    <label for="fecha_2024"><&nbsp;2024</label>
                    <input type="radio" id="fecha_2024" name="filtro-fecha" class="filtro-radio" value="<2024">
                </div>
                <div class="radio-container">
                    <label for="fecha_2020"><&nbsp;2020</label>
                    <input type="radio" id="fecha_2020" name="filtro-fecha" class="filtro-radio" value="<2020">
                </div>
            </div>

            <div class="filtro-item">
                <p class="filtro-titulo">Ordenar por:</p>
                <div class="radio-container">
                    <label for="ordenar_numero">Numero&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="ordenar_numero" name="filtro-ordenar" class="filtro-radio" value="numero">
                </div>
                <div class="radio-container">
                    <label for="ordenar_proveedor">Proveedor</label>
                    <input type="radio" id="ordenar_proveedor" name="filtro-ordenar" class="filtro-radio" value="proveedor">
                </div>
            </div>

            <button id="aplicarBusquedaCompra" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-compra">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleCompra">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseCompra').addEventListener('click', () => {
            document.getElementById('filtrosCompra').classList.add('hidden');
            document.getElementById('filtroToggleCompra').style.display = 'flex';
        });

        document.getElementById('filtroToggleCompra').addEventListener('click', () => {
            document.getElementById('filtrosCompra').classList.remove('hidden');
            document.getElementById('filtroToggleCompra').style.display = 'none';
        });
    </script>
</body>
</html>