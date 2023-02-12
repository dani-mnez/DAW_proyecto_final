<div id="lists_wrapper">
    <?php
    foreach ($user_data->lists as $list_key => $list_data) {
        require(__DIR__.'/list_card.php');
    }?>
    <?php if ($_GET['page'] == 'resume'): ?>
        <a href="/DAW_proyecto_final/templates/dashboard.php?page=lists" id="view_all_lists">Ver todas las listas</a>
    <?php elseif ($_GET['page'] == 'lists'): ?>
        <!-- TODO Hacer la logica de esto de abajo para introducir un formulario de creación -->
        <a href="/DAW_proyecto_final/templates/dashboard.php?page=lists" id="create_list">Crea una nueva lista</a>
    <?php endif; ?>
</div>
