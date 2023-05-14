<div class="producer_card">
    <div class="producer_info">
        <img src="<?php echo "/DAW_proyecto_final/assets/db_data/users/{$producer->_id}.jpg" ?>" alt="<?php echo $producer->company_name ?>">
        <div class="producer_card_text">
            <h2><?php echo $producer->company_name ?></h2>
            <p><?php echo "{$address->town} ({$address->city})" ?></p>
        </div>
    </div>
    <div class="producer_products">
        <?php
        $products = $mongo_db->exec(
            'find',
            'products',
            ['producer' => $producer->_id]
        )->toArray();

        if (count($products) >= 3) {
            for ($i = 0; $i < 3; $i++) {
                $prod = $products[$i];
                require(__DIR__ . '/prods_product_card.php');
            }
        } else {
            foreach ($products as $prod) {
                require(__DIR__ . '/prods_product_card.php');
            }
        }
        ?>
        <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=<?php echo $prod->producer ?>" class="view_more_producer">Ver más productos de este vendedor</a>
    </div>
</div>