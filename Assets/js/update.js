document.addEventListener('DOMContentLoaded', function() {
    let modificarVisible = false;
    let eliminarVisible = false;

    // Detectar la página actual
    const currentPage = window.location.pathname.split('/').pop();

    if (currentPage === 'proveedores.php') {
        // Proveedores
        document.getElementById('modificarproveedores').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.proveedores-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.proveedores-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarproveedores').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.proveedores-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.proveedores-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificar').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarProveedor').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificar');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Proveedor modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchProveedoresConsulta(); // Recargar los datos de los proveedores
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el proveedor: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'articulos.php') {
        // Artículos
        document.getElementById('modificararticulos').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.articulos-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.articulos-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminararticulos').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.articulos-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.articulos-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificarArticulos').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarArticulo').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificarArticulo');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Artículo modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchArticulosConsulta(); // Recargar los datos de los artículos
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el artículo: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'empleados.php') {
        // Empleados
        document.getElementById('modificarempleados').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.empleados-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.empleados-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarempleados').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.empleados-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.empleados-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificar').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarEmpleado').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificar');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Empleado modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchEmpleadosConsulta(); // Recargar los datos de los empleados
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el empleado: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'almacen.php') {
        // Almacenes
        document.getElementById('modificaralmacenes').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.almacenes-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.almacenes-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminaralmacenes').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.almacenes-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.almacenes-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificar').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarAlmacen').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificar');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Almacén modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchAlmacenesConsulta(); // Recargar los datos de los almacenes
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el almacén: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    }  if (currentPage === 'clientes.php') {
        // Clientes
        document.getElementById('modificarclientes').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.clientes-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.clientes-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarclientes').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.clientes-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.clientes-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificar').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarCliente').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificar');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Cliente modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchClientesConsulta(); // Recargar los datos de los clientes
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el cliente: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'produccion.php') {
        // Producción
        document.getElementById('modificarproduccion').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.produccion-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.produccion-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarproduccion').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.produccion-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.produccion-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificarProduccion').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarProduccion').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificarProduccion');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Producción modificada con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchProduccionConsulta(); // Recargar los datos de la producción
            } else {
                mensajeRespuesta.textContent = 'Error al modificar la producción: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'inventario.php') {
        // Inventario
        document.getElementById('modificarinventario').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.inventario-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.inventario-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarinventario').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.inventario-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.inventario-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificarInventario').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarInventario').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificarInventario');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Inventario modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchInventarioConsulta(); // Recargar los datos del inventario
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el inventario: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'escandallos.php') {
        // Escandallos
        document.getElementById('modificarescandallos').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.escandallo-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.escandallo-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarescandallos').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.escandallo-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.escandallo-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificarEscandallo').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarEscandallo').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificarEscandallo');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Escandallo modificado con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchEscandalloConsulta(); // Recargar los datos del escandallo
            } else {
                mensajeRespuesta.textContent = 'Error al modificar el escandallo: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });

    } else if (currentPage === 'compra.php') {
        // Factura Compra
        document.getElementById('modificarFacturaCompra').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.factura-compra-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.factura-compra-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarFacturaCompra').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.factura-compra-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.factura-compra-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificarFacturaCompra').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarFacturaCompra').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificarFacturaCompra');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Factura de compra modificada con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchFacturaCompraConsulta(); // Recargar los datos de las facturas de compra
            } else {
                mensajeRespuesta.textContent = 'Error al modificar la factura de compra: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });
    } else if (currentPage === 'venta.php') {
        // Factura Venta
        document.getElementById('modificarFacturaVenta').addEventListener('click', function() {
            modificarVisible = !modificarVisible;
            eliminarVisible = false; // Ocultar los botones de eliminar
            document.querySelectorAll('.factura-venta-modificar-btn').forEach(btn => {
                btn.style.display = modificarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.factura-venta-eliminar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('eliminarFacturaVenta').addEventListener('click', function() {
            eliminarVisible = !eliminarVisible;
            modificarVisible = false; // Ocultar los botones de modificar
            document.querySelectorAll('.factura-venta-eliminar-btn').forEach(btn => {
                btn.style.display = eliminarVisible ? 'inline-block' : 'none';
            });
            document.querySelectorAll('.factura-venta-modificar-btn').forEach(btn => {
                btn.style.display = 'none';
            });
        });

        document.getElementById('cerrarFormularioModificarFacturaVenta').addEventListener('click', function() {
            document.getElementById('overlay2').style.display = 'none';
        });

        document.getElementById('formularioModificarFacturaVenta').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const mensajeRespuesta = document.getElementById('divRespuestaModificarFacturaVenta');
            if (result.status === 'success') {
                mensajeRespuesta.textContent = 'Factura de venta modificada con éxito.';
                mensajeRespuesta.style.color = 'green';
                fetchFacturaVentaConsulta(); // Recargar los datos de las facturas de venta
            } else {
                mensajeRespuesta.textContent = 'Error al modificar la factura de venta: ' + result.message;
                mensajeRespuesta.style.color = 'red';
            }
        });


    }
});

function mostrarFormularioModificar(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('nif_mod').value = item.nif_pro;
    document.getElementById('nif_original').value = item.nif_pro; // Establecer el NIF original
    document.getElementById('nombre_mod').value = item.nom_pro;
    document.getElementById('direccion_mod').value = item.dir_pro;
    document.getElementById('telefono_mod').value = item.tlf_pro;
    document.getElementById('email_mod').value = item.ema_pro;
    document.getElementById('descuento_mod').value = item.dto_pro;
}

function mostrarFormularioModificarArticulo(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('ide_original').value = item.ide_art; // Establecer el ID original
    document.getElementById('nombre_mod').value = item.nom_art;
    document.getElementById('tipo_mod').value = item.tip_art;
    document.getElementById('importe_mod').value = item.imp_art;
    document.getElementById('stock_mod').value = item.sto_art;
}

function mostrarFormularioModificarEmpleado(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('dni_mod').value = item.dni_emp;
    document.getElementById('dni_original').value = item.dni_emp; // Establecer el DNI original
    document.getElementById('nombre_mod').value = item.nom_emp;
    document.getElementById('direccion_mod').value = item.dir_emp;
    document.getElementById('telefono_mod').value = item.tlf_emp;
    document.getElementById('email_mod').value = item.ema_emp;
    document.getElementById('puesto_mod').value = item.pue_emp;
}

function mostrarFormularioModificarAlmacen(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('ide_original').value = item.ide_alm; // Establecer el ID original
    document.getElementById('nombre_mod').value = item.nom_alm;
    document.getElementById('ubicacion_mod').value = item.ubi_alm;
}

function mostrarFormularioModificarCliente(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('dni_mod').value = item.dni_cli;
    document.getElementById('dni_original').value = item.dni_cli; // Establecer el DNI original
    document.getElementById('nombre_mod').value = item.nom_cli;
    document.getElementById('direccion_mod').value = item.dir_cli;
    document.getElementById('telefono_mod').value = item.tlf_cli;
    document.getElementById('email_mod').value = item.ema_cli;
    document.getElementById('descuento_mod').value = item.dto_cli;
}

function mostrarFormularioModificarProduccion(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('id_mod').value = item.ide_pdc;
    document.getElementById('id_original').value = item.ide_pdc; // Establecer el ID original
    document.getElementById('fecha_mod').value = item.fec_pdc;
    document.getElementById('cantidad_mod').value = item.can_pdc;
    document.getElementById('almacen_mod').value = item.ide_alm;
    document.getElementById('escandallo_mod').value = item.ide_esc;
    document.getElementById('empleado_mod').value = item.dni_emp;
}

function mostrarFormularioModificarInventario(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('cod_inv_mod').value = item.cod_inv;
    document.getElementById('cod_inv_original').value = item.cod_inv; // Establecer el código original
    document.getElementById('fec_inv_mod').value = item.fec_inv;
    document.getElementById('dni_emp_mod').value = item.dni_emp;
    document.getElementById('ide_alm_mod').value = item.ide_alm;
}

function mostrarFormularioModificarEscandallo(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('ide_esc_original').value = item.ide_esc;
    document.getElementById('ide_esc_mod').value = item.ide_esc;
    document.getElementById('nom_esc_mod').value = item.nom_esc;
    document.getElementById('tie_esc_mod').value = item.tie_esc;
    document.getElementById('cos_esc_mod').value = item.cos_esc;
    document.getElementById('tip_esc_mod').value = item.tip_esc;
}

function mostrarFormularioModificarFacturaCompra(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('num_com_mod').value = item.num_com;
    document.getElementById('fec_com_mod').value = item.fec_com;
    document.getElementById('tot_com_mod').value = item.tot_com;
    document.getElementById('dni_emp_mod').value = item.dni_emp;
    document.getElementById('nif_pro_mod').value = item.nif_pro;
    document.getElementById('ide_alm_mod').value = item.ide_alm;
    document.getElementById('fac_com_mod').value = item.fac_com;
}

function mostrarFormularioModificarFacturaVenta(item) {
    document.getElementById('overlay2').style.display = 'flex';
    document.getElementById('num_ven_mod').value = item.num_ven;
    document.getElementById('fec_ven_mod').value = item.fec_ven;
    document.getElementById('tot_ven_mod').value = item.tot_ven;
    document.getElementById('dni_emp_mod').value = item.dni_emp;
    document.getElementById('dni_cli_mod').value = item.dni_cli;
    document.getElementById('ide_alm_mod').value = item.ide_alm;
}