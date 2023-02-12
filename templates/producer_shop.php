<?php include_once(__DIR__ . '/components/header.php'); ?>
<?php
    // Obtenemos la información del productor que sea igual al id pasado por GET
    $producer_info = $mongo_db->exec(
        'find_one',
        'producers',
        ['_id' => new MongoDB\BSON\ObjectId($_GET['producer_id'])]
    );

    // Obtenemos la información de los productos que ofrece el productor
    $producer_products = [];
    $prods_cat = [];
    $featured_products = [];
    foreach ($producer_info['products'] as $prod_id) {
        $product_info = $mongo_db->exec(
            'find_one',
            'products',
            ['_id' => $prod_id]
        );

        // Agregamos toda la información de cada producto al array
        array_push($producer_products, $product_info);

        // Filtramos los productos que han sido destacados por el productor
        if ($product_info->featured) {
            array_push($featured_products, $product_info);
        }

        // Agregamos las categorías de los productos a un array
        array_push($prods_cat, (string) $product_info->category);
    }
    // Dejamos solo las categorías que no se repiten (y ordenadas por número de productos en ellas)
    $prods_cat = array_keys(array_count_values($prods_cat));
?>
            <div id="content">
                <div id="producer_header" >
                    <img src="<?php echo "/DAW_proyecto_final/assets/db_data/users/{$_GET['producer_id']}_cover.jpg"; ?>" alt="Imagen de cabecera del productor">
                </div>
                <nav id="producer_nav">
                    <div id="main_producer_menu">
                        <div id="producer_info">
                            <div id="prod_prof_img">
                                <img src="<?php echo "/DAW_proyecto_final/assets/db_data/users/{$_GET['producer_id']}.jpg"; ?>" alt="Imagen de perfil del productor">
                            </div>
                            <p id="producer_name"><?php echo $producer_info->company_name; ?></p>
                        </div>

                        <div id="product_categories">
                        <?php foreach($prods_cat as $cat_id):
                            $cat_name = $mongo_db->exec(
                                'find_one',
                                'cats',
                                ['_id' => new MongoDB\BSON\ObjectId($cat_id)]
                            )->name;
                            ?>
                            <div class="cat_button">
                                <div class="cat_img">
                                    <img src="/DAW_proyecto_final/assets/icons/<?php echo strtolower($cat_name);?>.svg" alt="Icono de categoría de producto">
                                </div>
                                <p class="cat_name"><?php echo $cat_name; ?></p>
                            </div>
                        <?php endforeach; ?>
                        </div>

                        <div id="producer_search">
                            <input id="prod_search_box" type="search" name="prod_search">
                            <input id="prod_search_btn" type="image" src="/DAW_proyecto_final/assets/icons/search.svg" alt="Icono de búsqueda">
                        </div>
                    </div>
                    <div id="second_producer_menu">
                        <?php if(false):
                            // TODO Hacer la lógica de esto
                            ?>
                            <div class="subcat_button">
                                <div class="subcat_img">
                                    <img src="" alt="Icono de subcategoría de producto">
                                </div>
                                <p class="subcat_name"></p>
                            </div>
                        <?php else: ?>
                            <p>Por implementar</p>
                        <?php endif; ?>
                    </div>
                </nav>
                <div id="producer_shop_products">
                    <?php if (count($featured_products) > 0):?>
                    <div id="featured_products">
                        <h2>Productos destacados</h2>
                        <div class="products">
                            <?php
                            $producer_name = $producer_info->company_name;
                            foreach ($featured_products as $prod) {
                                $subcat = $mongo_db->exec(
                                    'find_one',
                                    'subcats',
                                    ['_id' => $prod['subcat']]
                                )->name;
                                // REV //OJO Crear un componente diferente para esto. No es necesario repetir el vendedor siempre
                                // En el caso de productos en las categorías, tampoco serían necesarias las categorías o subcategorías
                                include(__DIR__ . '/components/shop_product_card.php');
                            }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div id="products">
                        <?php
                        if ($producer_products):
                            foreach ($prods_cat as $cat_id):
                                $filteredProds = array_filter(
                                    $producer_products,
                                    fn($product) => $product['category'] == new MongoDB\BSON\ObjectId($cat_id)
                                );

                                $cat_name = $mongo_db->exec(
                                    'find_one',
                                    'cats',
                                    ['_id' => new MongoDB\BSON\ObjectId($cat_id)]
                                )->name;
                                ?>
                                <div class="prod_cat">
                                    <h2 class="cat_title"><?php echo $cat_name; ?></h2>
                                    <div class="prod_wrapper">
                                    <?php
                                    foreach ($filteredProds as $prod) {
                                        $producer_name = $mongo_db->exec(
                                            'find_one',
                                            'producers',
                                            ['_id' => $prod->producer]
                                        )->company_name;

                                        $subcat = $mongo_db->exec(
                                            'find_one',
                                            'subcats',
                                            ['_id' => $prod->subcat]
                                        )->name;

                                        include(__DIR__ . '/components/shop_product_card.php');
                                    }
                                    ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div id="share_btns">
                        <a href="whatsapp://send?text=¡Mira que bueno!" data-action="share/whatsapp/share" target="_blank">
                            <img src="/DAW_proyecto_final/assets/img/share_wa.webp" alt="Logotipo de Whatapp">
                        </a>
                        <a href="https://www.facebook.com/share.php?u=facebook.com" data-action="share/whatsapp/share" target="_blank">
                            <img src="/DAW_proyecto_final/assets/img/share_fb.webp" alt="Logotipo de Facebook">
                        </a>
                        <a href="https://www.google.com" target="_blank">
                            <img src="/DAW_proyecto_final/assets/img/share_ig.webp" alt="Logotipo de Instagram">
                        </a>
                        <a href="https://www.google.com" target="_blank">
                            <img src="/DAW_proyecto_final/assets/img/share_twit.webp" alt="Logotipo de Twitter">
                        </a>
                    </div>
                </div>
            </div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>
