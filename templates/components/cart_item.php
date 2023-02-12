<div class="cart_item">
    <!-- TODO hay que implemenmtar las funcionalidades del checkbox
        A saber:
            Actualizar la cesta
            Actualizar el precio total
            ...
    -->
    <div class="prod_img_wrapper">
        <input type="checkbox" name="" class="" <?php echo ($prod->selected) ? 'checked' : ''; ?> >
        <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod_info->imgs->cover ?>.jpg" alt="">
    </div>
    <div class="cart_text_wrap">
        <span class='name'><?php echo $prod_info->name ?></span>
        <!-- OJO Con la categoría se podrían agrupar los productos o algo parecido, para que sea más visual -->
        <!-- <span class="category"><?php //echo $prod_info['type'] ?></span> -->
        <!-- <span class="subtype"><?php //echo $prodSubcat ?></span> -->
        <span class="producer">Vendido por: <?php echo $producerName ?></span>
        <span class="stock"><?php echo $prod_info->stock[$prod_size_buyed]->qty > 0 ? 'En stock' : 'Agotado'; ?></span>
        <!-- <span class="total_prod_price"><?php //echo $totalPrice ?><span>€</span></span> -->
        <div class="prod_management">
            <select name="prod_qty">
                <option selected disabled hidden value="">Cant.: <?php echo $prod_qty_buyed ?></option>
                <option value="del">0 (Eliminar)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="cust">10+</option>
            </select>
            <a href="#">Eliminar</a>
            <a href="#">Guardar para más tarde</a>
            <a href="#">Ver otros productos como este</a>
        </div>
    </div>
    <span class="price"><?php echo $price ?>€</span>
</div>
