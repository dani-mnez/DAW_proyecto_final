<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

$data = json_decode(file_get_contents('php://input', true));

if (isset($data->action)) {
    switch ($data->action) {
        case 'like':
            echo 'Te gusta un artículo';

            $nextStatus = !$data->status; // Es el estado en el que estaba cuando se hizo click en el elemento - el estado que queremos será el CONTRARIO

            if ($nextStatus) {
                $mongo_db->exec(
                    'update_one',
                    'users',
                    [
                        ['_id' => $user_data->_id],
                        [
                            '$push' => [
                                "lists.desired_prods.prods" => new MongoDB\BSON\ObjectID($data->id)
                            ]
                        ]
                    ]
                );
            } else {
                $mongo_db->exec(
                    'update_one',
                    'users',
                    [
                        ['_id' => $user_data->_id],
                        [
                            '$pull' => [
                                "cart" => [
                                    "lists.desired_prods.prods" => new MongoDB\BSON\ObjectID($data->id)
                                ]
                            ]
                        ]
                    ]
                );
            }
            break;
        case 'add_cart':
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
            break;
        default:
            echo 'Algo ha fallado';
    }
}
