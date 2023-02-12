<div class="message_card">
    <button class="archive_msg">Archivar</button>
    <div class="user_img">
        <img src="<?php echo $other_user_profile_img; ?>" alt="Imagen de perfil de usuario">
    </div>
    <?php
    $last_msg = $ordered_msgs[count($ordered_msgs)-1];
    ?>
    <div class="msg_info">
        <p class="name"><?php echo $other_user_name; ?></p>
        <p class="last_msg"><?php
            $cosa = ($last_msg->user == substr($user_role, -1)) ? 'Tú' : $other_user_name;
            echo "$cosa: $last_msg->content";
        ?></p>
    </div>
    <div class="msg_last_date">
        <p class="last_date"><?php echo $last_msg->date->format("d-m-y"); ?></p>
    </div>
</div>
