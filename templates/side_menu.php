<div id="side_menu">
    <nav class="out_shadow" aria-label="Menú lateral">
        <?php
            $result = $db_access->execQuery('all_cat_prods', null);

            if ($result) {
                foreach ($result as $row) {
                    echo "<a>{$row['type']}</a>";
                }
            }
        ?>
    </nav>
    <div id="bkg_sel" class="out_shadow"></div>
</div>
