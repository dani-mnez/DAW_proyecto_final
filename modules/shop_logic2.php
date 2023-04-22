<?php
include_once '../modules/classes.php';
include_once '../modules/init_code.php';

$data = json_decode(file_get_contents('php://input', true));

if (isset($data->action)) {
    switch ($data->action) {
        case 'like':
            echo 'Te gusta un artículo';
            // TODO Hacer para que se guarde en la lista de favoritos si no existe el producto
            // TODO Hacer para que se elimine de la lista de favoritos si ya existe el producto
            break;
        case 'add_cart':

            $carrito_usuario = $mongo_db->exec(
                'find_one',
                'users',
                ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)]
            )->cart;
            
            $prod_in_cart = false;
            $index_prod = false;
            $final_cart = [];

            foreach($carrito_usuario as $idx_prod => $prod){
                $id_prod = (string) $prod->product;
                if($id_prod == $data->id){
                    $prod_in_cart = true;
                    $index_prod = $idx_prod;
                    $prod->qty++;
                    array_push($final_cart, $prod);
                } else {
                    array_push($final_cart, $prod);
                }
            }

            if ($prod_in_cart) { 

                $user_data = $mongo_db->exec(
                    'update_one',
                    'users',
                        [
                            ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)],
                            ['$set' => $final_cart]
                        ]      
                    );
                    
                // Ejemplo de phind
                // Conectarse a la base de datos
                $client = new MongoDB\Client("mongodb://localhost:27017");
                $collection = $client->mydb->users;

                // Definir el filtro y el operador de actualización
                $filter = array('_id' => new MongoDB\BSON\ObjectID('123456789012345678901234'));
                $update = array('$set' => array('cart.$[identifier].qty' => 10));
                $options = array('arrayFilters' => array(array('identifier.product' => '66666')));

                // Actualizar el documento en la colección
                $result = $collection->updateOne($filter, $update, $options);

                // Comprobar si la actualización se ha realizado correctamente
                if ($result->getModifiedCount() > 0) {
                    echo "Documento actualizado correctamente";
                } else {
                    echo "No se ha encontrado el documento o no se ha modificado ningún campo";
                }
            } else {
                $data_to_push = [
                    "cart" => [
                        'product' => new MongoDB\BSON\ObjectId($data->id),
                        'qty' => $data->qty,
                        'size' => $data->size,
                        'selected' => true
                    ]
                ];
            
                $mongo_db->exec(
                    'update_one',
                    'users',
                    [
                        ['_id' => new MongoDB\BSON\ObjectId(unserialize($_SESSION['user'])->id)],
                        ['$push' => $data_to_push]
                    ]
                );
            }
        break;
        default:
            echo 'Algo ha follado';
    }
}
