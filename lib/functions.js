function like_product(id, favedStatus) {
    let data = {
        action: "like",
        id: id,
        status: favedStatus,
    };
    send_data(data, "shop_logic");
}

function save_for_later(id) {
    let data = {
        action: "save_for_later",
        id: id,
    };
    send_data(data, "cart_logic");
}

function add_product_cart(id, size = 0, qty = 1) {
    let data = {
        action: "add_cart",
        id: id,
        size: size,
        qty: qty,
    };
    send_data(data, "shop_logic");
}

function buyed_prods_get_info() {
    fetch("/DAW_proyecto_final/modules/cart_logic.php", {
        method: "GET",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((json) => {
            let list_content = document.getElementById("list_prod_wrapper");

            list_content.innerHTML = "";
            for (const prod of json) {
                list_content.innerHTML += `
                <div class="list_product" data-id="${prod.prod_id.$oid}">
                    <img src="/DAW_proyecto_final/assets/db_data/products/${prod.prod_img}.jpg" alt="Imagen de producto">

                    <p class="product_name">${prod.prod_name}</p>
                    <p class="producer_name">Vendido por: <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=${prod.producer_id.$oid}">${prod.producer_name}</a></p>
                    <p class="price">${prod.prod_price}<span>€</span></p>
                    <p class="remaining">Quedan ${prod.prod_stock} unidades</p>
                    <div class="list_item_cta">
                        <button>Mover a la cesta</button>
                        <a href="">Eliminar</a>
                        <a href="">Ver productos similares</a>
                    </div>
                </div>`;
            }
            return list_content.innerHTML;
        });
}

function update_selected_prod(product_id, destinationStatus, prod_size) {
    let data = {
        action: "update_selected_prod",
        id: product_id,
        status: destinationStatus,
        size: prod_size,
    };
    send_data(data, "cart_logic");
}

function update_qty_prod(product_id, newProdQty, prod_size) {
    let data = {
        action: "update_prod_qty",
        id: product_id,
        qty: newProdQty,
        size: prod_size,
    };
    send_data(data, "cart_logic");
}

function del_prod_cart(product_id, prod_size) {
    let data = {
        action: "del_prod_cart",
        id: product_id,
        size: prod_size,
    };
    console.log(data);
    send_data(data, "cart_logic");
}

function send_data(data, processFile) {
    fetch(`/DAW_proyecto_final/modules/${processFile}.php`, {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    }).then((response) => response.text());
}

function show_log_reg() {
    // OJO Al hacer fetch, se crea una session nueva, con lo cual todos los datos de est se borran -- se puede pasar la ID de la sesion así: https://www.php.net/manual/en/session.idpassing.php
    fetch("/DAW_proyecto_final/templates/components/login.php", {
        method: "GET",
    })
        .then((response) => response.text())
        .then((text) => {
            if (document.getElementById("access_view") == null) {
                document.getElementsByTagName("body")[0].innerHTML += text;

                // Para cerrar el menú de login y registro
                let close_login = document.getElementById("close_access_view");
                close_login.onclick = hide_log_reg;

                // Para cambiar de login a registro
                let reg_btn = document.getElementById("reg_btn");
                reg_btn.onclick = show_register;
            }
        });
}

function hide_log_reg() {
    document.getElementById("access_view").remove();
}

function show_register() {
    fetch("/DAW_proyecto_final/templates/components/register.php", {
        method: "GET",
    })
        .then((response) => response.text())
        .then((text) => {
            if (document.getElementById("forms")) {
                document.getElementById("forms").innerHTML = text;
            }
        });
}

// Carga el contenido de la conversación
function load_conversation(elem) {
    fetch(
        `/DAW_proyecto_final/templates/components/dash/blocks/chat_box.php?conv=${elem}`,
        { method: "GET" }
    )
        .then((response) => response.text())
        .then((text) => {
            if (document.getElementById("conversation")) {
                document.getElementById("conversation").innerHTML = text;
            }
        });
}

// Envía un mensaje
function send_message(user, id) {
    let data = {
        user: user,
        content: document.getElementById("msgBox").value,
        chatID: id,
    };

    fetch("/DAW_proyecto_final/modules/send_message.php", {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
}

// Actualiza la tarjeta de la conversación con tu último mensaje
function update_conversation_card(chat_id) {
    let card = document.querySelector(`[data-conv-id="${chat_id}"]`);
    card.getElementsByClassName("last_msg")[0].innerHTML =
        "Tu: " + document.getElementById("msgBox").value;
}

// Al presionar enter en el input de mensaje, se envía el mensaje
function send_on_enter(e, user, id) {
    if (e.key == "Enter") {
        send_message(user, id);
        load_conversation(id);
        update_conversation_card(id);
    }
}

// Dashboard profile
// Para sustituir el texto por texfields al hacer click en el botón editar
function toggleEditBtns() {
    let botonesEdit = document.getElementsByClassName("profile_edit_btns");

    for (const btns of botonesEdit) {
        let celdaAnterior = btns.previousElementSibling;
        let prevValue = celdaAnterior.innerText;

        // Editar
        btns.children[0].addEventListener("click", () => {
            celdaAnterior.innerHTML = `<input type="text" value="${celdaAnterior.innerText}">`;

            for (const btn of btns.children) {
                btn.classList.toggle("hidden");
            }
        });

        // Aceptar
        btns.children[1].addEventListener("click", () => {
            for (const btn of btns.children) {
                btn.classList.toggle("hidden");
            }

            // TODO Hacer el fetch para actualizar los datos
            fetch("/DAW_proyecto_final/modules/dash_logic.php", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    action: "mod_prof_info",
                    field: celdaAnterior.getAttribute("data-field"),
                    value: btns.previousElementSibling.firstChild.value,
                }),
            });
            // .then((response) => response.text())
            // .then((text) => console.log(text));

            celdaAnterior.innerHTML =
                btns.previousElementSibling.children[0].value;
        });

        // Cancelar
        btns.children[2].addEventListener("click", () => {
            for (const btn of btns.children) {
                btn.classList.toggle("hidden");
            }

            celdaAnterior.innerHTML = prevValue;
        });
    }
}

// Filtro subcategorías
function subCat_filter() {
    let subcatBtns = document.getElementsByClassName("subcat_button"),
        subcatContainers = document.getElementsByClassName("prod_subcat");

    for (const btn of subcatBtns) {
        btn.addEventListener("click", () => {
            let activeBtn = Array.from(subcatBtns).filter((btn) => {
                return btn.classList.contains("subcat_button_selected");
            });

            if (activeBtn.length == 1 && activeBtn[0] != btn) {
                activeBtn[0].classList.remove("subcat_button_selected");
            }
            btn.classList.add("subcat_button_selected");

            activeBtn = Array.from(subcatBtns).filter((btn) => {
                return btn.classList.contains("subcat_button_selected");
            });

            // Si el botón clicado es el de "Todas las subcategorías"
            if (btn.dataset.subcat == "all") {
                for (const subCatContainer of subcatContainers) {
                    subCatContainer.classList.remove("hidden");
                }
            } else {
                for (const subCatContainer of subcatContainers) {
                    let mustBeVisible =
                        subCatContainer.getAttribute("data-subcatgroup") ==
                        btn.getAttribute("data-subcat");

                    subCatContainer.classList.toggle("hidden", !mustBeVisible);
                }
            }
        });
    }
}
