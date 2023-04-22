<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

$data = json_decode(file_get_contents('php://input', true));

if (isset($data->action)) {
    switch ($data->action) {
        case 'like':
            echo 'Te gusta un artículo';
            // TODO Hacer para que se guarde en la lista de favoritos si no existe el producto
            // TODO Hacer para que se elimine de la lista de favoritos si ya existe el producto
            break;
        case 'add_cart':

            $carrito_usuario = $mongo_db->exec(
                'find_one',
                'users',
                ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)]
            )->cart;
            
            $prod_in_cart = false;
            $index_prod = false;

            foreach($carrito_usuario as $idx_prod => $prod){
                $id_prod = (string) $prod->product;
                if($id_prod == $data->id){
                    $prod_in_cart = true;
                    $index_prod = $idx_prod;
                    $prod->qty++;
                    break;
                }
            }

            if ($prod_in_cart) {
                $user_data = $mongo_db->exec(
                    'update_one',
                    'users',
                        [
                            ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)],
                            ['$set' => [ "cart" => [$carrito_usuario]]]
                        ]
                    );
            } else {
                $data_to_push = [
                    "cart" => [
                        'product' => new MongoDB\BSON\ObjectId($data->id),
                        'qty' => $data->qty,
                        'size' => $data->size,
                        'selected' => true
                    ]
                ];
            
                $mongo_db->exec(
                    'update_one',
                    'users',
                    [
                        ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)],
                        ['$push' => $data_to_push]
                    ]
                );
            }
        break;
        default:
            echo 'Algo ha follado';
    }
}
