<?php
include_once(__DIR__ . '../modules/classes.php');
session_start();

if (isset($_POST['dir_login_submit']) || isset($_POST['dir_contact_submit']) || isset($_POST['dir_update_submit'])) {
    $db_access = unserialize($_SESSION['db_acc']);
}
if (isset($_POST['dir_login_submit'])) {
    echo $query;
}

if (isset($_POST['dir_contact_submit'])) {
    echo $query;
}

if (isset($_POST['dir_update_submit'])) {
    $query = "{$_POST['street_type']};{$_POST['street']};{$_POST['number']};{$_POST['floor']};{$_POST['postal_code']};{$_POST['city']};{$_POST['province']}";
    print_r($_POST);
    echo $query;
}
