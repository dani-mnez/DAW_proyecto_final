<?php
include_once(__DIR__ . '/classes.php');

session_start();
$suported_mimetypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/webp'];

if (isset($_POST['reg_submit'])) {
    // ¿Existe el usuario en la BBDD?
    $db_access = unserialize($_SESSION['db_acc']);
    $account = $db_access->execQuery('chk_created_user', [$_POST['mail']]);

    if ($account) {
        echo "Ya hay un usuario usando ese email";
    } else {
        // ¿La contraseña y la repetición de la contraseña coinciden?
        if ($_POST['pwd'] == $_POST['pwd_chck']) {

            // print_r($_FILES['profile_img']);

            // ¿Se ha subido una imagen?
            if ($_FILES['profile_img']) {
                // Comprobamos si el tamaño, las dimensiones y la extensión son adecuados
                $SIZE_LIMIT = 40000;  // 40Mb (por poner un valor) // OJO Se puede hacer una variable global
                $is_correct_format = in_array($_FILES['profile_img']['type'], $suported_mimetypes);

                // Esto no es necesario en principio
                    // Será menos necesario cuando se implemente el recortador de imagen
                $image_info = getimagesize($_FILES['profile_img']['tmp_name']);
                $is_squared = ($image_info[0] / $image_info[1]) == 1;

                // print_r($image_info);

                if ($is_correct_format && $_FILES['profile_img']['size'] < $SIZE_LIMIT) {
                    // TODO Se puede obviar el formato de la imagen haciendo un preprocesamiento en la parte
                    // cliente con JS y una normalización en la parte PHP
                        // TODO se pueden hacer comprabaciones de peso (introducir un compresor de imágenes)
                        // y proporciones (crear un recortador de la imagen con previsualización)
                        // OJO Esto se puede mejorar mucho con un sistema de conversión de imagenes (imagewebp)
                        // - https://www.php.net/manual/en/function.imagewebp.php

                    $img_obj = match ($_FILES['profile_img']['type']) {
                        'image/jpeg' => imagecreatefromjpeg($_FILES['profile_img']['tmp_name']),
                        'image/gif' => imagecreatefromgif($_FILES['profile_img']['tmp_name']),
                        'image/png' => imagecreatefrompng($_FILES['profile_img']['tmp_name']),
                        'image/bmp' => imagecreatefrombmp($_FILES['profile_img']['tmp_name']),
                        'image/webp' => imagecreatefromwebp($_FILES['profile_img']['tmp_name'])
                    };

                    // $croped_img = imagecrop($img_obj,
                    // $OJO_AQUI_VAN_LOS_DATOS_DEL_RECORTADOR_DEL_FRONTEND  // TODO
                    // );


                    // Se sube la imagen a la carpeta destino
                    $target_dir = '../assets/db_data/users/';
                    $adapted_name = str_replace(['@', '.'], '_', $_POST['mail']);
                    $target_name = "${adapted_name}_prof.webp";
                    $target_path = $target_dir . $target_name;

                    // print_r([$target_dir, $adapted_name, $target_name, $target_path]);

                    // Escalamos la imagen, preservando el ratio (cuadrado)
                    $scaled_img = imagescale($img_obj, 256);

                    // Guardamos la imagen final e imprimimos confirmación
                    if (imagewebp($scaled_img, $target_path)) {
                        echo "WOWERS - IMAGEN SUBIDA";
                    }

                    // No haría falta revisar si ya existe el fichero (porque antes saltaría el aviso de que la cuenta ya existe)


                } else {
                    echo 'La imagen no tiene el formato requerido';
                }
            }

            // Se manda el mail con el link de confirmación
            $random_confirm_code = random_bytes(16);
            // La lógica es crear un código único de confirmación para cada usuario del estilo:
                // https://soldemarzo.com/activate_logic.php?email=XXXXXX&activation_code=XXXXXXX

            // OJO Todo esto se debe configurar en un servidor (en local debería instalarme el módulo sendmail)
                // Eso sería borrar todo XAMPP y reinstalarlo
                // TODO Hacerlo más adelante
            // $from = ;
            // $to = 'soldemarzo@proton.me';
            // $message = ;
            // $headers = ;

            // mail($to, $subject, $message, $headers);



            // Se escribe la información sobre el nuevo usuario en la BBDD (en la tabla temp_users)
            $db_access->execQuery('insert_new_user', [$_POST['mail'], $_POST['pwd'], $_POST['name'], $target_name], $random_confirm_code);

            //OJO Esto no sería necesario si no salimos de home porque estamos en un popup de registro (??)
            // header("Location: ./login.php");
            // exit();

            //TODO Hacer echo de mensaje de aviso "Te llegará un mail para la confirmación de tu cuenta"
        } else {
            echo 'Las contraseñas no coinciden';
        }
    }
}
