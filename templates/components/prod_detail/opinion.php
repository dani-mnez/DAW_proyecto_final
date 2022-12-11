<div class="prod_opinion">
    <div class="user_info">
        <img src="<?php echo '/DAW_proyecto_final/assets/db_data/users/' . (string) $op->from . '.jpg';?>" alt="">
        <p><?php echo $userName ?></p>
    </div>
    <div class="rate">
        <div class="visual_rate">
            <img src="<?php echo '/DAW_proyecto_final/assets/img/rate_imgs/' . strtr((string) round($op->rate*2)/2, '.', '_') . '.svg';?>" alt="<?php echo "Valoración de $op->rate";?>">
            <p><?php echo $op->body->title ?></p>
        </div>
        <?php $form_date = formatMongoDate($op->publish_date); ?>
        <p><?php echo $form_date ?></p>
    </div>
    <p class="opinion_body"><?php echo $op->body->body ?></p>
    <p class='util_count'>A <?php
    echo $op->body->likes; echo ($op->body->likes > 1) ? " personas" : " persona";?> le ha resultado útil</p>
    <div class="opinion_cta">
        <button>Me resultó útil</button>
        <a href="">Informa de un comportamiento negativo</a>
    </div>
</div>
