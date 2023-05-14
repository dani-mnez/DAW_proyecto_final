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

// Comprobar si el producto está en la lista de favoritos del usuario
function isFaved($productID)
{
    // TODO Meter un if para comprobar si el usuario está logueado - ya que da error en la tienda si no está
    global $user_data;

    if (isset($user_data)) {

        if ($user_data->type == 'buyer') {
        
            $raw_user_fav_list = $user_data->lists->desired_prods->prods->bsonSerialize();
            $callback = function ($objId) {
                return (string) $objId;
            };
            $fav_list = array_map($callback, $raw_user_fav_list);

            return in_array($productID, $fav_list);
        } else {
            return false;
        }
    } else {
        return false;
    }
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
        case 'checkout':
            $baseTitle .= ' | Tramitar pedido';
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
        case 'checkout':
            $bodyClass = 'checkout' . $bodyClass;
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