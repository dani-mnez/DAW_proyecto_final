<?php


function formatMongoDate($mongoDate)
{
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
    $dateTime = $mongoDate->toDateTime();
    $formDate = $dateTime->format('j \d\e M \d\e o');
    return strtr($formDate, $monthTranslatePool);
}


function getTitle($fileName)
{
    $baseTitle = 'Sol de marzo';

    switch ($fileName) {
        case 'index':   return $baseTitle;                             break;
        case 'shop':           $baseTitle .= ' | Tienda';              break;
        case 'producer_shop':  $baseTitle .= ' | Tienda de productor'; break; // OJO Estaría bien poner el nombre del productor en vez del nombre genérico
        case 'cart':           $baseTitle .= ' | Carrito';             break;
        case 'product_detail': $baseTitle .= ' | Producto';            break; // OJO Estaría bien poner el nombre del producto en vez de "Producto"
        case 'dashboard':      $baseTitle .= ' | Panel de control';    break;
        default:               $baseTitle .= ' | ????????';
    }

    return $baseTitle;
}


function bodyClassGen($fileName)
{
    $bodyClass = '_body';

    switch ($fileName) {
        case 'index':          $bodyClass = 'index' . $bodyClass;         break;
        case 'shop':           $bodyClass = 'shop' . $bodyClass;          break;
        case 'producer_shop':  $bodyClass = 'producer_shop' . $bodyClass; break;
        case 'cart':           $bodyClass = 'cart' . $bodyClass;          break;
        case 'product_detail': $bodyClass = 'prod_det' . $bodyClass;      break;
        case 'dashboard':      $bodyClass = 'dash' . $bodyClass;          break;
        default:               $bodyClass = 'default' . $bodyClass;
    }

    return $bodyClass;
}


function destroyCookie($cookieName)
{
    setcookie($cookieName, '', time() - 3600, '/');
    destroyCookie($cookieName);
}
