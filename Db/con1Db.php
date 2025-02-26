<?php
    class Conex1
    {
        // Conexión MySQL
        public static function con1()
        {
            $se = "localhost";
            $us = "root";
            $co = "";
            $bd = "empresa";
    
            // $mysqli = new mysqli("localhost", "usuario", "clave", "bd", "puerto-opcional");
        $conexion = new mysqli($se, $us, $co, $bd);

            if ($conexion->connect_errno)
            {
                // Mensaje
                $mensaje = "Error de conexión a BD\r\n" . $conexion->connect_error;
                // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
                $mensaje = wordwrap($mensaje, 70, "\r\n");
                // Envío
                mail('xxx@xxx.com', 'Error de conexión a BD', $mensaje);
                
                printf("Error en la conexion: %s\n", $conexion->connect_error);
                exit();
            }
            else
            {
                $conexion->set_charset("utf8");
                return $conexion;
            }
        }          
    }
?>