<div id="access_view" class="out_shadow access_view">
    <!-- TODO Hacer un par de tabs para elegir entre productor o comprador -->
    <img id="close_access_view" src="/DAW_proyecto_final/assets/icons/x.svg" alt="Cerrar ventana">
    <div id="forms">
        <form action="/DAW_proyecto_final/modules/login_logic.php" method="post" id='log_form'>
            <ul>
                <li>
                    <input type="radio" name="user_type" id="log_buyer">
                    <label for="buyer">Quiero comprar</label>
                </li>
                <li>
                    <input type="radio" name="user_type" id="log_producer">
                    <label for="producer">Quiero vender</label>
                </li>
            </ul>
            <label for="mail">Email:</label>
            <input type="email" name="mail" id="inp_mail">
            <label for="pwd">Contraseña:</label>
            <input type="password" name="pwd" id="pwd">
            <input type="submit" name="submit" value="Enviar">
        </form>
        <div class="log_links">
            <a href="">¿Has olvidado la contraseña?</a>
            <a href="">¿Has olvidado el correo?</a>
            <a id="reg_btn">¿No tienes cuenta? ¡Regístrate!</a>
        </div>
    </div>
</div>
