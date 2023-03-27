<?php
include_once 'classes.php';
include_once 'init_code.php';

$data = json_decode(file_get_contents('php://input', true));

switch ($_POST['action']) {
    case 'mod_prof_info':
        $mongo_db->exec(
            'update_one',
            'users',
            [
                ['_id' => $_SESSION['user_id']],
                ['$set' => [
                    'name' => $_POST['name'],
                    'mail' => $_POST['mail'],
                    'phone' => $_POST['phone']
                ]]
            ]
        );

        break;

    default:
        # code...
        break;
}
