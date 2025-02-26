<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['dni'])) {
    header('Location: registro.php');
    exit();
}
?>