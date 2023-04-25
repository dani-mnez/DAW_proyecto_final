<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

$data = json_decode(file_get_contents('php://input', true));

$mongo_db->exec(
    'update_one',
    'users',
    [
        ['_id' => new MongoDB\BSON\ObjectID(unserialize($_SESSION['user'])->id)],
        ['$set' => [
            'cart.$[identifier].selected' => $data->status
            ]
        ],
        ['arrayFilters' => [
                [
                    'identifier.product' => [
                            '$eq' => new MongoDB\BSON\ObjectID($data->id)
                        ]
                ]
            ]
        ]
    ]);