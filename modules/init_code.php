<?php
// Iniciamos la sesión
session_start();

/*
Definimos las credenciales de la BBDD,
creamos la clase con la que la gestionaremos
y la guardamos en la sesión (para poder usarla entre páginas)
*/
# TODO Gestionar las COOKIES

const DB_HOST = 'soldemarzo.c8k10vi.mongodb.net';
const DB_NAME = 'project';  // La colección -> DB_COLLECTION debería llamarse
const DB_PORT = 3306;  // De momento no se usa porque el código va embebido
$DB_USER = 'soldemarzo';
$DB_PASS = "soldemarzo";

$mongo_db = new MongoDBAccess(
    DB_HOST,
    $DB_USER,
    $DB_PASS,
    DB_NAME,
    DB_PORT
);


if (!isset($prod_cat_qty)) {
    $pipeline =
    [
        [
            '$group' => [
                '_id' => '$category',
                'products' => [ '$sum' => 1]
            ]
        ]
    ];

    $prod_cat_qty = $mongo_db->client->project->products->aggregate($pipeline)->toArray();

    usort($prod_cat_qty, function ($a, $b) { return $b['products'] - $a['products']; });
    foreach ($prod_cat_qty as $cat) {
        $cat['name'] = $mongo_db->exec(
            'find_one',
            'cats',
            ['_id' => $cat->_id]
        )->name;
    }

    /* OJO Otro modo de hacerlo sería pasarlo a un array con esta estructura:
    [
        "categoria" => N,
        "categoria" => N,
        "categoria" => N,
        ...
    ]
    */
}

if (!isset($products)) {
    $products = $mongo_db->exec(
        'find',
        'products',
        []
    );
}

// TODO Se puede meter aquí mucha mas info que no haga falta rellamarse


if (isset($_SESSION['user']) && !isset($user_data)) {
    $collectionType = unserialize($_SESSION['user'])->type == 'producer' ? 'producers' : 'users';
        $user_data = $mongo_db->exec(
            'find_one',
            $collectionType,
            ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)]
        );
        $user_data['type'] = unserialize($_SESSION['user'])->type;
}
