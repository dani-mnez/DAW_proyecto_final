<form action="./modules/register_logic.php" enctype='multipart/form-data' method="post" id='reg_form'>
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
    <label for="profile_img">Sube una foto de perfil:</label>
    <input type="file" name="profile_img" id="reg_profile_img">
    <label for="name">Nombre:</label>
    <input require type="text" name="surname1" id="reg_name">
    <label for="surname1">Primer apellido:</label>
    <input require type="text" name="surname2" id="reg_sur1">
    <label for="surname2">Segundo apellido:</label>
    <input require type="text" name="name" id="reg_sur2">
    <label for="mail">Email:</label>
    <input require type="email" name="mail" id="reg_mail">
    <label for="pwd">Contraseña:</label>
    <input require type="password" name="pwd" id="reg_pwd">
    <label for="pwd_chck">Repite la contraseña:</label>
    <input require type="password" name="pwd_chck" id="reg_pwd_chk">
    <input type="submit" name="reg_submit" value="¡Regístrate!">
</form>