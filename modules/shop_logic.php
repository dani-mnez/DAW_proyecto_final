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
            $data_to_push = [
                "cart" => [
                    'product' => new MongoDB\BSON\ObjectId($data->id),
                    'qty' => $data->qty,
                    'size' => $data->size,
                    'selected' => true
                ]
            ];
            // OJO Si el producto NO existe aún
            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)],
                    ['$push' => $data_to_push]
                ]
            );

            // TODO Hacer para que si el producto ya existe, se actualice la cantidad
            break;
        default:
            echo 'algo ha fallado';
    }
}
