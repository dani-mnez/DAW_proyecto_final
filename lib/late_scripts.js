// Para el menú de la foto de perfil
if (document.getElementById("prof_wrap")) {
    let profile_pic = document.getElementById("prof_wrap"),
        prof_menu = document.getElementById("profile_pic_menu");

    profile_pic.addEventListener("mouseenter", () => {
        // position_menu()
        prof_menu.style.display = "block";
    });

    profile_pic.addEventListener("mouseleave", () => {
        prof_menu.style.display = "none";
    });
}

// Para acceder a las páginas de detalle de producto
let product_cards = document.getElementsByClassName("product");

for (const prod of product_cards) {
    prod.addEventListener("click", () => {
        window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod.getAttribute(
            "data-id"
        )}`;
    });
}

// Funcionalidad para agregar productos al carrito (desde la tarjeta de producto, sugerencia de producto o la tarjeta de producto en lista) - shop, cat_shop, product_detail, cart, dashboard (listas), detalle de pedidos...
// OJO Está casi todo hecho en functions.js y shop_logic.php

// Scripts específicos de cada página
let PAGE = document.getElementsByTagName("body")[0].getAttribute("data-page");
console.log(PAGE);
switch (PAGE) {
    case "index":
        break;
    case "shop":
        let prods = document.getElementsByClassName("product");

        for (const prod of prods) {
            prod.addEventListener("mouseover", (e) => {
                console.log(e.target);
            });
        }
        break;
    case "cat_shop":
        subCat_filter();
        break;
    case "cart":
        break;
    case "dashboard":
        toggleEditBtns();
        break;
    default:
        break;
}