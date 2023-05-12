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

        setupImgViewer();
        modifyProdQty();
        prodInfoTabs();
        setupSimilarProdCards();

    },
    cat_shop: function () {
        setupProductCards();
        subCat_filter();
    },
    dashboard: function () {
        toggleEditBtns();
    },
    cart: function () {
        const cart_items = [...document.getElementsByClassName("cart_item")];

        cart_items.forEach((item) => {
            const prod_id = item.dataset.prodId,
                prod_cta =
                    item.getElementsByClassName("prod_management")[0].children,
                qty_input = prod_cta[0],
                delete_prod_btn = prod_cta[1],
                save_prod_btn = prod_cta[2],
                sel_checkbox = item.getElementsByClassName("prod_checkbox")[0];

            qty_input.addEventListener("change", () => {
                console.log("Se cambia la cantidad");
                console.log(qty_input.value);
            });

            sel_checkbox.addEventListener("click", () => {
                if (sel_checkbox.checked) {
                    console.log("Se selecciona");
                } else {
                    console.log("Se deselecciona");
                }
            });
        });
        toggleCtaBtns();
        updateSelectedDatabase();
    },
};

if (PAGE in pageFunctions) {
    pageFunctions[PAGE]();
}

// Para detalle de producto
function setupImgViewer() {
    const main_img = document.getElementById("main_image"),
        prev_img = document.getElementById("img_viewer_nav_left"),
        next_img = document.getElementById("img_viewer_nav_right"),
        thumbnails = [...document.getElementsByClassName("thumbnail")];
    let current_idx = 0;

    function updateImage(new_idx) {
        thumbnails[current_idx].classList.remove("selected_thumbnail");
        current_idx = new_idx;
        main_img.src = thumbnails[current_idx].src;
        thumbnails[current_idx].classList.add("selected_thumbnail");
    }

    thumbnails.forEach((thumbnail, thmb_idx) => {
        thumbnail.addEventListener("click", () => {
            updateImage(thmb_idx);
        });
    });

    prev_img.addEventListener("click", () => {
        const new_idx =
            current_idx > 0 ? current_idx - 1 : thumbnails.length - 1;
        updateImage(new_idx);
    });

    next_img.addEventListener("click", () => {
        const new_idx =
            current_idx < thumbnails.length - 1 ? current_idx + 1 : 0;
        updateImage(new_idx);
    });
}

function modifyProdQty() {
    const prod_qty = document.getElementById("prod_qty"),
        add_qty_btn = document.getElementById("add_prod_qty_btn"),
        sub_qty_btn = document.getElementById("subs_prod_qty_btn");
    let current_qty = 1;

    add_qty_btn.addEventListener("click", () => {
        current_qty++;
        prod_qty.textContent = current_qty;
    });

    sub_qty_btn.addEventListener("click", () => {
        if (current_qty > 1) {
            current_qty--;
            prod_qty.textContent = current_qty;
        }
    });
}

function prodInfoTabs() {
    const nut_info_tab = document.getElementById("nut_info_tabs").children[0],
        nut_info_tab_content =
            document.getElementsByClassName("nut_info_content")[0],
        nutrotional_info = nut_info_tab_content.innerHTML,
        alergens_tab = document.getElementById("nut_info_tabs").children[1],
        alergens_tab_content =
            alergens_tab.dataset.alergens != undefined
                ? alergens_tab.dataset.alergens.split("/")
                : [];
    let current_tab = nut_info_tab;

    nut_info_tab.addEventListener("click", () => {
        if (current_tab != nut_info_tab) {
            current_tab.classList.remove("nut_info_tab_active");
            current_tab = nut_info_tab;
            current_tab.classList.add("nut_info_tab_active");

            nut_info_tab_content.innerHTML = nutrotional_info;
        }
    });

    alergens_tab.addEventListener("click", () => {
        if (current_tab != alergens_tab) {
            current_tab.classList.remove("nut_info_tab_active");
            current_tab = alergens_tab;
            current_tab.classList.add("nut_info_tab_active");

            if (alergens_tab_content.length > 0) {
                nut_info_tab_content.innerHTML = "";
                alergens_tab_content.forEach((alergen) => {
                    nut_info_tab_content.innerHTML += `<p>${alergen}</p>`;
                });
            } else {
                nut_info_tab_content.innerHTML =
                    "<p>No se conocen alérgenos para este producto</p>";
            }
        }
    });
}

function setupSimilarProdCards() {
    const similar_prod_cards = document.getElementsByClassName("sim_prod");

    for (const card of similar_prod_cards) {
        const prod_id = card.dataset.id;

        card.addEventListener("click", () => {
            window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod_id}`;
        });
    }
}

// Para las tarjetas de producto (shop, cat_shop)
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
            add_cart_btn.classList.add("add_cart_btn_clicked");
            setTimeout(() => {
                add_cart_btn.classList.remove("add_cart_btn_clicked");
            }, 200);
        });

        like_prod_btn.addEventListener("click", (e) => {
            let isFaved = like_prod_btn.classList.contains("faved");

            e.stopPropagation();
            console.log("likeProd");
            like_product(prod_id);
            like_prod_btn.classList.toggle("faved");

            like_prod_btn.children[0].src = isFaved
                ? "/DAW_proyecto_final/assets/icons/fav.svg"
                : "/DAW_proyecto_final/assets/icons/fav_full.svg";
        });
    }
}

// Para carrito
function checkProdUpdate() {}

function toggleCtaBtns() {
    const for_later_btn_tab = document.getElementById("later_btn_tab"),
        prev_buyed_btn = document.getElementById("recent_btn_tab"),
        list_content = document.getElementById("list_prod_wrapper"),
        saved_for_later_content = list_content.innerHTML;
    let prev_buyed_content = false;

    let current_tab = for_later_btn_tab;

    for_later_btn_tab.addEventListener("click", () => {
        if (current_tab != for_later_btn_tab) {
            current_tab.classList.remove("selected_cta_tab");
            current_tab = for_later_btn_tab;
            current_tab.classList.add("selected_cta_tab");

            list_content.innerHTML = saved_for_later_content;
        }
    });

    prev_buyed_btn.addEventListener("click", () => {
        if (current_tab != prev_buyed_btn) {
            current_tab.classList.remove("selected_cta_tab");
            current_tab = prev_buyed_btn;
            current_tab.classList.add("selected_cta_tab");

            // FIX Hacer que el condicional funcione, hasta ahora solo entra en el IF
            if (prev_buyed_content == false) {
                buyed_prods_get_info();
            } else {
                list_content.innerHTML = prev_buyed_content;
            }
        }
    });
}

// Funcion para comprobar que el producto esta marcado con checkbox al tramitar pedido

function updateSelectedDatabase() {
    let products_cart = [...document.getElementsByClassName("cart_item")];
    products_cart.forEach((product) => {
        let checked_status = product.getElementsByClassName("prod_checkbox")[0].checked;
        product.addEventListener("change", () => {
            checked_status = !checked_status;
            // Lógica
            update_selected_prod(product.dataset.prodId, checked_status);
        });
    });
}