<?php
    include_once('../modules/classes.php');
    session_start();

    // Lógica de la llamada GET para obtener todos los datos
    $prod_data;
    if (isset($_GET['id'])) {
        $db_access = unserialize($_SESSION['db_acc']);
        $prod_data = $db_access->execQuery('prod_detail', [$_GET['id']])[0];
    }
?>

<!-- TODO Hay que cambiar la tabla PRODUCTS para añadir más imágenes, no sé si modificar prod_img_name para que se puedan meter más o cambiarle el nombre a `prod_cover_img` y crear otro campo para poner el resto de nombres del mismo modo que  como se hace con las direcciones (estilo CSV) -->

<?php require_once('../templates/header.php'); ?>
            <div id="content">
                <?php //print_r($prod_data) ?>
                <div id="product_wrap">
                    <div id="product_info">
                        <div id="imgs_viewer">
                            <!-- TODO Crear el visor de fotos, de momento solo la imagen principal -->
                            <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod_data['prod_img_name'] ?>" alt="">
                        </div>
                        <div id="text_data">
                            <span class="product_name"><?php echo $prod_data['name'] ?></span>
                            <a class="producer_name">Ir a la página de: NOMBRE DE PROVEEDOR</a>
                            <div class="rate">
                                <div class="stars">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2560px-5_stars.svg.png" alt="Rate">
                                </div>
                                <span>437 valoraciones</span>
                            </div>
                            <div class="price">
                                <span class='discount'>-5%</span>
                                <span><?php echo $prod_data['price'] ?></span>
                            </div>
                            <span class="descript"><?php echo $prod_data['description'] ?></span>
                            <div class="similar">
                                <div class="sim_prod">
                                    <img src="https://picsum.photos/200/200" alt="">
                                    <a href="">Producto relacionado</a>
                                    <div class="sim_prod_rate">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2560px-5_stars.svg.png" alt="">
                                        <a href="">(345)</a>
                                        <span>EUR 13euro</span>
                                    </div>
                                </div>
                                <div class="sim_prod">
                                    <img src="https://picsum.photos/200/200" alt="">
                                    <a href="">Producto relacionado</a>
                                    <div class="sim_prod_rate">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2560px-5_stars.svg.png" alt="">
                                        <a href="">(345)</a>
                                        <span>EUR 13euro</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ratings"></div>
                </div>
                <div id="side_menu"></div>
            </div>
<?php require_once('../templates/footer.php'); ?>
