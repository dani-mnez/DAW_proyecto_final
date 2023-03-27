<?php
// OJO Hay que volver a llamar a los archivos iniciales que definen mongo y las funciones
// Habrá alguna forma de evitar esto?
// TODO Mirar de acortar el path
include_once(__DIR__ . '../../../../../modules/classes.php');
include_once(__DIR__ . '../../../../../modules/functions.php');
include_once(__DIR__ . '../../../../../modules/init_code.php');

$chat = $mongo_db->exec(
    'find_one',
    'chats',
    [
        '_id' => new MongoDB\BSON\ObjectId($_GET['conv'])
    ]
);

$user = unserialize($_SESSION['user']);

// Que rol tiene nuestro usuario (user1, user2...)
$user_role = ($chat->user1 == $user->id) ? 'user1' : 'user2';

// Obtenemos información del otro usuario
$otherUserInfo = getChatUserData($chat);

// Obtener nombre del otro usuario
$other_user_name = ($otherUserInfo['type'] == 'user') ? "{$otherUserInfo['obj']->name->name} {$otherUserInfo['obj']->name->surname1}" : $otherUserInfo['obj']->company_name;

// Obtener imagen de perfil del otro usuario
$other_user_profile_img = ($otherUserInfo['obj']->profile_img) ? "/DAW_proyecto_final/assets/db_data/users/{$otherUserInfo['obj']->_id}.jpg" : '/DAW_proyecto_final/assets/img/default_profile_img.png';

//Juntamos los mensajes y los ordenamos por fecha
$ordered_msgs = array(...$chat->messages);
foreach ($ordered_msgs as $msg) {
    $msg->date = $msg->date->toDateTime();
}

function orderByDate($a, $b)
{
    return $a->date->getTimestamp() - $b->date->getTimestamp();
}
usort($ordered_msgs, 'orderByDate');

$other_user_id = ($user_role == 'user1') ? $chat->user2 : $chat->user1;
?>

<div id="chat_topbar">
    <h2 id="receiver_name"><?php echo $other_user_name ?></h2>
    <div id="actions">
        <span>Archivar conversación</span>
        <?php
        if ($otherUserInfo['type'] == 'user') {
            // TODO Esto aún no está implementado, se necesita tener la página de pedidos del productor y la de detalle de UN pedido
            $link = "";
            $linkText = "Ver pedidos realizados";
            // "<a href='/DAW_proyecto_final/productor/$other_user->_id'></a>";
        } else {
            $link = "/DAW_proyecto_final/templates/producer_shop.php?producer_id=$other_user_id";
            $linkText = "Visitar tienda";
        }
        echo "<a href='$link'>$linkText</a>"
        ?>
    </div>
</div>
<div id="chat_msgs">
    <div class="reverseScroll"> <!-- OJO Esto está puesto para hacer que la conversación empiece desde abajo -->
        <!-- TODO También se podría hacer que se recordara la posición del scroll y se volviera a poner ahí al recargar la página (sería agregar un campo más a los datos de chat, por usuario) (o hacerlo por cookies) -->
        <?php
        // OJO Hacer de esto una función?
        $grouped_msgs = array();

        foreach ($ordered_msgs as $msg) {
            $date = $msg->date;
            $date = formatDate($msg->date);

            if (!isset($grouped_msgs[$date])) {
                $grouped_msgs[$date] = array();
            }
            $grouped_msgs[$date][] = $msg;
        }

        $lastUser = "";
        $withImg = true;
        foreach ($grouped_msgs as $date => $msgs) {
            echo "<p class='chatDate'>$date</p>";
            foreach ($msgs as $msg) {
                $withImg = $lastUser != $msg->user;
                $lastUser = $msg->user;
                require(__DIR__ . '/../blocks/message_item.php');
            }
        }
        ?>
    </div>
</div>
<div id="chat_write">
    <input type="text" name="msgContent" id="msgBox" placeholder="Escribe un mensaje..." onkeypress='send_on_enter(<?php $user = substr($user_role, -1); echo "event, $user, \"{$chat->_id}\"" ?>)'>
    <button id="sendMsg" onclick='send_message(<?php
        echo "$user, \"{$chat->_id}\""; ?>), load_conversation(<?php echo "\"{$chat->_id}\"" ?>), update_conversation_card(<?php echo "\"{$chat->_id}\"" ?>)'>
        <img src="/DAW_proyecto_final/assets/icons/send.svg" alt="Enviar mensaje">
    </button>
</div>