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
