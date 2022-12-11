<?php include_once(__DIR__ . '/components/header.php'); ?>
            <div id="content">
                <div id="cart_item_wrapper">
                    <div id="cart_items">
                        <h1>Cesta</h1>
                        <a href="#" id="deselect-all">Anula la selección de todos los productos</a>
                        <span>Precio</span>
                        <?php
                            $user = unserialize($_SESSION['user'])->mail;
                            $results = $mongo_db->exec(
                                'find_one',
                                'users',
                                ['mail' => $user]
                            )->cart;

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
                                    $totalPrice = $price * $prod_qty_buyed;

                                    $totalProds += $prod_qty_buyed;
                                    $totalPrice += $totalPrice;
                                    include('./components/cart_item.php');
                                }
                            }
                        ?>

                        <div class="subtotal_text">
                            <span>Subtotal (<?php echo $totalProds ?> productos):</span>
                            <span><?php echo $totalPrice ?> €</span>
                        </div>
                    </div>
                    <div id="my_prods">
                        <h2>Tus productos</h2>
                        <!-- Pestaña: guardado para más tarde
                                    Accede a la BDD/sesión/cookies para recoger los productos guardados -->
                        <!-- Pestaña: Comprar de nuevo
                                    Accede al historial de compras (BDD) para sugerirte productos comprados anteriormente y/o comprados varias veces -->
                        <!-- TODO Hacer que se recojan todos los datos del usuario al momento de hacer login -> para hacer el mínimo número de peticiones a la BDD posibles -->
                        <!-- OJO En amazon, las tabs las hacen con DIVS con un #text dentro a pelo -> USAR LO MISMO PARA EL PANEL DE LOGIN/REGISTRO -->
                    </div>
                </div>
                <div id="cart_resume">
                    <div class="subtotal_text">
                        <span>Subtotal (<?php echo $totalProds ?> productos):</span>
                        <span><?php echo $totalPrice ?> €</span>
                    </div>
                    <button>Tramitar pedido</button>
                </div>
            </div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>
