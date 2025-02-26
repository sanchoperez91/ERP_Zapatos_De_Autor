document.addEventListener('DOMContentLoaded', function() {
    // Selecciona ambos elementos por sus IDs y añade el evento
    document.querySelectorAll('#añadirempleados, #añadirproveedores, #añadirclientes, #añadirarticulos, #añadiralmacenes, #añadirproduccion, #añadirescandallos, #añadirinventario, #añadirFacturaCompra, #añadirFacturaVenta, #añadirDetalleCompra, #añadirDetalleVenta, #añadirDetalleEscandallo').forEach(function(element) {
        element.addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'flex';
            
        });
    });

    // Añade el evento para cerrar el formulario
    document.getElementById('cerrarFormulario').addEventListener('click', function() {
        document.getElementById('overlay').style.display = 'none';
    });
});