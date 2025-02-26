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
        const rellenarSelect = (selectElement, dataList, inputElement) => {
            if (selectElement && dataList.length > 0) {
                selectElement.innerHTML = "<option value=''>Seleccione...</option>";
                dataList.forEach(({ id, nombre }) => {
                    const option = document.createElement("option");
                    option.value = id; // Usamos el ID en el valor de la opción
                    option.textContent = id; // Usamos el ID también como texto visible
                    option.dataset.nombre = nombre; // Guardamos el nombre en el dataset para actualizar el input
                    selectElement.appendChild(option);
                });

                // Asociar evento al select para actualizar el input correspondiente
                selectElement.addEventListener("change", () => {
                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                    if (inputElement) {
                        inputElement.value = selectedOption.dataset.nombre || ""; // Actualizamos el input con el nombre
                    }
                });
            }
        };

        // Cargar datos desde el servidor
        async function cargarDatosFormInventario() {
            try {
                const response = await fetch("Controllers/inventarioConsulta2Controller.php");
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
                    data.ide_art.map(art => ({ id: art.ide_art, nombre: art.nom_art })),
                    document.getElementById("nom_art")
                );

            } catch (error) {
                console.error("Error al cargar los datos:", error);
            }
        }

        // Evento de clic en el botón "+ Artículo"
        document.getElementById('botonAñadirArticuloInventario').addEventListener('click', function (event) {
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
            });

            nuevoContenedor.style.position = 'relative';
            nuevoContenedor.appendChild(botonEliminar);

            // Insertar el nuevo contenedor en el DOM antes del contenedor del botón "+ Artículo"
            const contenedorBoton = document.getElementById('contAñadirInventario3');
            if (!contenedorBoton) {
                console.error('No se encontró el contenedor del botón.');
                return;
            }

            contenedorBoton.parentNode.insertBefore(nuevoContenedor, contenedorBoton);

            // Rellenar los nuevos selects en el contenedor clonado
            const selectEmpleado = nuevoContenedor.querySelector("#dniEmpleado");
            const inputEmpleado = nuevoContenedor.querySelector("#nombreEmpleado");
            const selectAlmacen = nuevoContenedor.querySelector("#codigoAlmacen");
            const inputAlmacen = nuevoContenedor.querySelector("#nombreAlmacen");
            const selectArticulo = nuevoContenedor.querySelector("#ideArticulo");
            const inputArticulo = nuevoContenedor.querySelector("#nom_art");

            // Rellenar selects del nuevo contenedor con los datos correctos
            rellenarSelect(selectEmpleado, data.dni_emp.map(emp => ({ id: emp.dni_emp, nombre: emp.nom_emp })), inputEmpleado);
            rellenarSelect(selectAlmacen, data.ide_alm.map(alm => ({ id: alm.ide_alm, nombre: alm.nom_alm })), inputAlmacen);
            rellenarSelect(selectArticulo, data.ide_art.map(art => ({ id: art.ide_art, nombre: art.nom_art })), inputArticulo);
        });

        // Cargar datos iniciales cuando la página cargue
        cargarDatosFormInventario();

    });
    </script>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoinventario" class="crud">Listado</button>
        <button id="añadirinventario" class="crud">Añadir</button>
        <button id="modificarinventario" class="crud">Modificar</button>
        <button id="eliminarinventario" class="crud">Eliminar</button>
    </div>

    <div id="overlay">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirInventario" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR INVENTARIO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioInventario" action="#" method="POST">
                    <!-- Primer div: Nuevo Inventario -->
                    <div id="contNuevaInventario" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">DATOS EMPLEADO</h1>
                        <div class="contAñadir2" id="contAñadirInventario1">
                            <div class="miniCont">    
                                <label for="dniEmpleado">DNI Empleado:</label>
                                <select id="dniEmpleado" name="dniEmpleado" class="opciones_select" required>
                                    <option value="" disabled selected>Seleccione DNI empleado</option>
                                </select><br>
                            </div>
                            <div class="miniCont"> 
                                <label for="nombreEmpleado">Nombre Empleado:</label>
                                <input type="text" id="nombreEmpleado" name="nombreEmpleado" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont"> 
                                <label for="fechaInventario">Fecha:</label>
                                <input type="date" id="fechaInventario" name="fechaInventario" required><br>
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
                                    <option value="" disabled selected>Seleccione ID almacén</option>
                                </select><br>
                            </div>
                            <div class="miniCont">
                                <label for="nombreAlmacen">Nombre Almacén:</label>
                                <input type="text" id="nombreAlmacen" name="nombreAlmacen" class="no_modificable" required readonly><br>
                            </div>
                        </div>
                    </div>

                    <h1 class="titulosFormEscandallo">Artículos</h1>
                    <div class="contAñadir2 contMateria">
                        <div class="miniCont">   
                            <label for="ideArticulo">Ide Articulos:</label>
                            <select id="ideArticulo" name="ideArticulo[]" class="opciones_select" required>
                                <option value="" disabled selected>Seleccione ID artículo</option>
                            </select>
                        </div>
                        <div class="miniCont">
                            <label for="nom_art">Nombre artículo: </label>
                            <input type="text" id="nom_art" name="nom_art[]" class="no_modificable" required readonly><br>
                        </div>
                        <div class="miniCont">
                            <label for="can_art">Cantidad:</label>
                            <input type="number" id="can_art" name="can_art[]" min="1" required><br>
                        </div>
                    </div>
                    <div class="contAñadir2" id="contAñadirInventario3">
                        <div id="divBotonAñadirArticuloInventario" class="divBotonMateria">
                            <button type="button" id="botonAñadirArticuloInventario" class="botonAñadirArt" name="divBotonAñadirMateriaEscandallo">+ Artículo</button>
                        </div>
                    </div>
                    
                    <div id="divBotonAñadirInventario" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirInventario" class="botonAñadir" name="botonAñadirInventario">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" style="display: none;">
    <div class="forminsercion" id="excepcioninventario">
        <button class="close-btn" id="cerrarFormularioModificarInventario">&times;</button>
        <div id="tituloModificarInventario" class="divTituloModificar">
            <h2 class="tituloModificar">MODIFICAR INVENTARIO</h2>
        </div>
        <div id="contEmp2">
            <form id="formularioModificarInventario" action="Controllers/inventarioModificacion1Controller.php" method="POST">
                <input type="hidden" id="cod_inv_original" name="cod_inv_original">
                <div id="contModificarInventario" class="contDatosForm2">
                    <h1 class="titulosFormEscandallo">DATOS EMPLEADO</h1>
                    <div class="contAñadir2" id="contModificarInventario1">
                        <div class="miniCont">
                            <label for="cod_inv_mod">Código Inventario:</label>
                            <input type="text" id="cod_inv_mod" name="cod_inv"  class="no_modificable" required readonly><br>
                        </div>
                        <div class="miniCont">
                            <label for="dni_emp_mod">DNI Empleado:</label>
                            <select id="dni_emp_mod" name="dni_emp" class="opciones_select" required>
                                <option value="" disabled selected>Seleccione DNI empleado</option>
                            </select><br>
                        </div>
                        <div class="miniCont">
                            <label for="fec_inv_mod">Fecha:</label>
                            <input type="date" id="fec_inv_mod" name="fec_inv" required><br>
                        </div>
                    </div>
                </div>
                <div id="contDatosAlmacen" class="contDatosForm2">
                    <h1 class="titulosFormEscandallo">DATOS ALMACEN</h1>
                    <div class="contAñadir2" id="contModificarAlmacen1">
                        <div class="miniCont">
                            <label for="ide_alm_mod">ID Almacén:</label>
                            <select id="ide_alm_mod" name="ide_alm" class="opciones_select" required>
                                <option value="" disabled selected>Seleccione ID almacén</option>
                            </select><br>
                        </div>
                    </div>
                </div>
                <div id="divBotonModificarInventario" class="divBotonAñadir">
                    <button type="submit" id="botonModificarInventario" class="botonAñadir" name="botonModificarInventario">Guardar</button>
                </div>
                <div id="divRespuestaModificarInventario"></div>
            </form>
        </div>
    </div>
</div>

    <div class="filtros hidden" id="filtrosInventario">
        <div class="encabezadofiltros">
            <h1>Filtros</h1>
            <span class="filtro-close" id="filtroCloseInventario">X</span>
        </div>
        <div class="contenidofiltros">
            <div class="filtro-item">
                <!-- Barra de búsqueda -->
                <div class="busqueda">
                    <label for="buscarCampoInventario">Buscar por:</label>
                    <select id="buscarCampoInventario" name="buscarCampoInventario">
                    <option value="todos">Todos</option>
                        <option value="cod_inv">Código Inventario</option>
                        <option value="ide_alm">ID Almacen</option>
                        <option value="dni_emp">DNI Empleado</option>
                    </select>
                    <input type="text" id="buscarValorInventario" name="buscarValorInventario">
                </div>
            </div>

            <div class="filtro-item">
                <!-- Radiobuttons de ordenación -->
                <div class="ordenacion">
                    <label>Ordenar por:</label>
                    <div class="radio-container">
                        <label for="ordenarCodigoAscInventario">Código Ascendente&nbsp;&nbsp;</label>
                        <input type="radio" id="ordenarCodigoAscInventario" name="ordenarInventario" value="codigo_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarCodigoDescInventario">Código Descendente</label>
                        <input type="radio" id="ordenarCodigoDescInventario" name="ordenarInventario" value="codigo_desc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarFechaAscInventario">Fecha Ascendente&nbsp;&nbsp;</label>
                        <input type="radio" id="ordenarFechaAscInventario" name="ordenarInventario" value="fecha_asc">
                    </div>
                    <div class="radio-container">
                        <label for="ordenarFechaDescInventario">Fecha Descendente</label>
                        <input type="radio" id="ordenarFechaDescInventario" name="ordenarInventario" value="fecha_desc">
                    </div>
                </div>
            </div>

            <button id="aplicarBusquedaInventario" class="aplicarbusqueda">Aplicar búsqueda</button>
            <button class="eliminar-filtros-inventario">Eliminar Filtros</button>
        </div>
    </div>

    <div class="filtro-toggle" id="filtroToggleInventario">
        <span>>></span>
    </div>

    <script>
        document.getElementById('filtroCloseInventario').addEventListener('click', () => {
            document.getElementById('filtrosInventario').classList.add('hidden');
            document.getElementById('filtroToggleInventario').style.display = 'flex';
        });

        document.getElementById('filtroToggleInventario').addEventListener('click', () => {
            document.getElementById('filtrosInventario').classList.remove('hidden');
            document.getElementById('filtroToggleInventario').style.display = 'none';
        });

        async function cargarDNIEmpleados() {
            const response = await fetch('Controllers/empleadosConsulta1Controller.php');
            const empleados = await response.json();
            const selectDNIEmpleado = document.getElementById('dniEmpleado');
            const selectDNIEmpleadoMod = document.getElementById('dni_emp_mod');

            empleados.forEach(empleado => {
                const option = document.createElement('option');
                option.value = empleado.dni_emp;
                option.textContent = empleado.dni_emp;
                selectDNIEmpleado.appendChild(option);

                const optionMod = document.createElement('option');
                optionMod.value = empleado.dni_emp;
                optionMod.textContent = empleado.dni_emp;
                selectDNIEmpleadoMod.appendChild(optionMod);
            });
        }

        async function cargarIDAlmacenes() {
            const response = await fetch('Controllers/almacenesConsulta1Controller.php');
            const almacenes = await response.json();
            const selectIDAlmacen = document.getElementById('codigoAlmacen');
            const selectIDAlmacenMod = document.getElementById('ide_alm_mod');

            almacenes.forEach(almacen => {
                const option = document.createElement('option');
                option.value = almacen.ide_alm;
                option.textContent = almacen.ide_alm;
                selectIDAlmacen.appendChild(option);

                const optionMod = document.createElement('option');
                optionMod.value = almacen.ide_alm;
                optionMod.textContent = almacen.ide_alm;
                selectIDAlmacenMod.appendChild(optionMod);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            cargarDNIEmpleados();
            cargarIDAlmacenes();
        });
    </script>
</body>
</html>