<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

$data = json_decode(file_get_contents('php://input', true));

if (isset($data->action)) {
    switch ($data->action) {
        case 'like':
            echo 'Te gusta un artículo';
            break;
        case 'add_cart':
            $data_to_push = [
                "cart" => [
                    'product' => new MongoDB\BSON\ObjectId($data->product_id),
                    'size' => $data->size,
                    'quantity' => $data->qty,
                    'selected' => true
                ]
            ];
            $mongo_db->exec(
                'update_one',
                'users',
                [
                    ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)],
                    ['$push' => [$data_to_push]]
                ]
            );
            echo 'Has añadido un artículo';
            break;
        default:
            echo 'algo ha fallado';
    }
}
