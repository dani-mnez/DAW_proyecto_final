<?php include_once(__DIR__ . '/components/header.php'); ?>
<div id="content">
    <div id="checkout_header">
        <h1>Tramitar Pedido</h1>
    </div>
    <div id="checkout_content">
        <div id="col_left">
            <div id="addresses">
                <div>
                    <h2>Direcciones de Envío</h2>
                </div>
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
                <div>
                    <h2>Métodos de Pago</h2>
                </div>
                <div id="pay_methods_wrapper">
                    <div id="pay_wrapper">
                        <div class="payment_method">
                            <img src="../assets/img/tarjetas2.svg" alt="tarjetas">
                            <p><span>Pago con tarjeta bancaria</span></p>
                        </div>
                        <div class="payment_method">
                            <img src="../assets/img/transferencia-bancaria2.svg" alt="transferencia">
                            <p><span>Transferencia bancaria</span></p>
                        </div>
                        <div class="payment_method">
                            <img id="img_bizum" src="../assets/img/bizum2.svg" alt="bizum">
                            <p><span>Pago mediante Bizum</span></p>
                        </div>
                        <div class="payment_method">
                            <img src="../assets/img/paypal2.svg" alt="paypal">
                            <p><span>Pago mediante Paypal</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <h2>Resumen del pedido y Opciones de envío</h2>
                </div>
                <div id="resume_wrapper">
                    <div id="resume_wrapper_items">
                        <?php
                            $user = unserialize($_SESSION['user']);
                            $carrito = $mongo_db->exec(
                                'find_one',
                                'users',
                                ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)]
                            )->cart;
                            foreach($carrito as $prod_carrito){
                                if($prod_carrito->selected){
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
                        <div>
                            <button id="checkout_btn">
                                <span>Tramitar pedido</span>
                                <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="Flecha hacia delante">
                            </button>
                        </div>
                        <div>
                            <div>
                                <span>Importe total:</span>
                                <span>
                                    <?php 
                                        $product_price_sum = 0;
                                        $total_price = 0;
                                        foreach($carrito as $prod_carrito){
                                            if($prod_carrito->selected){
                                                $product_price_sum = $price * $prod_carrito->qty;
                                                $total_price = $total_price + $product_price_sum;
                                            }
                                        }

                                        echo $total_price . '€';
                                    ?>
                                </span>
                            </div>
                            <div>
                                <span>Al completar tu pedido aceptas nuestras <a href="">Condiciones de uso y venta</a></span>
                                <span>Consulta nuestro <a href="">Aviso de privacidad</a> </span>
                                <span>y nuestro <a href="">Aviso de cookies</a> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi quis a dicta mollitia provident. Corporis, et cupiditate ut itaque a magni laudantium, labore iusto, molestiae maiores provident nostrum deserunt impedit?
                        Totam quos, molestiae, recusandae laborum quam iste cumque itaque cum adipisci sit similique. Voluptatem suscipit nulla molestiae pito doloremque saepe perspiciatis expedita, quae sint voluptatibus, quaerat deleniti voluptates! Omnis assumenda excepturi non amet sequi iure corporis voluptatibus enim corrupti aliquid, modi similique repellendus.
                    </p>
                </div>
            </div>
        </div>
        <div id="col_right">
            <div id="content_right">
                <div class="section_content_right">
                    <button id="checkout_btn">
                        <span>Tramitar pedido</span>
                        <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="Flecha hacia delante">
                    </button>
                    <div>
                        <span>Al completar tu pedido aceptas nuestras <a href="">Condiciones de uso y venta</a></span>
                        <span>Consulta nuestro <a href="">Aviso de privacidad</a> y nuestro <a href="">Aviso de cookies</a></span>
                    </div>
                </div>
                <div class="section_content_right">
                    <h3>Resumen de pedido:</h3>
                    <div class="section_content_right_tot">
                        <h4>Productos:</h4>
                        <div class="num_prices">
                            <?php
                                echo $total_price . " €";
                            ?>
                        </div>
                    </div>
                    <div class="section_content_right_tot">
                        <h4>Envío:</h4>
                        <div class="num_prices">
                            <span>Loquesea</span>
                        </div>
                    </div>
                </div>
                <div class="section_content_right">
                    <div class="section_content_right_tot">
                        <h3>Importe total:</h3>
                        <div  class="num_prices">
                            <?php
                                $envio = 3.95;
                                echo round((($total_price + $envio) * 1.21), 2) . " €";
                            ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <span>Los totales de los pedidos incluyen IVA</span>
                </div>
                <div class="section_content_right_text">
                    <p>Texto explicativo del proceso de pago, envío del pedido y entrega; posibles soluciones a los problemas y dudas frecuentes.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>