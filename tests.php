<?php
require 'vendor/autoload.php'; // include Composer's autoloader

use \MongoDB\Client;
use \MongoDB\Driver\ServerApi;


$serverApi = new ServerApi(ServerApi::V1);
$client = new MongoDB\Client(
    'mongodb+srv://soldemarzo:soldemarzo@soldemarzo.c8k10vi.mongodb.net/?retryWrites=true&w=majority', [], ['serverApi' => $serverApi]);
$collection = $client->soldemarzo->project;

// print_r($collection);
$search = $collection->find();

foreach ($search as $entry) {
    echo $entry;
    echo $entry['name'] . "\n";
}

// print_r($search);
// print_r($collection->find(
//     array('name'=> 'Mercedes Tyler')
// ));

// OJO usar get_class_methods para ver los métodos de una clase u objeto

// Lo de abajo ha creado una colección nueva dentro de la base de datos project
// $client->project->createCollection('fromPHP');