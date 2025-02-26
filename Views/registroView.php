<div id="cont1" class="cont1">
    <div id="logo" class="logo">
        <img id="imglogo" src="Assets/img/logo_zapatos.png" style="border: 5px solid #593609; opacity:1">
    </div>

    <div id="contCuadroRegistro" class="contRegistro">
        <div id="tituloRegistro">Zapatos de Autor</div>
        
        <div id="contRegistro">
            <div id="iconoRegistro">
                <img id="imgUsuario1" src="Assets/img/usuario.png"/>
            </div>
            <form id="formRegistro" onsubmit="event.preventDefault(); confirmarRegistro();">
                <div id="contUsuario">
                    <div id="imgUsuario"><img src="Assets/img/imgUsuario.png"/></div>
                    <div id="inputUsuario"><input id="inputDni" name="inputDni" type="text" placeholder="Introduzca DNI"></div>
                </div>
                <div id="contContraseña">
                    <div id="imgContraseña"><img src="Assets/img/candado.png"/></div>
                    <div id="inputContraseña"><input id="inputContra" name="inputContra" type="password" placeholder="Introduzca contraseña"></div>
                </div>
                <div id="botonInicio">
                    <button type="submit" id="botonRegistro">Iniciar Sesión</button>
                </div>

            </form>

        </div>
    </div>
</div>
