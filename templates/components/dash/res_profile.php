<div id="res_prof">
    <h1>Perfil</h1>

    <div id="res_contact">
        <h2>Datos de contacto</h2>
        <div id="contact_data">
            <div id="img_wrapper">
                <img src="<?php echo "/DAW_proyecto_final/assets/db_data/users/$user_data->_id.jpg" ?>" alt="Imagen de perfil">
                <div id="img_button">
                    <span>Cambiar imagen</span>
                    <img src="/DAW_proyecto_final/assets/icons/edit.svg" alt="Lápiz">
                </div>
            </div>
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo "{$user_data->name->name} {$user_data->name->surname1} {$user_data->name->surname2}" ?></td>
                    <td><button>Editar</button></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $user_data->mail ?></td>
                    <td><button>Editar</button></td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td><?php echo $user_data->phone->default ?></td>
                    <td><button>Editar</button></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td>********</td>
                    <td><button>Editar</button></td>
                </tr>
            </table>
        </div>
    </div>

    <div id="res_directions">
        <h2>Tus direcciones</h2>
        <div id="directions_wrapper">
            <?php
            foreach ($user_data->address as $address) {
                $user_dir = $mongo_db->exec(
                    'find_one',
                    'addresses',
                    ['_id'=> $address]
                );

                require(__DIR__ .'/direction_card.php');
            }
            ?>
            <div id="new_dir">
                <img src="/DAW_proyecto_final/assets/icons/add.svg" alt="Añadir dirección">
                <span>Añadir nueva dirección</span>
            </div>
        </div>
    </div>
</div>
