<?php
class Usuario {
    // Devuelve Datos (select)
    public function verificarUsuario($dni, $contra) {
        // Conexión
        $mysqli = Conex1::con1();
        
        // Sentencia
        $stmt = $mysqli->prepare("SELECT * FROM empleados WHERE dni_emp = ?");
        $stmt->bind_param("s", $dni); // 's' indica un string
        $stmt->execute();
        
        // Obtención del resultado
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        
        // Verificar la contraseña
        if ($data && password_verify($contra, $data['con_emp'])) {
            // Liberación del conjunto de resultados
            $result->free();
            // Cierre de la declaración
            $stmt->close();
            // Cierre de la conexión
            $mysqli->close();
            
            // Devolución del resultado
            return $data;
        } else {
            // Liberación del conjunto de resultados
            $result->free();
            // Cierre de la declaración
            $stmt->close();
            // Cierre de la conexión
            $mysqli->close();
            
            // Devolución de null si la verificación falla
            return null;
        }
    }
}
?>