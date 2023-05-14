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
            del_prod_cart();
            break;
        case "delete_cart_list_item":
            del_prod_item_list();
            break;
        case "replace_cart_list_item":
            // Eliminar de la lista de deseos
            del_prod_item_list();

            // Añadir al carrito
            add_to_cart();

            // Obtenemos la información del producto
            $prod_info = $mongo_db->exec(
                'find_one',
                'products',
                ['_id' => new MongoDB\BSON\ObjectID($data->id)]
            );

            $producer_info = $mongo_db->exec(
                'find_one',
                'producers',
                ['_id' => $prod_info->producer]
            );
            $prod_info["producer"] = $producer_info->_id;
            $prod_info["producerName"] = $producer_info->company_name;

            echo json_encode($prod_info);
            break;
        default:
            break;
    }
}

function del_prod_item_list()
{
    global $mongo_db, $user_data, $data;

    $mongo_db->exec(
        'update_one',
        'users',
        [
            ['_id' => $user_data->_id],
            [
                '$pull' => [
                    "lists.saved_prods.prods" => new MongoDB\BSON\ObjectID($data->id)
                ]
            ]
        ]
    );
}

function del_prod_cart()
{
    global $mongo_db, $user_data, $data;

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
}

function add_to_cart()
{
    global $mongo_db, $user_data, $data;

    $prod_in_cart = false;
    $index_prod = false;
    $userCart = $user_data->cart;

    // Comprobamos que el producto no esté ya en el carrito
    if (count($userCart) > 0) {
        foreach ($userCart as $idx_prod => $prod) {
            if ((string) $prod->product == $data->id) {
                $prod_in_cart = true;
                $index_prod = $idx_prod;
                break;
            }
        }
    }

    if ($prod_in_cart) {
        $prodSizes = $userCart[$index_prod]->sizes;
        $prodSizeExists = array_key_exists($data->size, [...$prodSizes]);

        if ($prodSizeExists) {
            // Para cuando es el mismo tamaño
            $qtyInCart = $prodSizes[$data->size]->qty;

            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => $user_data->_id],
                    [
                        '$set' => [
                            "cart.$[identifier].sizes.{$data->size}.qty" => $qtyInCart + $data->qty
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
            // Para cuando es de distinto tamaño
            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => $user_data->_id],
                    [
                        '$set' => [
                            "cart.{$index_prod}.sizes.{$data->size}" => [
                                'qty' => $data->qty,
                                'selected' => true
                            ]
                        ]
                    ]
                ]
            );
        }
    } else {
        $data_to_include = (object) [
            "{$data->size}" => [
                'qty' => $data->qty,
                'selected' => true
            ]
        ];

        $mongo_db->exec(
            'update_one',
            'users',
            [
                ['_id' => $user_data->_id],
                ['$push' => [
                    "cart" => [
                        'product' => new MongoDB\BSON\ObjectId($data->id),
                        'sizes' => $data_to_include
                    ]
                ]]
            ]
        );
    }
}
