<div class="cart_item">
    <!-- TODO hay que implemenmtar las funcionalidades del checkbox
        A saber:
            Actualizar la cesta
            Actualizar el precio total
            ...
    -->
    <div class="prod_img_wrapper">
        <input type="checkbox" name="" class="">
        <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod['product_img'] ?>" alt="">
    </div>
    <div class="cart_text_wrap">
        <span class='name'><?php echo $prod['product_name'] ?></span>
        <!-- OJO Con la categoría se podrían agrupar los productos o algo parecido, para que sea más visual -->
        <!-- <span class="category"><?php //echo $prod['type'] ?></span> -->
        <span class="subtype"><?php echo $prod['product_subtype'] ?></span>
        <span class="producer">De <?php echo $prod['producer_name'] ?></span>
        <span class="stock"><?php echo $prod['product_stock_qty'] > 0 ? 'En stock' : 'Agotado'; ?></span>
        <span class="total_prod_price"><?php echo $prod['product_price'] * $prod['cart_prod_qty'] ?><span>€</span></span>
        <div class="prod_management">
            <select name="prod_qty">
                <option selected disabled hidden value="">Cant.: <?php echo $prod['cart_prod_qty'] ?></option>
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
    <span class="price"><?php echo $prod['product_price'] ?>€</span>
</div>
