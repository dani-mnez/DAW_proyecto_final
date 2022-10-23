<form action="./modules/register_logic.php" enctype='multipart/form-data' method="post" id='reg_form'>
    <label for="profile_img">Sube una foto de perfil:</label>
    <input type="file" name="profile_img" id="reg_profile_img">
    <label for="name">Nombre:</label>
    <input require type="text" name="name" id="reg_text">
    <label for="mail">Email:</label>
    <input require type="email" name="mail" id="reg_mail">
    <label for="pwd">Contraseña:</label>
    <input require type="password" name="pwd" id="reg_pwd">
    <label for="pwd_chck">Repite la contraseña:</label>
    <input require type="password" name="pwd_chck" id="reg_pwd_chk">
    <input type="submit" name="reg_submit" value="¡Regístrate!">
</form>
