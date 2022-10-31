<?php
function getTitle($fileName)
{
    $baseTitle = 'Sol de marzo';

    switch ($fileName) {
        case 'index' : return $baseTitle; break;
        case 'shop' : $baseTitle .= ' | Tienda'; break;
        case 'cart' : $baseTitle .= ' | Carrito'; break;
        default : $baseTitle .= ' | ????????';
    }

    return $baseTitle;
}

function bodyClassGen($fileName)
{
    $bodyClass = '_body';

    switch ($fileName) {
        case 'index' : $bodyClass = 'index' . $bodyClass; break;
        case 'shop' : $bodyClass = 'shop' . $bodyClass; break;
        case 'cart' : $bodyClass = 'cart' . $bodyClass; break;
        default : $bodyClass = 'default' . $bodyClass;
    }

    return $bodyClass;
}
