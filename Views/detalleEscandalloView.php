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
        <button id="botonDetalleEscandallo" class="detalle">DETALLE ESCANDALLO</button>
    </div>
    
    <div>
        <input type="hidden" id="ide_esc" required placeholder="ide_esc" name="ide_esc" value="<?php echo $_GET['ide_esc'];?>"> 
    </div>

    <div id="overlay" style="display: none;">
    <div class="forminsercion">
            <button class="close-btn" id="cerrarFormulario">&times;</button>
            <div id="tituloAñadirDetalleEscandallo" class="divTituloAñadir">
                <h2 class="tituloAñadir">AÑADIR DETALLE DE ESCANDALLO</h2>
            </div>
            <div id="contEmp2">
            <form id="formularioDetalleEscandallo" action="#" method="POST">
                <!-- Primer div: Nuevo DetalleEscandallo -->
                <div id="contNuevaDetalleEscandallo" class="contDatosForm2">
                    <div class="contAñadir2" id="contAñadirDetalleEscandallo1">
                        <div class="miniCont">    
                            <label for="ide_esc">Ide Escandallo:</label>
                            <input type="text" id="ide_esc" required placeholder="ide_esc" name="ide_esc" class="no_modificable" readonly value="<?php echo $_GET['ide_esc'];?>">
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
                            
                            
                        </div>
                        <div class="contAñadir2" id="contAñadirDetalleEscandallo3">
                            <div id="divBotonAñadirArticuloDetalleEscandallo" class="divBotonMateria">
                                <button type="button" id="botonAñadirArticuloDetalleEscandallo" class="botonAñadirArt" name="divBotonAñadirMateriaEscandallo">+ Artículo</button>
                            </div>
                        </div>
                    <div id="divBotonAñadirDetalleEscandallo" class="divBotonAñadir">
                        
                        <button type="submit" id="botonAñadirDetalleEscandallo" class="botonAñadir" name="botonAñadirDetalleEscandallo">Guardar</button>
                    </div>
                    <div id="divRespuesta"> </div>
                </form>

            </div>
        </div>
    </div>
</body>
