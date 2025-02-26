<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <style>
        /* Estilos para el fondo sombreado */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Estilos para el formulario centrado */
        .formAñadirEmpleado {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* Estilos para el botón de cerrar */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        /* Tu CSS existente */
        #divRespuesta {
            height: 90px;
            width: 100%;
            background-color: aqua;
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        #contTotal {
            padding: 20px;
            background-color: #ece8e0; /* Fondo para distinguir */
            max-width: 800px;
            margin: 0 auto;
            border: 4px solid #593609;
            border-radius: 8px;
        }
        #tituloAñadirEmpleado {
            text-align: center;
            margin-bottom: 20px; /* Separación del resto */
        }
        .tituloAñadirEmpleado {
            font-size: 2.5rem;
            color: #593609;
        }
        #contDatosEmpleado {
            display: flex;
            flex-wrap: wrap; /* Permite que los elementos se ajusten si la pantalla es pequeña */
            gap: 20px; /* Espaciado entre columnas */
            justify-content: space-between;
        }
        .contAñadirEmpleado {
            flex: 1; /* Cada columna ocupa el mismo espacio */
            min-width: 300px; /* Tamaño mínimo de cada columna */
        }
        label {
            display: block; /* Apilar los labels sobre los inputs */
            margin-bottom: 8px; /* Separación con el input */
            font-weight: bold;
            font-size: 25px;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #524830;
            border-radius: 4px;
            margin-bottom: 15px; /* Separación entre inputs */
            box-sizing: border-box;
        }
        #puesto {
            width: 250px;
            height: 35px;
        }
        #divbotonAñadirEmpleado {
            text-align: center;
            margin-top: 20px;
        }
        #botonAñadirEmpleado {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: 2px solid black;
            border-radius: 5px;
            font-size: 1.5rem;
            cursor: pointer;
        }
        #botonAñadirEmpleado:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <button id="mostrarFormulario">Mostrar Formulario</button>
    <div id="overlay">
        <div class="formAñadirEmpleado">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirEmpleado">
                <h2 class="tituloAñadirEmpleado">AÑADIR EMPLEADO</h2>
            </div>
            <div id="contEmp2">
                <form id="formularioEmpleado" action="#" method="POST">
                    <div id="contDatosEmpleado">    
                        <div class="contAñadirEmpleado" id="contAñadirEmpleado1">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" required><br>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br>
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" required><br>
                        </div>
                        <div class="contAñadirEmpleado" id="contAñadirEmpleado2">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required><br>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>
                            <label for="puesto">Puesto:</label>
                            <select id="puesto" name="puesto" required>
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
                    <div id="divbotonAñadirEmpleado">
                        <button type="submit" id="botonAñadirEmpleado" name="botonAñadirEmpleado">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mostrarFormulario').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'flex';
        });

        document.getElementById('cerrarFormulario').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'none';
        });
    </script>
</body>
</html>