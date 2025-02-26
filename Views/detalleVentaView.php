<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <script defer>
    
    </script>
</head>
<body>
    
    <div id="contenedorPadre" class="contenedor0">
        
    </div>
    <div id="contenedorDetalle">
        <button id="botonDetalleVenta" class="detalle">DETALLE FACTURA VENTA</button>
    </div>
    
    <div>
        <input type="hidden" id="idNumVen" required placeholder="num_ven" name="idNumVen" value="<?php echo $_GET['num_ven'];?>"> 
    </div>

    <div id="overlay" style="display: none;">
    <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirDetalleVenta" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR DETALLE DE FACTURA DE VENTA</h2>
            </div>
            <div id="contEmp2">
            <form id="formularioDetalleVenta" action="#" method="POST">
                <!-- Primer div: Nuevo DetalleVenta -->
                <div id="contNuevaDetalleVenta" class="contDatosForm2">
                    <div class="contAñadir2" id="contAñadirDetalleVenta1">
                        <div class="miniCont">    
                            <label for="num_ven">Número propio de factura:</label>
                            <input type="text" id="idNumVen" required placeholder="num_ven" name="idNumVen" class="no_modificable" readonly value="<?php echo $_GET['num_ven'];?>"> 
                                <option value="" disabled selected></option>
                            <!-- Opciones de factura se cargarán dinámicamente -->
                            </select><br>
                        </div>
                    </div>
                </div>
                <!--    SEGUNDO CONTENEDOR DATOS DE ARTICULOS -->
                <h1 class="titulosFormEscandallo">ARTÍCULOS</h1>
                        <div class="contAñadir2 contMateria">
                            <div class="miniCont">   
                                <label for="ideArticulo">Ide Artículo:</label>
                                <select id="ideArticulo" name="ideArticulo" class="opciones_select" required>
                                    <option value="" disabled selected>Seleccione ID artículo</option>
                                <!-- Opciones de ID se cargarán dinámicamente -->
                                </select>
                            </div>
                            <div class="miniCont">
                                <label for="nom_art">Nombre artículo: </label>
                                <input type="text" id="nom_art" name="nom_art" class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont">
                                <label for="imp_art">Importe unitario:</label>
                                <input type="number" id="imp_art" name="imp_art" required ><br>
                            </div>
                            <div class="miniCont">
                                <label for="can_art">Cantidad:</label>
                                <input type="number" id="can_art" name="can_art" min="1" required><br>
                            </div>
                            
                            
                        </div>
                        <div class="contAñadir2" id="contAñadirDetalleVenta3">
                            <div id="divBotonAñadirArticuloDetalleVenta" class="divBotonMateria">
                                <button type="button" id="botonAñadirArticuloDetalleVenta" class="botonAñadirArt" name="divBotonAñadirMateriaEscandallo">+ Artículo</button>
                            </div>
                        </div>
                    <div id="divBotonAñadirDetalleVenta" class="divBotonAñadir">
                        
                        <button type="submit" id="botonAñadirDetalleVenta" class="botonAñadir" name="botonAñadirDetalleVenta">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>