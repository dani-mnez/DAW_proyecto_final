<?php
// De momento no he encontrado forma mejor que la de crear una instancia de la calse que maneja la BDD mediante la inclusión de init_code.php
// Intenté hacerlo pasando la clase mediante fetch POST, pero al no poder serializarse, daba error
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

// TODO Al iniciar sesión, en cualquier página, se debería redirigir de vuelta a la página en la que se estaba
    // Ej.: Si inicio sesión en la página de shop.php, me redirige a index.php
    // OJO Eso se puede hacer con un fetch que al recibir respuesta elimine el cuadro de login y cambie el menú principal con el menú del usuario

if (isset($_POST['submit'])) {
    $account = $mongo_db->exec(
        'find_one',
        'users',
        ['mail' => $_POST['mail']]
    );

    if ($account) {
        if ($account['password'] == $_POST['pwd']) {
            $_SESSION['user'] = serialize(new User([
               'mail' => $account['mail'],
               'name' => $account['name'],
               'type' => 'comp',
               'phone' => $account['phone']
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
