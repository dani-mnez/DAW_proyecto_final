<?php

// Obtener datos del usuario de una conversación
function getChatUserData($chat)
{
    global $user_role, $mongo_db;
    // Obtener documento del otro usuario
    $other_user_id = ($user_role == 'user1') ? $chat->user2 : $chat->user1;

    $other_user_obj = $mongo_db->exec(
        'find_one',
        'users',
        ['_id' => $other_user_id]
    );
    $other_user_type = 'user';

    if ($other_user_obj == null) {
        $other_user_obj = $mongo_db->exec(
            'find_one',
            'producers',
            ['_id' => $other_user_id]
        );
        $other_user_type = 'producer';
    }

    return [
        'obj' => $other_user_obj,
        'type' => $other_user_type
    ];
}

// Formatear fechas
$monthTranslatePool = [
    'Jan' => 'enero',
    'Feb' => 'febrero',
    'Mar' => 'marzo',
    'Apr' => 'abril',
    'May' => 'mayo',
    'Jun' => 'junio',
    'Jul' => 'julio',
    'Aug' => 'agosto',
    'Sep' => 'septiembre',
    'Oct' => 'octubre',
    'Nov' => 'noviembre',
    'Dic' => 'diciembre',
];

function formatMongoDate($mongoDate)
{
    global $monthTranslatePool;

    $dateTime = $mongoDate->toDateTime();
    $formDate = $dateTime->format('j \d\e M \d\e o');
    return strtr($formDate, $monthTranslatePool);
}

function formatDate($date)
{
    global $monthTranslatePool;

    $formDate = $date->format('j \d\e M \d\e o');
    return strtr($formDate, $monthTranslatePool);
}


// Generar título de la página
function getTitle($fileName)
{
    $baseTitle = 'Sol de marzo';

    switch ($fileName) {
        case 'index':
            return $baseTitle;
            break;
        case 'shop':
            $baseTitle .= ' | Tienda';
            break;
        case 'producer_shop':
            $baseTitle .= ' | Tienda de productor';
            break; // OJO Estaría bien poner el nombre del productor en vez del nombre genérico
        case 'cart':
            $baseTitle .= ' | Carrito';
            break;
        case 'product_detail':
            $baseTitle .= ' | Producto';
            break; // OJO Estaría bien poner el nombre del producto en vez de "Producto"
        case 'dashboard':
            $baseTitle .= ' | Panel de control';
            break;
        default:
            $baseTitle .= ' | ????????';
    }

    return $baseTitle;
}

// Generar clase del body según el nombre del archivo
function bodyClassGen($fileName)
{
    $bodyClass = '_body';

    switch ($fileName) {
        case 'index':
            $bodyClass = 'index' . $bodyClass;
            break;
        case 'shop':
            $bodyClass = 'shop' . $bodyClass;
            break;
        case 'producer_shop':
            $bodyClass = 'producer_shop' . $bodyClass;
            break;
        case 'cart':
            $bodyClass = 'cart' . $bodyClass;
            break;
        case 'product_detail':
            $bodyClass = 'prod_det' . $bodyClass;
            break;
        case 'dashboard':
            $bodyClass = 'dash' . $bodyClass;
            break;
        default:
            $bodyClass = 'default' . $bodyClass;
    }

    return $bodyClass;
}

// Destruir cookie
function destroyCookie($cookieName)
{
    setcookie($cookieName, '', time() - 3600, '/');
    destroyCookie($cookieName);
}

function update_cart() {

}

function save_cart() {

}

function update_item() {

}

function delete_item($user, $productID) {

}

function save_item_for_later($user, $productID) {

}

function look_for_similar_item() {

}

function recover_saved_item() {
    
}

function delete_saved_item() {

}