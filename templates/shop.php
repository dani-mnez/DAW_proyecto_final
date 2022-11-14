<?php include_once(__DIR__ . '/header.php'); ?>
            <div id="content">
                <div id="shop_filters"></div>
                <?php include_once(__DIR__ . '/side_menu.php'); ?>
                <div id="products">
                    <?php
                        $results = $db_access->execQuery('all_prods', null);

                        if ($results) {
                            foreach ($results as $key => $value) {
                                include(__DIR__ . '/product.php');
                            }
                        }
                    ?>
                </div>
            </div>
<?php include_once(__DIR__ . '/footer.php'); ?>
