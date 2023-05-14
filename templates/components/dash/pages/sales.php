<h1>Ventas</h1>
<div id="order_hist_wrapper">

    <?php
    echo "<div id='res_graph'>
      <h1>Gráficos de ingresos</h1>";
      require_once(__DIR__ . '/../blocks/graphs.php');
      echo "</div>";
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
        require(__DIR__.'/../blocks/sales_card.php');
    }
    ?>
</div>
<h2>Historial de ventas</h2>
