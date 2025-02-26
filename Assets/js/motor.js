// Función para desactivar un botón
function disabledButton(control1) {
    control1.disabled = true;
}

// Función para activar un botón
function enableButton(control1) {
    control1.disabled = false;
}

// Creación de bloques HTML de respuesta
function createResponseBlock(item) {
    const bloque0 = document.createElement("div");
    bloque0.classList.add("bloque0");

    // COMENTARIO: Cambio de campos para los clientes, empleados y artículos. Se han añadido campos de artículos.
    const fields = [
        "ide_des", "uds_des",
        "ide_din", "can_din", // DETALLE INVENTARIO AÑADIDOS
        "ide_dve", "imp_dve", "can_dve", // DETALLE VENTA AÑADIDOS
        "ide_dco", "imp_dco", "can_dco", // DETALLE COMPRA AÑADIDOS
        "num_com", "fac_com", "fec_com", "tot_com", // FACTUR COMPRA AÑADIDOS
        "num_ven", "fec_ven", "tot_ven", // FACTUR VENTA AÑADIDOS
        "cod_inv", "fec_inv", // INVENTARIO AÑADIDOS
        "nif_pro", "nom_pro", "dir_pro", "tlf_pro", "ema_pro", "dto_pro", // PROVEEDORES AÑADIDOS
        "dni_cli", "nom_cli", "dir_cli", "tlf_cli", "ema_cli", "dto_cli", // CLIENTES AÑADIDOS

        "ide_pdc", "fec_pdc", "can_pdc", // PRODUCCION AÑADIDOS
        "ide_esc", "nom_esc", "tie_esc", "cos_esc", "tip_esc", //ESCANDALLO AÑADIDOS
        "ide_alm", "nom_alm", "ubi_alm", //ALMACENES AÑADIDOS
        "dni_emp", "nom_emp", "dir_emp", "tlf_emp", "ema_emp", "pue_emp", // EMPLEADOS AÑADIDOS
        "ide_art", "nom_art", "tip_art", "imp_art", "sto_art" //ARTICULOS AÑADIDOS
    ];



    fields.forEach(field => {
        if (item[field] !== undefined) {
            const div = document.createElement("div");
            div.classList.add("bloque1");
            div.textContent = item[field]; // Directamente el valor del campo

            bloque0.appendChild(div);
        }
    });

    return bloque0;
}

function createResponseBlockWithLink(item, linkKey, baseUrl, urlParam) {
    const bloque0 = document.createElement("div");
    bloque0.classList.add("bloque0");

    const fields = [
        "ide_des", "uds_des",
        "ide_din", "can_din", // DETALLE INVENTARIO AÑADIDOS
        "ide_dve", "imp_dve", "can_dve", // DETALLE VENTA AÑADIDOS
        "ide_dco", "imp_dco", "can_dco", // DETALLE COMPRA AÑADIDOS
        "num_com", "fac_com", "fec_com", "tot_com", // FACTUR COMPRA AÑADIDOS
        "num_ven", "fec_ven", "tot_ven", // FACTUR VENTA AÑADIDOS
        "cod_inv", "fec_inv", // INVENTARIO AÑADIDOS
        "nif_pro", "nom_pro", "dir_pro", "tlf_pro", "ema_pro", "dto_pro", // PROVEEDORES AÑADIDOS
        "dni_cli", "nom_cli", "dir_cli", "tlf_cli", "ema_cli", "dto_cli", // CLIENTES AÑADIDOS

        "ide_pdc", "fec_pdc", "can_pdc", // PRODUCCION AÑADIDOS
        "ide_esc", "nom_esc", "tie_esc", "cos_esc", "tip_esc", //ESCANDALLO AÑADIDOS
        "ide_alm", "nom_alm", "ubi_alm", //ALMACENES AÑADIDOS
        "dni_emp", "nom_emp", "dir_emp", "tlf_emp", "ema_emp", "pue_emp", // EMPLEADOS AÑADIDOS
        "ide_art", "nom_art", "tip_art", "imp_art", "sto_art" //ARTICULOS AÑADIDOS

    ];


    fields.forEach(field => {
        if (item[field] !== undefined) {
            const div = document.createElement("div");
            div.classList.add("bloque1");

            if (field === linkKey) {
                // Si el campo es el que debe ser un enlace, creamos un <a>
                const link = document.createElement("a");
                link.href = `${baseUrl}?${urlParam}=${item[field]}`; // URL dinámica
                link.textContent = item[field];
                link.classList.add("bot-detalle");
                div.appendChild(link);
            } else {
                // Si no, simplemente mostramos el valor del campo
                div.textContent = item[field];
            }

            bloque0.appendChild(div);
        }
    });

    return bloque0;
}

// Función para realizar peticiones fetch
async function makeFetchFormRequest(method, url, form) {
    const formData1 = new FormData(form);

    try {
        console.log("FORMULARIO: ", form);
        console.log("method: " + method);
        console.log("URL: " + url);

        const response = await fetch(url, {
            method: method,
            body: formData1,
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        throw new Error(`Captura del error: ${error.message}`);
    }
}


// Proveedores
async function fetchProveedoresConsulta(filtroNombre = '', ordenarPor = '', buscarCampoProveedores = 'todos', buscarValorProveedores = '') {
    const controllerUrl = "Controllers/proveedoresConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroNombre, ordenarPor, buscarCampoProveedores, buscarValorProveedores })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                nif_pro: "NIF",
                nom_pro: "Nombre",
                dir_pro: "Direccion",
                tlf_pro: "Telefono",
                ema_pro: "Email",
                dto_pro: "Descuento"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.nif = item.nif_pro; // Añadir el NIF como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'proveedores-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaProveedor(item.nif_pro, item.nom_pro, item.dir_pro, item.tlf_pro, item.ema_pro, item.dto_pro);
                });

                // Crear el botón de lápiz
                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️'; // Icono de lápiz
                modificarBtn.classList.add('modificar-btn', 'proveedores-modificar-btn');
                modificarBtn.style.display = 'none'; // Ocultar por defecto
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificar(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS PROVEEDORES

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaProveedores').addEventListener('click', () => {
        const buscarValorProveedores = document.getElementById('buscarValorProveedores').value;
        const buscarCampoProveedores = document.getElementById('buscarCampoProveedores').value;
        const ordenarRadioProveedores = document.querySelector('input[name="ordenarProveedores"]:checked');
        const ordenarPorProveedores = ordenarRadioProveedores ? ordenarRadioProveedores.value : '';
        fetchProveedoresConsulta('', ordenarPorProveedores, buscarCampoProveedores, buscarValorProveedores);
    });

    document.querySelector('.eliminar-filtros-proveedores').addEventListener('click', () => {
        document.querySelectorAll('input[name="ordenarProveedores"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoProveedores').value = 'todos';
        document.getElementById('buscarValorProveedores').value = '';
        fetchProveedoresConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseProveedores').addEventListener('click', () => {
        document.getElementById('filtrosProveedores').classList.add('hidden');
        document.getElementById('filtroToggleProveedores').style.display = 'flex';
    });

    document.getElementById('filtroToggleProveedores').addEventListener('click', () => {
        document.getElementById('filtrosProveedores').classList.remove('hidden');
        document.getElementById('filtroToggleProveedores').style.display = 'none';
    });
});



// Clientes
async function fetchClientesConsulta(filtroNombre = '', ordenarPor = '', buscarCampoClientes = 'todos', buscarValorClientes = '') {
    const controllerUrl = "Controllers/clientesConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroNombre, ordenarPor, buscarCampoClientes, buscarValorClientes })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                dni_cli: "DNI",
                nom_cli: "Nombre",
                dir_cli: "Direccion",
                tlf_cli: "Telefono",
                ema_cli: "Email",
                dto_cli: "Descuento"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.dni = item.dni_cli; // Añadir el DNI como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'clientes-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaCliente(item.dni_cli);
                });

                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️'; // Icono de lápiz
                modificarBtn.classList.add('modificar-btn', 'clientes-modificar-btn');
                modificarBtn.style.display = 'none'; // Ocultar por defecto
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificarCliente(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS CLIENTES

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaClientes').addEventListener('click', () => {
        const buscarValorClientes = document.getElementById('buscarValorClientes').value;
        const buscarCampoClientes = document.getElementById('buscarCampoClientes').value;
        const ordenarRadioClientes = document.querySelector('input[name="ordenarClientes"]:checked');
        const ordenarPorClientes = ordenarRadioClientes ? ordenarRadioClientes.value : '';
        fetchClientesConsulta('', ordenarPorClientes, buscarCampoClientes, buscarValorClientes);
    });

    document.querySelector('.eliminar-filtros-clientes').addEventListener('click', () => {
        document.querySelectorAll('input[name="ordenarClientes"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoClientes').value = 'todos';
        document.getElementById('buscarValorClientes').value = '';
        fetchClientesConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseClientes').addEventListener('click', () => {
        document.getElementById('filtrosClientes').classList.add('hidden');
        document.getElementById('filtroToggleClientes').style.display = 'flex';
    });

    document.getElementById('filtroToggleClientes').addEventListener('click', () => {
        document.getElementById('filtrosClientes').classList.remove('hidden');
        document.getElementById('filtroToggleClientes').style.display = 'none';
    });
});

// Empleados
async function fetchEmpleadosConsulta(filtroNombre = '', ordenarPor = '', buscarCampoEmpleados = 'todos', buscarValorEmpleados = '') {
    const controllerUrl = "Controllers/empleadosConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroNombre, ordenarPor, buscarCampoEmpleados, buscarValorEmpleados })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                dni_emp: "DNI",
                nom_emp: "Nombre",
                dir_emp: "Direccion",
                tlf_emp: "Telefono",
                ema_emp: "Email",
                pue_emp: "Puesto"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.dni = item.dni_emp; // Añadir el DNI como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'empleados-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaEmpleado(item.dni_emp);
                });

                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️'; // Icono de lápiz
                modificarBtn.classList.add('modificar-btn', 'empleados-modificar-btn');
                modificarBtn.style.display = 'none'; // Ocultar por defecto
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificarEmpleado(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS EMPLEADOS

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaEmpleados').addEventListener('click', () => {
        const buscarValorEmpleados = document.getElementById('buscarValorEmpleados').value;
        const buscarCampoEmpleados = document.getElementById('buscarCampoEmpleados').value;
        const ordenarRadioEmpleados = document.querySelector('input[name="ordenarEmpleados"]:checked');
        const ordenarPorEmpleados = ordenarRadioEmpleados ? ordenarRadioEmpleados.value : '';
        fetchEmpleadosConsulta('', ordenarPorEmpleados, buscarCampoEmpleados, buscarValorEmpleados);
    });

    document.querySelector('.eliminar-filtros-empleados').addEventListener('click', () => {
        document.querySelectorAll('input[name="ordenarEmpleados"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoEmpleados').value = 'todos';
        document.getElementById('buscarValorEmpleados').value = '';
        fetchEmpleadosConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseEmpleados').addEventListener('click', () => {
        document.getElementById('filtrosEmpleados').classList.add('hidden');
        document.getElementById('filtroToggleEmpleados').style.display = 'flex';
    });

    document.getElementById('filtroToggleEmpleados').addEventListener('click', () => {
        document.getElementById('filtrosEmpleados').classList.remove('hidden');
        document.getElementById('filtroToggleEmpleados').style.display = 'none';
    });
});

// Artículos
async function fetchArticulosConsulta(filtroStockArticulos = '', filtroTipoArticulos = '', ordenarPorArticulos = '', buscarCampoArticulos = 'todos', buscarValorArticulos = '') {
    const controllerUrl = "Controllers/articulosConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    if (!divResponse) {
        console.error("Error: Elemento con ID 'contenedor2' no encontrado.");
        return;
    }

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroStockArticulos, filtroTipoArticulos, ordenarPorArticulos, buscarCampoArticulos, buscarValorArticulos })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }

        const textResponse = await response.text(); // Obtener la respuesta como texto primero
        console.log("Respuesta del servidor: ", textResponse); // Ver lo que devuelve el servidor

        let dataConsulta;
        try {
            dataConsulta = JSON.parse(textResponse); // Intentar parsear como JSON
        } catch (jsonError) {
            throw new Error('Error al parsear la respuesta JSON');
        }

        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_art: "ID",
                nom_art: "Nombre",
                tip_art: "Tipo",
                imp_art: "Precio",
                sto_art: "Stock"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.ide = item.ide_art; // Añadir el ID como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'articulos-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaArticulo(item.ide_art);
                });

                // Crear el botón de lápiz
                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️'; // Icono de lápiz
                modificarBtn.classList.add('modificar-btn', 'articulos-modificar-btn');
                modificarBtn.style.display = 'none'; // Ocultar por defecto
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificarArticulo(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS ARTÍCULOS

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaArticulos').addEventListener('click', () => {
        const buscarValorArticulos = document.getElementById('buscarValorArticulos').value;
        const buscarCampoArticulos = document.getElementById('buscarCampoArticulos').value;
        const filtroStockArticulos = document.querySelector('input[name="filtro-stock-articulos"]:checked');
        const filtroTipoArticulos = document.querySelector('input[name="filtro-tipo-articulos"]:checked');
        const ordenarRadioArticulos = document.querySelector('input[name="filtro-ordenar-articulos"]:checked');
        const filtroStock = filtroStockArticulos ? filtroStockArticulos.value : '';
        const filtroTipo = filtroTipoArticulos ? filtroTipoArticulos.value : '';
        const ordenarPorArticulos = ordenarRadioArticulos ? ordenarRadioArticulos.value : '';
        fetchArticulosConsulta(filtroStock, filtroTipo, ordenarPorArticulos, buscarCampoArticulos, buscarValorArticulos);
    });

    document.querySelector('.eliminar-filtros-articulos').addEventListener('click', () => {
        document.querySelectorAll('input[name="filtro-stock-articulos"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-tipo-articulos"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-ordenar-articulos"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoArticulos').value = 'todos';
        document.getElementById('buscarValorArticulos').value = '';
        fetchArticulosConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseArticulos').addEventListener('click', () => {
        document.getElementById('filtrosArticulos').classList.add('hidden');
        document.getElementById('filtroToggleArticulos').style.display = 'flex';
    });

    document.getElementById('filtroToggleArticulos').addEventListener('click', () => {
        document.getElementById('filtrosArticulos').classList.remove('hidden');
        document.getElementById('filtroToggleArticulos').style.display = 'none';
    });
});


// Almacenes
async function fetchAlmacenesConsulta(filtroID = '', filtroNombre = '', buscarCampoAlmacenes = 'todos', buscarValorAlmacenes = '') {
    const controllerUrl = "Controllers/almacenesConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    if (!divResponse) {
        console.error("Error: Elemento con ID 'contenedor2' no encontrado.");
        return;
    }

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroID, filtroNombre, buscarCampoAlmacenes, buscarValorAlmacenes })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_alm: "ID",
                nom_alm: "Nombre",
                ubi_alm: "Ubicación"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.ide = item.ide_alm; // Añadir el IDE como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'almacenes-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaAlmacen(item.ide_alm);
                });

                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️'; // Icono de lápiz
                modificarBtn.classList.add('modificar-btn', 'almacenes-modificar-btn');
                modificarBtn.style.display = 'none'; // Ocultar por defecto
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificarAlmacen(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS ALMACENES
document.addEventListener('DOMContentLoaded', () => {
    const filtroRadios = document.querySelectorAll('input[name="ordenarAlmacenes"]');

    filtroRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            filtroRadios.forEach(otherRadio => {
                if (otherRadio !== radio) {
                    otherRadio.checked = false;
                }
            });
        });
    });

    document.getElementById('aplicarBusquedaAlmacenes').addEventListener('click', () => {
        const filtroSeleccionado = document.querySelector('input[name="ordenarAlmacenes"]:checked');
        const filtroValor = filtroSeleccionado ? filtroSeleccionado.value : '';
        const buscarCampoAlmacenes = document.getElementById('buscarCampoAlmacenes').value;
        const buscarValorAlmacenes = document.getElementById('buscarValorAlmacenes').value;

        let filtroID = '';
        let filtroNombre = '';

        if (filtroValor.includes('id')) {
            filtroID = filtroValor;
        } else if (filtroValor.includes('nombre')) {
            filtroNombre = filtroValor;
        }

        fetchAlmacenesConsulta(filtroID, filtroNombre, buscarCampoAlmacenes, buscarValorAlmacenes);
    });

    document.querySelector('.eliminar-filtros-almacenes').addEventListener('click', () => {
        filtroRadios.forEach(el => el.checked = false);
        document.getElementById('buscarCampoAlmacenes').value = 'todos';
        document.getElementById('buscarValorAlmacenes').value = '';
        fetchAlmacenesConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseAlmacenes').addEventListener('click', () => {
        document.getElementById('filtrosAlmacenes').classList.add('hidden');
        document.getElementById('filtroToggleAlmacenes').style.display = 'flex';
    });

    document.getElementById('filtroToggleAlmacenes').addEventListener('click', () => {
        document.getElementById('filtrosAlmacenes').classList.remove('hidden');
        document.getElementById('filtroToggleAlmacenes').style.display = 'none';
    });
});



// Producción
async function fetchProduccionConsulta(filtroID = '', filtroFecha = '', buscarCampoProduccion = 'todos', buscarValorProduccion = '') {
    const controllerUrl = "Controllers/produccionConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroID, filtroFecha, buscarCampoProduccion, buscarValorProduccion })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.status === "error") {
            throw new Error(dataConsulta.message);
        }

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_pdc: "ID",
                fec_pdc: "Fecha",
                can_pdc: "Cantidad",
                ide_alm: "ID Almacen",
                ide_esc: "ID Escandallo",
                dni_emp: "DNI Empleado"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.id = item.ide_pdc; // Añadir el ID como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'produccion-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaProduccion(item.ide_pdc, item.fec_pdc, item.can_pdc, item.ide_alm, item.ide_esc, item.dni_emp);
                });

                // Crear el botón de lápiz
                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️'; // Icono de lápiz
                modificarBtn.classList.add('modificar-btn', 'produccion-modificar-btn');
                modificarBtn.style.display = 'none'; // Ocultar por defecto
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificarProduccion(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS PRODUCCION
document.addEventListener('DOMContentLoaded', () => {
    const filtroRadios = document.querySelectorAll('input[name="ordenarProduccion"], input[name="ordenarFechaProduccion"]');

    filtroRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            filtroRadios.forEach(otherRadio => {
                if (otherRadio !== radio) {
                    otherRadio.checked = false;
                }
            });
        });
    });

    document.getElementById('aplicarBusquedaProduccion').addEventListener('click', () => {
        const filtroID = document.querySelector('input[name="ordenarProduccion"]:checked');
        const idPorProduccion = filtroID ? filtroID.value : '';
        const filtroFecha = document.querySelector('input[name="ordenarFechaProduccion"]:checked');
        const fechaPorProduccion = filtroFecha ? filtroFecha.value : '';
        const buscarCampoProduccion = document.getElementById('buscarCampoProduccion').value;
        const buscarValorProduccion = document.getElementById('buscarValorProduccion').value;
        fetchProduccionConsulta(idPorProduccion, fechaPorProduccion, buscarCampoProduccion, buscarValorProduccion);
    });

    document.querySelector('.eliminar-filtros-produccion').addEventListener('click', () => {
        filtroRadios.forEach(el => el.checked   = false);
        document.getElementById('buscarCampoProduccion').value = 'todos';
        document.getElementById('buscarValorProduccion').value = '';
        fetchProduccionConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseProduccion').addEventListener('click', () => {
        document.getElementById('filtrosProduccion').classList.add('hidden');
        document.getElementById('filtroToggleProduccion').style.display = 'flex';
    });

    document.getElementById('filtroToggleProduccion').addEventListener('click', () => {
        document.getElementById('filtrosProduccion').classList.remove('hidden');
        document.getElementById('filtroToggleProduccion').style.display = 'none';
    });
});



// CONSULTA INVENTARIO
async function fetchInventarioConsulta(filtroFecha = '', filtroCodigo = '', buscarCampoInventario = 'todos', buscarValorInventario = '') {
    const controllerUrl = "Controllers/inventarioConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroFecha, filtroCodigo, buscarCampoInventario, buscarValorInventario })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlockWithLink({
                cod_inv: "Código",
                fec_inv: "Fecha",
                dni_emp: "DNI Empleado",
                ide_alm: "ID Almacén"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlockWithLink(item, 'cod_inv', 'detInv.php', 'cod_inv');
                row.dataset.cod_inv = item.cod_inv;
            
                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'inventario-eliminar-btn');
                eliminarBtn.style.display = 'none';
                eliminarBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    eliminarFilaInventario(item.cod_inv, item.fec_inv, item.dni_emp, item.ide_alm);
                });
            
                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️';
                modificarBtn.classList.add('modificar-btn', 'inventario-modificar-btn');
                modificarBtn.style.display = 'none';
                modificarBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    mostrarFormularioModificarInventario(item);
                });
            
                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS INVENTARIO
document.addEventListener('DOMContentLoaded', () => {
    const filtroRadios = document.querySelectorAll('input[name="ordenarInventario"]');

    filtroRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            filtroRadios.forEach(otherRadio => {
                if (otherRadio !== radio) {
                    otherRadio.checked = false;
                }
            });
        });
    });

    document.getElementById('aplicarBusquedaInventario').addEventListener('click', () => {
        const filtroSeleccionado = document.querySelector('input[name="ordenarInventario"]:checked');
        const filtroValor = filtroSeleccionado ? filtroSeleccionado.value : '';
        const buscarCampoInventario = document.getElementById('buscarCampoInventario').value;
        const buscarValorInventario = document.getElementById('buscarValorInventario').value;

        let filtroFecha = '';
        let filtroCodigo = '';

        if (filtroValor.includes('fecha')) {
            filtroFecha = filtroValor;
        } else if (filtroValor.includes('codigo')) {
            filtroCodigo = filtroValor;
        }

        fetchInventarioConsulta(filtroFecha, filtroCodigo, buscarCampoInventario, buscarValorInventario);
    });

    document.querySelector('.eliminar-filtros-inventario').addEventListener('click', () => {
        filtroRadios.forEach(el => el.checked = false);
        document.getElementById('buscarCampoInventario').value = 'todos';
        document.getElementById('buscarValorInventario').value = '';
        fetchInventarioConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseInventario').addEventListener('click', () => {
        document.getElementById('filtrosInventario').classList.add('hidden');
        document.getElementById('filtroToggleInventario').style.display = 'flex';
    });

    document.getElementById('filtroToggleInventario').addEventListener('click', () => {
        document.getElementById('filtrosInventario').classList.remove('hidden');
        document.getElementById('filtroToggleInventario').style.display = 'none';
    });
});


// ESCANDALLO CONSULTA
async function fetchEscandalloConsulta(filtroOrdenar = '', filtroTiempo = '', filtroCoste = '', filtroTipo = '', buscarCampoEscandallo = 'todos', buscarValorEscandallo = '') {
    const controllerUrl = "Controllers/escandalloConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroOrdenar, filtroTiempo, filtroCoste, filtroTipo, buscarCampoEscandallo, buscarValorEscandallo })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_esc: "ID Escandallo",
                nom_esc: "Nombre Escandallo",
                tie_esc: "Tiempo",
                cos_esc: "Coste",
                tip_esc: "Tipo",
                ide_art: "ID Articulo",
                nom_art: "Nombre Articulo",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlockWithLink(item,
                    'ide_esc', // Campo que será un enlace
                    'escDet.php', // URL base
                    'ide_esc' // Parámetro de la URL
                );
                row.dataset.ide_esc = item.ide_esc;

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'escandallo-eliminar-btn');
                eliminarBtn.style.display = 'none';
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaEscandallo(item.ide_esc);
                });

                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️';
                modificarBtn.classList.add('modificar-btn', 'escandallo-modificar-btn');
                modificarBtn.style.display = 'none';
                modificarBtn.addEventListener('click', function() {
                    mostrarFormularioModificarEscandallo(item);
                });

                const producirBtn = document.createElement('button');
                producirBtn.textContent = 'Producir';
                producirBtn.classList.add('producir-btn');
                producirBtn.addEventListener('click', function() {
                    mostrarFormularioProduccionEP(item.ide_esc);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                row.insertBefore(producirBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// Función para mostrar el formulario de producción
function mostrarFormularioProduccionEP(ide_esc) {
    const formHtml = `
        <div id="produccionFormEP" class="modalEP">
            <div class="modal-contentEP">
                <span class="closeEP">&times;</span>
                <h2>Producción</h2>
                <label for="cantidadProduccionEP">Cantidad:</label>
                <input type="number" id="cantidadProduccionEP" name="cantidadProduccionEP">
                <label for="almacenProduccionEP">Almacén:</label>
                <select id="almacenProduccionEP" name="almacenProduccionEP">
                    <!-- Opciones de almacenes se llenarán dinámicamente -->
                </select>
                <label for="empleadoProduccionEP">Empleado:</label>
                <select id="empleadoProduccionEP" name="empleadoProduccionEP">
                    <!-- Opciones de empleados se llenarán dinámicamente -->
                </select>
                <div id="respuestaProduccionEP" class="respuestaEP"></div>
                <button id="guardarProduccionEP">Guardar</button>
                <button id="cancelarProduccionEP">Cancelar</button>
            </div>
        </div>
    `;

    const modalContainer = document.createElement('div');
    modalContainer.innerHTML = formHtml;
    document.body.appendChild(modalContainer);

    // Llenar el select de empleados y almacenes
    fetchEmpleadosEP();
    fetchAlmacenesEP();

    document.getElementById("guardarProduccionEP").addEventListener('click', function() {
        guardarProduccionEP(ide_esc);
    });

    document.getElementById("cancelarProduccionEP").addEventListener('click', function() {
        closeModalEP();
    });

    document.querySelector('.closeEP').addEventListener('click', function() {
        closeModalEP();
    });

    // Mostrar el modal
    document.getElementById("produccionFormEP").style.display = "block";
}

// Función para cerrar el modal
function closeModalEP() {
    const modal = document.getElementById("produccionFormEP");
    if (modal) {
        modal.style.display = "none";
        modal.remove();
    }
}

// Función para llenar el select de empleados
async function fetchEmpleadosEP() {
    const controllerUrl = "Controllers/empleadosConsulta1Controller.php";
    const empleadoSelect = document.getElementById("empleadoProduccionEP");

    try {
        const response = await fetch(controllerUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const empleados = await response.json();

        empleados.forEach(empleado => {
            const option = document.createElement('option');
            option.value = empleado.dni_emp;
            option.textContent = `${empleado.nom_emp} (${empleado.dni_emp})`;
            empleadoSelect.appendChild(option);
        });
    } catch (error) {
        console.error("Error al obtener los empleados:", error.message);
    }
}

// Función para llenar el select de almacenes
async function fetchAlmacenesEP() {
    const controllerUrl = "Controllers/almacenesConsulta1Controller.php";
    const almacenSelect = document.getElementById("almacenProduccionEP");

    try {
        const response = await fetch(controllerUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const almacenes = await response.json();

        almacenes.forEach(almacen => {
            const option = document.createElement('option');
            option.value = almacen.ide_alm;
            option.textContent = `${almacen.nom_alm} (${almacen.ide_alm})`;
            almacenSelect.appendChild(option);
        });
    } catch (error) {
        console.error("Error al obtener los almacenes:", error.message);
    }
}

// Función para guardar la producción
async function guardarProduccionEP(ide_esc) {
    const cantidadProduccion = document.getElementById("cantidadProduccionEP").value;
    const empleadoProduccion = document.getElementById("empleadoProduccionEP").value;
    const almacenProduccion = document.getElementById("almacenProduccionEP").value;
    const respuestaDiv = document.getElementById("respuestaProduccionEP");

    if (!cantidadProduccion || !empleadoProduccion || !almacenProduccion) {
        respuestaDiv.textContent = 'Todos los campos son obligatorios.';
        respuestaDiv.style.color = 'red';
        return;
    }

    try {
        // Sumar el artículo terminado
        const responseTerminado = await fetch('Controllers/5produccionEscandalloTerminadoController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cantidadProduccion,
                ide_esc
            })
        });

        if (!responseTerminado.ok) {
            throw new Error(`Error de red: ${responseTerminado.statusText}`);
        }
        const resultTerminado = await responseTerminado.json();
        if (resultTerminado.status !== 'success') {
            throw new Error('Error al sumar el artículo terminado: ' + resultTerminado.message);
        }

        // Restar los artículos materia
        const responseMateria = await fetch('Controllers/5produccionEscandalloMateriaController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cantidadProduccion,
                ide_esc
            })
        });

        if (!responseMateria.ok) {
            throw new Error(`Error de red: ${responseMateria.statusText}`);
        }
        const resultMateria = await responseMateria.json();
        if (resultMateria.status !== 'success') {
            throw new Error('Error al restar los artículos materia: ' + resultMateria.message);
        }

        // Insertar una nueva fila en la tabla de producción
        const responseProduccion = await fetch('Controllers/5produccionEscandalloController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cantidadProduccion,
                ide_esc,
                empleadoProduccion,
                almacenProduccion
            })
        });

        if (!responseProduccion.ok) {
            throw new Error(`Error de red: ${responseProduccion.statusText}`);
        }
        const resultProduccion = await responseProduccion.json();
        if (resultProduccion.status === 'success') {
            respuestaDiv.textContent = 'Producción guardada exitosamente.';
            respuestaDiv.style.color = 'green';
            setTimeout(() => {
                closeModalEP();
                fetchEscandalloConsulta(); // Volver a la vista de escandallos
            }, 2000);
        } else {
            throw new Error('Error al guardar la producción: ' + resultProduccion.message);
        }
    } catch (error) {
        console.error("Error al guardar la producción:", error.message);
        respuestaDiv.textContent = 'No se pudo guardar la producción.';
        respuestaDiv.style.color = 'red';
    }
}



// FILTROS ESCANDALLO
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaEscandallo').addEventListener('click', () => {
        const filtroOrdenar = document.querySelector('input[name="filtro-ordenar"]:checked');
        const filtroTiempo = document.querySelector('input[name="filtro-tiempo"]:checked');
        const filtroCoste = document.querySelector('input[name="filtro-coste"]:checked');
        const filtroTipo = document.querySelector('input[name="filtro-tipo"]:checked');
        const buscarCampoEscandallo = document.getElementById('buscarCampoEscandallo').value;
        const buscarValorEscandallo = document.getElementById('buscarValorEscandallo').value;
        const ordenarPorEscandallo = filtroOrdenar ? filtroOrdenar.value : '';
        const tiempoPorEscandallo = filtroTiempo ? filtroTiempo.value : '';
        const costePorEscandallo = filtroCoste ? filtroCoste.value : '';
        const tipoPorEscandallo = filtroTipo ? filtroTipo.value : '';
        fetchEscandalloConsulta(ordenarPorEscandallo, tiempoPorEscandallo, costePorEscandallo, tipoPorEscandallo, buscarCampoEscandallo, buscarValorEscandallo);
    });

    document.querySelector('.eliminar-filtros-escandallo').addEventListener('click', () => {
        document.querySelectorAll('input[name="filtro-ordenar"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-tiempo"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-coste"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-tipo"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoEscandallo').value = 'todos';
        document.getElementById('buscarValorEscandallo').value = '';
        fetchEscandalloConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseEscandallo').addEventListener('click', () => {
        document.getElementById('filtrosEscandallo').classList.add('hidden');
        document.getElementById('filtroToggleEscandallo').style.display = 'flex';
    });

    document.getElementById('filtroToggleEscandallo').addEventListener('click', () => {
        document.getElementById('filtrosEscandallo').classList.remove('hidden');
        document.getElementById('filtroToggleEscandallo').style.display = 'none';
    });
});

// CONSULTA FACTURA-COMPRA
async function fetchFacturaCompraConsulta(filtroImporte = '', filtroFecha = '', filtroOrdenar = '', buscarCampoCompra = 'todos', buscarValorCompra = '') {
    const controllerUrl = "Controllers/facturaCompraConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroImporte, filtroFecha, filtroOrdenar, buscarCampoCompra, buscarValorCompra })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlockWithLink({
                num_com: "Nº Fact Propio",
                fec_com: "Fecha",
                tot_com: "Importe Total",
                dni_emp: "DNI Empleado",
                ide_alm: "ID Almacen",
                fac_com: "Nº Fact Proveedor",
                nif_pro: "NIF Proveedor",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlockWithLink(item, 'num_com', 'detCom.php', 'num_com');
                row.dataset.num_com = item.num_com;

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'factura-compra-eliminar-btn');
                eliminarBtn.style.display = 'none';
                eliminarBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    eliminarFilaFacturaCompra(item.num_com, item.fec_com, item.tot_com, item.fac_com);
                });

                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️';
                modificarBtn.classList.add('modificar-btn', 'factura-compra-modificar-btn');
                modificarBtn.style.display = 'none';
                modificarBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    mostrarFormularioModificarFacturaCompra(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS COMPRA
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaCompra').addEventListener('click', () => {
        const filtroImporte = document.querySelector('input[name="filtro-importe"]:checked');
        const filtroFecha = document.querySelector('input[name="filtro-fecha"]:checked');
        const filtroOrdenar = document.querySelector('input[name="filtro-ordenar"]:checked');
        const buscarCampoCompra = document.getElementById('buscarCampoCompra').value;
        const buscarValorCompra = document.getElementById('buscarValorCompra').value;
        const importePorCompra = filtroImporte ? filtroImporte.value : '';
        const fechaPorCompra = filtroFecha ? filtroFecha.value : '';
        const ordenarPorCompra = filtroOrdenar ? filtroOrdenar.value : '';
        fetchFacturaCompraConsulta(importePorCompra, fechaPorCompra, ordenarPorCompra, buscarCampoCompra, buscarValorCompra);
    });

    document.querySelector('.eliminar-filtros-compra').addEventListener('click', () => {
        document.querySelectorAll('input[name="filtro-importe"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-fecha"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-ordenar"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoCompra').value = 'todos';
        document.getElementById('buscarValorCompra').value = '';
        fetchFacturaCompraConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseCompra').addEventListener('click', () => {
        document.getElementById('filtrosCompra').classList.add('hidden');
        document.getElementById('filtroToggleCompra').style.display = 'flex';
    });

    document.getElementById('filtroToggleCompra').addEventListener('click', () => {
        document.getElementById('filtrosCompra').classList.remove('hidden');
        document.getElementById('filtroToggleCompra').style.display = 'none';
    });
});

// CONSULTA FACTURA-VENTA
async function fetchFacturaVentaConsulta(filtroImporte = '', filtroFecha = '', filtroOrdenar = '', buscarCampoVenta = 'todos', buscarValorVenta = '') {
    const controllerUrl = "Controllers/facturaVentaConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filtroImporte, filtroFecha, filtroOrdenar, buscarCampoVenta, buscarValorVenta })
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlockWithLink({
                num_ven: "Nº Fact Propio",
                fec_ven: "Fecha",
                tot_ven: "Importe Total",
                dni_emp: "DNI Empleado",
                ide_alm: "ID Almacen",
                dni_cli: "DNI Cliente"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlockWithLink(item, 'num_ven', 'venDet.php', 'num_ven');
                row.dataset.num_ven = item.num_ven;

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'factura-venta-eliminar-btn');
                eliminarBtn.style.display = 'none';
                eliminarBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    eliminarFilaFacturaVenta(item.num_ven, item.fec_ven, item.tot_ven);
                });

                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️';
                modificarBtn.classList.add('modificar-btn', 'factura-venta-modificar-btn');
                modificarBtn.style.display = 'none';
                modificarBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    mostrarFormularioModificarFacturaVenta(item);
                });

                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

// FILTROS VENTA
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('aplicarBusquedaVenta').addEventListener('click', () => {
        const filtroImporte = document.querySelector('input[name="filtro-importe"]:checked');
        const filtroFecha = document.querySelector('input[name="filtro-fecha"]:checked');
        const filtroOrdenar = document.querySelector('input[name="filtro-ordenar"]:checked');
        const buscarCampoVenta = document.getElementById('buscarCampoVenta').value;
        const buscarValorVenta = document.getElementById('buscarValorVenta').value;
        const importePorVenta = filtroImporte ? filtroImporte.value : '';
        const fechaPorVenta = filtroFecha ? filtroFecha.value : '';
        const ordenarPorVenta = filtroOrdenar ? filtroOrdenar.value : '';
        fetchFacturaVentaConsulta(importePorVenta, fechaPorVenta, ordenarPorVenta, buscarCampoVenta, buscarValorVenta);
    });

    document.querySelector('.eliminar-filtros-venta').addEventListener('click', () => {
        document.querySelectorAll('input[name="filtro-importe"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-fecha"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="filtro-ordenar"]').forEach(el => el.checked = false);
        document.getElementById('buscarCampoVenta').value = 'todos';
        document.getElementById('buscarValorVenta').value = '';
        fetchFacturaVentaConsulta(); // Recargar datos por defecto
    });

    document.getElementById('filtroCloseVenta').addEventListener('click', () => {
        document.getElementById('filtrosVenta').classList.add('hidden');
        document.getElementById('filtroToggleVenta').style.display = 'flex';
    });

    document.getElementById('filtroToggleVenta').addEventListener('click', () => {
        document.getElementById('filtrosVenta').classList.remove('hidden');
        document.getElementById('filtroToggleVenta').style.display = 'none';
    });
});




//CONSULTA DETALLE-COMPRA
async function fetchDetalleCompraConsulta() {
    const controllerUrl = "Controllers/detalleCompraConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    // Obtener el valor del ID "idNumCom"
    const idNumComInput = document.getElementById("idNumCom"); // Asumiendo que el elemento existe
    const idNumComValue = idNumComInput ? idNumComInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumCom como parámetro en la URL
        const response = await fetch(`${controllerUrl}?idNumCom=${encodeURIComponent(idNumComValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_dco: "ID",
                num_com: "Nº Fact Propio",
                ide_art: "ID Articulo",
                nom_art: "Nombre Articulo",
                imp_dco: "Importe compra artículo",
                can_dco: "Cantidad compra artículo",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.nif = item.ide_dco; // Añadir el IDE Detalle Compra como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'proveedores-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaProveedor(item.ide_dco, item.imp_dco, item.can_dco);
                });

                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-VENTA
async function fetchDetalleVentaConsulta() {
    const controllerUrl = "Controllers/detalleVentaConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    // Obtener el valor del ID "idNumCom"
    const idNumVenInput = document.getElementById("idNumVen"); // Asumiendo que el elemento existe
    const idNumVenValue = idNumVenInput ? idNumVenInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumCom como parámetro en la URL
        const response = await fetch(`${controllerUrl}?idNumVen=${encodeURIComponent(idNumVenValue)}`, {
            method: 'GET',
        });


        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_dve: "ID",
                num_ven: "Nº Fact Propio",
                ide_art: "ID Articulo",
                nom_art: "Nombre Articulo",
                imp_dve: "Importe venta artículo",
                can_dve: "Cantidad venta artículo",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                row.dataset.nif = item.ide_dve; // Añadir el IDE Detalle Venta como atributo de datos

                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn', 'proveedores-eliminar-btn');
                eliminarBtn.style.display = 'none'; // Ocultar por defecto
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaProveedor(item.ide_dve, item.imp_dve, item.can_dve);
                });

                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-INVENTARIO
async function fetchDetalleInventarioConsulta() {
    const controllerUrl = "Controllers/detalleInventarioConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    // Obtener el valor del ID "idNumInv"
    const idNumInvInput = document.getElementById("cod_inv"); // Asumiendo que el elemento existe
    const idNumInvValue = idNumInvInput ? idNumInvInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumInv como parámetro en la URL
        const response = await fetch(`${controllerUrl}?cod_inv=${encodeURIComponent(idNumInvValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_din: "ID",
                ide_art: "ID Articulo",
                nom_art: "Nombre Articulo",
                can_din: "Cantidad Articulo",
                cod_inv: "Codigo Inventario",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-ESCANDALLO
async function fetchDetalleEscandalloConsulta() {
    const controllerUrl = "Controllers/detalleEscandalloConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    // Obtener el valor del ID "idNumCom"
    const idNumComInput = document.getElementById("ide_esc"); // Asumiendo que el elemento existe
    const idNumComValue = idNumComInput ? idNumComInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumCom como parámetro en la URL
        const response = await fetch(`${controllerUrl}?ide_esc=${encodeURIComponent(idNumComValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_des: "ID",
                ide_art: "ID Articulo",
                nom_art: "Nombre Material",
                uds_des: "Cantidad Material",
                ide_esc: "ID Escandallo",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-COMPRA-PADRE
async function fetchDetalleCompraConsultaPadre() {
    const controllerUrl = "Controllers/detalleCompraConsultaPadreController.php";
    const divResponse = document.getElementById("contenedorPadre");

    // Obtener el valor del ID "idNumCom"
    const idNumComInput = document.getElementById("idNumCom"); // Asumiendo que el elemento existe
    const idNumComValue = idNumComInput ? idNumComInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumCom como parámetro en la URL
        const response = await fetch(`${controllerUrl}?idNumCom=${encodeURIComponent(idNumComValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                num_com: "Nº Fact Propio",
                fec_com: "Fecha",
                tot_com: "Importe Total",
                dni_emp: "DNI Empleado",
                ide_alm: "ID Almacen",
                fac_com: "Nº Fact Proveedor",
                nif_pro: "NIF Proveedor",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-VENTA-PADRE
async function fetchDetalleVentaConsultaPadre() {
    const controllerUrl = "Controllers/detalleVentaConsultaPadreController.php";
    const divResponse = document.getElementById("contenedorPadre");

    // Obtener el valor del ID "idNumCom"
    const idNumVenInput = document.getElementById("idNumVen"); // Asumiendo que el elemento existe
    const idNumVenValue = idNumVenInput ? idNumVenInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumCom como parámetro en la URL
        const response = await fetch(`${controllerUrl}?idNumVen=${encodeURIComponent(idNumVenValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                num_ven: "Nº Fact Propio",
                fec_ven: "Fecha",
                tot_ven: "Importe Total",
                dni_emp: "DNI Empleado",
                ide_alm: "ID Almacen",
                dni_cli: "DNI Cliente"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-ESCANDALLO-PADRE
async function fetchDetalleEscandalloConsultaPadre() {
    const controllerUrl = "Controllers/detalleEscandalloConsultaPadreController.php";
    const divResponse = document.getElementById("contenedorPadre");

    // Obtener el valor del ID "idNumCom"
    const idNumComInput = document.getElementById("ide_esc"); // Asumiendo que el elemento existe
    const idNumComValue = idNumComInput ? idNumComInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumCom como parámetro en la URL
        const response = await fetch(`${controllerUrl}?ide_esc=${encodeURIComponent(idNumComValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                ide_esc: "ID Escandallo",
                nom_esc: "Nombre Escandallo",
                tie_esc: "Tiempo",
                cos_esc: "Coste",
                tip_esc: "Tipo"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

//CONSULTA DETALLE-INVENTARIO-PADRE
async function fetchDetalleInventarioConsultaPadre() {
    const controllerUrl = "Controllers/detalleInventarioConsultaPadreController.php";
    const divResponse = document.getElementById("contenedorPadre");

    // Obtener el valor del ID "idNumInv"
    const idNumInvInput = document.getElementById("cod_inv"); // Asumiendo que el elemento existe
    const idNumInvValue = idNumInvInput ? idNumInvInput.value : 0; // Toma el valor o usa 0 como predeterminado

    try {
        // Añadir el valor de idNumInv como parámetro en la URL
        const response = await fetch(`${controllerUrl}?cod_inv=${encodeURIComponent(idNumInvValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                cod_inv: "Código",
                fec_inv: "Fecha",
                dni_emp: "DNI Empleado",
                ide_alm: "ID Almacén"
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}







// Escucha del DOM cargado
document.addEventListener("DOMContentLoaded", function() {
    const botones = [
        { nombre: "INICIO", url: "inicio.php" },
        { nombre: "CLIENTES", url: "clientes.php" },
        { nombre: "PROVEEDORES", url: "proveedores.php" },
        { nombre: "COMPRA", url: "compra.php" },
        { nombre: "VENTA", url: "venta.php" },
        { nombre: "ARTICULOS", url: "articulos.php" }, // COMENTARIO ARTÍCULOS: Se incluye en los botones de navegación
        { nombre: "EMPLEADOS", url: "empleados.php" },
        { nombre: "INVENTARIO", url: "inventario.php" },
        { nombre: "ALMACEN", url: "almacen.php" },
        { nombre: "PRODUCCION", url: "produccion.php" },
        { nombre: "CERRAR SESION", url: "cerrar_sesion.php" }
    ];

    const contenedorBotones = document.querySelector('.contenedorbotones');

    // Obtener el path actual
    const currentPath = window.location.pathname.split('/').pop();

    // Crear los botones de navegación
    botones.forEach((boton, index) => {
        const input = document.createElement('input');
        input.type = 'radio';
        input.id = boton.nombre.toLowerCase();
        input.name = 'menu';
        input.classList.add('radio');

        if (boton.url === currentPath) {
            input.checked = true;
        }

        const label = document.createElement('label');
        label.htmlFor = boton.nombre.toLowerCase();
        label.textContent = boton.nombre;
        label.classList.add('botonesinicio');

        /*if (boton.nombre === "VENTA") label.classList.add('especial');*/
        if (window.location.href.includes("escandallos.php") && boton.nombre === "ARTICULOS") {
            label.classList.add("articulospulsado");
        }
        if (window.location.href.includes("detCom.php") && boton.nombre === "COMPRA") {
            label.classList.add("articulospulsado");
        }
        if (window.location.href.includes("venDet.php") && boton.nombre === "VENTA") {
            label.classList.add("articulospulsado");
        }
        if (window.location.href.includes("detInv.php") && boton.nombre === "INVENTARIO") {
            label.classList.add("articulospulsado");
        }
        if (window.location.href.includes("escDet.php") && boton.nombre === "ARTICULOS") {
            label.classList.add("articulospulsado");
        }
        label.addEventListener('click', () => {
            window.location.href = boton.url;
        });

        contenedorBotones.appendChild(input);
        contenedorBotones.appendChild(label);
    });


    //INSERCIONES

    // Inserción de empleado
    const formEmpleado = document.getElementById("formularioEmpleado");
    if (formEmpleado) {
        const buttonEmpleado = document.getElementById("botonAñadirEmpleado");
        const controllerEmpleado = "Controllers/empleadosInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formEmpleado.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonEmpleado.disabled = true;

            makeFetchFormRequest('POST', controllerEmpleado, formEmpleado)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Empleado: " + response.message; // Prefijo para distinguir respuestas
                        formEmpleado.reset();
                    } else {
                        divResponse.textContent = "Empleado: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del empleado:", error.message);
                    divResponse.textContent = 'Empleado: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonEmpleado.disabled = false;
                    fetchEmpleadosConsulta(); // Función específica para empleados
                });
        });
    }

    // Insercion de clientes
    const formClientes = document.getElementById("formularioClientes");
    if (formClientes) {
        const buttonClientes = document.getElementById("botonAñadirClientes");
        const controllerClientes = "Controllers/clientesInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formClientes.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonClientes.disabled = true;

            makeFetchFormRequest('POST', controllerClientes, formClientes)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Clientes: " + response.message; // Prefijo para distinguir respuestas
                        formClientes.reset();
                    } else {
                        divResponse.textContent = "Clientes: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del cliente:", error.message);
                    divResponse.textContent = 'Cliente: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonClientes.disabled = false;
                    fetchClientesConsulta(); // Función específica para clientes
                });
        });
    }


    // Inserción de proveedor
    const formProveedor = document.getElementById("formularioProveedor");
    if (formProveedor) {
        const buttonProveedor = document.getElementById("botonAñadirProveedor");
        const controllerProveedor = "Controllers/proveedoresInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formProveedor.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonProveedor.disabled = true;
            makeFetchFormRequest('POST', controllerProveedor, formProveedor)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Proveedor: " + response.message; // Prefijo para distinguir respuestas
                        formProveedor.reset();
                    } else {
                        divResponse.textContent = "Proveedor: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del proveedor:", error.message);
                    divResponse.textContent = 'Proveedor: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonProveedor.disabled = false;
                    fetchProveedoresConsulta(); // Función específica para proveedores
                });
        });
    }


    // Inserción de artículos
    const formArticulo = document.getElementById("formularioArticulo");
    if (formArticulo) {
        const buttonArticulo = document.getElementById("botonAñadirArticulo");
        const controllerArticulo = "Controllers/articulosInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta");

        formArticulo.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonArticulo.disabled = true;
            makeFetchFormRequest('POST', controllerArticulo, formArticulo)
                .then(responseJson => {
                    if (responseJson.status === "success") {
                        divResponse.textContent = "Articulo: " + responseJson.message;
                        formArticulo.reset();
                    } else {
                        divResponse.textContent = "Artículo: " + (responseJson.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del artículo:", error.message);
                    divResponse.textContent = 'Artículo: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonArticulo.disabled = false;
                    fetchArticulosConsulta();
                });
        });
    }

    // Inserción de proveedor
    const formAlmacen = document.getElementById("formularioAlmacenes");
    if (formAlmacen) {
        const buttonAlmacen = document.getElementById("botonAñadirAlmacen");
        const controllerAlmacen = "Controllers/almacenesInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formAlmacen.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonAlmacen.disabled = true;
            makeFetchFormRequest('POST', controllerAlmacen, formAlmacen)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Proveedor: " + response.message; // Prefijo para distinguir respuestas
                        formAlmacen.reset();
                    } else {
                        divResponse.textContent = "Proveedor: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del proveedor:", error.message);
                    divResponse.textContent = 'Proveedor: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonAlmacen.disabled = false;
                    fetchAlmacenesConsulta(); // Función específica para almacenes
                });
        });
    }

    // Inserción de ESCANDALLOS
    const formEscandallo = document.getElementById("formularioEscandallo");
    if (formEscandallo) {
        const buttonEscandallo = document.getElementById("botonAñadirEscandallo");
        const controllerEscandallo = "Controllers/escandalloInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta");

        formEscandallo.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonEscandallo.disabled = true;
            makeFetchFormRequest('POST', controllerEscandallo, formEscandallo)
                .then(responseJson => {
                    if (responseJson.status === "success") {
                        divResponse.textContent = "Escandallo: " + responseJson.message;
                        formEscandallo.reset();
                    } else {
                        divResponse.textContent = "Escandallo: " + (responseJson.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del escandallo:", error.message);
                    divResponse.textContent = 'Escandallo: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonEscandallo.disabled = false;
                    fetchEscandalloConsulta();
                });
        });
    }

    // Inserción de INVENTARIO
    const formInventario = document.getElementById("formularioInventario");
    if (formInventario) {
        const buttonInventario = document.getElementById("botonAñadirInventario");
        const controllerInventario = "Controllers/inventarioInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formInventario.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonInventario.disabled = true;

            makeFetchFormRequest('POST', controllerInventario, formInventario)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Inventario: " + response.message; // Prefijo para distinguir respuestas
                        formInventario.reset();
                    } else {
                        divResponse.textContent = "Inventario: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción del inventario:", error.message);
                    divResponse.textContent = 'Inventario: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonInventario.disabled = false;
                    fetchInventarioConsulta(); // Función específica para invantarios
                });
        });
    }

    // Inserción de PRODUCCION
    const formProduccion = document.getElementById("formularioProduccion");
    if (formProduccion) {
        const buttonProduccion = document.getElementById("botonAñadirProduccion");
        const controllerProduccion = "Controllers/produccionInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formProduccion.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonProduccion.disabled = true;

            makeFetchFormRequest('POST', controllerProduccion, formProduccion)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Produccion: " + response.message; // Prefijo para distinguir respuestas
                        formProduccion.reset();
                    } else {
                        divResponse.textContent = "Produccion: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción de Produccion:", error.message);
                    divResponse.textContent = 'Produccion: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonProduccion.disabled = false;
                    fetchProduccionConsulta(); // Función específica para invantarios
                });
        });
    }

    // Inserción de Factura Compra
    const formFacturaCompra = document.getElementById("formularioFacturaCompra");
    if (formFacturaCompra) {
        const buttonFacturaCompra = document.getElementById("botonAñadirFacturaCompra");
        const controllerFacturaCompra = "Controllers/facturaCompraInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formFacturaCompra.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonFacturaCompra.disabled = true;

            makeFetchFormRequest('POST', controllerFacturaCompra, formFacturaCompra)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Factura Compra: " + response.message; // Prefijo para distinguir respuestas
                        formFacturaCompra.reset();
                    } else {
                        divResponse.textContent = "Factura Compra: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción de Factura Compra:", error.message);
                    divResponse.textContent = 'Factura Compra: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonFacturaCompra.disabled = false;
                    fetchFacturaCompraConsulta(); // Función específica para invantarios
                });
        });
    }

    // Inserción de Factura Venta
    const formFacturaVenta = document.getElementById("formularioFacturaVenta");
    if (formFacturaVenta) {
        const buttonFacturaVenta = document.getElementById("botonAñadirFacturaVenta");
        const controllerFacturaVenta = "Controllers/facturaVentaInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta"); // Mismo ID para ambos

        formFacturaVenta.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonFacturaVenta.disabled = true;

            makeFetchFormRequest('POST', controllerFacturaVenta, formFacturaVenta)
                .then(response => {
                    if (response.status === "success") {
                        divResponse.textContent = "Factura Venta: " + response.message; // Prefijo para distinguir respuestas
                        formFacturaVenta.reset();
                    } else {
                        divResponse.textContent = "Factura Venta: " + (response.message || 'Error desconocido.');
                    }
                })
                .catch(error => {
                    console.error("Error en la inserción de Factura Venta:", error.message);
                    divResponse.textContent = 'Factura Venta: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonFacturaVenta.disabled = false;
                    fetchFacturaVentaConsulta(); // Función específica para invantarios
                });
        });
    }





    // FIN DE INSERCIONES



    // COMENTARIO: Se ha añadido la función de consulta de PROVEEDORES solo si estamos en la página de PROVEEDORES
    if (window.location.href.includes("proveedores.php")) {
        fetchProveedoresConsulta();
    }

    // COMENTARIO: Se ha añadido la función de consulta de clientes solo si estamos en la página de clientes
    if (window.location.href.includes("clientes.php")) {
        fetchClientesConsulta();
    }

    // COMENTARIO EMPLEADOS: Se ejecuta la consulta de EMPLEADOS solo si estamos en la página de EMPLEADOS
    if (window.location.href.includes("empleados.php")) {
        fetchEmpleadosConsulta();
    }

    // COMENTARIO ARTÍCULOS: Se ejecuta la consulta de artículos solo si estamos en la página de artículos
    if (window.location.href.includes("articulos.php")) {
        fetchArticulosConsulta();
        var elemento = document.getElementById("botonProductos");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }
    }
    // COMENTARIO ALMACEN: Se ejecuta la consulta de ALMACEN solo si estamos en la página de ALMACEN
    if (window.location.href.includes("almacen.php")) {
        fetchAlmacenesConsulta();
    }
    // COMENTARIO PRODUCCION: Se ejecuta la consulta de PRODUCCION solo si estamos en la página de PRODUCCION
    if (window.location.href.includes("produccion.php")) {
        fetchProduccionConsulta();

    }
    if (window.location.href.includes("escandallos.php")) {
        fetchEscandalloConsulta();

        var elemento = document.getElementById("botonEscandallos");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }

    }
    // COMENTARIO INVENTARIO: Se ejecuta la consulta de INVENTARIO solo si estamos en la página de INVENTARIO
    if (window.location.href.includes("inventario.php")) {
        fetchInventarioConsulta();
    }
    // COMENTARIO FACTURA COMPRA: Se ejecuta la consulta de FACTURA COMPRA solo si estamos en la página de COMPRA
    if (window.location.href.includes("compra.php")) {
        fetchFacturaCompraConsulta();
        var elemento = document.getElementById("botonFacturaCompra");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }
    }
    // COMENTARIO FACTURA VENTA: Se ejecuta la consulta de FACTURA VENTA solo si estamos en la página de VENTA
    if (window.location.href.includes("venta.php")) {
        fetchFacturaVentaConsulta();
        var elemento = document.getElementById("botonFacturaVenta");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }
    }

    if (window.location.href.includes("detCom.php")) {
        fetchDetalleCompraConsulta();
        fetchDetalleCompraConsultaPadre();
        var elemento = document.getElementById("botonFacturaCompra");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }
    }

    if (window.location.href.includes("venDet.php")) {
        fetchDetalleVentaConsulta();
        fetchDetalleVentaConsultaPadre();
        var elemento = document.getElementById("botonFacturaCompra");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }
    }
    if (window.location.href.includes("detInv.php")) {
        fetchDetalleInventarioConsulta();
        fetchDetalleInventarioConsultaPadre();
        /*var elemento = document.getElementById("botonFacturaCompra");
        if (elemento) {
            elemento.classList.add("buttoncompraventa2pulsado");
        }*/
    }

    if (window.location.href.includes("escDet.php")) {
        fetchDetalleEscandalloConsulta();
        fetchDetalleEscandalloConsultaPadre();
    }


});