<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoalmacenes" class="crud">Listado</button>
        <button id="añadiralmacenes" class="crud">Añadir</button>
        <button id="modificaralmacenes" class="crud">Modificar</button>
        <button id="eliminaralmacenes" class="crud">Eliminar</button>
    </div>

    <div id="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirAlmacenes" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR ALMACEN</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioAlmacenes" action="#" method="POST">
                    <div id="contDatosAlmacenes" class="contDatosForm1">    
                        <div class="contAñadir1" id="contAñadirAlmacenes1">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="ubicacion">Ubicacion:</label>
                            <input type="text" id="ubicacion" name="ubicacion" required><br>
                        </div>
                    </div>
                    <div id="divbotonAñadirAlmcenes" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirAlmacen" class="botonAñadir" name="botonAñadirAlmacen">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" class="overlay2" style="display: none;">
        <div class="formmodificar">
            <button class="close-btn" id="cerrarFormularioModificar">&times;</button>
            <div id="tituloModificarAlmacen" class="divTituloModificar">
                <h2 class="tituloModificar">MODIFICAR ALMACEN</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioModificarAlmacen" action="Controllers/almacenesModificacion1Controller.php" method="POST">
                    <input type="hidden" id="ide_original" name="ide_original">
                    <div id="contDatosAlmacenes" class="contDatosForm1">    
                        <div class="contModificar1" id="contModificarAlmacenes1">
                            <label for="nombre_mod">Nombre:</label>
                            <input type="text" id="nombre_mod" name="nombre" required><br>
                            <label for="ubicacion_mod">Ubicacion:</label>
                            <input type="text" id="ubicacion_mod" name="ubicacion" required><br>
                        </div>
                    </div>
                    <div id="divbotonModificarAlmacen" class="divBotonModificar">
                        <button type="submit" id="botonModificarAlmacen" class="botonModificar" name="botonModificarAlmacen">Guardar</button>
                    </div>
                    <div id="divRespuestaModificar"> </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>