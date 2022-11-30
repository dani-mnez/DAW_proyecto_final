<?php require_once('../templates/header.php');
    // Lógica de la llamada GET para obtener todos los datos
    if (isset($_GET['id'])) {
        $product = $mongo_db->exec(
            'find_one',
            'products',
            // OJO Para seleccionar un objeto por su ID, ha de crearse primero un objeto BSON de tipo ObjectId
            ['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]
        );
    }
?>
            <div id="content">
                <div id="product_wrap">
                    <div id="product_info">
                        <div id="imgs_viewer">
                            <!-- TODO Crear el visor de fotos, de momento solo la imagen principal -->
                            <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $product['prod_img_name'] ?>" alt="">
                        </div>
                        <div id="text_data">
                            <span class="product_name"><?php echo $product['name'] ?></span>
                            <a class="producer_name">Ir a la página de: NOMBRE DE PROVEEDOR</a>
                            <div class="rate">
                                <div class="stars">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2560px-5_stars.svg.png" alt="Rate">
                                </div>
                                <span>437 valoraciones</span>
                            </div>
                            <div class="price">
                                <span class='discount'>-5%</span>
                                <span><?php echo $product['price'] ?></span>
                            </div>
                            <span class="descript"><?php echo $product['description'] ?></span>
                            <div class="similar">
                                <div class="sim_prod">
                                    <img src="https://picsum.photos/200/200" alt="">
                                    <a href="">Producto relacionado</a>
                                    <div class="sim_prod_rate">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2560px-5_stars.svg.png" alt="">
                                        <a href="">(345)</a>
                                        <span>EUR 13€</span>
                                    </div>
                                </div>
                                <div class="sim_prod">
                                    <img src="https://picsum.photos/200/200" alt="">
                                    <a href="">Producto relacionado</a>
                                    <div class="sim_prod_rate">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2560px-5_stars.svg.png" alt="">
                                        <a href="">(345)</a>
                                        <span>EUR 13€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ratings"></div>
                </div>
                <div id="cat_shop_menu"></div>
            </div>
<?php require_once('../templates/footer.php'); ?>
