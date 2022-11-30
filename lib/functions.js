function like_product(id) {
    let data = {
        action: 'like',
        id: id
    }
    send_data(data)
}

function add_product_cart(id) {
    let data = {
        action: 'add_cart',
        id: id
    }
    send_data(data)
}

function send_data(data) {
    fetch("/DAW_proyecto_final/modules/shop_logic.php", {
        method: 'POST',
        headers:{
            'Accept' : 'application/json',
            'Content-Type' : 'application/json',
        },
        body: JSON.stringify(data)
    })
        .then(response => response.text())
        .then(text => console.log(text))
}

function show_log_reg() {
    // OJO Al hacer fetch, se crea una session nueva, con lo cual todos los datos de est se borran -- se puede pasar la ID de la sesion así: https://www.php.net/manual/en/session.idpassing.php
    fetch("/DAW_proyecto_final/templates/login.php", { method: "GET" })
    .then(response => response.text())
    .then(text => {
        if (document.getElementById('access_view') == null) {
            document.getElementsByTagName('body')[0].innerHTML += text
        }
    })
}

function hide_log_reg() {
    document.getElementById('access_view').remove()
}

function show_register() {
    fetch("/DAW_proyecto_final/templates/register.php", { method: "GET" })
    .then(response => response.text())
    .then(text => {
        if (document.getElementById('forms')) {
            document.getElementById('forms').innerHTML = text
        }
    })
}