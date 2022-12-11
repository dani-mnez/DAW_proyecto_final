<div id="opinion_menu">
    <div id="opinion_stats">
        <div id="prod_opinion_val">
            <img src="<?php echo '/DAW_proyecto_final/assets/img/rate_imgs/' . strtr((string) round($mean_rate*2)/2, '.', '_') . '.svg';?>" alt="<?php echo "Valoración media de $mean_rate";?>">
            <p><?php echo "$mean_rate sobre 5";?></p>
        </div>
        <p><?php echo "$total_rates valoraciones globales";?></p>
        <table>
            <?php
            $bar_value = [
                round($rate_distribution[0]*100),
                round($rate_distribution[1]*100),
                round($rate_distribution[2]*100),
                round($rate_distribution[3]*100),
                round($rate_distribution[4]*100)
            ];

            $bar_style = array_map(function ($v) {
                return $v == 0 ? 'display:none;' : "width: $v%;";
            }, $bar_value);
            ?>
            <tr>
                <td>5 estrellas</td>
                <td><div class="rate_bar"><div class="rate_meter" style="<?php echo $bar_style[0] ?>"/></div></td>
                <td><?php echo $bar_value[0].'%' ?></td>
            </tr>
            <tr>
                <td>4 estrellas</td>
                <td><div class="rate_bar"><div class="rate_meter" style="<?php echo $bar_style[1] ?>"/></div></td>
                <td><?php echo $bar_value[1].'%' ?></td>
            </tr>
            <tr>
                <td>3 estrellas</td>
                <td><div class="rate_bar"><div class="rate_meter" style="<?php echo $bar_style[2] ?>"/></div></td>
                <td><?php echo $bar_value[2].'%' ?></td>
            </tr>
            <tr>
                <td>2 estrellas</td>
                <td><div class="rate_bar"><div class="rate_meter" style="<?php echo $bar_style[3] ?>"/></div></td>
                <td><?php echo $bar_value[3].'%' ?></td>
            </tr>
            <tr>
                <td>1 estrellas</td>
                <td><div class="rate_bar"><div class="rate_meter" style="<?php echo $bar_style[4] ?>"/></div></td>
                <td><?php echo $bar_value[4].'%' ?></td>
            </tr>
        </table>
    </div>

    <div id="cta_opinion">
        <h3>Valora este producto</h3>
        <p>Ayuda a otros clientes con tu opinión</p>
        <button>Escribir mi opinión</button>
    </div>
</div>