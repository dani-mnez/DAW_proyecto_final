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

function updateMenuQty(qtyToAdd) {
    let actualQty = parseInt(document.querySelector("#cart_icon p").innerHTML);
    document.querySelector("#cart_icon p").innerHTML = actualQty + qtyToAdd;
}

// Scripts específicos de cada página
let PAGE = document.body.dataset.page;
console.log(PAGE);

const pageFunctions = {
    shop: function () {
        setupProductCards();
    },
    product_detail: function () {
        // Agregar producto al carrito
        const prod_id = document.getElementById("product_wrap").dataset.prodId;
        const add_cart_btn = document.getElementById("add_btn");
        let prodSize = [0],
            prodQty = [1];

        add_cart_btn.addEventListener("click", (e) => {
            e.preventDefault();
            add_product_cart(prod_id, prodSize[0], prodQty[0]);
            updateMenuQty(prodQty[0]);
        });

        setupImgViewer();
        recalculateNutritionalInfo(prodSize);
        modifyProdQty(prodQty);
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
        const items_container = document.getElementById("cart_items"),
            qtyDropdownMenu = document.getElementById("qty_select_dropdown"),
            listWrapper = document.getElementById("list_prod_wrapper"),
            for_later_btn_tab = document.getElementById("later_btn_tab"),
            prev_buyed_btn = document.getElementById("recent_btn_tab"),
            list_content = document.getElementById("list_prod_wrapper"),
            saved_for_later_content = list_content.innerHTML;
        let prod_id,
            prodSize,
            nextStatus,
            prod_card,
            prod_qty_wrapper_clicked,
            actualProduct,
            actualProductExtraInfo,
            actualQty,
            current_tab = for_later_btn_tab,
            prev_buyed_content = false;

        // Visibilidad del dropdown de cantidad
        qtyDropdownMenu.addEventListener("blur", () => {
            qtyDropdownMenu.style.display = "none";

            // Quitamos el resaltado del elemento del dropdown
            let highlightedElement =
                qtyDropdownMenu.getElementsByClassName("selected_qty")[0];

            if (highlightedElement != undefined) {
                highlightedElement.classList.remove("selected_qty");
            }
        });

        // Acciones generales de las listas de Tus productos
        listWrapper.addEventListener("click", (e) => {
            const targetEl = e.target,
                list_prod_id = targetEl.closest(".list_product").dataset.id;

            if (targetEl.id == "") {
                if (targetEl.tagName == "IMG") {
                    window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${list_prod_id}`;
                } else if (targetEl.tagName == "BUTTON") {
                    replace_cart_list_item(
                        list_prod_id,
                        items_container,
                        targetEl.closest(".list_product"),
                        [allCartProds, allProductsInfo]
                    );
                } else if (
                    targetEl.tagName == "A" &&
                    targetEl.parentElement.classList.contains("list_item_cta")
                ) {
                    delete_cart_list_item(list_prod_id);
                    targetEl.closest(".list_product").remove();
                }
            }
        });

        // Acciones generales de los productos del carrito
        items_container.addEventListener("click", (e) => {
            const targetEl = e.target;

            prod_card = targetEl.closest(".cart_item");
            prod_id = prod_card.dataset.prodId;
            prodSize = prod_card.dataset.prodSize;
            actualProduct = allCartProds.find(
                (prod) => prod.product.$oid == prod_id
            );
            actualProductExtraInfo = allProductsInfo.find(
                (prod) => prod._id.$oid == prod_id
            );
            actualQty = actualProduct.sizes[prodSize].qty;

            // Para el selector de cantidad que ejecuta el dropdown (de 1 a 9)
            if (
                targetEl.className == "prod_qty_wrapper" ||
                targetEl.parentElement.className == "prod_qty_wrapper"
            ) {
                if (targetEl.className == "prod_qty_wrapper") {
                    prod_qty_wrapper_clicked = targetEl;

                    actualQty = parseInt(
                        targetEl.getElementsByClassName("prod_qty_number")[0]
                            .innerHTML
                    );
                } else {
                    prod_qty_wrapper_clicked = targetEl.parentElement;

                    if (targetEl.classList.contains("prod_qty_number")) {
                        actualQty = parseInt(targetEl.innerHTML);
                    } else {
                        actualQty = parseInt(
                            targetEl.nextElementSibling != null
                                ? targetEl.nextElementSibling.innerHTML
                                : targetEl.previousElementSibling.innerHTML
                        );
                    }
                }
                showQtyDropdown(prod_qty_wrapper_clicked, actualQty);
            }

            if (targetEl.classList.length > 0) {
                switch (targetEl.classList.value) {
                    case "prod_checkbox":
                        nextStatus = targetEl.checked;

                        update_selected_prod(prod_id, nextStatus, prodSize);
                        updateTotals({
                            nextStatus: nextStatus,
                            newQty: 0,
                            prod_id: prod_id,
                            prodSize: prodSize,
                        });
                        break;

                    case "cart_card_cta_btn":
                        if (targetEl.dataset.action == "delete") {
                            del_prod_cart(prod_id, prodSize);
                        } else {
                            del_prod_cart(prod_id, prodSize);

                            // Comprobamos si el producto ya está en la lista de para comprar más tarde
                            let prodAlreadySaved = likeList.some((item) => {
                                if (item.$oid == prod_id) {
                                    return true;
                                }
                            });

                            if (!prodAlreadySaved) {
                                save_for_later(prod_id);

                                if (current_tab == for_later_btn_tab) {
                                    list_content.innerHTML += `<div class="list_product" data-id="${prod_id}">
                                        <img src="/DAW_proyecto_final/assets/db_data/products/${actualProductExtraInfo.imgs.cover}.jpg" alt="Imagen de producto">

                                        <p class='product_name'>${actualProductExtraInfo.name}</p>
                                        <p class='producer_name'>Vendido por: <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=${actualProductExtraInfo.producer}">${actualProductExtraInfo.producerName}</a></p>
                                        <p class="price">${actualProductExtraInfo.stock[0].price}<span>€</span></p>
                                        <p class='remaining'>Quedan ${actualProductExtraInfo.stock[0].qty} unidades</p>
                                        <div class="list_item_cta">
                                            <button>Mover a la cesta</button>
                                            <a href="">Eliminar</a>
                                        </div>
                                    </div>`;
                                } else {
                                    // TODO Actualizar un objeto de los productos para mas tarde
                                }
                            }
                        }
                        updateMenuQty(-actualQty);
                        prod_card.remove();
                        updateTotals({
                            newQty: 0,
                            prod_id: prod_id,
                            prodSize: prodSize,
                        });
                        break;

                    case "qty_checkbox_btn":
                        e.preventDefault();
                        let new_qty = parseInt(
                            e.target.previousElementSibling.value
                        );

                        if (new_qty == 0) {
                            del_prod_cart(prod_id, prodSize);

                            updateMenuQty(-actualQty);
                            prod_card.remove();
                        } else {
                            // Si la cantidad está entre 1 y 9, se pone el selector standard (dropdown)
                            if (new_qty < 10) {
                                // Creamos el selector de unidades
                                let dropdownQtySelector =
                                    document.createElement("div");
                                dropdownQtySelector.classList.add(
                                    "prod_qty_wrapper"
                                );
                                dropdownQtySelector.innerHTML = `<span>Cant.:&nbsp;</span>
                    <span class="prod_qty_number">${new_qty}</span>
                    <img src="/DAW_proyecto_final/assets/icons/expand.svg" alt="">`;

                                // Reemplazamos el selector de unidades
                                e.target.parentElement.replaceWith(
                                    dropdownQtySelector
                                );
                            }
                            updateMenuQty(new_qty - actualQty);
                            update_qty_prod(prod_id, new_qty, prodSize);
                        }

                        updateTotals({
                            newQty: new_qty,
                            prod_id: prod_id,
                            prodSize: prodSize,
                        });
                        break;
                    default:
                        break;
                }
            }
        });

        // Acciones dentro del dropdown de cantidad
        qtyDropdownMenu.addEventListener("click", (e) => {
            const elem = e.target;
            let new_qty;

            if (elem.tagName == "SPAN") {
                let idx = [...qtyDropdownMenu.children].indexOf(elem);

                if (idx == 0 || idx == 10) {
                    if (idx == 0) {
                        del_prod_cart(prod_id, prodSize);
                        updateMenuQty(-actualQty);
                        prod_card.remove();
                        qtyDropdownMenu.blur();
                    } else {
                        // Creamos el selector de unidades
                        let checkboxDiv = document.createElement("div");
                        checkboxDiv.classList.add("textbox_qty_wrapper");
                        checkboxDiv.innerHTML = `<input type="text" name="prod_qty" value="${actualQty}">
                        <button class="qty_checkbox_btn">Actualizar</button>`;

                        // Reemplazamos el selector de unidades
                        prod_qty_wrapper_clicked.replaceWith(checkboxDiv);

                        // Cerramos el dropdown
                        qtyDropdownMenu.blur();
                    }
                } else {
                    new_qty = idx;
                    update_qty_prod(prod_id, idx, prodSize);
                    updateMenuQty(new_qty - actualQty);

                    // Cambiamos el número de unidades en el botón
                    prod_qty_wrapper_clicked.getElementsByClassName(
                        "prod_qty_number"
                    )[0].innerHTML = idx;
                    qtyDropdownMenu.blur();
                }

                if (idx != 10) {
                    prodSize =
                        prod_qty_wrapper_clicked.closest(".cart_item").dataset
                            .prodSize;
                    updateTotals({
                        newQty: new_qty,
                        prod_id: prod_id,
                        prodSize: prodSize,
                    });
                }
            }
        });

        // Para que funcionen las tabs de las listas
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
                    // FIX Mirar si esto se puede hacer pasando datos desde PHP
                    // TODO optimizar esto en cualquier caso
                    buyed_prods_get_info();
                } else {
                    list_content.innerHTML = prev_buyed_content;
                }
            }
        });
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

function modifyProdQty(prodQty) {
    const prod_qty = document.getElementById("prod_qty"),
        add_qty_btn = document.getElementById("add_prod_qty_btn"),
        sub_qty_btn = document.getElementById("subs_prod_qty_btn");

    add_qty_btn.addEventListener("click", () => {
        prodQty[0]++;
        prod_qty.textContent = prodQty[0];
    });

    sub_qty_btn.addEventListener("click", () => {
        if (prodQty[0] > 1) {
            prodQty[0]--;
            prod_qty.textContent = prodQty[0];
        }
    });
}

function prodInfoTabs() {
    const nut_info_tab = document.getElementById("nut_info_tabs").children[0],
        nut_info_tab_content = document.getElementById("nut_info_content"),
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
                let innerContent = "<div id='alergList'>";

                allergens.forEach((allergen) => {
                    innerContent += `<div class='allergen'>
                    <img src='/DAW_proyecto_final/assets/icons/alerg/${allergen.internalName}.svg' alt='${allergen.name}'>
                    ${allergen.name}
                    </div>`;
                });
                innerContent += "</div>";
                nut_info_tab_content.innerHTML = innerContent;
            } else {
                nut_info_tab_content.innerHTML =
                    "<p>No se han proporcionado alérgenos para este producto</p>";
            }
        }
    });
}

function setupSimilarProdCards() {
    const similar_prod_cards =
        document.getElementsByClassName("all_sim_prods")[0];

    similar_prod_cards.addEventListener("click", (e) => {
        if (e.target.classList[0] != "all_sim_prods") {
            const prod_id = e.target.closest(".sim_prod").dataset.id;

            if (e.target.tagName == "IMG") {
                window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod_id}`;
            } else if (e.target.tagName == "BUTTON") {
                e.preventDefault();
                add_product_cart(prod_id, 0, 1);
            }
        }
    });
}

// Para las tarjetas de producto (shop, cat_shop)
function setupProductCards() {
    const productsWrapper = document.getElementById("products");

    productsWrapper.addEventListener("click", (e) => {
        e.stopPropagation();

        if (e.target.tagName == "IMG") {
            const prod_id = e.target.closest(".product").dataset.id;
            const elemPadre = e.target.parentElement;

            switch (elemPadre.classList[0]) {
                case "like_btn":
                    let isFaved = elemPadre.classList.contains("faved");

                    like_product(prod_id, isFaved);

                    // Estilo
                    elemPadre.classList.toggle("faved");
                    elemPadre.children[0].src = isFaved
                        ? "/DAW_proyecto_final/assets/icons/fav.svg"
                        : "/DAW_proyecto_final/assets/icons/fav_full.svg";
                    break;
                case "add_cart_btn":
                    add_product_cart(prod_id, 0, 1);
                    updateMenuQty(1);
                    elemPadre.classList.add("add_cart_btn_clicked");
                    setTimeout(() => {
                        elemPadre.classList.remove("add_cart_btn_clicked");
                    }, 200);
                    break;
                case "product_img_wrapper":
                    window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod_id}`;
                    break;
                default:
                    break;
            }
        }
    });
}

// Para carrito
function showQtyDropdown(qtyWrapper, actualQty) {
    const prod_id = qtyWrapper.closest(".cart_item").dataset.id,
        qty_dropdown = document.getElementById("qty_select_dropdown"),
        qtyWrapperRect = qtyWrapper.getBoundingClientRect();

    qty_dropdown.style.display = "flex";
    qty_dropdown.style.top = `${qtyWrapperRect.top + window.scrollY}px`;
    qty_dropdown.style.left = `${qtyWrapperRect.left}px`;

    if (actualQty > 0 && actualQty < 10) {
        qty_dropdown.children[actualQty].classList.add("selected_qty");
    }
    qty_dropdown.focus();
}

function updateTotals({ nextStatus = null, newQty, prod_id, prodSize }) {
    const cartTotals = [...document.getElementsByClassName("subtotal_text")];

    let productOnFocus = allCartProds.find(
            (prod) => prod.product.$oid == prod_id
        ).sizes[prodSize],
        productInfoOnFocus = allProductsInfo.find(
            (prod) => prod._id.$oid == prod_id
        ).stock[prodSize];

    let qtyDiff = Math.abs(productOnFocus.qty - newQty);
    if (nextStatus != null) {
        if (nextStatus) {
            totalPrice += productInfoOnFocus.price * qtyDiff;
            totalProds += qtyDiff;
        } else {
            totalPrice -= productInfoOnFocus.price * qtyDiff;
            totalProds -= qtyDiff;
        }
    } else {
        totalPrice += productInfoOnFocus.price * (newQty - qtyDiff);
        totalProds += newQty - qtyDiff;
    }

    let sing = totalProds > 1 ? "s" : "";
    cartTotals.forEach((total) => {
        total.innerHTML = `
            <span>Subtotal (${totalProds} producto${sing}): </span>
            <span>${totalPrice.toFixed(2)} €</span>`;
    });
}

function del_in_cart_item_card(element) {
    if (allCartProds.length > 1) {
        element.remove();
    } else {
        element.parentElement.innerHTML =
            "<p>No hay productos en el carrito</p>";
        // TODO Cambiar también los totales
    }
}

// REV Hacer que cuando el elemento no esté visible, que se puedan seguir cambiando los datos
// Se podría hacer ocultando el elemento sin sustituirlo con un innerHTML cuando se selecciona la otra tab
function recalculateNutritionalInfo(prodSize) {
    const tableContent =
            document.getElementById("nut_info_content").children[0].children[0],
        energy = tableContent.children[1].children[2],
        totFat = tableContent.children[2].children[2],
        satFat = tableContent.children[3].children[2],
        totCarbs = tableContent.children[4].children[2],
        sugars = tableContent.children[5].children[2],
        protein = tableContent.children[6].children[2],
        salt = tableContent.children[7].children[2];

    const nutInfoContainer = document.getElementById("size_selector");
    nutInfoContainer.addEventListener("click", (e) => {
        if (e.target.tagName == "INPUT") {
            prodSize[0] = parseInt(e.target.value);

            if (prodSize[0] !== -1) {
                const selectedSize = product.stock[prodSize[0]].weight / 100;
                const prodInfo = product.nut_info;

                energy.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.kcals * 4.184
                )}kJ / ${formatNumberDecimal(
                    selectedSize * prodInfo.kcals
                )}kcal`;
                totFat.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.fats.total
                )}g`;
                satFat.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.fats.sat
                )}g`;
                totCarbs.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.carbs.total
                )}g`;
                sugars.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.carbs.sugar
                )}g`;
                protein.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.prots
                )}g`;
                salt.innerHTML = `${formatNumberDecimal(
                    selectedSize * prodInfo.salt
                )}g`;
            }
        }
    });
}

function formatNumberDecimal(number) {
    return number % 1 == 0 ? number.toFixed(0) : number.toFixed(2);
}
