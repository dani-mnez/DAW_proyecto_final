<?php include_once(__DIR__ . '/components/header.php'); ?>
<div id="content">
    <h1 id="page_title">Tramitar pedido</h1>
    <div id="checkout_content">
        <div id="col_left">
            <div id="addresses">
                <h2>Direcciones de envío</h2>
                <div id="directions_wrapper">
                    <?php
                    foreach ($user_data->address as $address) {
                        $user_dir = $mongo_db->exec(
                            'find_one',
                            'addresses',
                            ['_id' => $address]
                        );

                        require(__DIR__ . './components/dash/blocks/direction_card.php');
                    }
                    ?>
                    <div id="new_dir">
                        <img src="/DAW_proyecto_final/assets/icons/add.svg" alt="Añadir dirección">
                        <span>Añadir nueva dirección</span>
                    </div>
                </div>
            </div>
            <div id="pay_methods">
                <h2>Métodos de pago</h2>
                <div id="pay_wrapper">
                    <div class="payment_method">
                        <img src="../assets/img/tarjetas.png" alt="tarjetas">
                        <p>Tarjeta de crédito / débito</p>
                    </div>
                    <div class="payment_method">
                        <img src="../assets/img/transferencia-bancaria.png" alt="transferencia">
                        <p>Transferencia bancaria</p>
                    </div>
                    <div class="payment_method">
                        <img src="../assets/img/bizum.png" alt="bizum">
                    </div>
                    <div class="payment_method">
                        <img src="../assets/img/paypal.png" alt="paypal">
                    </div>
                </div>
            </div>
            <div id="res_opts">
                <h2>Resumen del pedido y opciones de envío</h2>
                <div id="resume_wrapper">
                    <div id="resume_wrapper_items">
                        <?php
                        $user = unserialize($_SESSION['user']);
                        $carrito = $mongo_db->exec(
                            'find_one',
                            'users',
                            ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)]
                        )->cart;
                        foreach ($carrito as $prod_carrito) {
                            if ($prod_carrito->selected) {
                                $prod_info = $mongo_db->exec(
                                    'find_one',
                                    'products',
                                    ['_id' => $prod_carrito->product]
                                );
                                $producerName = $mongo_db->exec(
                                    'find_one',
                                    'producers',
                                    ['_id' => $prod_info->producer]
                                )->company_name;
                                $price = $prod_info->stock[$prod_carrito->size]->price;

                                require(__DIR__ . './components/checkout/prod_checkout.php');
                            }
                        }
                        ?>
                    </div>
                    <div id="resume_wrapper_total">
                        <button class="checkout_btn">
                            <span>Tramitar pedido</span>
                            <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="Flecha hacia delante">
                        </button>
                        <div>
                            <p>
                                Importe total:
                                <?php
                                $product_price_sum = 0;
                                $total_price = 0;
                                foreach ($carrito as $prod_carrito) {
                                    if ($prod_carrito->selected) {
                                        $product_price_sum = $price * $prod_carrito->qty;
                                        $total_price = $total_price + $product_price_sum;
                                    }
                                }

                                echo $total_price . '€';
                                ?>
                            </p>
                            <p class="legal_text">
                                Al completar tu pedido aceptas nuestras
                                <a href="">Condiciones de uso y venta.</a>
                                Consulta nuestro
                                <a href="">Aviso de privacidad</a>
                                y nuestro
                                <a href="">Aviso de cookies</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi quis a dicta mollitia provident. Corporis, et cupiditate ut itaque a magni laudantium, labore iusto, molestiae maiores provident nostrum deserunt impedit?
                Totam quos, molestiae, recusandae laborum quam iste cumque itaque cum adipisci sit similique. Voluptatem suscipit nulla molestiae pito doloremque saepe perspiciatis expedita, quae sint voluptatibus, quaerat deleniti voluptates! Omnis assumenda excepturi non amet sequi iure corporis voluptatibus enim corrupti aliquid, modi similique repellendus.
            </p>
        </div>
        <div id="col_right">
            <div id="res_cta" class="section_content_right">
                <button class="checkout_btn">
                    <span>Tramitar pedido</span>
                    <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="Flecha hacia delante">
                </button>
                <p class="legal_text">
                    Al completar tu pedido aceptas nuestras
                    <a href="">Condiciones de uso y venta.</a>
                    Consulta nuestro
                    <a href="">Aviso de privacidad</a>
                    y nuestro
                    <a href="">Aviso de cookies</a>
                </p>
            </div>
            <div id="res_desglose" class="section_content_right">
                <h3>Resumen de pedido:</h3>
                <div class="section_content_right_tot">
                    <p>Productos:</p>
                    <div class="num_prices">
                        <?php
                        echo $total_price . " €";
                        ?>
                    </div>
                </div>
                <div class="section_content_right_tot">
                    <p>Envío:</p>
                    <div class="num_prices">
                        <!-- TODO -->
                        <span>Loquesea</span>
                    </div>
                </div>
            </div>
            <div id="res_totals" class="section_content_right">
                <div class="section_content_right_tot">
                    <h3>Importe total:</h3>
                    <div class="num_prices">
                        <?php
                        $envio = 3.95;
                        echo round((($total_price + $envio) * 1.21), 2) . " €";
                        ?>
                    </div>
                </div>
                <span>Los totales de los pedidos incluyen IVA</span>
            </div>
            <div class="section_content_right_text">
                <p>Texto explicativo del proceso de pago, envío del pedido y entrega; posibles soluciones a los problemas y dudas frecuentes.</p>
            </div>
        </div>
    </div>
</div>
<?php require_once(__DIR__ . '/components/prod_qty_dropdown.php'); ?>
<?php include_once(__DIR__ . '/components/footer.php'); ?>