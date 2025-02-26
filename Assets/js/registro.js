document.addEventListener('DOMContentLoaded', function() {
    async function confirmarRegistro() {
        const dni = document.getElementById('inputDni').value;
        const contra = document.getElementById('inputContra').value;

        // Validación básica
        if (!dni || !contra) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Enviar datos al servidor
        const response = await fetch('Controllers/registro1Controller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ dni, contra })
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = 'inicio.php'; // Redirigir a inicio.php
        } else {
            alert('Datos incorrectos');
        }
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        confirmarRegistro();
    });
});