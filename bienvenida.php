<?php
// Mostrar el mensaje de bienvenida con una clase CSS
echo "<div class='mensaje-bienvenida'>Te damos la Bienvenida, " . htmlspecialchars($_SESSION['nombre']) . ".</div>";
?>