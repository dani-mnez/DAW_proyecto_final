<?php include_once(__DIR__ . '/header.php'); ?>
            <?php include_once(__DIR__ . '/side_menu.php'); ?>
            <div id="content">
                <div id="shop_filters"></div>
                <div id="products">
                    <?php
                        $results = $db_access->execQuery('all_prods', null);

                        if($results):
                            foreach ($results as $key => $value):
                    ?>
                        <div class="product">
                            <div class="product_img_wrapper">
                                <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $value['prod_img_name'] ?>" alt="">
                                <div class="buttons">
                                    <a onclick="like_product(<?php echo $value['id'] ?>)" class="like_btn"><img src="/DAW_proyecto_final/assets/icons/fav.svg" alt=""></a>
                                    <a onclick="add_product_cart(<?php echo $value['id'] ?>)" class="add_cart_btn"><img src="/DAW_proyecto_final/assets/icons/add_cart.svg" alt=""></a>
                                </div>
                            </div>
                            <p class='name'><?php echo $value['name'] ?></p>
                            <p class='description'><?php echo $value['description'] ?></p>
                            <!-- Esto en realidad debería de ser una SUB-categoría (ej.: queso viejo, queso curado...) -->
                            <p class="category"><?php echo $value['type'] ?></p>
                            <p class="price"><?php echo $value['price'] ?><span>€</span></p>
                            <!-- Esto de aquí arriba no sé si ponerlo visible o que en la parte de abajo de cada producto se vea una franja informativa cuando queden pocas unidades, o directamente, siempre una barra que indique: quedan X del total 'corre y compra' -->
                            <span class="quantity"><?php echo $value['qty'] ?></span>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
<?php include_once(__DIR__ . '/footer.php'); ?>
