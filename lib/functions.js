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
    console.log('SHOW INICIADO')
    fetch("/DAW_proyecto_final/templates/login.php")
    .then(response => response.text())
    .then(text => {
        if (document.getElementById('access_view') == null) {
            document.getElementsByTagName('body')[0].innerHTML += text
        }
    })
    console.log('SHOW EJECUTADO')
}

function hide_log_reg() {
    document.getElementById('access_view').remove()
}

function show_register() {
    fetch("/DAW_proyecto_final/templates/register.php")
    .then(response => response.text())
    .then(text => {
        if (document.getElementById('forms')) {
            document.getElementById('forms').innerHTML = text
        }
    })
}