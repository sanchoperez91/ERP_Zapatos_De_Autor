<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoclientes" class="crud">Listado</button>
        <button id="añadirclientes" class="crud">Añadir</button>
        <button id="modificarclientes" class="crud">Modificar</button>
        <button id="eliminarclientes" class="crud">Eliminar</button>
    </div>

    <div id="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirCliente" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR CLIENTE</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioClientes" action="#" method="POST">
                    <div id="contDatosCliente" class="contDatosForm1">    
                        <div class="contAñadir1" id="contAñadirCliente1">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" required><br>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" required><br>
                        </div>
                        <div class="contAñadir1" id="contAñadirCliente2">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required><br>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>
                            <label for="descuento">Descuento:</label>
                            <input type="number" id="descuento" name="descuento" required><br>
                        </div>
                    </div>
                    <div id="divbotonAñadirCliented" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirClientes" class="botonAñadir" name="botonAñadirClientes">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" class="overlay2" style="display: none;">
        <div class="formmodificar">
            <button class="close-btn" id="cerrarFormularioModificar">&times;</button>
            <div id="tituloModificarCliente" class="divTituloModificar">
                <h2 class="tituloModificar">MODIFICAR CLIENTE</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioModificarCliente" action="Controllers/clientesModificacion1Controller.php" method="POST">
                    <input type="hidden" id="dni_original" name="dni_original">
                    <div id="contDatosCliente" class="contDatosForm1">    
                        <div class="contModificar1" id="contModificarCliente1">
                            <label for="dni_mod">DNI:</label>
                            <input type="text" id="dni_mod" name="dni" required readonly class="no_modificable"><br>
                            <label for="nombre_mod">Nombre:</label>
                            <input type="text" id="nombre_mod" name="nombre" required><br>
                            <label for="direccion_mod">Dirección:</label>
                            <input type="text" id="direccion_mod" name="direccion" required><br>
                        </div>
                        <div class="contModificar1" id="contModificarCliente2">
                            <label for="telefono_mod">Teléfono:</label>
                            <input type="text" id="telefono_mod" name="telefono" required><br>
                            <label for="email_mod">Email:</label>
                            <input type="email" id="email_mod" name="email" required><br>
                            <label for="descuento_mod">Descuento:</label>
                            <input type="number" id="descuento_mod" name="descuento" required><br>
                        </div>
                    </div>
                    <div id="divbotonModificarCliente" class="divBotonModificar">
                        <button type="submit" id="botonModificarCliente" class="botonModificar" name="botonModificarCliente">Guardar</button>
                    </div>
                    <div id="divRespuestaModificar"> </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>