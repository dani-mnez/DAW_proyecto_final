<div id="access_view" class="out_shadow access_view">
    <img id="close_access_view" src="/DAW_proyecto_final/assets/icons/x.svg" alt="Cerrar ventana">
    <div id="forms">
        <form action="/DAW_proyecto_final/modules/login_logic.php" method="post" id='log_form'>
            <fieldset id="login_user_type_select">
                <div class="btn_user_type">
                    <input type="radio" name="user_type" value="buyer" id="log_buyer" checked>
                    <label for="log_buyer">Quiero comprar</label>
                </div>
                <div class="btn_user_type">
                    <input type="radio" name="user_type" value="producer" id="log_producer">
                    <label for="log_producer">Quiero vender</label>
                </div>
            </fieldset>

            <div id="log_mail_wrapper">
                <label for="mail">Email*</label>
                <input type="email" name="mail" id="inp_mail" placeholder="tu@email.com">
            </div>

            <div id="log_pwd_wrapper">
                <label for="inp_pwd">Contraseña*</label>
                <input type="password" name="pwd" id="inp_pwd" placeholder="8+ caracteres">
            </div>

            <div id="log_links">
                <a href="">¿Has olvidado la contraseña?</a>
                <a href="">¿Has olvidado el correo?</a>
                <a id="reg_btn">¿No tienes cuenta? ¡Regístrate!</a>
            </div>
            <input id="log_submit" type="submit" name="submit" value="Enviar">
        </form>
    </div>
</div>
