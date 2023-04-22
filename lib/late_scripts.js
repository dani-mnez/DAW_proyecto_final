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

// Funcionalidad para agregar productos al carrito (desde la tarjeta de producto, sugerencia de producto o la tarjeta de producto en lista) - shop, cat_shop, product_detail, cart, dashboard (listas), detalle de pedidos...
// OJO Está casi todo hecho en functions.js y shop_logic.php

// Scripts específicos de cada página
let PAGE = document.body.dataset.page;
console.log(PAGE);

const pageFunctions = {
    shop: function () {
        setupProductCards();
    },
    product_detail: function () {
        const prod_id = document.getElementById("product_wrap").dataset.prodId;
        const add_cart_btn = document.getElementById("add_btn");
        add_cart_btn.addEventListener("click", () => {
            add_product_cart(prod_id);
        });
    },
    cat_shop: function () {
        setupProductCards();
        subCat_filter();
    },
    dashboard: function () {
        toggleEditBtns();
    },
};

if (PAGE in pageFunctions) {
    pageFunctions[PAGE]();
}

function setupProductCards() {
    const productCards = document.querySelectorAll(".product");

    for (const prod of productCards) {
        const prod_id = prod.dataset.id;

        prod.addEventListener("click", () => {
            window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod_id}`;
        });

        const add_cart_btn = prod.getElementsByClassName("add_cart_btn")[0];
        const like_prod_btn = prod.getElementsByClassName("like_btn")[0];

        add_cart_btn.addEventListener("click", (e) => {
            e.stopPropagation();
            console.log("addCart");
            add_product_cart(prod_id);
            // TODO Cambiar estilos del botón
        });

        like_prod_btn.addEventListener("click", (e) => {
            e.stopPropagation();
            console.log("likeProd");
            like_product(prod_id);
            // TODO Cambiar estilos del botón
        });
    }
}