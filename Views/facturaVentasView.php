<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <script defer>
    document.addEventListener('DOMContentLoaded', function () {

    let data = null;  // Declaramos la variable data fuera de la función

    // Función para rellenar un select con los datos
    const rellenarSelect = (selectElement, dataList, inputElement, impArtElement) => {
        if (selectElement && dataList.length > 0) {
            selectElement.innerHTML = "<option value=''>Seleccione...</option>";
            dataList.forEach(({ id, nombre, imp_art }) => {
                const option = document.createElement("option");
                option.value = id; // Usamos el ID en el valor de la opción
                option.textContent = id; // Usamos el ID también como texto visible
                option.dataset.nombre = nombre; // Guardamos el nombre en el dataset para actualizar el input
                option.dataset.impArt = imp_art; // Guardamos el precio unitario en el dataset
                selectElement.appendChild(option);
            });

            // Asociar evento al select para actualizar el input correspondiente
            selectElement.addEventListener("change", () => {
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                if (inputElement) {
                    inputElement.value = selectedOption.dataset.nombre || ""; // Actualizamos el input con el nombre
                }
                if (impArtElement) {
                    impArtElement.value = selectedOption.dataset.impArt || ""; // Actualizamos el input con el precio unitario
                }
                calcularImpTot(); // Recalcular el total al cambiar el artículo
            });
        }
    };

    // Función para asignar eventos a los campos de un contenedor
    const asignarEventosContenedor = (contenedor) => {
        const canArtInput = contenedor.querySelector("#can_art");
        const impArtInput = contenedor.querySelector("#imp_art");


        if (canArtInput) {
            canArtInput.addEventListener("input", calcularImpTot);
        }
        if (impArtInput) {
            impArtInput.addEventListener("input", calcularImpTot);
        }
    };

    // Cargar datos desde el servidor
    async function cargarDatosFormFacturaVenta() {
        try {
            const response = await fetch("Controllers/facturaVentaConsulta2Controller.php");
            if (!response.ok) throw new Error("Error en la respuesta del servidor");

            data = await response.json(); // Guardamos los datos en la variable `data`
            if (!data) throw new Error("Datos vacíos o no válidos");

            // Rellenar los selects iniciales con los datos de la respuesta
            rellenarSelect(
                document.getElementById("dniEmpleado"),
                data.dni_emp.map(emp => ({ id: emp.dni_emp, nombre: emp.nom_emp })),
                document.getElementById("nombreEmpleado")
            );
            rellenarSelect(
                document.getElementById("codigoAlmacen"),
                data.ide_alm.map(alm => ({ id: alm.ide_alm, nombre: alm.nom_alm })),
                document.getElementById("nombreAlmacen")
            );
            rellenarSelect(
                document.getElementById("ideArticulo"),
                data.ide_art.map(art => ({ id: art.ide_art, nombre: art.nom_art, imp_art: art.imp_art })),
                document.getElementById("nom_art"),
                document.getElementById("imp_art")
            );
            rellenarSelect(
                document.getElementById("dni_cli"),
                data.dni_cli.map(cli => ({ id: cli.dni_cli, nombre: cli.nom_cli })), // Corregido: usar cli en lugar de art
                document.getElementById("nom_cli")
            );

        } catch (error) {
            console.error("Error al cargar los datos:", error);
        } finally {
            // Asignar eventos al contenedor original
            const contenedorOriginal = document.querySelector('.contMateria');
            if (contenedorOriginal) {
                asignarEventosContenedor(contenedorOriginal);
            }
            calcularImpTot(); // Calcular el total al cargar la página
        }
    }

    // Evento de clic en el botón "+ Artículo"
    document.getElementById('botonAñadirArticuloFacturaVenta').addEventListener('click', function (event) {
        event.preventDefault(); // Prevenir comportamiento predeterminado del botón

        if (!data) {
            console.error('Los datos aún no están disponibles.'); // Verificamos que `data` esté disponible antes de usarla
            return;
        }

        // Clonar el contenedor original
        const original = document.querySelector('.contMateria');
        if (!original) {
            console.error('No se encontró el contenedor original.');
            return;
        }

        // Clonar el contenedor y limpiar sus valores
        const nuevoContenedor = original.cloneNode(true);

        // Limpiar los campos de entrada (inputs)
        nuevoContenedor.querySelectorAll('input').forEach(input => {
            if (!input.classList.contains('no_modificable')) {
                input.value = ''; // Limpiar solo los campos editables
            }
        });

        // Añadir el botón de eliminación (X)
        const botonEliminar = document.createElement('button');
        botonEliminar.textContent = 'X'; // Texto de la cruz
        botonEliminar.classList.add('botonEliminar');
        botonEliminar.style.cssText = 'position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; cursor: pointer;';
        botonEliminar.addEventListener('click', function () {
            nuevoContenedor.remove();
            calcularImpTot(); // Recalcular el total después de eliminar un contenedor
        });

        nuevoContenedor.style.position = 'relative';
        nuevoContenedor.appendChild(botonEliminar);

        // Insertar el nuevo contenedor en el DOM antes del contenedor del botón "+ Artículo"
        const contenedorBoton = document.getElementById('contAñadirFacturaVenta3');
        if (!contenedorBoton) {
            console.error('No se encontró el contenedor del botón.');
            return;
        }

        contenedorBoton.parentNode.insertBefore(nuevoContenedor, contenedorBoton);

        // Rellenar los nuevos selects en el contenedor clonado
        const selectArticulo = nuevoContenedor.querySelector("#ideArticulo");
        const inputArticulo = nuevoContenedor.querySelector("#nom_art");
        const impArtInput = nuevoContenedor.querySelector("#imp_art");


        // Rellenar selects del nuevo contenedor con los datos correctos
        rellenarSelect(selectArticulo, data.ide_art.map(art => ({ id: art.ide_art, nombre: art.nom_art, imp_art: art.imp_art })), inputArticulo, impArtInput);

        // Asignar eventos al nuevo contenedor
        asignarEventosContenedor(nuevoContenedor);

        // Recalcular el total después de añadir un nuevo contenedor
        calcularImpTot();
    });

    // Función para calcular el precio total de cada artículo
    function calcularImpTot() {
        const contMaterias = document.querySelectorAll('.contMateria');
        let totalFactura = 0;

        contMaterias.forEach(contMateria => {
            const canArtInput = contMateria.querySelector("#can_art");
            const impArtInput = contMateria.querySelector("#imp_art");
            const impTotInput = contMateria.querySelector("#imp_tot");

            if (canArtInput && impArtInput && impTotInput) {
                const canArt = parseFloat(canArtInput.value) || 0;
                const impArt = parseFloat(impArtInput.value) || 0;
                const impTot = canArt * impArt;
                impTotInput.value = impTot.toFixed(2); // Redondear a 2 decimales
                totalFactura += impTot;
            }
        });

        const totVenInput = document.getElementById("tot_ven");
        totVenInput.value = totalFactura.toFixed(2); // Redondear a 2 decimales
    }

    // Cargar datos iniciales cuando la página cargue
    cargarDatosFormFacturaVenta();

    });
    </script>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoFacturaVenta" class="crud">Listado</button>
        <button id="añadirFacturaVenta" class="crud">Añadir</button>
        <button id="modificarFacturaVenta" class="crud">Modificar</button>
        <button id="eliminarFacturaVenta" class="crud">Eliminar</button>
    </div>

    <div id="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirFacturaVenta" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR FACTURA DE VENTA</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioFacturaVenta" action="#" method="POST">
                    <!-- Primer div: Nuevo FacturaVenta -->
                    <div id="contNuevaFacturaVenta" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS EMPLEADO</h1>
                        <div class="contAñadir2" id="contAñadirFacturaVenta1">
                            <div class="miniCont">    
                                <label for="dniEmpleado">DNI Empleado:</label>
                                <select id="dniEmpleado" name="dniEmpleado" class="opciones_select" required>
                                    <option value="" disabled selected>Seleccione DNI empleado</option>
                                    <!-- Opciones de DNI se cargarán dinámicamente -->
                                </select><br>
                            </div>
                            <div class="miniCont"> 
                                <label for="nombreEmpleado">Nombre Empleado:</label>
                                <input type="text" id="nombreEmpleado" name="nombreEmpleado" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont"> 
                                <label for="fechaFacturaVenta">Fecha:</label>
                                <input type="date" id="fechaFacturaVenta" name="fechaFacturaVenta" required><br>
                            </div>
                        </div>
                    </div>

                    <!-- Segundo div: DATOS CLIENTE -->
                    <div id="contDatosAlmacen" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS CLIENTE</h1>
                        <div class="contAñadir2" id="contAñadirAlmacen1">
                            <div class="miniCont">
                                <label for="dni_cli">DNI Cliente:</label>
                                <select id="dni_cli" name="dni_cli" class="opciones_select" required>
                                    <option value="" disabled selected>Seleccione DNI cliente</option>
                                    <!-- Opciones de código de almacén se cargarán dinámicamente -->
                                </select><br>
                            </div>
                            <div class="miniCont">
                                <label for="nom_cli">Nombre Cliente:</label>
                                <input type="text" id="nom_cli" name="nom_cli" class="no_modificable" required readonly><br>
                            </div>
                        </div>
                    </div>

                    <!-- TERCER CONTENEDOR DATOS DE IMPORTE TOTAL -->
                    <div id="contDatosCliente" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS ALMACEN SALIDA</h1>
                        <div class="contAñadir2" id="contAñadirAlmacen1">
                            <div class="miniCont">
                                <label for="codigoAlmacen">Código Almacén:</label>
                                <select id="codigoAlmacen" name="codigoAlmacen" class="opciones_select" required>
                                    <option value="" disabled selected>Seleccione ID almacén</option>
                                    <!-- Opciones de código de almacén se cargarán dinámicamente -->
                                </select><br>
                            </div>
                            <div class="miniCont">
                                <label for="nombreAlmacen">Nombre Almacén:</label>
                                <input type="text" id="nombreAlmacen" name="nombreAlmacen" class="no_modificable" required readonly><br>
                            </div>
                        </div>
                    </div>

                    

                    <!-- QUINTO CONTENEDOR DATOS DE ARTICULOS -->
                    <h1 class="titulosFormEscandallo">ARTÍCULOS</h1>
                    <div class="contAñadir2 contMateria">
                        <div class="miniCont">   
                            <label for="ideArticulo">Ide Artículos:</label>
                            <select id="ideArticulo" name="ideArticulo[]" class="opciones_select" required>
                                <option value="" disabled selected>Seleccione ID artículo</option>
                                <!-- Opciones de ID se cargarán dinámicamente -->
                            </select>
                        </div>
                        <div class="miniCont">
                            <label for="nom_art">Nombre artículo: </label>
                            <input type="text" id="nom_art" name="nom_art[]" class="no_modificable" required readonly><br>
                        </div>
                        <div class="miniCont">
                            <label for="can_art">Cantidad:</label>
                            <input type="number" id="can_art" name="can_art[]" required><br>
                        </div>
                        <div class="miniCont">
                            <label for="imp_art">Precio unitario: </label>
                            <input type="text" id="imp_art" name="imp_art[]"  required ><br>
                        </div>
                        <div class="miniCont">
                            <label for="imp_tot">Precio total: </label>
                            <input type="text" id="imp_tot" name="imp_tot" required ><br>
                        </div>
                    </div>

                    <div class="contAñadir2" id="contAñadirFacturaVenta3">
                        <div id="divBotonAñadirArticuloFacturaVenta" class="divBotonMateria">
                            <button type="button" id="botonAñadirArticuloFacturaVenta" class="botonAñadirArt" name="divBotonAñadirMateriaEscandallo">+ Artículo</button>
                        </div>
                    </div>
                    <!-- CUARTO CONTENEDOR DATOS DE IMPORTE TOTAL -->
                    <h1 class="titulosFormEscandallo">IMPORTE TOTAL FACTURA</h1>
                    <div class="contAñadir2">
                        <div class="miniCont">   
                            <label for="tot_ven">Importe Total</label>
                            <input type="number" step="0.01" id="tot_ven" name="tot_ven"  required><br>
                        </div>
                    </div>
                    <div id="divBotonAñadirFacturaVenta" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirFacturaVenta" class="botonAñadir" name="botonAñadirFacturaVenta">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" style="display: none;">
    <div class="formmodificar">
        <button class="close-btn" id="cerrarFormularioModificarFacturaVenta">&times;</button>
        <div id="tituloModificarFacturaVenta" class="divTituloModificar">
            <h2 class="tituloModificar">MODIFICAR FACTURA DE VENTA</h2>
        </div>
        <div id="contEmp2">
            <form id="formularioModificarFacturaVenta" action="Controllers/facturaVentaModificacion1Controller.php" method="POST">
                <input type="hidden" id="num_ven_mod" name="num_ven">
                <div id="contDatosFacturaVenta" class="contDatosForm1">
                    <div class="contModificar1" id="contModificarFacturaVenta1">
                        <label for="fec_ven_mod">Fecha:</label>
                        <input type="date" id="fec_ven_mod" name="fec_ven" required><br>

                        <label for="tot_ven_mod">Importe Total:</label>
                        <input type="number" step="0.01" id="tot_ven_mod" name="tot_ven" required><br>

                        <label for="dni_emp_mod">DNI Empleado:</label>
                        <select id="dni_emp_mod" name="dni_emp" class="opciones_select" required>
                            <option value="" disabled selected>Seleccione DNI empleado</option>
                        </select><br>

                        <label for="dni_cli_mod">DNI Cliente:</label>
                        <select id="dni_cli_mod" name="dni_cli" class="opciones_select" required>
                            <option value="" disabled selected>Seleccione DNI cliente</option>
                        </select><br>

                        <label for="ide_alm_mod">ID Almacén:</label>
                        <select id="ide_alm_mod" name="ide_alm" class="opciones_select" required>
                            <option value="" disabled selected>Seleccione ID almacén</option>
                        </select><br>
                    </div>
                </div>
                <div id="divbotonModificarFacturaVenta" class="divBotonModificar">
                    <button type="submit" id="botonModificarFacturaVenta" class="botonModificar" name="botonModificarFacturaVenta">Guardar</button>
                </div>
                <div id="divRespuestaModificarFacturaVenta"></div>
            </form>
        </div>
    </div>
</div>

<script>
    async function cargarDNIEmpleados() {
        const response = await fetch('Controllers/empleadosConsulta1Controller.php');
        const empleados = await response.json();
        const selectDNIEmpleadoMod = document.getElementById('dni_emp_mod');

        empleados.forEach(empleado => {
            const option = document.createElement('option');
            option.value = empleado.dni_emp;
            option.textContent = empleado.dni_emp;
            selectDNIEmpleadoMod.appendChild(option);
        });
    }

    async function cargarDNIClientes() {
        const response = await fetch('Controllers/clientesConsulta1Controller.php');
        const clientes = await response.json();
        const selectDNIClienteMod = document.getElementById('dni_cli_mod');

        clientes.forEach(cliente => {
            const option = document.createElement('option');
            option.value = cliente.dni_cli;
            option.textContent = cliente.dni_cli;
            selectDNIClienteMod.appendChild(option);
        });
    }

    async function cargarIDAlmacenes() {
        const response = await fetch('Controllers/almacenesConsulta1Controller.php');
        const almacenes = await response.json();
        const selectIDAlmacenMod = document.getElementById('ide_alm_mod');

        almacenes.forEach(almacen => {
            const option = document.createElement('option');
            option.value = almacen.ide_alm;
            option.textContent = almacen.ide_alm;
            selectIDAlmacenMod.appendChild(option);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        cargarDNIEmpleados();
        cargarDNIClientes();
        cargarIDAlmacenes();
    });
</script>
</body>
</html>