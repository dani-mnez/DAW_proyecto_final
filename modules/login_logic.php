<?php
include_once 'classes.php';
include_once 'init_code.php';

// TODO Al iniciar sesión, en cualquier página, se debería redirigir de vuelta a la página en la que se estaba
    // Ej.: Si inicio sesión en la página de shop.php, me redirige a index.php
    // OJO Eso se puede hacer con un fetch que al recibir respuesta elimine el cuadro de login y cambie el menú principal con el menú del usuario

if (isset($_POST['submit'])) {
    $producer = $_POST['user_type'] == 'producer';
    $account = $mongo_db->exec(
        'find_one',
        ($producer) ? 'producers' : 'users',
        ['mail' => $_POST['mail']]
    );

    if ($account) {
        if ($account['password'] == $_POST['pwd']) {
            $_SESSION['user'] = serialize(new User([
                'id' => (string) $account->_id,
                'mail' => $account->mail,
                'name' => $account->name->name,
                'type' => $_POST['user_type'],
                'phone' => $account->phone->default,
                'prof_img' => $account->profile_img
        ]));
            header("Location: ../index.php");
            exit();
        } else {
            echo 'La contraseña es incorrecta';
        }
    } else {
        echo 'El mail introducido es incorrecto';
    }
}
/*
    Si el usuario hace login correctamente:
        - Se crea una clase usuario
            - Puede ser de tipo cliente o proveedor
            - Se añade a $_SESSION
            - Se cambia el usuario de la conexión a la BDD, de forma que solo tenga acceso a sus contenidos

            Si el usuario no puede hacer login correctamente:
        - Se le comunica

        - ¿Has olvidado la contraseña?
            - Se le pide el mail para mandarle correo
        - ¿Has olvidado tu usuario?
            - Se le pide el mail para mandarle correo
        - ¿No estás registrado?
            - Se le lleva al formulario de registro

    Si el usuario NO está registrado:
        - Se le lleva al formulario de registro
            - Es comprador:
                - Se le pedirá (en el mismo formulario):
                    - Nombre
                    - Mail
                    - Contraseña
                    - Edad (vendemos alcohol - vino, cerveza...)(además, viene muy bien para las analíticas)
                - A la hora del pago:
                    - Dirección
                    - Teléfono
                    - ...
            - Es productor:
                - Se le pedirá (en el mismo formulario):
                    - Nombre (público)
                    - Denominación (tal cual aparece en la documentación oficial)(tema de contratos)
                    - Mail
                    - Contraseña
                    - Dirección
                    - NIF/CIF (tema de contratos)
                    - Teléfono/s

                - Dentro de la plataforma:
                    - Productos
                    - etc //TODO Rellnar todo esto bien
*/
