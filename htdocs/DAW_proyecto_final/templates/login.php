<div id="access_view" class="out_shadow access_view">
    <!-- TODO Meterle un botón de cerrar la ventana de login/registro -->
    <!-- TODO Hacer un par de tabs para elegir entre productor o comprador -->
    <button onclick='hide_log_reg()'>Cerrar ventana</button>
    <div id="forms">
        <form action="/DAW_proyecto_final/modules/login_logic.php" method="post" id='log_form'>
            <label for="mail">Email:</label>
            <input type="email" name="mail" id="inp_mail">
            <label for="pwd">Contraseña:</label>
            <input type="password" name="pwd" id="pwd">
            <input type="submit" name="submit" value="Enviar">
        </form>
        <div class="log_links">
            <a href="">¿Has olvidado la contraseña?</a>
            <a href="">¿Has olvidado el correo?</a>
            <a onclick="show_register()">¿No tienes cuenta? ¡Regístrate!</a>
        </div>
    </div>
</div>
