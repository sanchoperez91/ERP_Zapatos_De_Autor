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
        <button id="listadoproveedores" class="crud">Listado</button>
        <button id="añadirproveedores" class="crud">Añadir</button>
        <button id="modificarproveedores" class="crud">Modificar</button>
        <button id="eliminarproveedores" class="crud">Eliminar</button>
    </div>

    <div id="overlay" class="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirProveedor" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR PROVEEDOR</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioProveedor" action="#" method="POST">
                    <div id="contDatosProveedor" class="contDatosForm1">    
                        <div class="contAñadir1" id="contAñadirProveedor1">
                            <label for="nif">NIF:</label>
                            <input type="text" id="nif" name="nif" required><br>

                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>

                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" required><br>
                        </div>
                        <div class="contAñadir1" id="contAñadirProveedor2">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required><br>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>

                            <label for="descuento">Descuento:</label>
                            <input type="number" id="descuento" name="descuento" required><br>
                        </div>
                    </div>
                    <div id="divbotonAñadirProveedor" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirProveedor" class="botonAñadir" name="botonAñadirProveedor">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" class="overlay2" style="display: none;">
        <div class="formmodificar">
            <button class="close-btn" id="cerrarFormularioModificar">&times;</button>
            <div id="tituloModificarProveedor" class="divTituloModificar">
                <h2 class="tituloModificar">MODIFICAR PROVEEDOR</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioModificarProveedor" action="Controllers/proveedoresModificacion1Controller.php" method="POST">
                    <input type="hidden" id="nif_original" name="nif_original">
                    <div id="contDatosProveedor" class="contDatosForm1">    
                        <div class="contModificar1" id="contModificarProveedor1">
                            <label for="nif_mod">NIF:</label>
                            <input type="text" id="nif_mod" name="nif" required readonly class="no_modificable"><br>

                            <label for="nombre_mod">Nombre:</label>
                            <input type="text" id="nombre_mod" name="nombre" required><br>

                            <label for="direccion_mod">Dirección:</label>
                            <input type="text" id="direccion_mod" name="direccion" required><br>
                        </div>
                        <div class="contModificar1" id="contModificarProveedor2">
                            <label for="telefono_mod">Teléfono:</label>
                            <input type="text" id="telefono_mod" name="telefono" required><br>

                            <label for="email_mod">Email:</label>
                            <input type="email" id="email_mod" name="email" required><br>

                            <label for="descuento_mod">Descuento:</label>
                            <input type="number" id="descuento_mod" name="descuento" required><br>
                        </div>
                    </div>
                    <div id="divbotonModificarProveedor" class="divBotonModificar">
                        <button type="submit" id="botonModificarProveedor" class="botonModificar" name="botonModificarProveedor">Guardar</button>
                    </div>
                    <div id="divRespuestaModificar"> </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>