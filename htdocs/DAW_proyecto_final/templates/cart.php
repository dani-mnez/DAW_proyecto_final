<?php include_once(__DIR__ . '/header.php'); ?>
            <div id="content">
                <div id="cart_items">
                    <?php
                        $user = unserialize($_SESSION['user'])->mail;
                        $results = $db_access->execQuery('cart_prods', [$user]);

                        if($results):
                            $totalPrice = 0.0;
                            foreach ($results as $key => $value):
                                $totalPrice += $value['price'] * $value['prod_qty']
                    ?>
                        <div class="cart_item">
                            <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $value['prod_img_name'] ?>" alt="">
                            <div class="cart_text_wrap">
                                <p class='name'><?php echo $value['name'] ?></p>
                                <!-- OJO Con la categoría se podrían agrupar los productos o algo parecido, para que sea más visual -->
                                <!-- <p class="category"><?php echo $value['type'] ?></p> -->
                                <p class="price"><?php echo $value['price'] ?><span>€</span></p>
                                <p class="prod_qty"><span>x</span><?php echo $value['prod_qty'] ?></p>
                                <p class="total_prod_price"><?php echo $value['price'] * $value['prod_qty'] ?><span>€</span></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="cart_resume">
                <?php echo "<p>$totalPrice<span>€</span></p>"; ?>
            </div>
<?php include_once(__DIR__ . '/footer.php'); ?>
