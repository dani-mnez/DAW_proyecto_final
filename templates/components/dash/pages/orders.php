<div id="order_hist_wrapper">
    <h1>Historial de pedidos</h1>
    <?php
    $orders = $mongo_db->exec(
        'find',
        'orders',
        ['buyer' => $user_data->_id]
    )->toArray();

    // OJO Se limita el número de pedidos a mostrar en la página resumen, mientras que en la página dedicada del historial, se muestran todos
    $hist_limit = 0;
    if ($_GET['page'] == 'resume') {
        $hist_limit = (count($orders) > 2) ? 2 : count($orders);
    } else {
        $hist_limit = count($orders);
    }

    for ($i=0; $i < $hist_limit; $i++) {
        $order_data = $orders[$i];
        require(__DIR__.'/../blocks/order_card.php');
    }
    ?>
</div>
