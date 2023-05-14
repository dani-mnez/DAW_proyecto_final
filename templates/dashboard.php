<?php
include_once(__DIR__ . '/components/header.php');

$page_name = match ($_GET['page']) {
    'resume'     => 'Resumen',
    'profile'    => 'Perfil',
    'lists'      => 'Tus listas',
    'orders'     => 'Pedidos',
    'products'   => 'Tus productos',
    'sales'      => 'Ventas',
    'messages'   => 'Mensajes',
    'incidences' => 'Incidencias',
    'feedback'   => 'Feedback',
    'help'       => 'Ayuda'
};

$user = unserialize($_SESSION['user'])
?>
    <div id="content">
        <h1 id="dash_page_title"><?php echo $page_name; ?></h1>

        <div class="dash_info">
            <?php include_once(__DIR__ . '/components/dash/blocks/dash_menu.php'); ?>

            <div id="dash_content">
                <?php
                $user_data = $mongo_db->exec(
                    'find_one',
                    ($user->type == "buyer") ? 'users' : 'producers',
                    ['_id'=>  new MongoDB\BSON\ObjectId(($user)->id)]
                );

                switch ($_GET['page']) {
                    case 'resume':
                        if ($user->type == "buyer") {
                            echo "<div id='res_prof'>
                            <h1>Perfil</h1>";
                            require_once(__DIR__ . '/components/dash/pages/profile.php');
                            echo "</div>";

                            echo "<div id='res_lists'>
                            <h1>Tus listas</h1>";
                            require_once(__DIR__ . '/components/dash/blocks/list_lists.php');
                            echo "</div>";

                            echo "<div id='res_hist'>
                            <h1>Historial de pedidos</h1>";
                            require_once(__DIR__ . '/components/dash/pages/orders.php');
                            echo "<button>Ver todos los pedidos</button>
                            </div>";
                        } else {
                            echo "<div id='res_graph'>
                            <h1>Gráficos de ingresos</h1>";
                            require_once(__DIR__ . '/components/dash/blocks/graphs.php');
                            echo "</div>";
                            
                            echo "<div id='res_products'>
                            <h1>Tus productos</h1>";
                            require_once(__DIR__ . '/components/dash/pages/products.php');
                            echo "</div>";
                            
                            echo "<div id='res_incidences'>
                            <h1>Incidencias por resolver</h1>";
                            require_once(__DIR__ . '/components/dash/pages/incidences.php');
                            echo "</div>";
                        }
                        break;
                    case 'profile':
                        require_once(__DIR__ . '/components/dash/pages/profile.php');
                        break;
                    case 'lists':
                        require_once(__DIR__ . '/components/dash/pages/lists.php');
                        break;
                    case 'orders':
                        require_once(__DIR__ . '/components/dash/pages/orders.php');
                        break;
                    case 'products':
                        require_once(__DIR__ . '/components/dash/pages/products.php');
                        break;
                    case 'sales':
                        require_once(__DIR__ . '/components/dash/pages/sales.php');
                        break;
                    case 'messages':
                        require_once(__DIR__ . '/components/dash/pages/messages.php');
                        break;
                    case 'incidences':
                        require_once(__DIR__ . '/components/dash/pages/incidences.php');
                        break;
                    case 'feedback':
                        require_once(__DIR__ . '/components/dash/pages/feedback.php');
                        break;
                    case 'help':
                        require_once(__DIR__ . '/components/dash/pages/help.php');
                        break;
                    default:
                        break;
                }
                ?>
            </div>
        </div>
    </div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>
