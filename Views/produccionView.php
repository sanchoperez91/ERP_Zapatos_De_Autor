<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
            // FUNCION QUE RELLENA LOS CAMPOS DEL FORM PRODUCCION CON LA BBDD
            async function cargarDatosFormProduccion() {
                try {
                    const response = await fetch("Controllers/produccionConsulta2Controller.php");
                    if (!response.ok) throw new Error("Error en la respuesta del servidor");

                    const data = await response.json();

                    // Poblamos el select de empleados
                    if (data.dni_emp.length > 0) {
                        const dniEmpleadoSelect = document.getElementById("dniEmpleado");
                        data.dni_emp.forEach(({ dni_emp, nom_emp }) => {
                            const option = document.createElement("option");
                            option.value = dni_emp;
                            option.textContent = dni_emp;
                            option.dataset.nombre = nom_emp; // Almacenamos el nombre como atributo de datos
                            dniEmpleadoSelect.appendChild(option);
                        });

                        dniEmpleadoSelect.addEventListener("change", (e) => {
                            const selectedOption = dniEmpleadoSelect.options[dniEmpleadoSelect.selectedIndex];
                            document.getElementById("nombreEmpleado").value = selectedOption.dataset.nombre || "";
                        });
                    }

                    // Poblamos el select de almacenes
                    if (data.ide_alm.length > 0) {
                        const almacenSelect = document.getElementById("codigoAlmacen");
                        data.ide_alm.forEach(({ ide_alm, nom_alm }) => {
                            const option = document.createElement("option");
                            option.value = ide_alm;
                            option.textContent = ide_alm;
                            option.dataset.nombre = nom_alm;
                            almacenSelect.appendChild(option);
                        });

                        almacenSelect.addEventListener("change", (e) => {
                            const selectedOption = almacenSelect.options[almacenSelect.selectedIndex];
                            document.getElementById("nombreAlmacen").value = selectedOption.dataset.nombre || "";
                        });
                    }

                    // Poblamos el select de escandallos
                    if (data.ide_esc.length > 0) {
                        const escandalloSelect = document.getElementById("codigoEscandallo");
                        data.ide_esc.forEach(({ ide_esc, nom_esc }) => {
                            const option = document.createElement("option");
                            option.value = ide_esc;
                            option.textContent = ide_esc;
                            option.dataset.nombre = nom_esc;
                            escandalloSelect.appendChild(option);
                        });

                        escandalloSelect.addEventListener("change", (e) => {
                            const selectedOption = escandalloSelect.options[escandalloSelect.selectedIndex];
                            document.getElementById("nombreEscandallo").value = selectedOption.dataset.nombre || "";
                        });
                    }
                } catch (error) {
                    console.error("Error al cargar los datos:", error);
                }
            }

            // Llamamos a la función para cargar los datos al cargar la página
            cargarDatosFormProduccion();
        });
    </script>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoproduccion" class="crud">Listado</button>
        <button id="añadirproduccion" class="crud">Añadir</button>
        <button id="modificarproduccion" class="crud">Modificar</button>
        <button id="eliminarproduccion" class="crud">Eliminar</button>
    </div>

    <div id="overlay">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirProduccion" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR PRODUCCIÓN</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioProduccion" action="#" method="POST">
                    <!-- Primer div: NUEVA PRODUCCION -->
                    <div id="contNuevaProduccion" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS EMPLEADO</h1>
                        <div class="contAñadir2" id="contAñadirProduccion1">
                            <div class="miniCont">    
                                <label for="dniEmpleado">DNI Empleado:</label>
                                <select id="dniEmpleado" name="dniEmpleado" class="opciones_select" required>
                                    <option value="" disabled selected>Selecciona el DNI del empleado</option>
                                    <!-- Opciones de DNI se cargarán dinámicamente -->
                                </select><br>
                            </div>
                            <div class="miniCont"> 
                                <label for="nombreEmpleado">Nombre Empleado:</label>
                                <input type="text" id="nombreEmpleado" name="nombreEmpleado" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont"> 
                                <label for="fechaProduccion">Fecha:</label>
                                <input type="date" id="fechaProduccion" name="fechaProduccion" required><br>
                            </div>
                        </div>
                    </div>

                    <!-- Segundo div: DATOS ALMACEN -->
                    <div id="contDatosAlmacen" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS ALMACEN</h1>
                        <div class="contAñadir2" id="contAñadirAlmacen1">
                            <div class="miniCont">
                                <label for="codigoAlmacen">Código Almacén:</label>
                                <select id="codigoAlmacen" name="codigoAlmacen" class="opciones_select" required>
                                    <option value="" disabled selected>Selecciona el código del almacén</option>
                                    <!-- Opciones de código de almacén se cargarán dinámicamente -->
                                </select><br>
                            </div>
                            <div class="miniCont">
                                <label for="nombreAlmacen">Nombre Almacén:</label>
                                <input type="text" id="nombreAlmacen" name="nombreAlmacen" class="no_modificable" required readonly><br>
                            </div>
                        </div>
                    </div>

                    <!-- Tercer div: ESCANDALLO -->
                    <div id="contEscandallo" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS ESCANDALLO</h1>
                        <div class="contAñadir2" id="contAñadirEscandallo1">
                            <div class="miniCont">
                                <label for="codigoEscandallo">Código Escandallo:</label>
                                <select id="codigoEscandallo" name="codigoEscandallo" class="opciones_select" required>
                                    <option value="" disabled selected>Selecciona el código del escandallo</option>
                                    <!-- Opciones de código de escandallo se cargarán dinámicamente -->
                                </select><br>
                            </div>
                            <div class="miniCont">
                                <label for="nombreEscandallo">Nombre Escandallo:</label>
                                <input type="text" id="nombreEscandallo" name="nombreEscandallo" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" min="1" required><br>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de guardar -->
                    <div id="divBotonGuardar" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirProduccion" class="botonAñadir" name="botonGuardar">Guardar</button>
                    </div>
                    
                    <div id="divRespuesta"></div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" class="overlay2" style="display: none;">
    <div class="formmodificar">
        <button class="close-btn" id="cerrarFormularioModificarProduccion">&times;</button>
        <div id="tituloModificarProduccion" class="divTituloModificar">
            <h2 class="tituloModificar">MODIFICAR PRODUCCIÓN</h2>
        </div>
        <div id="contEmp2">
            <form id="formularioModificarProduccion" action="Controllers/produccionModificacion1Controller.php" method="POST">
                <input type="hidden" id="id_original" name="id_original">
                <div id="contDatosProduccion" class="contDatosForm1">    
                    <div class="contModificar1" id="contModificarProduccion1">
                        <label for="id_mod">ID:</label>
                        <input type="text" id="id_mod" name="id" required readonly class="no_modificable"><br>

                        <label for="fecha_mod">Fecha:</label>
                        <input type="date" id="fecha_mod" name="fecha" required><br>

                        <label for="cantidad_mod">Cantidad:</label>
                        <input type="number" id="cantidad_mod" name="cantidad" required><br>
                    </div>
                    <div class="contModificar1" id="contModificarProduccion2">
                        <label for="almacen_mod">ID Almacén:</label>
                        <select id="almacen_mod" name="almacen" class="opciones_select" required>
                            <option value="" disabled selected>Seleccione ID almacén</option>
                        </select><br>

                        <label for="escandallo_mod">ID Escandallo:</label>
                        <select id="escandallo_mod" name="escandallo" class="opciones_select" required>
                            <option value="" disabled selected>Seleccione ID escandallo</option>
                        </select><br>

                        <label for="empleado_mod">DNI Empleado:</label>
                        <select id="empleado_mod" name="empleado" class="opciones_select" required>
                            <option value="" disabled selected>Seleccione DNI empleado</option>
                        </select><br>
                    </div>
                </div>
                <div id="divbotonModificarProduccion" class="divBotonModificar">
                    <button type="submit" id="botonModificarProduccion" class="botonModificar" name="botonModificarProduccion">Guardar</button>
                </div>
                <div id="divRespuestaModificarProduccion"></div>
            </form>
        </div>
    </div>
</div>

<script>
    async function cargarDNIEmpleados() {
        const response = await fetch('Controllers/empleadosConsulta1Controller.php');
        const empleados = await response.json();
        const selectDNIEmpleadoMod = document.getElementById('empleado_mod');

        empleados.forEach(empleado => {
            const option = document.createElement('option');
            option.value = empleado.dni_emp;
            option.textContent = empleado.dni_emp;
            selectDNIEmpleadoMod.appendChild(option);
        });
    }

    async function cargarIDAlmacenes() {
        const response = await fetch('Controllers/almacenesConsulta1Controller.php');
        const almacenes = await response.json();
        const selectIDAlmacenMod = document.getElementById('almacen_mod');

        almacenes.forEach(almacen => {
            const option = document.createElement('option');
            option.value = almacen.ide_alm;
            option.textContent = almacen.ide_alm;
            selectIDAlmacenMod.appendChild(option);
        });
    }

    async function cargarIDEscandallos() {
        const response = await fetch('Controllers/escandalloConsulta1Controller.php');
        const escandallos = await response.json();
        const selectIDEscandalloMod = document.getElementById('escandallo_mod');

        escandallos.forEach(escandallo => {
            const option = document.createElement('option');
            option.value = escandallo.ide_esc;
            option.textContent = escandallo.ide_esc;
            selectIDEscandalloMod.appendChild(option);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        cargarDNIEmpleados();
        cargarIDAlmacenes();
        cargarIDEscandallos();
    });
</script>
</body>
</html>