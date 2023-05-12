<?php include_once(__DIR__ . '/components/header.php'); ?>
<div id="content">
    <h1 id="page_title">Cesta</h1>
    <div id="main_cart">
        <span id="select_all">Selecciona todos los productos</span>
        <div id="cart_item_wrapper">
            <?php
            $userCart = $user_data->cart;

            if (count($userCart) > 0) : ?>
                <div id="cart_items">
                    <?php
                    if (count($userCart) > 0) {
                        $totalPrice = 0.0;
                        $totalProds = 0;
                        $allProductsInfo = [];

                        foreach ($userCart as $prod) {
                            $prod_info = $mongo_db->exec(
                                'find_one',
                                'products',
                                ['_id' => $prod->product]
                            );
                            array_push($allProductsInfo, $prod_info);

                            $producerName = $mongo_db->exec(
                                'find_one',
                                'producers',
                                ['_id' => $prod_info->producer]
                            )->company_name;
                            $prodSubcat = $mongo_db->exec(
                                'find_one',
                                'subcats',
                                ['_id' => $prod_info->subcat]
                            )->name;

                            foreach ($prod->sizes as $prod_size_buyed => $sizeInfo) {
                                $prod_qty_buyed = $sizeInfo->qty;

                                $price = $prod_info->stock[$prod_size_buyed]->price;
                                $totalPriceItem = $price * $prod_qty_buyed;

                                if ($sizeInfo->selected) {
                                    $totalProds += $prod_qty_buyed;
                                    $totalPrice += $totalPriceItem;
                                }

                                include('./components/cart_item.php');
                            }
                        }
                    }
                    ?>
                    <script type="text/javascript">
                        let totalProds = <?php echo $totalProds ?>;
                        let totalPrice = <?php echo $totalPrice ?>;
                        let allCartProds = JSON.parse('<?php echo json_encode($userCart) ?>');
                        let likeList = JSON.parse('<?php echo json_encode($user_data->lists->saved_prods->prods) ?>');
                        let allProductsInfo = JSON.parse('<?php echo json_encode($allProductsInfo) ?>');
                    </script>

                    <div class="subtotal_text">
                        <span>Subtotal (<?php echo $totalProds ?> productos):</span>
                        <span><?php echo $totalPrice ?> €</span>
                    </div>
                </div>
            <?php else : ?>
                <p class="void_cart_msg">Aún no has agregado ningún producto al carrito</p>
            <?php endif; ?>
        </div>
        <div id="cart_resume">
            <div id="cta_box">
                <div class="subtotal_text">
                    <?php if (count($userCart) > 0) : ?>
                        <span>Subtotal (<?php echo $totalProds ?> productos):</span>
                        <span><?php echo $totalPrice ?> €</span>
                    <?php else : ?>
                        <span>Agrega productos al carrito primero</span>
                    <?php endif; ?>
                </div>
                <?php if (count($userCart) > 0) : ?>
                    <a href="./checkout.php">
                    <?php else : ?>
                        <a class="nulledLink" href="#">
                        <?php endif; ?>
                        <button class="checkout_btn">
                            <span>Tramitar pedido</span>
                            <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="Flecha hacia delante">
                        </button>
                        </a>
            </div>
        </div>
    </div>

    <div id="my_prods">
        <h2>Tus productos</h2>
        <?php
        $saved_prods = $user_data->lists->saved_prods->prods;
        $palabra = (count($saved_prods) > 1) ? " productos" : " producto";
        ?>
        <div id="lists">
            <div class="tabs">
                <div id="later_btn_tab" class="selected_cta_tab">
                    <p>Guardado para mas tarde (<?php echo count($saved_prods) . $palabra ?>)</p>
                </div>
                <div id="recent_btn_tab">
                    <p>Comprados anteriormente</p>
                </div>
            </div>
            <div id="list_prod_wrapper">
                <?php if (count($saved_prods) > 0) : ?>
                    <?php
                    $later_prods = [];
                    foreach ($saved_prods as $prod_id) {
                        $prod_info = $mongo_db->exec(
                            'find_one',
                            'products',
                            ['_id' => $prod_id]
                        );
                        array_push($later_prods, $prod_info);
                    }

                    foreach ($later_prods as $prod) {
                        $producer_name = $mongo_db->exec(
                            'find_one',
                            'producers',
                            ['_id' => $prod->producer]
                        )->company_name;
                        include('./components/list_product_card.php');
                    }
                    ?>
                <?php else : ?>
                    <p>Aún no has agregado ningún producto a esta lista</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once(__DIR__ . '/components/prod_qty_dropdown.php'); ?>
<?php include_once(__DIR__ . '/components/footer.php'); ?>