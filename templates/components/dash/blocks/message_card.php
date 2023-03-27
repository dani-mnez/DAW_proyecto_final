<div class="message_card" data-conv-id="<?php echo $chat->_id ?>" onclick="load_conversation('<?php echo $chat->_id ?>')" >
    <button class="archive_msg"><img src="/DAW_proyecto_final/assets/icons/x.svg" alt="Archiva conversación"></button>
    <div class="user_img">
        <img src="<?php echo $other_user_profile_img; ?>" alt="Imagen de perfil de usuario">
    </div>
    <div class="msg_info">
        <p class="name"><?php echo $other_user_name; ?></p>
        <p class="last_msg"><?php
            $cosa = ($last_msg->user == substr($user_role, -1)) ? 'Tú' : $other_user_name;
            echo "$cosa: $last_msg->content";
        ?></p>
    </div>
    <div class="msg_last_date">
        <p class="last_date"><?php echo "{$last_msg->date->toDatetime()->format('d M y')}<br/>{$last_msg->date->toDatetime()->format('H:i')}"; ?></p>
    </div>
</div>
