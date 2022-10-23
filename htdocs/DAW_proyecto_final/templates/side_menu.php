<div id="side_menu">
    <nav class="out_shadow" aria-label="Menú lateral">
        <?php
            $result = $db_access->execQuery("SELECT DISTINCT `type` FROM `products` ORDER BY `qty` DESC");

            if ($result->num_rows > 0) {
                $flat_array = call_user_func_array('array_merge', $result->fetch_all());
                foreach ($flat_array as $val) {
                    echo "<a>$val</a>";
                }
            }
        ?>
    </nav>
    <div id="bkg_sel" class="out_shadow"/>
</div>
