

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
    

    <div id="jj" >
        <div class="forminsercion">
            
            <div id="tituloAñadirEmpleado" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR USUARIO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioEmpleado" action="#" method="POST">
                    <div id="contDatosEmpleado" class="contDatosForm1">    
                        <div class="contAñadir1" id="contAñadirEmpleado1">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" required><br>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="con_emp">Contraseña:</label>
                            <input type="password" pattern="\d*" min="0" minlength="4" maxlength="4" id="con_emp" name="con_emp" required placeholder="4 dígitos"><br>
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" required><br>
                        </div>
                        <div class="contAñadir1" id="contAñadirEmpleado2">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required><br>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>
                            <label for="puesto">Puesto:</label>
                            <select id="puesto" name="puesto" class="opciones_select" required>
                                <option value="" disabled selected>Selecciona un puesto</option>
                                <option value="compras">Compras</option>
                                <option value="direccion">Dirección</option>
                                <option value="contabilidad">Contabilidad</option>
                                <option value="produccion">Producción</option>
                                <option value="diseño">Diseño</option>
                                <option value="transporte">Transporte</option>
                            </select>
                        </div>
                    </div>
                    <div id="divbotonAñadirEmpleado" class="divBotonAñadir">
                        <button type="submit" id="botonAñadirEmpleado" class="botonAñadir" name="botonAñadirEmpleado">Regístrate</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>
                <div class="inicioalta">
                <h4>¿Ya tienes cuenta?</h4> <h4><a href="registro.php" class="iniciosesionalta">Inicia sesión</a></h4>
                </div>
            </div>
        </div>
    </div>

    

</body>
</html>