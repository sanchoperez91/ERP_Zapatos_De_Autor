

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoempleados" class="crud">Listado</button>
        <button id="añadirempleados" class="crud">Añadir</button>
        <button id="modificarempleados" class="crud">Modificar</button>
        <button id="eliminarempleados" class="crud">Eliminar</button>
    </div>

    <div id="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirEmpleado" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR EMPLEADO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioEmpleado" action="#" method="POST">
                    <div id="contDatosEmpleado" class="contDatosForm1">    
                        <div class="contAñadir1" id="contAñadirEmpleado1">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" required><br>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="con_emp">Contraseña:</label>
                            <input type="password" pattern="\d*" min="0" minlength="4" maxlength="4" id="con_emp" name="con_emp" required placeholder="4 dígitos"><br>
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" required><br>
                        </div>
                        <div class="contAñadir1" id="contAñadirEmpleado2">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required><br>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>
                            <label for="puesto">Puesto:</label>
                            <select id="puesto" name="puesto" class="opciones_select" required>
                                <option value="" disabled selected>Selecciona un puesto</option>
                                <option value="compras">Compras</option>
                                <option value="direccion">Dirección</option>
                                <option value="contabilidad">Contabilidad</option>
                                <option value="produccion">Producción</option>
                                <option value="diseño">Diseño</option>
                                <option value="transporte">Transporte</option>
                            </select>
                        </div>
                    </div>
                    <div id="divbotonAñadirEmpleado" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirEmpleado" class="botonAñadir" name="botonAñadirEmpleado">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" class="overlay2" style="display: none;">
        <div class="formmodificar">
            <button class="close-btn" id="cerrarFormularioModificar">&times;</button>
            <div id="tituloModificarEmpleado" class="divTituloModificar">
                <h2 class="tituloModificar">MODIFICAR EMPLEADO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioModificarEmpleado" action="Controllers/empleadosModificacion1Controller.php" method="POST">
                    <input type="hidden" id="dni_original" name="dni_original">
                    <div id="contDatosEmpleado" class="contDatosForm1">    
                        <div class="contModificar1" id="contModificarEmpleado1">
                            <label for="dni_mod">DNI:</label>
                            <input type="text" id="dni_mod" name="dni" required readonly class="no_modificable"><br>
                            <label for="nombre_mod">Nombre:</label>
                            <input type="text" id="nombre_mod" name="nombre" required><br>
                            <label for="direccion_mod">Dirección:</label>
                            <input type="text" id="direccion_mod" name="direccion" required><br>
                        </div>
                        <div class="contModificar1" id="contModificarEmpleado2">
                            <label for="telefono_mod">Teléfono:</label>
                            <input type="text" id="telefono_mod" name="telefono" required><br>
                            <label for="email_mod">Email:</label>
                            <input type="email" id="email_mod" name="email" required><br>
                            <label for="puesto_mod">Puesto:</label>
                            <select id="puesto_mod" name="puesto" class="opciones_select" required>
                                <option value="" disabled selected>Selecciona un puesto</option>
                                <option value="compras">Compras</option>
                                <option value="direccion">Dirección</option>
                                <option value="contabilidad">Contabilidad</option>
                                <option value="produccion">Producción</option>
                                <option value="diseño">Diseño</option>
                                <option value="transporte">Transporte</option>
                            </select>
                        </div>
                    </div>
                    <div id="divbotonModificarEmpleado" class="divBotonModificar">
                        <button type="submit" id="botonModificarEmpleado" class="botonModificar" name="botonModificarEmpleado">Guardar</button>
                    </div>
                    <div id="divRespuestaModificar"> </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>