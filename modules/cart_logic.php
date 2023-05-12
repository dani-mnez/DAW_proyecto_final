<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // FIX Esto es posible que ya no sea necesario
    $cosa = $mongo_db->exec(
        'find_one',
        'orders',
        ['buyer' => $user_data->_id]
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
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input', true));

    // OJO Esto de aquí abajo funciona a veces y otras no - el código está bien escrito
    switch ($data->action) {
        case 'save_for_later':
            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => $user_data->_id],
                    [
                        '$push' => [
                            "lists.saved_prods.prods" => new MongoDB\BSON\ObjectID($data->id)
                        ]
                    ]
                ]
            );
            break;
        case 'update_selected_prod':
            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => $user_data->_id],
                    [
                        '$set' => [
                            "cart.$[identifier].sizes.{$data->size}.selected" => $data->status
                        ]
                    ],
                    [
                        'arrayFilters' => [
                            [
                                'identifier.product' => [
                                    '$eq' => new MongoDB\BSON\ObjectID($data->id)
                                ]
                            ]
                        ]
                    ]
                ]
            );
            break;
        case 'update_prod_qty':
            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => $user_data->_id],
                    [
                        '$set' => [
                            "cart.$[identifier].sizes.{$data->size}.qty" => $data->qty
                        ]
                    ],
                    [
                        'arrayFilters' => [
                            [
                                'identifier.product' => [
                                    '$eq' => new MongoDB\BSON\ObjectID($data->id)
                                ]
                            ]
                        ]
                    ]
                ]
            );
            break;
        case 'del_prod_cart':
            $productSizes = null;
            foreach ($user_data->cart as $productInCart) {
                if ((string) $productInCart->product == $data->id) {
                    $productSizes = count((array) $productInCart->sizes);
                    break;
                };
            }

            if ($productSizes > 1) {
                // Si hay más de un tamaño, solo borramos el tamaño
                $mongo_db->exec(
                    'update_one',
                    'users',
                    [
                        ['_id' => $user_data->_id],
                        [
                            '$unset' => [
                                "cart.$[identifier].sizes.{$data->size}" => ""
                            ]
                        ],
                        [
                            'arrayFilters' => [
                                [
                                    'identifier.product' => [
                                        '$eq' => new MongoDB\BSON\ObjectID($data->id)
                                    ]
                                ]
                            ]
                        ]
                    ]
                );
            } else {
                // Si solo hay un tamaño, borramos el producto entero
                $mongo_db->exec(
                    'update_one',
                    'users',
                    [
                        ['_id' => $user_data->_id],
                        [
                            '$pull' => [
                                "cart" => [
                                    "product" => new MongoDB\BSON\ObjectID($data->id)
                                ]
                            ]
                        ]
                    ]
                );
            }
            break;
        default:
            break;
    }
}
