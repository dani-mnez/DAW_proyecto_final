<?php include_once(__DIR__ . '/components/header.php'); ?>
<?php
// REV El listado de todos los productos se puede obtener al iniciar la web y reusarlo en el resto de páginas (ya que todo se basa en ellos)
$cat_products = array_filter(
    $products->toArray(),
    fn ($product) => $product['category'] == $_GET['cat_id']
);

$cat_info = $mongo_db->exec(
    'find_one',
    'cats',
    ['_id' => new MongoDB\BSON\ObjectId($_GET['cat_id'])]
);

$subcats = [];
foreach ($cat_info->subcats as $subcat) {
    $subcat_info = $mongo_db->exec(
        'find_one',
        'subcats',
        ['_id' => $subcat]
    );

    array_push($subcats, $subcat_info);
}
?>
<div id="content">
    <div id="subcat_shop_header">
        <h1><?php echo $cat_info->name; ?></h1>
        <p><?php echo $cat_info->description; ?></p>
    </div>
    <?php require(__DIR__ . '/components/cat_shop/subcat_menu.php'); ?>
    <p><?php
        $count = count($cat_products);
        $palabra = ($count > 1) ? " productos" : " producto";
        echo $count . $palabra ?></p>

    <div id="products">
        <?php
        foreach ($cat_info->subcats as $subcat) :
            $filteredProds = array_filter(
                $cat_products,
                fn ($product) => $product->subcat == $subcat
            );

            $actual_subcat = array_values(
                array_filter(
                    $subcats,
                    fn ($scat) => $scat->_id == $subcat
                )
            )[0];
        ?>
            <div class="prod_subcat" data-subcatGroup="<?php echo $actual_subcat['name']; ?>">
                <div class="subcat_header">
                    <div class="header_subcat_img">
                        <img src="/DAW_proyecto_final/assets/img/share_wa.webp" alt="Icono de categoría de producto">
                    </div>
                    <h2 class="subcat_title"><?php echo $actual_subcat['name']; ?></h2>
                    <p class="subcat_descript"><?php echo $actual_subcat['description']; ?></p>
                </div>
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
    </div>
</div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>