<?php
include_once('./modules/classes.php');
session_start();
$suported_mimetypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/tiff', 'image/webp'];

if (isset($_POST['reg_submit'])) {

    // TODO se pueden hacer comprabaciones de peso (introducir un compresor de imágenes) y proporciones (crear un recortador de la imagen con previsualización)
    // Si las 2 contraseñas introducidas coinciden
    if ($_POST['pwd'] == $_POST['pwd_chck']) {

        // Si el tipo de imagen subida es compatible con las que hemos definido arriba
        if (in_array($_FILES['type'], $suported_mimetypes) ) {
            $db_access = unserialize($_SESSION['db_acc']);

            $account = $db_access->execQuery("SELECT * FROM users WHERE mail='{$_POST['mail']}'");

            if ($account->num_rows == 0) {
                // Se sube la imagen a la carpeta destino
                $target_dir = 'assets/db_data/users';
                $adapted_name = str_replace('@', '_', $_POST['mail'], 1);
                $target_name = "${adapted_name}_profile"; // REV Esto no incluye la extensión
                // TODO se puede meter un conversor de imagenes (a webp, por ejemplo)
                // TODO revisar que el fichero no exista áun
                // TODO terminar esto

                print_r($_FILES);

                // Se escribe la información sobre el nuevo usuario
                $db_access->execQuery("INSERT INTO users (mail, password, name) VALUES ('{$_POST['mail']}', '{$_POST['pwd']}', '{$_POST['name']}')");
                header("Location: ./login.php");  //OJO Esto no sería necesario si no salimos de home porque estamos en un popup de registro (??)
                exit();
            } else {
                echo "Ya hay un usuario usando ese email";
            }
        } else {
            echo 'La imagen no tiene el formato requerido';
        }
    } else {
        echo 'Las contraseñas no coinciden';
    }
}
