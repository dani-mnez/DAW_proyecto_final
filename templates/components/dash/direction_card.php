<div class="dir_card <?php if ($user_dir->default_location) {echo "def_loc";} ?>">
    <p class="dir_name">
        <span><?php echo "{$user_data->name->name} {$user_data->name->surname1} {$user_data->name->surname2}, "?></span>

    <?php
    $cosa = (array) $user_dir;
    unset($cosa['_id']);
    unset($cosa['default_location']);

    $dataString = implode(', ', $cosa);
    echo $dataString;
    ?></p>
    <a href="">Añadir instrucciones de entrega</a>

    <a href="">Modificar</a>
    <a href="">Eliminar</a>
    <?php if(!$user_dir->default_location): ?>
        <a href="">Marcar como predeterminado</a>
    <?php endif; ?>
</div>
