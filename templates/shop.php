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
                    )->toArray();

                    if ($products):
                        foreach ($prod_cat_qty as $cat):
                            $filteredProds = array_filter(
                                $products,
                                fn($product) => $product['category'] == $cat['_id']
                            );
                            ?>
                            <div class="prod_cat">
                                <h2 class="cat_title"><?php echo $cat['name']; ?></h2>
                                <div class="prod_wrapper">
                                <?php
                                foreach ($filteredProds as $prod) {
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
                                ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>
