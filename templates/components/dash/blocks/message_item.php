<?php
$class = ($msg->user != substr($user_role, -1)) ? "other_user" : "me";
// TODO Revisar si los mensajes de la misma persona son inmediatos o no para poner o no la imagen de perfil
if ($msg->user != substr($user_role, -1)) {
    $class = "other_user";
    $img = $other_user_profile_img;
} else {
    $class = "me";
    $img = "/DAW_proyecto_final/assets/db_data/users/{$user->id}.jpg";
}
if (!$withImg) $class .= " spaced";
?>
<div class="message_item <?php echo $class; ?>">
    <?php if ($withImg) : ?>
        <img src="<?php echo $img; ?>" alt="">
    <?php endif; ?>
    <div class="message">
        <p><?php echo $msg->content; ?></p>
    </div>
    <p class="hour"><?php echo $msg->date->format('H:i'); ?></p>
</div>