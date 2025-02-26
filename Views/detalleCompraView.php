
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <script>
    
    </script>
</head>
<body>
    
    <div id="contenedorPadre" class="contenedor0">
        
    </div>
    <div id="contenedorDetalle">
        <button id="botonDetalleCompra" class="detalle">DETALLE FACTURA COMPRA</button>
    </div>
    
    <div>
        <input type="hidden" id="idNumCom" required placeholder="num_com" name="idNumCom" value="<?php echo $_GET['num_com'];?>"> 
    </div>
    
    

    <div id="overlay" style="display: none;">
    <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirDetalleCompra" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR DETALLE DE FACTURA DE COMPRA</h2>
            </div>
            <div id="contEmp2">
            <form id="formularioDetalleCompra" action="#" method="POST">
                <!-- Primer div: Nuevo DetalleCompra -->
                <div id="contNuevaDetalleCompra" class="contDatosForm2">
                    <div class="contAñadir2" id="contAñadirDetalleCompra1">
                        <div class="miniCont">    
                            <label for="num_com">Número propio de factura:</label>
                            <input type="text" id="idNumCom" required placeholder="num_com" name="idNumCom" class="no_modificable" readonly value="<?php echo $_GET['num_com'];?>"> 
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
                                <label for="can_art">Cantidad:</label>
                                <input type="number" id="can_art" name="can_art" min="1" required><br>
                            </div>
                            <div class="miniCont">
                                <label for="imp_dco">Importe:</label>
                                <input type="number" id="imp_dco" name="imp_dco" min="0.01" step="0.01"required><br>
                            </div>
                            
                        </div>
                        <div class="contAñadir2" id="contAñadirDetalleCompra3">
                            <div id="divBotonAñadirArticuloDetalleCompra" class="divBotonMateria">
                                <button type="button" id="botonAñadirArticuloDetalleCompra" class="botonAñadirArt" name="divBotonAñadirMateriaEscandallo">+ Artículo</button>
                            </div>
                        </div>
                    <div id="divBotonAñadirDetalleCompra" class="divBotonAñadir">
                        
                        <button type="submit" id="botonAñadirDetalleCompra" class="botonAñadir" name="botonAñadirDetalleCompra">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>