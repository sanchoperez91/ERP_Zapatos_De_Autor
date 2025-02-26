<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <script >
</script>
</head>
<body>
    
    <div id="contenedorPadre" class="contenedor0">
        
    </div>
    <div id="contenedorDetalle">
        <button id="botonDetalleInventario" class="detalle">DETALLE INVENTARIO</button>
    </div>

    <div>
        <input type="hidden" id="cod_inv" required placeholder="cod_inv" name="cod_inv" value="<?php echo $_GET['cod_inv'];?>"> 
    </div>
    
    

    <div id="overlay" style="display: none;">
    <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirDetalleInventario" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR DETALLE INVENTARIO</h2>
            </div>
            <div id="contEmp2">
            <form id="formularioDetalleInventario" action="#" method="POST">
                <!-- Primer div: Nuevo DetalleInventario -->
                <div id="contNuevaDetalleInventario" class="contDatosForm2">
                    <div class="contAñadir2" id="contAñadirDetalleInventario1">
                        <div class="miniCont">    
                            <label for="cod_inv">Ide Inventario:</label>
                            <input type="text" id="cod_inv" required placeholder="cod_inv" name="cod_inv" class="no_modificable" readonly value="<?php echo $_GET['cod_inv'];?>"> 
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
                                <label for="nom_art">Nombre artículo: </label>
                                <select id="nom_art" name="nom_art" class="opciones_select" class="no_modificable"  required readonly>
                                    <option value="" disabled selected>Seleccione ID artículo</option>
                                <!-- Opciones de ID se cargarán dinámicamente -->
                                </select>
                            </div>
                            <div class="miniCont">   
                                <label for="ideArticulo">Ide Artículo:</label>
                                <input type="text" id="ideArticulo" name="ideArticulo"  class="no_modificable" required readonly><br>
                            </div>
                            <div class="miniCont">
                                <label for="can_art">Cantidad:</label>
                                <input type="number" id="can_art" name="can_art" min="1" required><br>
                            </div>                            
                        </div>
                        <div class="contAñadir2" id="contAñadirDetalleInventario3">
                            <div id="divBotonAñadirArticuloDetalleInventario" class="divBotonMateria">
                                <button type="button" id="botonAñadirArticuloDetalleInventario" class="botonAñadirArt" name="divBotonAñadirMateriaEscandallo">+ Artículo</button>
                            </div>
                        </div>
                    <div id="divBotonAñadirDetalleInventario" class="divBotonAñadir">
                        
                        <button type="submit" id="botonAñadirDetalleInventario" class="botonAñadir" name="botonAñadirDetalleInventario">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>