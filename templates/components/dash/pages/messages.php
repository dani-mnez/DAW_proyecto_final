<?php
$user_chats = $mongo_db->exec(
    'find',
    'chats',
    [
        '$or' =>
        [
            ['user1' =>  new MongoDB\BSON\ObjectId(($user)->id)],
            ['user2' =>  new MongoDB\BSON\ObjectId(($user)->id)]
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
            if (count($user_chats) == 0) {
                echo "<p id='no_chats'>Aún no has iniciado ninguna conversación.</br>Pulsa el botón'<img src='/DAW_proyecto_final/assets/icons/new_chat.svg' alt='Nueva conversación'>' para iniciar una nueva conversación.</p>";
            } else {
                $archived_chats = 0;
                foreach ($user_chats as $chat) {
                    // Que rol tiene nuestro usuario (user1, user2...)
                    $user_role = ($chat->user1 == $user->id) ? 'user1' : 'user2';

                    // Dependiendo de esto, gestionamos los datos de una u otra forma
                    if ($chat->archived[$user_role] == false) {
                        $otherUserInfo = getChatUserData($chat);

                        // Obtener imagen de perfil del otro usuario
                        $other_user_profile_img = ($otherUserInfo['obj']->profile_img) ? "/DAW_proyecto_final/assets/db_data/users/{$otherUserInfo['obj']->_id}.jpg" : '/DAW_proyecto_final/assets/img/default_profile_img.png';

                        // Obtener nombre del otro usuario
                        $other_user_name = ($otherUserInfo['type'] == 'user') ? "{$otherUserInfo['obj']->name->name} {$otherUserInfo['obj']->name->surname1}" : $otherUserInfo['obj']->company_name;

                        $last_msg = $chat->messages[count($chat->messages) - 1];

                        require(__DIR__ . '/../blocks/message_card.php');
                    } else {
                        $archived_chats++;
                    }
                }

                if ($archived_chats > 0) {
                    echo "<p class='no_chats'>Ver chats archivados ($archived_chats)</p>";
                }
            }
            ?>
        </div>
    </div>
    <div id="msgsDivider"></div>
    <div id="conversation">
        <p>Selecciona una conversación</p>
    </div>
</div>