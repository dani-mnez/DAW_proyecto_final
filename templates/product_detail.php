<?php require_once('../templates/components/header.php');
// Lógica de la llamada GET para obtener todos los datos
if (isset($_GET['id'])) {
    $prod = $mongo_db->exec(
        'find_one',
        'products',
        // OJO Para seleccionar un objeto por su ID, ha de crearse primero un objeto BSON de tipo ObjectId
        ['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]
    );

    if (property_exists($prod, 'promotion')) {
        $promo = $mongo_db->exec(
            'find_one',
            'promotions',
            ['_id' => $prod->promotion]
        );

        $disc = $promo->amount;
    }

    $producer = $mongo_db->exec(
        'find_one',
        'producers',
        ['_id' => $prod->producer]
    );
}
?>

<div id="content">
    <div id="product_wrap" data-prod-id="<?php echo $_GET['id'] ?>">
        <div id="product_info">
            <?php require('../templates/components/prod_detail/img_viewer.php') ?>
            <div id="product_desc">
                <div id="text_data">
                    <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=<?php echo $prod->producer ?>" class="producer_name"><?php echo $producer->company_name ?></a>
                    <span class="product_name"><?php echo $prod->name ?></span>
                    <div class="price">
                        <?php if (isset($disc)) : ?>
                            <?php if ($promo->amount > 1) : ?>
                                <span><?php echo $prod->stock[0]->price - $disc . '€' ?></span>
                                <span class='discount'><?php echo "-$disc" ?></span>
                            <?php else : ?>
                                <span><?php echo $prod->stock[0]->price - ($disc * $prod->stock[0]->price) . '€' ?></span>
                                <span class='discount'><?php echo '-' . $disc * 100 . '%' ?></span>
                            <?php endif; ?>
                        <?php else : ?>
                            <span><?php echo $prod->stock[0]->price . '€' ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="description">
                        <?php if ($prod->description->title) : ?>
                            <p class="descript_title"><?php echo $prod->description->title ?></p>
                        <?php endif; ?>
                        <p class="descript_body"><?php echo $prod->description->long ?></p>
                    </div>
                </div>
                <form id="prod_cta" action="" method="post">
                    <label>Tamaño:</label>
                    <fieldset>
                        <?php foreach ($prod->stock as $idx => $val) : ?>
                            <div class="format_sel_item">
                                <?php if ($idx == 0) : ?>
                                    <input id="<?php echo "{$val->format}_{$idx}"; ?>" type="radio" name="prod_size" value="<?php echo $idx ?>" checked>
                                <?php else : ?>
                                    <input id="<?php echo "{$val->format}_{$idx}"; ?>" type="radio" name="prod_size" value="<?php echo $idx ?>">
                                <?php endif; ?>
                                <label for="<?php echo "{$val->format}_{$idx}" ?>"><?php echo $val->format; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                    <div id="prod_qty_selector">
                        <button id="subs_prod_qty_btn" type="button">-</button>
                        <span id="prod_qty">1</span>
                        <button id="add_prod_qty_btn" type="button">+</button>
                    </div>

                    <button id="add_btn">Añadir a la cesta</button>
                </form>
                <div id="nut_info">
                    <div id="nut_info_tabs">
                        <span class="nut_info_tab_active">Información nutricional</span>
                        <span <?php
                                if (count($prod->allergens) > 0) {

                                    $allergens_to_show = '';
                                    foreach ($prod->allergens as $idx => $val) {
                                        $allergens_to_show .= $val;
                                        if ($idx < count($prod->allergens) - 1) {
                                            $allergens_to_show .= '/';
                                        }
                                    }
                                    echo "data-alergens='$allergens_to_show'";
                                }
                                ?>>Alérgenos</span>
                    </div>
                    <div class="nut_info_content">
                        <table>
                            <tr>
                                <th></th>
                                <th>Por 100g</th>
                                <th>Por cantidad seleccionada</th>
                            </tr>
                            <tr>
                                <th>Valor energético</th>
                                <td><?php echo $prod->nut_info->kcals * 4.184 . "kJ / {$prod->nut_info->kcals} kcal" ?></td>
                                <td><?php echo (($prod->nut_info->kcals * 4.184) * $prod->stock[0]->weight / 100) . 'kJ / ' . ($prod->nut_info->kcals * $prod->stock[0]->weight / 100) . 'kcal' ?></td>
                            </tr>
                            <tr>
                                <th><span>Grasas</span><br>de las cuales:</th>
                                <td><?php echo $prod->nut_info->fats->total ?>g</td>
                                <td><?php echo $prod->nut_info->fats->total * $prod->stock[0]->weight / 100 ?>g</td>
                            </tr>
                            <tr>
                                <td>Saturadas</td>
                                <td><?php echo $prod->nut_info->fats->sat ?>g</td>
                                <td><?php echo $prod->nut_info->fats->sat * $prod->stock[0]->weight / 100 ?>g</td>
                            </tr>
                            <tr>
                                <th><span>Hidratos de carbono</span><br> de los cuales:</th>
                                <td><?php echo $prod->nut_info->carbs->total ?>g</td>
                                <td><?php echo $prod->nut_info->carbs->total * $prod->stock[0]->weight / 100 ?>g</td>
                            </tr>
                            <tr>
                                <td>Azúcares</td>
                                <td><?php echo $prod->nut_info->carbs->sugar ?>g</td>
                                <td><?php echo $prod->nut_info->carbs->sugar * $prod->stock[0]->weight / 100 ?>g</td>
                            </tr>
                            <tr>
                                <th>Proteínas</th>
                                <td><?php echo $prod->nut_info->prots ?>g</td>
                                <td><?php echo $prod->nut_info->prots * $prod->stock[0]->weight / 100 ?>g</td>
                            </tr>
                            <tr>
                                <th>Sal</th>
                                <td><?php echo $prod->nut_info->salt ?>g</td>
                                <td><?php echo $prod->nut_info->salt * $prod->stock[0]->weight / 100 ?>g</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="buyed_together">
            <h2>Comprados juntos</h2>
             TODO
        </div> -->

        <div id="similar_prods">
            <h2>Productos similares</h2>
            <div class="all_sim_prods">
                <?php
                $sim_prods = $mongo_db->exec(
                    'find',
                    'products',
                    ['category' => $prod->category]
                );

                foreach ($sim_prods as $s_prod) {
                    if ($s_prod->_id != $prod->_id) {
                        require('../templates/components/prod_detail/sim_prod_card.php');
                    }
                }
                ?>
            </div>
        </div>
        <div id="ratings">
            <?php
            $opinion = $mongo_db->exec(
                'find',
                'opinions',
                ['to' => $prod->_id]
            )->toArray();

            $total_rates = count($opinion);
            $mean_rate = 0;
            $rate_distribution = [0, 0, 0, 0, 0];

            if ($total_rates > 0) {
                foreach ($opinion as $op) {
                    $mean_rate += $op->rate;

                    $rate_distribution[$op->rate - 1] += 1 / $total_rates;
                }

                $mean_rate /= $total_rates;
            }
            ?>

            <h2>Opiniones</h2>
            <!-- TODO Meter el link "Mostrar más opiniones" si aún quedan más de las mostradas actualmente, si no hay mas o no hay, no mostrarlo -->
            <div id="opinion_wrapper">
                <?php require('../templates/components/prod_detail/opinion_menu.php') ?>

                <div id="opinion_list">
                    <?php
                    if ($total_rates == 0) {
                        echo "<p class='no_opinions'>Aún no hay opiniones para este producto</p>";
                    } else {
                        foreach ($opinion as $op) {
                            $userName = $mongo_db->exec(
                                'find_one',
                                'users',
                                ['_id' => $op->from]
                            )->name->name;
                            require('../templates/components/prod_detail/opinion.php');
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="alim_safety">
        <h2>Seguridad alimentaria</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
    </div>
</div>
<?php require_once('../templates/components/footer.php'); ?>