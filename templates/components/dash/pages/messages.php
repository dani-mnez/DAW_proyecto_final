<?php
$user_chats = $mongo_db->exec(
    'find',
    'chats',
    ['$or' =>
        [
            ['user1'=>  new MongoDB\BSON\ObjectId(($user)->id)],
            ['user2'=>  new MongoDB\BSON\ObjectId(($user)->id)]
        ]
    ]
)->toArray();
?>

<div id="messages_wrapper">
    <div id="messages_menu">
        <div id="top_bar">
            <p>Conversaciones</p>
            <div id="msgs_search">
                <input id="msgs_search_box" type="search" name="msgs_search">
                <input id="msgs_search_btn" type="image" src="/DAW_proyecto_final/assets/icons/search.svg" alt="Icono de búsqueda">
            </div>
            <img src="/DAW_proyecto_final/assets/icons/new_chat.svg" alt="Nueva conversación">
        </div>
        <div id="conv_list">
            <?php
            foreach ($user_chats as $chat) {
                // Que rol tiene nuestro usuario (user1, user2...)
                $user_role = ($chat->user1 == $user->id) ? 'user1' : 'user2';

                // Info del otro usuario (imagen, nombre...)
                $other_user_id = ($user_role == 'user1') ? $chat->user2 : $chat->user1;
                $other_user_type = false;
                $other_user = $mongo_db->exec(
                    'find_one',
                    'users',
                    ['_id' => $other_user_id]
                );
                $other_user_type = 'user';

                if ($other_user == null) {
                    $other_user = $mongo_db->exec(
                        'find_one',
                        'producers',
                        ['_id' => $other_user_id]
                    );
                    $other_user_type = 'producer';
                }

                $other_user_profile_img = ($other_user->_id) ? "/DAW_proyecto_final/assets/db_data/users/$other_user->_id.jpg" : '/DAW_proyecto_final/assets/img/default_profile_img.png';

                $other_user_name = ($other_user_type == 'user') ? "{$other_user->name->name} {$other_user->name->surname1}" : $other_user->company_name;

                //Juntamos los mensajes y los ordenamos por fecha
                $ordered_msgs = array(...$chat->messages);
                foreach ($ordered_msgs as $msg) {
                    // iterator_to_array($msg); //OJO No se si esto es necesario
                    $msg->date = $msg->date->toDateTime();
                }

                function orderByDate($a, $b)
                {
                    return $a->date->getTimestamp() - $b->date->getTimestamp();
                }

                usort($ordered_msgs, 'orderByDate');

                // Dependiendo de esto, gestionamos los datos de una u otra forma

                require(__DIR__ . '/../blocks/message_card.php');
            }
            ?>
        </div>
    </div>
</div>
