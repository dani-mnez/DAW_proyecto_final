<div id="res_hist">
    <h1>Historial de pedidos</h1>
    <div id="order_hist_wrapper">
        <?php
        $orders = $mongo_db->exec(
            'find',
            'orders',
            ['buyer' => $user_data->_id]
        );
        foreach ($orders as $order_data) {
            require(__DIR__.'/order_card.php');
        }?>
    </div>
    <button>Ver todos los pedidos</button>
</div>
