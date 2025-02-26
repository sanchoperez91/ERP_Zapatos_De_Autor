<?php
session_start(); // Iniciar sesión
require_once '../Models/registro1Model.php';

class RegistroController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function confirmarRegistro($dni, $contra) {
        return $this->usuario->verificarUsuario($dni, $contra);
    }
}

// Procesamiento de la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../Db/con1Db.php'; // Asegúrate de que la ruta sea correcta

    $controller = new RegistroController();
    $data = json_decode(file_get_contents('php://input'), true);
    $dni = $data['dni'];
    $contra = $data['contra'];

    error_log("DNI: $dni, Contraseña: $contra"); // Mensaje de depuración

    $usuario = $controller->confirmarRegistro($dni, $contra);

    if ($usuario) {
        $_SESSION['dni'] = $dni; // Almacenar el DNI en la sesión
        $_SESSION['nombre'] = $usuario['nom_emp']; // Almacenar el nombre en la sesión
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>