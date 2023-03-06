<?php
include_once 'classes.php';
include_once 'init_code.php';

$data = json_decode(file_get_contents('php://input', true));

$nowTimeDate = new DateTime('now', new DateTimeZone('Europe/Madrid'));
$nowTimeDate->add(new DateInterval('PT1H')); // Le agregamos 1h porque estamos en UTC+1

$infoToAdd = [
    'user' => $data->user,
    'content' => $data->content,
    'date' => new MongoDB\BSON\UTCDateTime($nowTimeDate)
];

$mongo_db->exec(
    'update_one',
    'chats',
    [
        ['_id' => new MongoDB\BSON\ObjectId($data->chatID)],
        ['$push' => ["messages" => $infoToAdd]]
    ]
);