<div id="contact">
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
                <td data-field="name"><?php echo "{$user_data->name->name} {$user_data->name->surname1} {$user_data->name->surname2}" ?></td>
                <td class="profile_edit_btns">
                    <button>Editar</button>
                    <button class="hidden">Aceptar</button>
                    <button class="hidden">Cancelar</button>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td data-field="mail"><?php echo $user_data->mail ?></td>
                <td class="profile_edit_btns">
                    <button>Editar</button>
                    <button class="hidden">Aceptar</button>
                    <button class="hidden">Cancelar</button>
                </td>
            </tr>
            <tr>
                <td>Teléfono:</td>
                <td data-field="phone"><?php echo $user_data->phone->default ?></td>
                <td class="profile_edit_btns">
                    <button>Editar</button>
                    <button class="hidden">Aceptar</button>
                    <button class="hidden">Cancelar</button>
                </td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td data-field="pwd">********</td>
                <td class="profile_edit_btns">
                    <button>Editar</button>
                    <button class="hidden">Aceptar</button>
                    <button class="hidden">Cancelar</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php if ($user->type == "producer") : ?>

    <div id="direction">
        <h2>Tu dirección</h2>
        <table>
            <?php
            $user_dir = $mongo_db->exec(
                'find_one',
                'addresses',
                ['_id' => $user_data->address[0]]
            );
            unset($user_dir['_id']);
            unset($user_dir['default_location']);

            foreach ($user_dir as $add_field => $value) :
                $nombre_campo = match ($add_field) {
                    "type" => "Tipo de vía:",
                    "name" => "Nombre largo de vía:",
                    "number" => "Número de vía:",
                    "block" => "Bloque:",
                    "portal" => "Portal:",
                    "stair" => "Escalera:",
                    "floor" => "Planta / piso:",
                    "door" => "Puerta:",
                    "pc" => "Código postal:",
                    "town" => "Localidad:",
                    "city" => "Municipio:",
                    "ac" => "Provincia:",
                    "country" => "País:",
                    "additional_info" => "Información adicional:",
                    default => null
                };
            ?>
                <tr>
                    <td><?php echo $nombre_campo; ?></td>
                    <td><?php echo $value; ?></td>
                    <td><button>Editar</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div id="fiscal_info">
        <h2>Información fiscal</h2>
        <table>
            <?php
            $fiscal_info = $mongo_db->exec(
                'find_one',
                'addresses',
                ['_id' => $user_data->address[0]]
            );
            unset($user_dir['_id']);
            unset($user_dir['default_location']);

            foreach ($user_dir as $add_field => $value) :
                $nombre_campo = match ($add_field) {
                    "type" => "Tipo de vía:",
                    "name" => "Nombre largo de vía:",
                    "number" => "Número de vía:",
                    "block" => "Bloque:",
                    "portal" => "Portal:",
                    "stair" => "Escalera:",
                    "floor" => "Planta / piso:",
                    "door" => "Puerta:",
                    "pc" => "Código postal:",
                    "town" => "Localidad:",
                    "city" => "Municipio:",
                    "ac" => "Provincia:",
                    "country" => "País:",
                    "additional_info" => "Información adicional:",
                    default => null
                };
            ?>
                <tr>
                    <td><?php echo $nombre_campo; ?></td>
                    <td><?php echo $value; ?></td>
                    <td><button>Editar</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php else : ?>

    <div id="res_directions">
        <h2>Tus direcciones</h2>
        <div id="directions_wrapper">
            <?php
            foreach ($user_data->address as $address) {
                $user_dir = $mongo_db->exec(
                    'find_one',
                    'addresses',
                    ['_id' => $address]
                );

                require(__DIR__ . '/../blocks/direction_card.php');
            }
            ?>
            <div id="new_dir">
                <img src="/DAW_proyecto_final/assets/icons/add.svg" alt="Añadir dirección">
                <span>Añadir nueva dirección</span>
            </div>
        </div>
    </div>
<?php endif; ?>