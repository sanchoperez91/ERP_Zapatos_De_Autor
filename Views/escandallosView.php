<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Función para cargar los datos dinámicamente desde el servidor
    async function cargarDatosFormEscandallo() {
        try {
            const response = await fetch("Controllers/escandalloConsulta2Controller.php");
            if (!response.ok) throw new Error("Error en la respuesta del servidor");

            const data = await response.json();
            console.log(data); // Verifica la estructura de los datos

            // Poblamos el select de Artículos
            const selectArticulo = document.getElementById("ideArticulo");

            if (Array.isArray(data.ide_art) && data.ide_art.length > 0) {
                data.ide_art.forEach(({ ide_art, nom_art }) => {
                    const option = document.createElement("option");
                    option.value = ide_art;
                    option.textContent = ide_art; // Usamos el ID de artículo como texto visible
                    option.dataset.nombre = nom_art; // Almacenamos el nombre como atributo de datos
                    selectArticulo.appendChild(option);
                });

                selectArticulo.addEventListener("change", (e) => {
                    const selectedOption = selectArticulo.options[selectArticulo.selectedIndex];
                    document.getElementById("nom_art").value = selectedOption.dataset.nombre || "";
                });
            } else {
                console.error("data.ide_art no es un array válido o está vacío", data.ide_art);
            }

            // Poblamos el select de Materia
            const selectMateria = document.getElementById("ideMateria");

            if (Array.isArray(data.ide_art_mat) && data.ide_art_mat.length > 0) {
                data.ide_art_mat.forEach(({ ide_art, nom_art, imp_art }) => {
                    const option = document.createElement("option");
                    option.value = ide_art;
                    option.textContent = ide_art;
                    option.dataset.nombre = nom_art;
                    option.dataset.impArt = imp_art;
                    selectMateria.appendChild(option);
                });

                selectMateria.addEventListener("change", (e) => {
                    const selectedOption = selectMateria.options[selectMateria.selectedIndex];
                    document.getElementById("nom_mat").value = selectedOption.dataset.nombre || "";
                    document.getElementById("imp_art").value = selectedOption.dataset.impArt || "";
                    calcularImpTot(); // Recalcular el total al cambiar la materia
                });
            } else {
                console.error("data.ide_art_mat no es un array válido o está vacío", data.ide_art_mat);
            }

        } catch (error) {
            console.error("Error al cargar los datos:", error);
        } finally {
            calcularTotEsc(); // Calcular el total al cargar la página
        }
    }

    // Llamamos a la función para cargar los datos al cargar la página
    cargarDatosFormEscandallo();

    // Escucha el clic en el botón "+ Materia" para clonar un nuevo contenedor
    document.getElementById('botonAñadirMateriaEscandallo').addEventListener('click', function (event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del botón
        const original = document.querySelector('.contMateria');

        if (!original) {
            console.error('No se encontró ningún contenedor con la clase .contMateria.');
            return;
        }

        // Clona el contenedor
        const nuevoContenedor = original.cloneNode(true);

        // Limpia los campos del nuevo contenedor
        nuevoContenedor.querySelectorAll('input').forEach(input => {
            if (!input.classList.contains('no_modificable')) {
                input.value = ''; // Limpia los campos editables
            }
        });

        // Asigna los eventos 'change' a los nuevos selects
        const selectMateria = nuevoContenedor.querySelector('#ideMateria');
        if (selectMateria) {
            selectMateria.addEventListener("change", function () {
                const selectedOption = selectMateria.options[selectMateria.selectedIndex];
                nuevoContenedor.querySelector('#nom_mat').value = selectedOption.dataset.nombre || "";
                nuevoContenedor.querySelector('#imp_art').value = selectedOption.dataset.impArt || "";
                calcularImpTot(); // Recalcular el total al cambiar la materia
            });
        }

        // Añadir eventos para recalcular el total cuando cambien los valores de 'can_mat' e 'imp_art'
        const canMatInput = nuevoContenedor.querySelector('#can_mat');
        const impArtInput = nuevoContenedor.querySelector('#imp_art');

        if (canMatInput && impArtInput) {
            canMatInput.addEventListener("input", calcularImpTot);
            impArtInput.addEventListener("input", calcularImpTot);
        }

        // Crea el botón de eliminar (cruz)
        const botonEliminar = document.createElement('button');
        botonEliminar.textContent = 'X'; // Texto de la cruz
        botonEliminar.classList.add('botonEliminar'); // Clase para estilos
        botonEliminar.style.cssText = 'position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; cursor: pointer;';

        // Añade la funcionalidad al botón de eliminar
        botonEliminar.addEventListener('click', function () {
            nuevoContenedor.remove();
            calcularTotEsc(); // Recalcular el total después de eliminar un contenedor
        });

        // Añade el botón de eliminar al nuevo contenedor
        nuevoContenedor.style.position = 'relative'; // Asegura el posicionamiento para el botón
        nuevoContenedor.appendChild(botonEliminar);

        // Inserta el nuevo contenedor antes del contenedor del botón "+ Materia"
        const contenedorBoton = document.getElementById('contAñadirEscandallo3');
        if (!contenedorBoton) {
            console.error('No se encontró el contenedor del botón con el ID contAñadirEscandallo3.');
            return;
        }

        contenedorBoton.parentNode.insertBefore(nuevoContenedor, contenedorBoton);

        // Recalcular el total después de añadir un nuevo contenedor
        calcularTotEsc();
    });

    // CALCULA EL PRECIO TOTAL DEL ESCANDALLO
    const cantidadInput = document.getElementById("cantidad");
    const pphInput = document.getElementById("pph");
    const totalHorasInput = document.getElementById("totalHoras");

    // Función para calcular el total de horas
    function calcularTotalHoras() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const pph = parseFloat(pphInput.value) || 0;
        const totalHoras = cantidad * pph;
        totalHorasInput.value = totalHoras.toFixed(2); // Redondear a 2 decimales
        calcularTotEsc(); // Recalcular el total del escandallo
    }

    // Función para calcular el precio total de la materia
    function calcularImpTot() {
        const contMaterias = document.querySelectorAll('.contMateria');
        let totalMateria = 0;

        contMaterias.forEach(contMateria => {
            const canMatInput = contMateria.querySelector('#can_mat');
            const impArtInput = contMateria.querySelector('#imp_art');
            const impTotInput = contMateria.querySelector('#imp_tot');

            if (canMatInput && impArtInput && impTotInput) {
                const canMat = parseFloat(canMatInput.value) || 0;
                const impArt = parseFloat(impArtInput.value) || 0;
                const impTot = canMat * impArt;
                impTotInput.value = impTot.toFixed(2); // Redondear a 2 decimales
                totalMateria += impTot;
            }
        });

        calcularTotEsc(); // Recalcular el total del escandallo
    }

    // Función para calcular el total del escandallo
    function calcularTotEsc() {
        const totalHoras = parseFloat(totalHorasInput.value) || 0;
        let totalMateria = 0;

        // Sumar los valores de 'imp_tot' de todos los contenedores de materia
        document.querySelectorAll('.contMateria').forEach(contMateria => {
            const impTotInput = contMateria.querySelector('#imp_tot');
            if (impTotInput) {
                totalMateria += parseFloat(impTotInput.value) || 0;
            }
        });

        const totEscInput = document.getElementById("tot_esc");
        const totEsc = totalHoras + totalMateria;
        totEscInput.value = totEsc.toFixed(2); // Redondear a 2 decimales
    }

    // Escucha cambios en los inputs para `totalHoras`
    cantidadInput.addEventListener("input", calcularTotalHoras);
    pphInput.addEventListener("input", calcularTotalHoras);

    // Escucha cambios en los inputs para `imp_tot`
    document.querySelectorAll('.contMateria').forEach(contMateria => {
        const canMatInput = contMateria.querySelector('#can_mat');
        const impArtInput = contMateria.querySelector('#imp_art');

        if (canMatInput && impArtInput) {
            canMatInput.addEventListener("input", calcularImpTot);
            impArtInput.addEventListener("input", calcularImpTot);
        }
    });
});
</script>
</head>
<body>
    <div class="contenedorbotones2">
        <button id="listadoescandallos" class="crud">Listado</button>
        <button id="añadirescandallos" class="crud">Añadir</button>
        <button id="modificarescandallos" class="crud">Modificar</button>
        <button id="eliminarescandallos" class="crud">Eliminar</button>
    </div>

    <div id="overlay" style="display: none;">
        <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirEscandallo" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR ESCANDALLO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioEscandallo" action="#" method="POST">
                    <div id="contDatosEscandallo" class="contDatosForm2">
                        <h1 class="titulosFormEscandallo">Datos Escandallo</h1>
                        <div class="contAñadir2" id="contAñadirEscandallo1">
                            <div class="miniCont">
                                <label for="tipoEscandallo">Tipo Escandallo:</label>
                                <select id="tipoEscandallo" name="tipoEscandallo" class="opciones_select" required>
                                    <option value="" disabled selected>Selecciona un tipo</option>
                                    <option value="comun">Comun</option>
                                    <option value="personalizado">Personalizado</option>
                                </select><br>
                            </div>
                            <div class="miniCont">
                                <label for="nombre">Nombre Escandallo:</label>
                                <input type="text" id="nombreEscandallo" name="nombreEscandallo" required><br>
                            </div>
                            <div class="miniCont">
                                <label for="ideArticulo">Ide Articulo:</label>
                                <select id="ideArticulo" name="ideArticulo" class="opciones_select" required>
                                    <option value="" disabled selected>Selecciona el ID del producto</option>
                                </select>
                            </div>
                            <div class="miniCont">
                                <label for="nom_art">Nombre articulo: </label>
                                <input type="text" id="nom_art" name="nom_art[]" class="no_modificable" required readonly><br>
                            </div>
                        </div>
                        <h1 class="titulosFormEscandallo">Mano de Obra</h1>
                        <div class="contAñadir2" id="contAñadirEscandallo1">
                            <div class="miniCont">
                                <label for="cantidad">Horas de mano de obra:</label>
                                <input type="number" id="cantidad" name="cantidad" min="1" required><br>
                            </div>
                            <div class="miniCont">
                                <label for="pph">Precio por hora:</label>
                                <input type="double" id="pph" name="pph" required><br>
                            </div>
                            <div class="miniCont">
                                <label for="totalHoras">Precio total mano de obra:</label>
                                <input type="double" id="totalHoras" name="totalHoras" class="no_modificable" required readonly><br>
                            </div>
                        </div>

                        <h1 class="titulosFormEscandallo">Materia</h1>
                        <div class="contAñadir2 contMateria">
                            <div class="miniCont">
                                <label for="ideMateria">Ide Materia:</label>
                                <select id="ideMateria" name="ideMateria[]" class="opciones_select" required>
                                    <option value="" disabled selected>Selecciona el ID de la materia</option>
                                </select>
                            </div>
                            <div class="miniCont">
                                <label for="nom_mat">Nombre materia: </label>
                                <input type="text" id="nom_mat" name="nom_mat[]" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont">
                                <label for="can_mat">Cantidad:</label>
                                <input type="number" id="can_mat" name="can_mat[]" min="1" required><br>
                            </div>
                            <div class="miniCont">
                                <label for="imp_art">Precio unitario: </label>
                                <input type="text" id="imp_art" name="imp_art[]" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont">
                                <label for="imp_tot">Precio total: </label>
                                <input type="text" id="imp_tot" name="imp_tot[]" class="no_modificable" required readonly><br>
                            </div>
                        </div>
                        <div class="contAñadir2" id="contAñadirEscandallo3">
                            <div id="divBotonAñadirMateriaEscandallo" class="divBotonMateria">
                                <button type="button" id="botonAñadirMateriaEscandallo" class="botonAñadirMat" name="divBotonAñadirMateriaEscandallo">+ Materia</button>
                            </div>
                        </div>
                        <div class="miniCont2">
                            <label for="tot_esc" class="tot_esc">Precio total escandallo: </label>
                            <input type="double" id="tot_esc" name="tot_esc" class="no_modificable2" required readonly><br>
                        </div>
                        <div id="divBotonAñadirEscandallo" class="divBotonAñadir">
                            <button type="submit" id="botonAñadirEscandallo" class="botonAñadir" name="botonAñadirEscandallo">Guardar</button>
                        </div>
                        <div id="divRespuesta"> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay2" class="overlay2" style="display: none;">
    <div class="formmodificar">
        <button class="close-btn" id="cerrarFormularioModificarEscandallo">&times;</button>
        <div id="tituloModificarEscandallo" class="divTituloModificar">
            <h2 class="tituloModificar">MODIFICAR ESCANDALLO</h2>
        </div>
        <div id="contEmp2">
            <form id="formularioModificarEscandallo" action="Controllers/escandalloModificacion1Controller.php" method="POST">
                <input type="hidden" id="ide_esc_original" name="ide_esc_original" required readonly class="no_modificable">
                <div id="contDatosEscandallo" class="contDatosForm1">
                    <div class="contModificar1" id="contModificarEscandallo1">
                        <label for="ide_esc_mod">IDE Escandallo:</label>
                        <input type="text" id="ide_esc_mod" name="ide_esc" required readonly class="no_modificable"><br>

                        <label for="nom_esc_mod">Nombre Escandallo:</label>
                        <input type="text" id="nom_esc_mod" name="nom_esc" required><br>

                        <label for="tie_esc_mod">Tiempo:</label>
                        <input type="text" id="tie_esc_mod" name="tie_esc" required><br>

                        <label for="cos_esc_mod">Coste:</label>
                        <input type="text" id="cos_esc_mod" name="cos_esc" required><br>

                        <label for="tip_esc_mod">Tipo:</label>
                        <select id="tip_esc_mod" name="tip_esc" required>
                            <option value="" disabled selected>Selecciona un tipo</option>
                            <option value="comun">Comun</option>
                            <option value="personalizado">Personalizado</option>
                        </select><br>
                    </div>
                </div>
                <div id="divbotonModificarEscandallo" class="divBotonModificar">
                    <button type="submit" id="botonModificarEscandallo" class="botonModificar" name="botonModificarEscandallo">Guardar</button>
                </div>
                <div id="divRespuestaModificarEscandallo"> </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>