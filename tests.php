<?php
require 'vendor/autoload.php'; // include Composer's autoloader

use \MongoDB\Client;
use \MongoDB\Driver\ServerApi;


$serverApi = new ServerApi(ServerApi::V1);
$client = new MongoDB\Client(
    'mongodb+srv://soldemarzo:soldemarzo@soldemarzo.c8k10vi.mongodb.net/?retryWrites=true&w=majority',
    [],
    ['serverApi' => $serverApi]
);
$collection = $client->project->users;

$search = $collection->find();

foreach ($search as $user) {
    echo $user->name;
    print_r((array)$user);
}

// OJO usar get_class_methods para ver los métodos de una clase u objeto

// Lo de abajo ha creado una colección nueva dentro de la base de datos project
// $client->project->createCollection('fromPHP');
