<?php include_once(__DIR__ . '/components/header.php'); ?>
            <div id="content">
                <div id="shop_header">
                    <h1>Todos los productos</h1>
                    <p>Descubre una gran variedad de delicias gastronómicas</p>
                </div>
                <?php include_once(__DIR__ . '/components/cat_shop_menu.php'); ?>
                <div id="products">
                    <?php
                        $products = $mongo_db->exec(
                            'find',
                            'products',
                            []
                        );

                        if ($products) {
                            foreach ($products as $prod) {
                                $producer_name = $mongo_db->exec(
                                    'find_one',
                                    'producers',
                                    ['_id' => $prod->producer]
                                )->company_name;
                                $subcat = $mongo_db->exec(
                                    'find_one',
                                    'subcats',
                                    ['_id' => $prod->subcat]
                                )->name;
                                include(__DIR__ . '/components/shop_product_card.php');
                            }
                        }
                    ?>
                </div>
            </div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>
