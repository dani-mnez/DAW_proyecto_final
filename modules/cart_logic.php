<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';


$cosa = $mongo_db->exec(
    'find_one',
    'orders',
    ['buyer' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)]
)->products;

// Obtenemos la info. completa de los productos comprados
$info_buyed_prods = [];
foreach ($cosa as $buyed_prod) {
    $product_info = $mongo_db->exec(
        'find_one',
        'products',
        ['_id' => $buyed_prod->_id]
    );

    $producer_info = $mongo_db->exec(
        'find_one',
        'producers',
        ['_id' => $product_info->producer]
    );

    $data = [
        'prod_id' => $product_info->_id,
        'prod_img' => $product_info->imgs->cover,
        'prod_name' => $product_info->name,
        'prod_price' => $product_info->stock[$buyed_prod->format]->price,
        'prod_stock' => $product_info->stock[$buyed_prod->format]->qty,

        'producer_id' => $producer_info->_id,
        'producer_name' => $producer_info->company_name
    ];

    array_push($info_buyed_prods, $data);
}

echo json_encode($info_buyed_prods);
