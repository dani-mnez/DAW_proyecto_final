-- Para la selección de la info en cart.php
SELECT
	carts.prod_qty AS cart_prod_qty,
    products.name AS product_name,
    products.price AS product_price,
    products.qty AS product_stock_qty,
    products.type AS product_type,
    products.subtype AS product_subtype,
    products.prod_img_name AS product_img,
    producers.name AS producer_name
FROM carts
JOIN products ON carts.prod_id = products.id
JOIN producers ON producers.mail = products.producer_id