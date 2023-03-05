<?php include_once(__DIR__ . '/../header.php'); ?>
    <div id="content">
        <h1>Empiece a vender</h1>
        <p>Para ayudarte a sacar el mejor partido a nuestra plataforma, necesitamos la información de este formulario.</p>
        <fieldset id="producer_registration">
            <legend>Rellena el formulario y te contactaremos para completar el alta:</legend>
            <form action="./modules/producer_register_logic.php" enctype='multipart/form-data' method="post" id='reg_form'>
                <label for="profile_img">Sube una foto de perfil:</label>
                <br/>
                <input type="file" name="profile_img" id="reg_profile_img">
                <br/>
                <label for="name">Nombre:</label>
                <input require type="text" name="name" id="reg_text">
                <br/>
                <label for="mail">Email:</label>
                <input require type="email" name="mail" id="reg_mail">
                <br/>
                <label for="pwd">Contraseña:</label>
                <input require type="password" name="pwd" id="reg_pwd">
                <br/>
                <label for="pwd_chck">Repite la contraseña:</label>
                <input require type="password" name="pwd_chck" id="reg_pwd_chk">
                <br/>
                <label for="company_name">Nombre de la compañía:</label>
                <input require type="text" name="company_name" id="reg_company_name">
                <br/>
                <label for="telephone">Teléfono de contacto:</label>
                <input require type="integer" name="telephone" id="reg_telephone">
                <br/>
                <label for="xxx">XXXX:</label>
                <input require type="integer" name="xxx" id="reg_xxx">
                <br/>
                <input type="submit" name="reg_submit" value="Confirma petición de registro">
            </form>
        </fieldset>
    </div>
<?php include_once(__DIR__ . '/../footer.php'); ?>