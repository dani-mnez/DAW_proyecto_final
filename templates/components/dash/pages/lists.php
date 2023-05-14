<div id="lists">
    <h1>Todas las listas</h1>
    <?php require_once(__DIR__ . '/../blocks/list_lists.php'); ?>

    <?php if ($list_info != null): ?>
        <div id="list_products">
            <h2><?php echo "Lista: $list_selected_name"; ?></h2>
            <div id="list_prod_wrapper">
            <?php
                foreach ($list_info->prods as $prod_id) {
                    $prod = $mongo_db->exec(
                        'find_one',
                        'products',
                        ['_id' => $prod_id]
                    );

                    $producer_name = $mongo_db->exec(
                        'find_one',
                        'producers',
                        ['_id' => $prod->producer]
                    )->company_name;

                    require(__DIR__ . '/../../list_product_card.php');
                }
            ?>
            </div>
        </div>
    <?php endif; ?>
</div>
