<?php include_once(__DIR__ . '/components/header.php'); ?>
    <div id="content">
        <?php include_once(__DIR__ . '/components/dash_menu.php'); ?>

        <div id="dash_content">
            <?php

            $user_data = $mongo_db->exec(
                'find_one',
                'users',
                ['mail'=> unserialize($_SESSION['user'])->mail]
            );

            if (unserialize($_SESSION['user'])->type == "buyer") {
                require_once(__DIR__ . '/components/dash/res_profile.php');
                require_once(__DIR__ . '/components/dash/res_lists.php');
                require_once(__DIR__ . '/components/dash/res_hist.php');
            } else {
                require_once(__DIR__ . '/components/dash/res_graphs.php');
                require_once(__DIR__ . '/components/dash/res_products.php');
                require_once(__DIR__ . '/components/dash/res_incid.php');
            }
            ?>

            <!-- FIX Lo de abajo es para borrar, se implementará en los componentes de arriba -->
            <a href="./components/update_info.php">Modifica tu información</a>
        </div>
    </div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>
