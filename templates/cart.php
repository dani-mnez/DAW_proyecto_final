<?php include_once(__DIR__ . '/components/header.php'); ?>
<div id="content">
    <h1>Cesta</h1>
    <div id="main_cart">
        <span id="select_all">Selecciona todos los productos</span>
        <div id="cart_item_wrapper">
            <div id="cart_items">
                <?php
                $user = unserialize($_SESSION['user'])->mail;
                $user = $mongo_db->exec(
                    'find_one',
                    'users',
                    ['mail' => $user]
                );

                $results = $user->cart;

                if ($results) {
                    $totalPrice = 0.0;
                    $totalProds = 0;

                    foreach ($results as $prod) {
                        $prod_size_buyed = $prod->size;
                        $prod_qty_buyed = $prod->qty;

                        $prod_info = $mongo_db->exec(
                            'find_one',
                            'products',
                            ['_id' => $prod->product]
                        );
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

                        $price = $prod_info->stock[$prod_size_buyed]->price;
                        $totalPriceItem = $price * $prod_qty_buyed;

                        if ($prod->selected) {
                            $totalProds += $prod_qty_buyed;
                            $totalPrice += $totalPriceItem;
                        }

                        include('./components/cart_item.php');
                    }
                }
                ?>

                <div class="subtotal_text">
                    <span>Subtotal (<?php echo $totalProds ?> productos):</span>
                    <span><?php echo $totalPrice ?> €</span>
                </div>
            </div>
        </div>
        <div id="cart_resume">
            <div id="cta_box">
                <div class="subtotal_text">
                    <span>Subtotal (<?php echo $totalProds ?> productos):</span>
                    <span><?php echo $totalPrice ?> €</span>
                </div>
                <button>
                    <span>Tramitar pedido</span>
                    <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="Flecha hacia delante">
                </button>
            </div>
            <!-- <div id="related_prods">
                <p>Productos relacionados</p>
            </div> -->
        </div>
    </div>

    <div id="my_prods">
        <h2>Tus productos</h2>
        <?php
        $saved_prods = $user->lists->saved_prods->prods;
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
            </div>
        </div>
        <!-- Pestaña: Comprar de nuevo
            Accede al historial de compras (BDD) para sugerirte productos comprados anteriormente y/o comprados varias veces -->
    </div>
</div>

<div id="qty_select_dropdown">
    <span>0 (Eliminar)</span>
    <span>1</span>
    <span>2</span>
    <span>3</span>
    <span>4</span>
    <span>5</span>
    <span>6</span>
    <span>7</span>
    <span>8</span>
    <span>9</span>
    <span>10+</span>
    <!-- TODO Hacer que la cantidad esté resaltada al abrir el menú -->
</div>

<?php include_once(__DIR__ . '/components/footer.php'); ?>