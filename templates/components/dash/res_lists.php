<div id="res_lists">
    <h1>Tus listas</h1>

    <div id="lists_wrapper">
        <?php
        foreach ($user_data->lists as $list_key => $list_data) {
            require(__DIR__.'/list_card.php');
        }?>
        <button id="view_all_lists">Ver todas las listas</button>
    </div>
</div>
