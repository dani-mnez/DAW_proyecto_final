<?php

$data = json_decode(file_get_contents('php://input', true));

if (isset($data->action)) {
    switch ($data->action) {
        case 'like' : echo 'Te gusta un artículo'; break;
        case 'add_cart' : echo 'Has añadido un artículo'; break;
        default : echo 'algo ha fallado';
    }
}
