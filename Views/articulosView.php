<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="Assets/css/styles.css">
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoarticulos" class="crud">Listado</button>
        <button id="añadirarticulos" class="crud">Añadir</button>
        <button id="modificararticulos" class="crud">Modificar</button>
        <button id="eliminararticulos" class="crud">Eliminar</button>
    </div>

    <div id="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirArticulo" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR ARTICULO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioArticulo" action="#" method="POST">
                    <div id="contDatosArticulo" class="contDatosForm1">    
                        <div class="contAñadir1" id="contAñadirArticulo1">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="tipo">Tipo:</label>
                            <select id="tipo" name="tipo" class="opciones_select" required>
                                <option value="" disabled selected>Selecciona un tipo</option>
                                <option value="terminado">Terminado</option>
                                <option value="materia">Materia</option>
                            </select>
                        </div>
                        <div class="contAñadir1" id="contAñadirArticulo2">
                            <label for="importe">Importe:</label>
                            <input type="text" id="importe" name="importe" required><br>
                            <label for="stock">Stock:</label>
                            <input type="text" id="stock" name="stock" required><br>
                        </div>
                    </div>
                    <div id="divBotonAñadirArticulo" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirArticulo" class="botonAñadir" name="botonAñadirArticulo">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" style="display: none;">
        <div class="formmodificar">
            <button class="close-btn" id="cerrarFormularioModificarArticulos">&times;</button>
            <div id="tituloModificarArticulo" class="divTituloModificar">
                <h2 class="tituloModificar">MODIFICAR ARTICULO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioModificarArticulo" action="Controllers/articulosModificacion1Controller.php" method="POST">
                    <input type="hidden" id="ide_original" name="ide_original">
                    <div id="contDatosArticulo" class="contDatosForm1">    
                        <div class="contModificar1" id="contModificarArticulo1">
                            <label for="nombre_mod">Nombre:</label>
                            <input type="text" id="nombre_mod" name="nombre" required><br>
                            <label for="tipo_mod">Tipo:</label>
                            <select id="tipo_mod" name="tipo" class="opciones_select" required>
                                <option value="terminado">Terminado</option>
                                <option value="materia">Materia</option>
                            </select>
                        </div>
                        <div class="contModificar1" id="contModificarArticulo2">
                            <label for="importe_mod">Importe:</label>
                            <input type="text" id="importe_mod" name="importe" required><br>
                            <label for="stock_mod">Stock:</label>
                            <input type="text" id="stock_mod" name="stock" required><br>
                        </div>
                    </div>
                    <div id="divbotonModificarArticulo" class="divBotonModificar">
                        <button type="submit" id="botonModificarArticulo" class="botonModificar" name="botonModificarArticulo">Guardar</button>
                    </div>
                    <div id="divRespuestaModificarArticulo"> </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>