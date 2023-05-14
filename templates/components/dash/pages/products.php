<?php
  if (isset($user_data->products)) {
    $products_id = $user_data->products;
    $products = [];

    foreach ($products_id as $prod) {
      $product = $mongo_db->exec(
          'find_one',
          'products',
          ['_id' => $prod]
      );

      array_push($products, $product);
    }
  }
?>

<h2>Productos</h2>
<div id="prod_container">
  <?php
    if (isset($user_data->products)) {
      $prod_total = count($user_data->products) > 4 ? $prod_total = 4 : $prod_total = count($user_data->products);
      
      for ($i=0; $i < $prod_total ; $i++) {
        include(__DIR__ . '/../blocks/product_card.php');
      }
    } else {
      echo "<p>No tienes productos</p>";
    }
  ?>
  <button>Ver todos los productos</button>
</div>