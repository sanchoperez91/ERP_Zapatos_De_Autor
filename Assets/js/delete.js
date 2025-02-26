document.addEventListener('DOMContentLoaded', function() {
    let eliminarModo = false;

    const eliminarBtnClientes = document.getElementById('eliminarclientes');
    if (eliminarBtnClientes) {
        eliminarBtnClientes.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'clientes');
        });
    }

    const eliminarBtnProveedores = document.getElementById('eliminarproveedores');
    if (eliminarBtnProveedores) {
        eliminarBtnProveedores.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'proveedores');
        });
    }


    const eliminarBtnEmpleados = document.getElementById('eliminarempleados');
    if (eliminarBtnEmpleados) {
        eliminarBtnEmpleados.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'empleados');
        });
    }

    const eliminarBtnAlmacenes = document.getElementById('eliminaralmacenes');
    if (eliminarBtnAlmacenes) {
        eliminarBtnAlmacenes.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'almacenes');
        });
    }

    const eliminarBtnFacturaCompra = document.getElementById('eliminarFacturaCompra');
if (eliminarBtnFacturaCompra) {
    eliminarBtnFacturaCompra.addEventListener('click', function() {
        eliminarModo = !eliminarModo;
        toggleEliminarModo(eliminarModo, 'factura-compra');
    });
}

const eliminarBtnFacturaVenta = document.getElementById('eliminarFacturaVenta');
if (eliminarBtnFacturaVenta) {
    eliminarBtnFacturaVenta.addEventListener('click', function() {
        eliminarModo = !eliminarModo;
        toggleEliminarModo(eliminarModo, 'factura-venta');
    });
}

    const eliminarBtnArticulos = document.getElementById('eliminararticulos');
    if (eliminarBtnArticulos) {
        eliminarBtnArticulos.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'articulos');
        });
    }

    const eliminarBtnEscandallo = document.getElementById('eliminarescandallos');
    if (eliminarBtnEscandallo) {
        eliminarBtnEscandallo.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'escandallo');
        });
    }

    function toggleEliminarModo(activar, tipo) {
        const botonesEliminar = document.querySelectorAll(`.${tipo}-eliminar-btn`);
        botonesEliminar.forEach(btn => {
            btn.style.display = activar ? 'flex' : 'none';
        });
    }
});

const eliminarBtnInventario = document.getElementById('eliminarInventario');
if (eliminarBtnInventario) {
    eliminarBtnInventario.addEventListener('click', function() {
        eliminarModo = !eliminarModo;
        toggleEliminarModo(eliminarModo, 'inventario');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    let eliminarModo = false;

    const eliminarBtnProduccion = document.getElementById('eliminarProduccion');
    if (eliminarBtnProduccion) {
        eliminarBtnProduccion.addEventListener('click', function() {
            eliminarModo = !eliminarModo;
            toggleEliminarModo(eliminarModo, 'produccion');
        });
    }

    function toggleEliminarModo(activar, tipo) {
        const botonesEliminar = document.querySelectorAll(`.${tipo}-eliminar-btn`);
        botonesEliminar.forEach(btn => {
            btn.style.display = activar ? 'flex' : 'none';
        });
    }
});


async function eliminarFilaCliente(dni) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este cliente?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarClientes = "Controllers/clientesEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarClientes, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ dni })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchClientesConsulta(); // Actualizar la lista de clientes
        } else {
            alert("No se puede eliminar este cliente, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del cliente:", error.message);
    }
}

async function eliminarFilaProveedor(nif, nombre, direccion, telefono, email, descuento) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este proveedor?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarProveedores = "Controllers/proveedoresEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarProveedores, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nif,
                nombre,
                direccion,
                telefono,
                email,
                descuento
            })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchProveedoresConsulta(); // Actualizar la lista de proveedores
        } else {
            alert("No se puede eliminar este proveedor, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del proveedor:", error.message);
    }
}

async function eliminarFilaEmpleado(dni) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este empleado?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarEmpleados = "Controllers/empleadosEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarEmpleados, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ dni })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchEmpleadosConsulta(); // Actualizar la lista de empleados
        } else {
            alert("No se puede eliminar este empleado, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del empleado:", error.message);
    }
}


async function eliminarFilaAlmacen(ide) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este almacén?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarAlmacenes = "Controllers/almacenesEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarAlmacenes, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ide })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchAlmacenesConsulta(); // Actualizar la lista de almacenes
        } else {
            alert("No se puede eliminar este almacén, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del almacén:", error.message);
    }
}


async function eliminarFilaFacturaCompra(num_com) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar esta factura de compra?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    try {
        // Eliminar la factura de compra y actualizar el stock de los artículos
        const response = await fetch("Controllers/facturaCompraEliminacion1Controller.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ num_com })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchFacturaCompraConsulta(); // Actualizar la lista de facturas de compra
        } else {
            alert("Error al eliminar la factura de compra: " + result.message);
        }
    } catch (error) {
        console.error("Error en la eliminación de la factura de compra:", error.message);
    }
}

async function eliminarFilaFacturaVenta(num_ven) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar esta factura de venta?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    try {
        // Eliminar la factura de venta y actualizar el stock de los artículos
        const response = await fetch("Controllers/facturaVentaEliminacion1Controller.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ num_ven })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchFacturaVentaConsulta(); // Actualizar la lista de facturas de venta
        } else {
            alert("Error al eliminar la factura de venta: " + result.message);
        }
    } catch (error) {
        console.error("Error en la eliminación de la factura de venta:", error.message);
    }
}


async function eliminarFilaArticulo(ide) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este artículo?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarArticulos = "Controllers/articulosEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarArticulos, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ide })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchArticulosConsulta(); // Actualizar la lista de artículos
        } else {
            alert("No se puede eliminar este artículo, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del artículo:", error.message);
    }
}


async function eliminarFilaEscandallo(ide) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este escandallo?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarEscandallo = "Controllers/escandalloEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarEscandallo, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ide })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchEscandalloConsulta(); // Actualizar la lista de escandallos
        } else {
            alert("No se puede eliminar este escandallo, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del escandallo:", error.message);
    }
}


async function eliminarFilaInventario(cod_inv) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este inventario?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarInventario = "Controllers/inventarioEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarInventario, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cod_inv })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchInventarioConsulta(); // Actualizar la lista de inventarios
        } else {
            alert("No se puede eliminar este inventario, está asociado a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación del inventario:", error.message);
    }
}

async function eliminarFilaProduccion(ide_pdc) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar esta producción?");
    if (!confirmacion) {
        return; // Si el usuario cancela, no se procede con la eliminación
    }

    const controllerEliminarProduccion = "Controllers/produccionEliminacion1Controller.php";
    try {
        const response = await fetch(controllerEliminarProduccion, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ide_pdc })
        });

        const result = await response.json();
        if (result.status === "success") {
            fetchProduccionConsulta(); // Actualizar la lista de producciones
        } else {
            alert("No se puede eliminar esta producción, está asociada a otras tablas.");
        }
    } catch (error) {
        console.error("Error en la eliminación de la producción:", error.message);
    }
}