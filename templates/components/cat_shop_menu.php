<p>Compra por: Categoría</p>
<nav id="cat_shop_menu" aria-label="Menú lateral">
    <a>Todos</a>
    <?php
        $results = $mongo_db->exec(
            'distinct',
            'products',
            'category'
        );

        if ($results):
            foreach ($results as $row):
    ?>
        <a style="background-image: <?php echo "url('../assets/db_data/cats/$row.jpg')"; ?>;" ><?php echo $row; ?></a>
    <?php
    endforeach;
    endif;
    ?>
</nav>
<?php
$totalProds = $mongo_db->exec(
    'count',
    'products',
    []
);
?>
<p><?php echo $totalProds ?> productos</p>