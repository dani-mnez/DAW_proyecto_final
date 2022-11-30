<?php include_once(__DIR__ . '/header.php'); ?>
            <div id="content">
                <?php include_once(__DIR__ . '/cat_shop_menu.php'); ?>
                <div id="products">
                    <?php
                        $results = $db_access->exec(
                            'find',
                            'products',
                            []
                        );

                        if ($results) {
                            foreach ($results as $key => $value) {
                                include(__DIR__ . '/product.php');
                            }
                        }
                    ?>
                </div>
            </div>
<?php include_once(__DIR__ . '/footer.php'); ?>
