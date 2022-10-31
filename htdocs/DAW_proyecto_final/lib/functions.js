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
