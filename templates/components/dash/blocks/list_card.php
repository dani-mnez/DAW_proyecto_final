<div class="list_card">
    <!-- TODO Al clicar en la imagen, debe redirigir a la página del producto -->
    <!-- TODO Crear funcionalidad de los botones MOVER A LA CESTA, ELIMINAR y VER PRODUCTOS SIMILARES -->
    <div class="list_card_info">
        <div class="list_img_wrapper">
            <?php
            $is_std = ($list_key == "desired_prods" || $list_key == "saved_prods");

            $list_name = match ($list_key) {
                "desired_prods" => "Mis deseados",
                "saved_prods" => "Para más tarde",
                default => $list_data->title
            };

            if (count($list_data->prods) > 0):
            // TODO Que primero se impriman las listas obligatorias: DESIRED y SAVED FOR LATER, luego las creadas por el usuario
                foreach ($list_data->prods as $prod_id):
                    $img = $mongo_db->exec(
                        'find_one',
                        'products',
                        ['_id' => $prod_id]
                    )->imgs->cover;
                ?>
                    <img src="<?php echo "/DAW_proyecto_final/assets/db_data/products/$img.jpg" ?>" alt="Imagen de producto">
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aún no has añadido ningún producto a esta lista</p>
            <?php endif; ?>
        </div>
        <p class="list_name"><?php echo $list_name ?></p>
        <?php if(!$is_std): ?>
            <p class="list_desc"><?php echo $list_data->description ?></p>
        <?php endif;?>
    </div>

    <div class="list_card_cta">
        <a href="<?php echo "/DAW_proyecto_final/templates/dashboard.php?page=lists&list=$list_key"?>" class="mod_list">Modificar</a>
        <?php if(!$is_std): ?>
            <a href="" class="del_list">Eliminar</a>
        <?php endif;?>
    </div>
</div>
