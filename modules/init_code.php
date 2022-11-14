<?php
// Iniciamos la sesión
session_start();

/*
Definimos las credenciales de la BBDD,
creamos la clase con la que la gestionaremos
y la guardamos en la sesión (para poder usarla entre páginas)
*/
// TODO Crear un sistema de control de permisos para la BBDD en la que los diferentes usuarios registrados solo puedan acceder a sus datos / o hacer un bypass para no crear tantos usuarios - la verdad que en esto no tengo las cosas claras
# TODO Gestionar las COOKIES
# TODO Gestionar las cuentas de usuario múltiples
const DB_HOST = 'dani-martinez.com';
const DB_NAME = 'project';
const DB_PORT = 3306;
$DB_USER = 'soldemarzo';
$DB_PASS = "soldemarzo2022!";

$db_access = new DBAccess(DB_HOST, $DB_USER, $DB_PASS, DB_NAME, DB_PORT);

$_SESSION['db_acc'] = serialize($db_access);
