<?php
// Incluímos el archivo para poder usar $sb_access (clase DBAccess)
// Este include va antes del sessión_start para que pueda leer la clase que debe tener almacenada en la sesión
include_once('../modules/classes.php');

// Iniciamos la sesión
session_start();


if (isset($_POST['submit'])) {
    $db_access = unserialize($_SESSION['db_acc']);

    $account = $db_access->execQuery("SELECT * FROM users WHERE mail='{$_POST['mail']}'");

    if ($account->num_rows == 0) {
        echo 'El mail instroducido es incorrecto';
    } else {
        $acc_info = $account->fetch_assoc();

        if ($acc_info['password'] == $_POST['pwd']) {
            $_SESSION['user'] = serialize(new Buyer($acc_info));
            header("Location: ../index.php");
            exit();
        } else {
            echo 'La contraseña es incorrecta';
        }
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
