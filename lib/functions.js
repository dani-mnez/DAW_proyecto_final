function like_product(id) {
    let data = {
        action: "like",
        id: id,
    };
    send_data(data);
}

function add_product_cart(id) {
    let data = {
        action: "add_cart",
        id: id,
    };
    send_data(data);
}

function send_data(data) {
    fetch("/DAW_proyecto_final/modules/shop_logic.php", {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.text())
        .then((text) => console.log(text));
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
        chatID: id
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
    card.getElementsByClassName("last_msg")[0].innerHTML = "Tu: " + document.getElementById("msgBox").value;
}

// Al presionar enter en el input de mensaje, se envía el mensaje
function send_on_enter(e, user, id) {
    if (e.key == "Enter") {
        send_message(user, id);
        load_conversation(id);
        update_conversation_card(id);
    }
}